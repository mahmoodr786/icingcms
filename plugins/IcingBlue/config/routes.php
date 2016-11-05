<?php
use Cake\Routing\Router;

Router::plugin(
    'IcingBlue',
    ['path' => '/icing-blue'],
    function ($routes) {
        $routes->prefix('admin', function ($routes) {
            $routes->connect('/', ['plugin' => 'IcingBlue', 'controller' => 'ThemeData', 'action' => 'index']);
            $routes->fallbacks('DashedRoute');
        });
    }
);

/*if (Configure::check('globalAdminMenu')) {
$globalAdminMenu = Configure::read('globalAdminMenu');
}
$globalAdminMenu['menus']['IcingBlue'] = [
'raw' => false,
'rawCode' => '',
'name' => 'Icing Blue Theme',
'weight' => 700,
'icon' => 'fa fa-object-ungroup',
'url' => Router::url(['prefix' => 'admin', 'plugin' => 'IcingBlue', 'controller' => 'ThemeData', 'action' => 'index']),
'options' => [],
'dropdown' => false,
'childrens' => [],
];
Configure::write('globalAdminMenu', $globalAdminMenu);*/
