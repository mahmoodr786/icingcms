<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

Router::plugin(
    'ContentManager',
    ['path' => '/content-manager'],
    function ($routes) {
        $routes->prefix('admin', function ($routes) {
            $routes->connect('/', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']);
            $routes->fallbacks('DashedRoute');
        });
        $routes->fallbacks('DashedRoute');
    }
);

Router::scope('/', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'display']);
    $routes->connect('/*', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'display']);
});

if (Configure::check('globalAdminMenu')) {
    $globalAdminMenu = Configure::read('globalAdminMenu');
}
$globalAdminMenu['menus']['ContentManager'] = [
    'raw' => false,
    'rawCode' => '',
    'name' => 'Content Manager',
    'weight' => 300,
    'icon' => 'fa fa-pencil-square-o',
    'url' => Router::url(['prefix' => 'admin', 'plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']),
    'options' => [
        'class' => 'dropdown-toggle',
    ],
    'dropdown' => true,
    'childrens' => [
        [
            'raw' => false,
            'rawCode' => '',
            'name' => 'Pages',
            'url' => Router::url(['prefix' => 'admin', 'plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']),
            'options' => [],
        ],
        [
            'raw' => false,
            'rawCode' => '',
            'name' => 'Page Types',
            'url' => Router::url(['prefix' => 'admin', 'plugin' => 'ContentManager', 'controller' => 'PageTypes', 'action' => 'index']),
            'options' => [],
        ],
    ],
];
Configure::write('globalAdminMenu', $globalAdminMenu);
