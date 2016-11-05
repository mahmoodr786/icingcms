<?php
namespace IcingManager\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Utility\Inflector;
use IcingManager\Controller\AppController;
use Migrations\Migrations;

/**
 * Plugins Controller
 *
 * @property \IcingManager\Model\Table\PluginsTable $Plugins
 */
class PluginsController extends AppController
{

    public $pluginsDir = ROOT . DS . 'plugins';

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $plugins = [];
        $pluginDirs = new Folder($this->pluginsDir);
        $pluginDirs = $pluginDirs->read();
        $activeplugins = $this->readLoadFile();
        foreach ($pluginDirs[0] as $pluginDir) {
            $pluginJson = $this->pluginsDir . DS . $pluginDir . DS . 'config' . DS . 'plugin.json';
            if (file_exists($pluginJson)) {
                $file = new File($pluginJson);
                $data = json_decode($file->read(), true);
                $isActive = array_search($pluginDir, array_column($activeplugins, 'name'));
                $isActive > -1 ? $data[0]['active'] = 'Yes' : $data[0]['active'] = 'No';
                $plugins[] = $data[0];

            }
            //else ignore core plugins and themes
        }
        $this->set(compact('plugins'));
        $this->set('_serialize', ['plugins']);
    }

    /**
     * Download method
     *
     * @return \Cake\Network\Response|null
     */

    public function download()
    {
        $plugins = file_get_contents('https://icingcms.org/api/plugins.json?limit=20');
        $this->set('plugins', $plugins);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add.
     */
    public function add()
    {
        $this->autoRender = false;
        $params = $this->request->query;
        if ((isset($params['url']) && !empty($params['url']))
            && ($params['folder_name']) && !empty($params['folder_name'])) {
            $downloaded = $this->downloadZip($params);
            if ($downloaded['error'] === false) {
                $this->Flash->success(__('The plugin has been installed'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__($downloaded['errorMsg']));
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->Flash->error(__('No Folder Name or URL. Please try again.'));
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Deactivate method
     *
     * @param string|null $pluginName Plugin folder name.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function deactivate($pluginName = null)
    {
        $this->autoRender = false;
        if (is_null($pluginName) or !is_dir($this->pluginsDir . DS . $pluginName)) {
            $this->Flash->error(__('Plugin not found.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->_deactivate($pluginName)) {
            $this->Flash->success(__('The plugin has been deactivated.'));
        } else {
            $this->Flash->error(__('The plugin could not be deactivated. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Activate method
     *
     * @param string|null $pluginName Plugin folder name.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function activate($pluginName = null)
    {
        $this->autoRender = false;
        if (is_null($pluginName) or !is_dir($this->pluginsDir . DS . $pluginName)) {
            $this->Flash->error(__('Plugin not found.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->_activate($pluginName);
    }
    public function migrate($pluginName = null)
    {
        if (!is_null($pluginName)) {
            $this->runMigrations($pluginName);
            $this->Flash->success(__('The plugin has been activated.'));
        } else {
            $this->Flash->error(__('The plugin could not be activated. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Delete method
     *
     * @param string|null $pluginName Plugin folder name.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function delete($pluginName = null, $rollback = 0)
    {
        if (is_null($pluginName) or !is_dir($this->pluginsDir . DS . $pluginName)) {
            $this->Flash->error(__('Plugin not found.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($rollback == 1) {
            $this->rollbackMigrations($pluginName);
            $phinxlog = Inflector::underscore($pluginName);
            $connection = ConnectionManager::get('default');
            $connection->execute('DROP TABLE IF EXISTS ' . $phinxlog . '_phinxlog');
        }

        if ($this->_deactivate($pluginName) && $this->rmDashrf($this->pluginsDir . DS . $pluginName)) {
            $this->Flash->success(__('The plugin has been deleted and deactivated.'));
        } else {
            $this->Flash->error(__('The plugin could not be deactivated or deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * _deactivate method
     * deactivate a plugin.
     * @param $pluginName: plugin folder name.
     * @return BOOL
     */
    private function _deactivate($pluginName)
    {
        $pluginDir = ROOT . DS . 'plugins';
        $pluginLoad = $this->readLoadFile();
        $newPluginLoad = [];

        foreach ($pluginLoad as $plugin) {
            if ($plugin['name'] != $pluginName) {
                $newPluginLoad[] = $plugin;
            }
        }
        $writeLoadFile = $this->writeLoadFile($newPluginLoad);
        if ($writeLoadFile) {
            return true;
        }
        return false;
    }
    /**
     * _activate method
     * activate a plugin.
     * @param $pluginName: plugin folder name.
     * @return BOOL
     */
    private function _activate($pluginName)
    {
        $pluginLoad = $this->readLoadFile();
        $pluginConfigDir = $this->pluginsDir . DS . $pluginName . DS . 'config' . DS;
        $routes = file_exists($pluginConfigDir . 'routes.php') ? true : false;
        $bootstrap = file_exists($pluginConfigDir . 'bootstrap.php') ? true : false;
        $newPluginLoad = [0 => ['name' => $pluginName, 'routes' => $routes, 'bootstrap' => $bootstrap]];
        $count = 1;
        foreach ($pluginLoad as $activePlugin) {
            $newPluginLoad[$count] = $activeplugin;
            $count++;
        }
        $writeLoadFile = $this->writeLoadFile($newPluginLoad);
        if ($writeLoadFile) {
            return $this->redirect(['action' => 'migrate', $pluginName]);
        }
        $this->Flash->error(__('The plugin could not be activated. Please, try again.'));
        return false;
    }
    /**
     * runMigrations method
     * quick wrapper to Migrations.
     * @param $plugin: plugin folder name.
     * @return BOOL
     */
    private function runMigrations($pluginName)
    {
        $plugin = ['plugin' => $pluginName];
        $migrations = new Migrations();
        $status = $migrations->status($plugin);
        if (!empty($status)) {
            $migrate = $migrations->migrate($plugin);
            if ($migrate) {
                $migrations->seed($plugin);
                return true;
            }
            return false;
        }
        return false;
    }
    /**
     * rollbackMigrations method
     * quick wrapper to rollback.
     * @param $plugin: plugin folder name.
     * @return BOOL
     */
    private function rollbackMigrations($plugin)
    {
        $plugin = ['plugin' => $plugin];
        $migrations = new Migrations();
        return $migrations->rollback($plugin);
    }
    /**
     * downloadZip method
     * This will download zip file from url and write to tmp folder.
     * It will then unzip the folder and runs a validation check.
     * @param url params: folder_name and url of the ziped file.
     * @return array
     */
    private function downloadZip($params)
    {
        $url = $params['url'];
        $folderName = $params['folder_name'];
        $tmpDir = ROOT . DS . 'tmp';
        $pluginDir = $this->pluginsDir;
        $plugin = file_put_contents($tmpDir . DS . 'plugin.zip', fopen($url, 'r'));
        $pluginTmpDir = $tmpDir . DS . 'plugins';
        $errorMsg = "";
        $pluginZip = $tmpDir . DS . 'plugin.zip';
        $zip = new \ZipArchive;
        $zipFile = $zip->open($pluginZip);
        if ($zipFile) {
            $zip->extractTo($pluginTmpDir);
            $zip->close();
            $this->rmDashrf($pluginZip);
            $pluginConfigFolder = $pluginTmpDir . DS . $folderName . DS . 'config' . DS;
            if (file_exists($pluginConfigFolder . DS . 'plugin.json')) {
                if (file_exists($pluginTmpDir . DS . $folderName . DS . 'vendor' . DS . 'autoload.php')) {
                    $pluginFolder = new Folder($pluginTmpDir . DS . $folderName);
                    $pluginFolder->copy($pluginDir . DS . $folderName);
                    if (is_dir($pluginDir . DS . $folderName)) {
                        $this->rmDashrf($pluginTmpDir);
                        return ['error' => false];

                    } else {
                        $this->rmDashrf($pluginTmpDir);
                        return [
                            'error' => true,
                            'errorMsg' => 'Unable to write to: ' . $pluginDir . ' Please make sure the folder owner is your webserver group.',
                        ];
                    }
                } else {
                    $this->rmDashrf($pluginTmpDir);
                    return [
                        'error' => true,
                        'errorMsg' => 'Plugin vendor' . DS . 'autoload.php file not found.',
                    ];
                }
            } else {
                $this->rmDashrf($pluginTmpDir);
                return [
                    'error' => true,
                    'errorMsg' => 'Plugin plugin.json file not found.',
                ];
            }
        } else {
            return ['error' => true, 'errorMsg' => 'Failed to extarct zip file. Please Make sure your tmp dir is writble'];
        }
    }
    /**
     * rmDashRf method
     * Will remove a folder with its files
     * @param string folder path
     * @return BOOL
     */
    private function rmDashrf($folderPath)
    {
        if (is_dir($folderPath)) {
            $folder = new Folder($folderPath);
            if ($folder->delete()) {
                return true;
            }
        }
        if (unlink($folderPath)) {
            return true;
        }
        return false;
    }
    /**
     * readLoadFile method
     * This will decode the plugin load json file into and arary.
     * @return Array
     */
    private function readLoadFile()
    {
        $loadFile = $this->pluginsDir . DS . 'IcingManager' . DS . 'config' . DS . 'pluginLoad.json';
        return json_decode(file_get_contents($loadFile), true);
    }
    /**
     * writeLoadFile method
     * This will encode array into json and write it.
     * @param array $contents
     * @return BOOL
     */
    private function writeLoadFile($contents)
    {
        $loadFile = $this->pluginsDir . DS . 'IcingManager' . DS . 'config' . DS . 'pluginLoad.json';
        return file_put_contents($loadFile, json_encode($contents));
    }
}
