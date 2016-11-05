<?php

namespace IcingManager\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;

class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $loginRedirect = (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') ? '/admin' : '/';
        $this->loadComponent('Csrf');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('IcingManager.Icing');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'plugin' => 'UserManager',
            ],
            'authorize' => ['Controller'],
            'authError' => 'Authentication Failed.',
            'storage' => 'Session',
            'loginRedirect' => $loginRedirect,
            'logoutRedirect' => '/',
        ]);
    }
    /**
     * isAuthorized.
     *
     * This will check if the user allowed to access certain functions.
     *
     * You can use this function fix your permissions.
     *
     * @return true or false
     */
    public function isAuthorized($user)
    {
        // Admin can access any action
        if (isset($user['role_id']) && $user['role_id'] == 1) {
            //1 for Admin
            return true;
        }
        // Any registered user can access public functions
        if (empty($this->request->params['prefix'])) {
            return true;
        }

        // Only Admins can access Admin functions
        if ($this->request->params['prefix'] === 'admin') {
            return (bool) ($user['role_id'] == 1);
        }
        // Default deny
        return false;
    }
    /**
     * @param \Cake\Event\Event $event The beforeFilter event.
     * beforeFilter Method
     * Runs before any other function.
     * @return Void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
    /**
     * Before render callback.
     * This is where ThemeManager sets the layout or the Theme.
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $theme = Configure::read('site.theme');
        $this->viewBuilder()->theme($theme);
        $this->viewBuilder()->helpers(["$theme.Theme", "IcingManager.Icing"]);
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] === 'admin') {
            if ($this->request->params['action'] == 'login') {
                $this->viewBuilder()->layout('login');
            } else {
                $this->viewBuilder()->layout('admin');
            }
        }
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
