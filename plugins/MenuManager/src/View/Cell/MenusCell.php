<?php
namespace MenuManager\View\Cell;

use Cake\View\Cell;

/**
 * Menus cell
 */
class MenusCell extends Cell
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($key = null)
    {
        $error = false;
        $errorMsg = "";
        $menu = null;

        if (is_null($key)) {
            $error = true;
            $errorMsg = "Menu key is not set.";
        } else {
            //make sure you add the plugin name to model.
            $this->loadModel('MenuManager.Menus');
            $menu = $this->Menus->find()
                ->where(['Menus.key' => $key])
                ->contain(['Links' => function ($q) {
                    return $q->where(['Links.status' => 1])->order(['order' => 'ASC']);
                },
                ])
                ->first();
            if (isset($menu->id) && $menu->id > 0) {
                $error = false;
                $errorMsg = "";
            } else {
                $error = true;
                $errorMsg = "A Menu with that key is not found.";
            }
        }
        $this->set(compact('error', 'errorMsg', 'menu'));
    }
}
