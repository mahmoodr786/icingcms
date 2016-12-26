<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

Router::plugin(
    'UserManager',
    ['path' => '/user-manager'],
    function ($routes) {
        $routes->prefix('admin', function ($routes) {
            $routes->connect('/', ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'index']);
            $routes->fallbacks('DashedRoute');
        });
        $routes->fallbacks('DashedRoute');
    }
);
Router::connect('/register', ['prefix' => false, 'plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'add']);
Router::connect('/login', ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'login']);
Router::connect('/logout', ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'logout']);
Router::connect('/admin/login', ['prefix' => 'admin', 'plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'login']);
Router::connect('/admin/logout', ['prefix' => 'admin', 'plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'logout']);

if (Configure::check('globalAdminMenu')) {
    $globalAdminMenu = Configure::read('globalAdminMenu');
}
$globalAdminMenu['menus']['UserManager'] = [
    'raw' => false,
    'rawCode' => '',
    'name' => 'User Manager',
    'weight' => 600,
    'icon' => 'fa fa-users',
    'url' => Router::url(['prefix' => 'admin', 'plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'index', '_base' => false]),
    'options' => [
        'class' => 'dropdown-toggle',
    ],
    'dropdown' => true,
    'childrens' => [
        [
            'raw' => false,
            'rawCode' => '',
            'name' => 'Users',
            'url' => Router::url(['prefix' => 'admin', 'plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'index', '_base' => false]),
            'options' => [],
        ],
        [
            'raw' => false,
            'rawCode' => '',
            'name' => 'Roles',
            'url' => Router::url(['prefix' => 'admin', 'plugin' => 'UserManager', 'controller' => 'Roles', 'action' => 'index', '_base' => false]),
            'options' => [],
        ],

    ],
];

Configure::write('globalAdminMenu', $globalAdminMenu);
