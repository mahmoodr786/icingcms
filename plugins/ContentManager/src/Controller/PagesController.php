<?php

namespace ContentManager\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use ContentManager\Controller\AppController;
use ContentManager\View\AppView as View;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * @param \Cake\Event\Event $event The beforeFilter event.
     * beforeFilter Method
     * Runs before any other function.
     * @return Void
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
    }
    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {

        $this->autoRender = false;
        $theme = Configure::read('site.theme');
        //reconstruct the URL
        $path = func_get_args();
        $path = '/' . implode('/', $path);
        //Find the page by URL
        $page = $this->Pages->find()
            ->contain(['PageTypes', 'PageContents'])
            ->where(['url' => $path, 'status' => 1])
            ->first();
        //Do we have a page?
        if (isset($page->id) && $page->id > 0) {
            //Try to render page.
            try {
                $view = new View();
                $view->setPageData($page->page_contents, false);
                $view->set(compact('page'));
                if (!empty($page->page_type->layout)) {
                    $html = $view->render('ContentManager.Pages/' . $page->page_type->file_name, $theme . '.' . $page->page_type->layout);
                } else {
                    $html = $view->render('ContentManager.Pages/' . $page->page_type->file_name, false);
                }
                echo $html;
            } catch (MissingTemplateException $e) {
                if (Configure::read('debug')) {
                    throw $e;
                }
                throw new NotFoundException();
            }
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }
}
