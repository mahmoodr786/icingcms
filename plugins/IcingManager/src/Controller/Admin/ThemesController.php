<?php
namespace IcingManager\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Utility\Inflector;
use IcingManager\Controller\AppController;
use Migrations\Migrations;

/**
 * Themes Controller
 *
 * @property \IcingManager\Model\Table\ThemesTable $Themes
 */
class ThemesController extends AppController
{

    public $themesDir = ROOT . DS . 'plugins';

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $themes = [];
        $themeDirs = new Folder($this->themesDir);
        $themeDirs = $themeDirs->read();
        $activethemes = $this->readLoadFile();
        foreach ($themeDirs[0] as $themeDir) {
            $themeJson = $this->themesDir . DS . $themeDir . DS . 'config' . DS . 'theme.json';
            if (file_exists($themeJson)) {
                $file = new File($themeJson);
                $data = json_decode($file->read(), true);
                $isActive = array_search($themeDir, array_column($activethemes, 'name'));
                $isActive > -1 ? $data[0]['active'] = 'Yes' : $data[0]['active'] = 'No';
                $data[0]['is_primary'] = $activethemes[0]['name'] == $themeDir ? true : false;
                $themes[] = $data[0];

            }
            //else ignore core themes and plugins
        }
        $this->set(compact('themes'));
        $this->set('_serialize', ['themes']);
    }

    /**
     * Download method
     *
     * @return \Cake\Network\Response|null
     */

    public function download()
    {
        $themes = file_get_contents('https://icingcms.org/api/themes.json?limit=20');
        $this->set('themes', $themes);
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
                $this->Flash->success(__('The theme has been installed'));
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
     * @param string|null $themeName theme folder name.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function deactivate($themeName = null)
    {
        $this->autoRender = false;
        if (is_null($themeName) or !is_dir($this->themesDir . DS . $themeName)) {
            $this->Flash->error(__('theme not found.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->_deactivate($themeName)) {
            $this->Flash->success(__('The theme has been deactivated.'));
        } else {
            $this->Flash->error(__('The theme could not be deactivated. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Activate method
     *
     * @param string|null $themeName theme folder name.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function activate($themeName = null, $makePrimary = null)
    {
        $this->autoRender = false;
        if (is_null($themeName) or !is_dir($this->themesDir . DS . $themeName)) {
            $this->Flash->error(__('theme not found.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->_activate($themeName, $makePrimary);
    }
    public function migrate($themeName = null)
    {
        if (!is_null($themeName)) {
            $this->runMigrations($themeName);
            $this->Flash->success(__('The theme has been activated.'));
        } else {
            $this->Flash->error(__('The theme could not be activated. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Delete method
     *
     * @param string|null $themeName theme folder name.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function delete($themeName = null, $rollback = 0)
    {
        if (is_null($themeName) or !is_dir($this->themesDir . DS . $themeName)) {
            $this->Flash->error(__('theme not found.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($rollback == 1) {
            $this->rollbackMigrations($themeName);
            $phinxlog = Inflector::underscore($themeName);
            $connection = ConnectionManager::get('default');
            $connection->execute('DROP TABLE IF EXISTS ' . $phinxlog . '_phinxlog');
        }

        if ($this->_deactivate($themeName) && $this->rmDashrf($this->themesDir . DS . $themeName)) {
            $this->Flash->success(__('The theme has been deleted and deactivated.'));
        } else {
            $this->Flash->error(__('The theme could not be deactivated or deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * _deactivate method
     * deactivate a theme.
     * @param $themeName: theme folder name.
     * @return BOOL
     */
    private function _deactivate($themeName)
    {
        $themeDir = ROOT . DS . 'themes';
        $themeLoad = $this->readLoadFile();
        $newthemeLoad = [];

        foreach ($themeLoad as $theme) {
            if ($theme['name'] != $themeName) {
                $newthemeLoad[] = $theme;
            }
        }
        $writeLoadFile = $this->writeLoadFile($newthemeLoad);
        if ($writeLoadFile) {
            return true;
        }
        return false;
    }
    /**
     * _activate method
     * activate a theme.
     * @param $themeName: theme folder name.
     * @return BOOL
     */
    private function _activate($themeName, $makePrimary)
    {
        $themeLoad = $this->readLoadFile();
        $themeConfigDir = $this->themesDir . DS . $themeName . DS . 'config' . DS;
        $routes = file_exists($themeConfigDir . 'routes.php') ? true : false;
        $bootstrap = file_exists($themeConfigDir . 'bootstrap.php') ? true : false;
        $newLoadFile = [0 => ['name' => $themeName, 'routes' => $routes, 'bootstrap' => $bootstrap]];
        $count = 1;
        foreach ($themeLoad as $activeTheme) {
            $newLoadFile[$count] = $activeTheme;
            $count++;
        }
        $writeLoadFile = $this->writeLoadFile($newLoadFile);
        if ($writeLoadFile && $makePrimary == 0) {
            return $this->redirect(['action' => 'migrate', $themeName]);
        } elseif ($writeLoadFile && $makePrimary == 1) {
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The theme could not be activated. Please, try again.'));
        return false;
    }
    /**
     * runMigrations method
     * quick wrapper to Migrations.
     * @param $theme: theme folder name.
     * @return BOOL
     */
    private function runMigrations($themeName)
    {
        $theme = ['plugin' => $themeName];
        $migrations = new Migrations();
        $status = $migrations->status($theme);
        if (!empty($status)) {
            $migrate = $migrations->migrate($theme);
            if ($migrate) {
                $migrations->seed($theme);
                return true;
            }
            return false;
        }
        return false;
    }
    /**
     * rollbackMigrations method
     * quick wrapper to rollback.
     * @param $theme: theme folder name.
     * @return BOOL
     */
    private function rollbackMigrations($theme)
    {
        $theme = ['plugin' => $theme];
        $migrations = new Migrations();
        return $migrations->rollback($theme);
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
        $themeDir = $this->themesDir;
        $theme = file_put_contents($tmpDir . DS . 'theme.zip', fopen($url, 'r'));
        $themeTmpDir = $tmpDir . DS . 'themes';
        $errorMsg = "";
        $themeZip = $tmpDir . DS . 'theme.zip';
        $zip = new \ZipArchive;
        $zipFile = $zip->open($themeZip);
        if ($zipFile) {
            $zip->extractTo($themeTmpDir);
            $zip->close();
            $this->rmDashrf($themeZip);
            $themeConfigFolder = $themeTmpDir . DS . $folderName . DS . 'config' . DS;
            if (file_exists($themeConfigFolder . DS . 'theme.json')) {
                if (file_exists($themeTmpDir . DS . $folderName . DS . 'vendor' . DS . 'autoload.php')) {
                    $themeFolder = new Folder($themeTmpDir . DS . $folderName);
                    $themeFolder->copy($themeDir . DS . $folderName);
                    if (is_dir($themeDir . DS . $folderName)) {
                        $this->rmDashrf($themeTmpDir);
                        return ['error' => false];

                    } else {
                        $this->rmDashrf($themeTmpDir);
                        return [
                            'error' => true,
                            'errorMsg' => 'Unable to write to: ' . $themeDir . ' Please make sure the folder owner is your webserver group.',
                        ];
                    }
                } else {
                    $this->rmDashrf($themeTmpDir);
                    return [
                        'error' => true,
                        'errorMsg' => 'theme vendor' . DS . 'autoload.php file not found.',
                    ];
                }
            } else {
                $this->rmDashrf($themeTmpDir);
                return [
                    'error' => true,
                    'errorMsg' => 'theme theme.json file not found.',
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
     * This will decode the theme load json file into and array.
     * @return Array
     */
    private function readLoadFile()
    {
        $loadFile = $this->themesDir . DS . 'IcingManager' . DS . 'config' . DS . 'themeLoad.json';
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
        $loadFile = $this->themesDir . DS . 'IcingManager' . DS . 'config' . DS . 'themeLoad.json';
        return file_put_contents($loadFile, json_encode($contents));
    }
}
