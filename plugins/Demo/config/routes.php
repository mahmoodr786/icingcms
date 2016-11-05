<?php
use Cake\Routing\Router;

Router::plugin(
    'Demo',
    ['path' => '/demo'],
    function ($routes) {
    	$routes->connect('/', ['plugin' => 'Demo','controller' => 'Home', 'action' => 'index']);
        $routes->fallbacks('DashedRoute');
    }
);
