<?php
namespace ContentManager\Controller\Admin;

use ContentManager\Controller\AppController;

/**
 * PageContents Controller
 *
 * @property \ContentManager\Model\Table\PageContentsTable $PageContents
 */
class PageContentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pages']
        ];
        $pageContents = $this->paginate($this->PageContents);

        $this->set(compact('pageContents'));
        $this->set('_serialize', ['pageContents']);
    }

    /**
     * View method
     *
     * @param string|null $id Page Content id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pageContent = $this->PageContents->get($id, [
            'contain' => ['Pages']
        ]);

        $this->set('pageContent', $pageContent);
        $this->set('_serialize', ['pageContent']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pageContent = $this->PageContents->newEntity();
        if ($this->request->is('post')) {
            $pageContent = $this->PageContents->patchEntity($pageContent, $this->request->data);
            if ($this->PageContents->save($pageContent)) {
                $this->Flash->success(__('The page content has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page content could not be saved. Please, try again.'));
            }
        }
        $pages = $this->PageContents->Pages->find('list', ['limit' => 200]);
        $this->set(compact('pageContent', 'pages'));
        $this->set('_serialize', ['pageContent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Content id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pageContent = $this->PageContents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pageContent = $this->PageContents->patchEntity($pageContent, $this->request->data);
            if ($this->PageContents->save($pageContent)) {
                $this->Flash->success(__('The page content has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page content could not be saved. Please, try again.'));
            }
        }
        $pages = $this->PageContents->Pages->find('list', ['limit' => 200]);
        $this->set(compact('pageContent', 'pages'));
        $this->set('_serialize', ['pageContent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Content id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageContent = $this->PageContents->get($id);
        if ($this->PageContents->delete($pageContent)) {
            $this->Flash->success(__('The page content has been deleted.'));
        } else {
            $this->Flash->error(__('The page content could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
