<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ContentManager\View;

use App\View\AppView as View;
use Cake\Core\Configure;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link http://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $theme = Configure::read('site.theme');
        $this->loadHelper('ContentManager.Page');
        $this->loadHelper("$theme.Theme");
        $this->loadHelper("IcingManager.Icing");
    }
    /**
     * setPageData method
     * sets the page helper data
     * @param JSON $data
     * @return VOID
     */
    public function setPageData($data, $mode)
    {
        $this->Page->editMode = $mode;
        $pageData = [];
        if (!empty($data)) {
            foreach ($data as $content) {
                $pageData[$content->name] = $content->value;
            }
            $this->Page->data = $pageData;
        }
    }
    /**
     * getFormData
     * gets the form data back from page helper and gives to controller
     * @return $form HTML
     */
    public function getFormData()
    {
        return $this->Page->form;
    }
}
