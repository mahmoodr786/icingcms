<?php

namespace IcingBlue\View\Helper;

use Cake\View\Helper;
use Cake\Cache\Cache;
use Cake\Routing\Router;

class ThemeHelper extends Helper{

	public $helpers = ['Html']; // load Html helper

	public function isActive($url){
		$url = Router::parse($url);
		$prefix = $this->request->params['prefix'];
		$controller = $this->request->params['controller'];
		$action = $this->request->params['action'];
		if($prefix){
			if($url['controller'] == $controller && $url['action'] == $action && $url['prefix'] == $prefix){
				return true;
			}
		}else{
			if($url['controller'] == $controller && $url['action'] == $action){
				return true;
			}
		}
		return false;
	}
}