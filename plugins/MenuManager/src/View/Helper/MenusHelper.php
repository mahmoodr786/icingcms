<?php
namespace MenuManager\View\Helper;

use Cake\Routing\Router;
use Cake\View\Helper;
use Cake\View\View;

/**
 * Menus helper
 */
class MenusHelper extends Helper
{

    public $helpers = ['Html', 'IcingManager.Icing']; // load Html and Icinghelper

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function create($menu = null)
    {
        $html = "";
        $groupedLinks = [];
        $orderedGroupedLinks = [];

        if (is_null($menu)) {
            return 'Menu not found.';
        }
        //group parent links
        foreach ($menu->links as $link) {
            if (is_null($link->parent_id)) {
                $groupedLinks[$link->id] = [
                    'link' => $link->toArray(), //convert to array
                    'children' => [],
                ];
            }
        }
        //add the child links
        foreach ($menu->links as $link) {
            if (!is_null($link->parent_id) && $link->parent_id > 0) {
                //order childeren
                $groupedLinks[$link->parent_id]['children'][$link->order] = $link->toArray(); //convert to array
            }
        }
        //order parent links
        foreach ($groupedLinks as $groupedLink) {
            $orderedGroupedLinks[$groupedLink['link']['order']] = $groupedLink;
        }
        foreach ($orderedGroupedLinks as $ogLink) {
            $html .= $this->_createLink($ogLink, $menu->tag, $menu->tag_attributes, $menu->list_tag, $menu->list_tag_attributes, $menu->dropdown_tag, $menu->dropdown_tag_attributes, $menu->dropdown_list_tag, $menu->dropdown_list_tag_attributes, $menu->active_class);
        }
        return $this->Html->tag($menu->tag, $html, $this->Icing->HTMLAttrsToArray($menu->tag_attributes));
    }
    public function isActive($url)
    {
        $urlStr = $url;
        $url = Router::parse($url);
        $params = $this->request->params;
        $prefix = isset($params['prefix']) ? $params['prefix'] : false;
        $controller = $params['controller'];
        $action = $params['action'];

        if ($controller == "Pages" && $action == 'display') {
            if (count($params['pass']) == 0 && $urlStr == '/') {
                return true;
            }
            if (count($params['pass']) > 0 && count($url['pass']) > 0) {
                $currentPageUrlStr = '/' . implode('/', $params['pass']);
                if ($currentPageUrlStr == $urlStr) {
                    return true;
                }
            }
            return false;
        }
        if ($prefix) {
            if ($url['controller'] == $controller && $url['action'] == $action && $url['prefix'] == $prefix) {
                return true;
            }
        } else {
            if ($url['controller'] == $controller && $url['action'] == $action) {
                return true;
            }
        }
        return false;
    }
    private function _createLink($ogLink, $tag, $tagAttrs, $listTag, $listTagAttrs, $dropdownTag, $dropdownTagAttrs, $dropdownListTag, $dropdownListTagAtrrs, $activeClass)
    {
        $parentAttrs = $this->Icing->HTMLAttrsToArray($listTagAttrs);
        $childerenHTML = "";

        if ($this->isActive($ogLink['link']['url'])) {
            $parentAttrs = $this->_addActiveClass($parentAttrs, $activeClass);
        }

        if (isset($ogLink['children']) && count($ogLink['children']) > 0) {
            $dropdownListTagAtrrs = $this->Icing->HTMLAttrsToArray($dropdownListTagAtrrs);
            foreach ($ogLink['children'] as $link) {
                if ($this->isActive($link['url'])) {
                    $dropdownListTagAtrrs = $this->_addActiveClass($dropdownListTagAtrrs, $activeClass);
                    //make sure parent is active
                    $parentAttrs = $this->_addActiveClass($parentAttrs, $activeClass);
                }
                $chLinkAttrs = $this->Icing->HTMLAttrsToArray($link['attributes']);
                $chLinkAttrs['escape'] = $link['allow_html'] === true ? false : true;
                $childerenHTML .= $this->Html->tag($dropdownListTag, $this->Html->link($link['name'], $link['url'], $chLinkAttrs), $dropdownListTagAtrrs);
            }
            $childerenHTML = $this->Html->tag($dropdownTag, $childerenHTML, $this->Icing->HTMLAttrsToArray($dropdownTagAttrs));
            $ogLink['link']['url'] = 'javascript:void(0)'; //make dropdown clickable.
        }
        $linkAttrs = $this->Icing->HTMLAttrsToArray($ogLink['link']['attributes']);
        $linkAttrs['escape'] = $ogLink['link']['allow_html'] === true ? false : true;
        return $this->Html->tag($listTag, $this->Html->link($ogLink['link']['name'], $ogLink['link']['url'], $linkAttrs) . $childerenHTML, $parentAttrs);
    }
    private function _addActiveClass($attrs = array(), $activeClass = null)
    {
        if (!is_null($activeClass)) {
            if (isset($attrs['class'])) {
                $attrs['class'] = $attrs['class'] . ' ' . $activeClass;
            } else {
                $attrs['class'] = $activeClass;
            }
        }
        return $attrs;
    }
}
