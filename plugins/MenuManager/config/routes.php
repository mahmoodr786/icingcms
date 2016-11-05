<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

Router::plugin(
    'MenuManager',
    ['path' => '/menu-manager'],
    function ($routes) {
        $routes->prefix('admin', function ($routes) {
            $routes->connect('/', ['plugin' => 'MenuManager', 'controller' => 'Menus', 'action' => 'index']);
            $routes->fallbacks('DashedRoute');
        });
        $routes->fallbacks('DashedRoute');
    }
);

if (Configure::check('globalAdminMenu')) {
    $globalAdminMenu = Configure::read('globalAdminMenu');
}
$globalAdminMenu['menus']['MenuManager'] = [
    'raw' => false,
    'rawCode' => '',
    'weight' => 400,
    'icon' => 'fa fa-bars',
    'name' => 'Menu Manager',
    'url' => Router::url(['prefix' => 'admin', 'plugin' => 'MenuManager', 'controller' => 'Menus', 'action' => 'index']),
    'options' => [
        'class' => 'dropdown-toggle',
    ],
    'dropdown' => true,
    'childrens' => [
        [
            'raw' => false,
            'rawCode' => '',
            'name' => 'Menus',
            'url' => Router::url(['prefix' => 'admin', 'plugin' => 'MenuManager', 'controller' => 'Menus', 'action' => 'index']),
            'options' => [],
        ],
        [
            'raw' => false,
            'rawCode' => '',
            'name' => 'Links',
            'url' => Router::url(['prefix' => 'admin', 'plugin' => 'MenuManager', 'controller' => 'Links', 'action' => 'index']),
            'options' => [],
        ],
    ],
];
Configure::write('globalAdminMenu', $globalAdminMenu);
