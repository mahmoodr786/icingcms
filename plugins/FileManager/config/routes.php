<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

Router::plugin(
    'FileManager',
    ['path' => '/file-manager'],
    function ($routes) {
        $routes->prefix('admin', function ($routes) {
            $routes->connect('/', ['plugin' => 'FileManager', 'controller' => 'Files', 'action' => 'index']);
            $routes->fallbacks('DashedRoute');
        });
        $routes->fallbacks('DashedRoute');
    }
);

if (Configure::check('globalAdminMenu')) {
    $globalAdminMenu = Configure::read('globalAdminMenu');
}
$globalAdminMenu['menus']['FileManager'] = [
    'raw' => false,
    'rawCode' => '',
    'name' => 'File Manager',
    'weight' => 500,
    'icon' => 'fa fa-files-o',
    'url' => Router::url(['prefix' => 'admin', 'plugin' => 'FileManager', 'controller' => 'files', 'action' => 'index', '_base' => false]),
    'options' => [],
    'dropdown' => false,
    'childrens' => [],
];
Configure::write('globalAdminMenu', $globalAdminMenu);
