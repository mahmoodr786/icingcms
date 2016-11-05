<?php
namespace ContentManager\Controller\Admin;

use Cake\Filesystem\File;
use ContentManager\Controller\AppController;

/**
 * PageTypes Controller
 *
 * @property \ContentManager\Model\Table\PageTypesTable $PageTypes
 */
class PageTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $pageTypes = $this->paginate($this->PageTypes);

        $this->set(compact('pageTypes'));
        $this->set('_serialize', ['pageTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Page Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pageType = $this->PageTypes->get($id, [
            'contain' => ['Pages'],
        ]);

        $this->set('pageType', $pageType);
        $this->set('_serialize', ['pageType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pageType = $this->PageTypes->newEntity();
        if ($this->request->is('post')) {
            $pageType = $this->PageTypes->patchEntity($pageType, $this->request->data);
            if ($this->PageTypes->save($pageType)) {
                $path = ROOT . 'plugins' . DS . 'ContentManager' . DS . 'src' . DS . 'Template' . DS . 'Pages' . DS;
                $fileName = $this->request->data['file_name'] . '.ctp';
                $page = new File($path . $fileName);
                $page->create();
                if ($page->exists()) {
                    $this->Flash->success(__('The page type has been saved and file is created.'));
                } else {
                    $this->Flash->error(__("The page type has been saved but Icing was unable to create the page file. Please create the {$fileName} here: {$path}"));
                }
                $page->close();
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pageType'));
        $this->set('_serialize', ['pageType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pageType = $this->PageTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pageType = $this->PageTypes->patchEntity($pageType, $this->request->data);
            if ($this->PageTypes->save($pageType)) {
                $this->Flash->success(__('The page type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pageType'));
        $this->set('_serialize', ['pageType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageType = $this->PageTypes->get($id);
        if ($this->PageTypes->delete($pageType)) {
            $this->Flash->success(__('The page type has been deleted.'));
        } else {
            $this->Flash->error(__('The page type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
