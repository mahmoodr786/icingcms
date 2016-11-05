<?php
namespace FileManager\Controller\Admin;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Request\Request;
use FileManager\Controller\AppController;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as Filesystem;

/**
 * Files Controller
 *
 */
class FilesController extends AppController
{

    public $uploadDir;
    public $filesUrl;
    public $formats;

    public function initialize()
    {
        parent::initialize();
        //S3
        //$this->uploadDir = 'ADA'; //prefix
        //$this->filesUrl = "https://s3.amazonaws.com/720emails/ADA"; //public url path
        $this->uploadDir = WWW_ROOT . 'uploads' . DS;
        $this->filesUrl = "/uploads/";
        $this->formats['img'] = ['png', 'jpg', 'jpeg', 'bmp'];
        $this->formats['doc'] = ['xls', 'xlsx', 'doc', 'docx', 'pdf', 'ppt', 'pptx'];
        $this->formats['video'] = ['webm', 'mp4', 'avi', 'mov', '.mkv', 'wmv', 'flv', 'm4v'];
        $this->formats['audio'] = ['mp3', 'm4a', 'mka', 'wma', 'ogg', 'aiff'];
    }
    /**
     * beforeFilter Method
     * runs before any functions
     *
     *
     */

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->eventManager()->off($this->Csrf);
        $this->Security->config('unlockedActions', ['upload', 'movefiles', 'deletefiles']);
    }

    /**
     * Before render callback.
     * This is where ThemeManager sets the layout or the Theme.
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $params = $this->request->query;
        if (isset($params['iframe']) && $params['iframe'] == 1) {
            $this->viewBuilder()->layout('iframe');
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $params = $this->request->query;
        $filesUrl = $this->filesUrl;
        $formats = $this->formats;
        $formats['video'] = ['webm', 'mp4']; //playable
        $formats['audio'] = ['mp3', 'ogg']; // playable
        $this->set(compact('filesUrl', 'formats', 'params'));
    }
    /**
     * GetFiles method
     * AJAX
     * http://flysystem.thephpleague.com/api/
     * @return void
     */
    public function getfiles()
    {

        $params = $this->request->query;
        $dir = $this->_getDir();
        $crumbs = $this->_getFolderCrumbs($this->uploadDir, $dir);
        $settings = $this->_getSettings();

        $filesystem = $this->_getFileSystem($dir);
        $list = $this->_filter($filesystem, $params);
        $relativePath = str_replace($this->uploadDir, '', $dir);
        $view = !empty($params['view']) ? $params['view'] : 'rows';
        $this->set(compact('crumbs', 'list', 'settings', 'relativePath', 'view'));
    }
    /**
     * Move Method
     *
     * @return void
     */
    public function movefiles()
    {
        $this->autoRender = false;
        $dir = $this->request->query['dir'];
        $reason = 'Files Successfully Moved';
        if ($this->request->is('post')) {
            $filesystem = $this->_getFileSystem($this->uploadDir);
            $files = $this->request->data;
            $folder = $files[0];
            unset($files[0]);

            if ($folder == DS) {
                $folderExists = count($filesystem->listContents());
                $folder = ""; //unset folder there is already a DS
            } else {
                $folderExists = count($filesystem->listContents($folder, true));
            }

            if ($folderExists > 0) {
                foreach ($files as $fileOrDir) {
                    $fileOrDir = explode(':', $fileOrDir);
                    $type = $fileOrDir[0];
                    $fileOrDir = $fileOrDir[1];

                    if ($type == 'dir') {
                        $contents = $filesystem->listContents($fileOrDir, true);
                        foreach ($contents as $fileArr) {
                            if ($fileArr['type'] != "dir") {
                                $fileContent = $filesystem->read($fileArr['path']);
                                $newPath = $folder . str_replace($dir, '', DS . $fileArr['path']);
                                $filesystem->write($newPath, $fileContent);
                            }
                        }
                        $filesystem->deleteDir($fileOrDir);
                    } else {
                        $exists = $filesystem->has($fileOrDir);
                        if ($exists) {
                            $contents = $filesystem->read($fileOrDir);
                            $copied = $filesystem->write($folder . DS . basename($fileOrDir), $contents);
                            if ($copied) {
                                $filesystem->delete($fileOrDir);
                            }
                        }
                    }
                }
            } else {
                $reason = "Invalid directory. Please make sure your directory contains an empty file if the directory is empty.";
                echo $reason;
                exit;
            }
        }
        echo $reason;
        exit;
    }
    /**
     * Delete folder or file(s).
     *
     * @return void
     */
    public function deletefiles()
    {
        $this->autoRender = false;
        $reason = 'Files Deleted Successfully';
        if ($this->request->is('post')) {
            $filesystem = $this->_getFileSystem($this->uploadDir);
            $files = $this->request->data;
            foreach ($files as $fileOrDir) {
                $fileOrDir = explode(':', $fileOrDir);
                $type = $fileOrDir[0];
                $fileOrDir = $fileOrDir[1];

                if ($type == 'dir') {
                    $filesystem->deleteDir($fileOrDir);
                } else {
                    $exists = $filesystem->has($fileOrDir);
                    if ($exists) {
                        $filesystem->delete($fileOrDir);
                    }
                }
            }
        }
        echo $reason;
        exit;
    }
    /**
     * Add folder
     *
     * @return void
     */
    public function addfolder()
    {
        $this->autoRender = false;
        $reason = 'Folder Added Successfully';
        $params = $this->request->query;
        $dir = $this->_getDir();
        $filesystem = $this->_getFileSystem($dir);
        $dirName = $params['dirname'] . DS . 'empty';
        $filesystem->write($dirName, '');
        echo $reason;
        exit;
    }
    /**
     * Upload Method
     *
     * @return void
     */
    public function upload()
    {
        $this->autoRender = false;
        $dir = $this->_getDir();
        $fileUploadMsg = "Done";
        $fileUploadReason = "File Successfully Uploaded";

        $settings = $this->_getSettings();

        $filesystem = $this->_getFileSystem($dir);
        $file = $this->request->data['file'];

        if ($file['error'] > 0) {
            $fileUploadMsg = "Failed";
            $fileUploadReason = $this->_getFileUploadError($file['error']);
        } else {
            $filesystem->write($file['name'], file_get_contents($file['tmp_name']));
        }

        echo json_encode(['msg' => $fileUploadMsg, 'reason' => $fileUploadReason]);
    }
    private function _getDir()
    {
        $params = $this->request->query;
        $dir = isset($params['dir']) ? $params['dir'] : null;

        if (is_null($dir) or $dir == DS) {
            $dir = $this->uploadDir;
        } else {
            $dir = $this->uploadDir . $dir;
        }
        return $dir;
    }

    private function _getSettings()
    {
        return json_decode(file_get_contents(APP . '../plugins' . DS . 'FileManager' . DS . 'config' . DS . 'settings.json'));
    }
    /**
     * Configure Flysystem here.
     * Using Local Adapter.
     * @return League\Flysystem\Filesystem
     */
    private function _getFileSystem($dir)
    {

        $adapter = new Local($dir);
        //S3
        //$client = S3Client::factory([
        //   'credentials' => [
        //        'key' => 'your-key',
        //        'secret' => 'your-secret',
        //    ],
        //    'region' => 'us-east-1',
        //    'version' => 'latest',
        //]);
        //$adapter = new AwsS3Adapter($client, 'your-bucket-name', $dir);

        $filesystem = new Filesystem($adapter);
        return $filesystem;
    }
    /**
     * Filter Method.
     * filters different file types.
     * @param $file, $offset, $limit, $filter
     * @return Array
     */
    private function _filter($filesystem, $params)
    {

        $CList = [];
        $list = $filesystem->listContents();
        $filter = isset($params['filter']) ? $params['filter'] : null;
        $search = isset($params['search']) ? $params['search'] : null;
        $img = $this->formats['img'];
        $doc = $this->formats['doc'];
        $video = $this->formats['video'];
        $audio = $this->formats['audio'];

        foreach ($list as $fileOrDir) {
            if ($fileOrDir['type'] == "dir") {
                $fileOrDir['count'] = count($filesystem->listContents($fileOrDir['path']));
                $CList[] = $this->_searchMatch($search, $fileOrDir);
            } else {
                $ext = isset($fileOrDir['extension']) ? $fileOrDir['extension'] : null;
                $fileOrDir['icon'] = $this->_getIcon($ext);

                if (is_null($filter)) {
                    $CList[] = $this->_searchMatch($search, $fileOrDir);
                } else {
                    if ($filter == "sort-image" && in_array($ext, $img)) {
                        $CList[] = $this->_searchMatch($search, $fileOrDir);
                    } else if ($filter == "sort-video" && in_array($ext, $video)) {
                        $CList[] = $this->_searchMatch($search, $fileOrDir);
                    } else if ($filter == "sort-audio" && in_array($ext, $audio)) {
                        $CList[] = $this->_searchMatch($search, $fileOrDir);
                    } else if ($filter == "sort-docs" && in_array($ext, $doc)) {
                        $CList[] = $this->_searchMatch($search, $fileOrDir);
                    } else if ($filter == "sort-everything") {
                        $CList[] = $this->_searchMatch($search, $fileOrDir);
                    } else {
                        //not part of the filter
                    }
                }
            }
        }

        return array_filter($CList);
    }
    /**
     * SearchMatch Method.
     * looks for similarity in keywords
     * @param $keywords, $fileOrDir
     * @return File or dir array
     */
    private function _searchMatch($keywords, $fileOrDir)
    {
        if (is_null($keywords)) {
            return $fileOrDir;
        } else {
            $count = substr_count(strtolower($fileOrDir['basename']), strtolower($keywords));
            if ($count > 0) {
                return $fileOrDir;
            }
        }
        return [];
    }
    /**
     * Get icon based on extention
     * @return String
     */
    private function _getIcon($ext = null)
    {
        $img = $this->formats['img'];
        $doc = $this->formats['doc'];
        $video = $this->formats['video'];
        $audio = $this->formats['audio'];

        if (is_null($ext)) {
            return 'fa fa-files-o fa-2';
        }

        switch ($ext) {
            case in_array($ext, $img):
                return 'fa fa-file-image-o fa-2';
                break;
            case in_array($ext, $video):
                return 'fa fa-film fa-2';
                break;
            case in_array($ext, $audio):
                return 'fa fa-file-audio-o fa-2';
                break;
            case in_array($ext, $doc):
                return 'fa fa-file-audio-o fa-2';
                break;
            default:
                return 'fa fa-files-o fa-2';
                break;
        }
    }
    /**
     * Get the current dir and other dir list.
     * @return array
     */
    private function _getFolderCrumbs($uploadDir, $dir)
    {
        $crumbs = ['Uploads' => DS];
        if (is_null($dir) or $dir == $uploadDir) {
            return $crumbs;
        } else {
            $dir = str_replace($uploadDir . DS, '', $dir); //remove upload path
            $dirs = explode(DS, $dir);
            foreach ($dirs as $dir) {
                if (!empty($dir)) {
                    $crumbs[ucwords($dir)] = $dir;
                }
            }
        }
        return $crumbs;
    }
    private function _getFileUploadError($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }
        return $message;
    }
}
