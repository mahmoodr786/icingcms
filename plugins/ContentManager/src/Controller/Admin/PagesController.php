<?php
namespace ContentManager\Controller\Admin;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use ContentManager\Controller\AppController;
use ContentManager\View\AppView as View;

/**
 * Pages Controller
 *
 * @property \ContentManager\Model\Table\PagesTable $Pages
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
        parent::beforeFilter($event);
        $this->Security->config('unlockedActions', ['edit']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PageTypes', 'Roles'],
        ];
        $this->set('pages', $this->paginate($this->Pages));
        $this->set('_serialize', ['pages']);
    }

    /**
     * View method
     *
     * @param string|null $id Page id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => ['PageTypes', 'Roles', 'PageContents'],
        ]);
        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $page = $this->Pages->newEntity();
        if ($this->request->is('post')) {
            $page = $this->Pages->patchEntity($page, $this->request->data);
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }

        $pageTypes = $this->Pages->PageTypes->find('list', ['limit' => 200]);
        $roles = $this->Pages->Roles->find('list', ['limit' => 200]);
        $this->set(compact('page', 'pageTypes', 'roles'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $html = "";
        $page = $this->Pages->get($id, [
            'contain' => ['PageTypes', 'Roles', 'PageContents'],
        ]);
        //rendering here
        //Try to render page.
        try {
            $view = new View();
            $view->setPageData($page->page_contents, true);
            $view->set(compact('page'));
            $html = $view->render('ContentManager.Pages/' . $page->page_type->file_name, false);
            $html = $view->getFormData();
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
        //end of rendering
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contents = $this->request->data['PageContents'];
            unset($this->request->data['PageContents']);
            $page = $this->Pages->patchEntity($page, $this->request->data);
            $this->_savePageContents($page, $contents);
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));
                return $this->redirect(['action' => 'edit', $page->id]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }
        $pageTypes = $this->Pages->PageTypes->find('list', ['limit' => 200]);
        $roles = $this->Pages->Roles->find('list', ['limit' => 200]);
        $this->set(compact('page', 'pageTypes', 'roles', 'html'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * savePageContents method
     * @param type $page
     * @param type|array $contents
     * @return BOOL
     */
    private function _savePageContents($page, $contents = array())
    {
        $pageID = $page->id;
        $pageContents = $this->Pages->PageContents->find('list')->where(['PageContents.page_id' => $pageID])->toArray();
        $pageContents = array_flip($pageContents);
        $adds = [];
        $updates = [];
        foreach ($contents as $key => $content) {
            if (is_array($content)) {
                if (isset($pageContents[$key])) {
                    $updates[$key] = serialize($content);
                } else {
                    $adds[$key] = serialize($content);
                }
            } else {
                if (isset($pageContents[$key])) {
                    $updates[$key] = $content;
                } else {
                    $adds[$key] = $content;
                }
            }
        }
        $pageContentsTable = TableRegistry::get('ContentManager.PageContents');
        foreach ($adds as $key => $add) {
            $pageContent = $pageContentsTable->newEntity();
            $pageContent->page_id = $pageID;
            $pageContent->name = $key;
            $pageContent->value = $add;
            $pageContent->created = date('Y-m-d H:i:s');
            $pageContent->modified = date('Y-m-d H:i:s');
            $pageContentsTable->save($pageContent);
        }
        foreach ($updates as $key => $update) {
            $pageContent = $pageContentsTable->get($pageContents[$key]);
            $pageContent->value = $update;
            $pageContent->modified = date('Y-m-d H:i:s');
            $pageContentsTable->save($pageContent);
        }
        return true;
    }
}
