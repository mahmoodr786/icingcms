<?php
namespace IcingManager\Controller\Admin;

use Cake\Cache\Cache;
use IcingManager\Controller\AppController;

/**
 * Settings Controller
 *
 * @property \IcingManager\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $settings = $this->paginate($this->Settings);

        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }

    /**
     * View method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $query = $this->Settings
            ->find('all')
            ->where(['key LIKE ' => "$id.%"]);

        $settings = $this->paginate($query);

        $this->set('settings', $settings);
        $this->set('name', $id);
        $this->set('_serialize', ['settings']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setting = $this->Settings->newEntity();
        if ($this->request->is('post')) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->_reloadCache();
                $this->Flash->success(__('The setting has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $settings = $this->Settings
            ->find('all')
            ->where(['key LIKE ' => "$id.%"])
            ->order(['order' => 'ASC'])
            ->all();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->request->data[$id];
            $settingIds = $this->request->data['ids'];
            foreach ($settings as $sKey => $setting) {
                $update = $this->Settings->get($settingIds[$sKey]);
                $update->val = $setting;
                $this->Settings->save($update);
            }
            $this->_reloadCache();
            $this->Flash->success(__('The settings has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }
    /**
     * Prop Edit method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function propEdit($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }
    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success(__('The setting has been deleted.'));
        } else {
            $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    private function _reloadCache()
    {
        $cacheSettings = [];
        $settings = $this->Settings->find()->all()->toArray();
        foreach ($settings as $setting) {
            $cacheSettings[$setting['key']] = $setting['val'];
        }
        if (($settings = Cache::read('settings', 'forever')) === false) {
            Cache::write('settings', $cacheSettings, 'forever');
        } else {
            Cache::delete('settings');
            Cache::write('settings', $cacheSettings, 'forever');
        }
    }
}
