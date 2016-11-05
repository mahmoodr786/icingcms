<?php
namespace IcingManager\View\Helper;

use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;
use Cake\View\Helper;
use Cake\View\View;

/**
 * Icing helper
 */
class IcingHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * HTMLAttrsToArray method
     * @param $attrsString a string of attrs: class="foo" name="bar"
     * @return array
     */
    public function HTMLAttrsToArray($attrString = null)
    {
        $attrs = [];
        if (!is_null($attrString) && !empty($attrString)) {
            $string = '<bar><foo ' . $attrString . '>1</foo></bar>';
            $xml = @simplexml_load_string($string);
            if ($xml) {
                $attrs = (array) $xml->foo[0]->attributes();
                return $attrs['@attributes'];
            }
        }
        return $attrs;
    }
    /**
     * parentKey method
     * @param String $fullkey Theme.Site
     * @return String Theme
     */
    public function parentKey($fullKey = null)
    {
        if (!is_null($fullKey) && !empty($fullKey)) {
            $fullKey = explode('.', $fullKey);
            return $fullKey[0];
        }
        return '';
    }
    /**
     * settingsGetKey method
     * Checks if settings cache exists if not it will create it.
     * It will try to find the
     * @param type|null $key
     * @return String Value or BOOL false
     */
    public function settingsRead($key = null)
    {
        $settings = [];

        if (is_null($key)) {
            return false;
        }

        if (($settings = Cache::read('settings', 'forever')) === false) {
            $cacheSettings = [];
            $settingsTable = TableRegistry::get('Settings');
            $settings = $settingsTable->find()->all()->toArray();
            foreach ($settings as $setting) {
                $cacheSettings[$setting['key']] = $setting['val'];
            }
            Cache::write('settings', $cacheSettings, 'forever');
            $settings = $cacheSettings;
        }

        if (isset($settings[$key])) {
            return $settings[$key];
        }

        return false;
    }
}
