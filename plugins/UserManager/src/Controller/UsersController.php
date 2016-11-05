<?php
namespace UserManager\Controller;

use Cake\Cache\Cache;
use Cake\Event\Event;
use UserManager\Controller\AppController;

/**
 * Users Controller
 *
 * @property \UserManager\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cookie');
        $this->Cookie->config([
            'expires' => '+30 days',
        ]);
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
        $this->Auth->allow(['login', 'logout', 'reset', 'forgot']);
    }

    /**
     * Index method
     *
     * @return void
     */
    //enable if you need it
    /*public function index()
    {
    $this->paginate = [
    'contain' => ['Roles'],
    ];
    $this->set('users', $this->paginate($this->Users));
    $this->set('_serialize', ['users']);
    }*/

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    //enable if you need it
    /*
    public function view($id = null)
    {
    $user = $this->Users->get($id, [
    'contain' => ['Roles'],
    ]);
    $this->set('user', $user);
    $this->set('_serialize', ['user']);
    }*/

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allow_add = $this->Icing->settingsRead('User.allow_add');
        if ($allow_add < 1) {
            $this->Flash->error(__('Not Aallowed.'));
            return $this->redirect('/');
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    //enable if you need it
    /*public function edit($id = null)
    {
    // do it your self.
    $this->Flash->error(__('not allowed'));
    return $this->redirect('/');
    }*/

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    //enable if you need it
    /*public function delete($id = null)
    {
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
    $this->Flash->success(__('The user has been deleted.'));
    } else {
    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
    }*/

    /**
     * Login method
     * Logs The User In
     * @return Void
     */
    public function login()
    {
        $this->_rememberMe();
        if ($this->request->is('post')) {
            if ($this->_canAttemptLogin()) {
                if (filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL)) {
                    $this->request->data['email'] = $this->request->data['username'];
                    unset($this->request->data['username']);
                    $this->Auth->config('authenticate', [
                        'Form' => [
                            'fields' => ['username' => 'email'],
                        ],
                    ]);
                    $this->Auth->constructAuthenticate();
                }
                $user = $this->Auth->identify();
                if ($user) {
                    $rMe = $this->request->data['remember_me'];
                    if (is_numeric($rMe) && $rMe == 1) {
                        $this->Cookie->write('User.username', $user['username']);
                        $this->Cookie->write('User.id', $user['id']);
                    }
                    $this->Auth->setUser($user);
                    $this->_loginAttempted(false, true);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->_loginAttempted();
                $this->Flash->error(__('Invalid username or password, try again'));
            } else {
                $this->Flash->error(__('Your account has been locked. Please try again in 1 Hour.'));
            }
        }
    }
    /**
     * Auto Login Remember Me
     *
     * @return Rredirect
     */
    private function _rememberMe()
    {
        $cookieUser = $this->Cookie->read('User');
        if ($cookieUser) {
            $user = $this->Users->find()
                ->where(['id' => $cookieUser['id'], 'username' => $cookieUser['username']])
                ->first();
            if ($user) {
                $user = $user->toArray();
                $this->Auth->setUser($user);
                $this->_loginAttempted(false, true);
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
    }
    /**
     * Can Attempt to login method.
     * Check if the person has reached the number of login attemtps
     * allowed by options.
     *
     * @return BOOL
     */
    private function _canAttemptLogin()
    {
        //get count
        $count = $this->_loginAttempted(true);
        $allowed_attempts = $this->Icing->settingsRead('User.login_attempt');
        $num_attempts = $allowed_attempts > 0 ? $allowed_attempts : 5;
        if ($count <= $num_attempts) {
            return true;
        }
        return false;
    }
    /**
     * loginAttempted metho
     * @param type|bool $get
     * @param type|bool $delete
     * @return  Int or BOOL
     */
    private function _loginAttempted($get = false, $delete = false)
    {
        //Write to cache the number of login attempts
        $cacheName = sha1($_SERVER['REMOTE_ADDR'] . 'loginAttempts');

        if ($get) {
            $count = 0;
            if (Cache::read($cacheName, 'oneHour') !== false) {
                $count = Cache::read($cacheName, 'oneHour');
            }
            return $count;
        }

        if (Cache::read($cacheName, 'oneHour') === false) {
            Cache::write($cacheName, 1, 'oneHour');
        } else {
            $count = Cache::read($cacheName, 'oneHour');
            Cache::write($cacheName, ($count + 1), 'oneHour');
        }

        if ($delete) {
            Cache::delete($cacheName, 'oneHour');
        }

        return true;
    }
    /**
     * logout mehtod
     * @return VOID
     */
    public function logout()
    {
        $this->Cookie->delete('User');
        return $this->redirect($this->Auth->logout());
    }
    /**
     * forgot mehtod
     * will send an email
     * @return VOID
     */
    public function forgot()
    {
        if ($this->request->is('post')) {
            if (filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL)) {
                $user = $this->Users->find()
                    ->where(['email' => $this->request->data['username']])
                    ->first();
            } else {
                $user = $this->Users->find()
                    ->where(['username' => $this->request->data['username']])
                    ->first();
            }

            if ($user) {
                $key = sha1(date('YMDHis') . 'IcingCMS');
                $user->activation_key = $key;
                if ($this->Users->save($user)) {
                    $noreplyEmail = $this->Icing->settingsRead('User.noreply_email');
                    if (!$noreplyEmail && empty($noreplyEmail)) {
                        $noreplyEmail = 'noreply@' . $_SERVER['HTTP_HOST'];
                    }
                    $email = new Email();
                    $email->viewVars(['link' => '/admin/user-manager/users/reset/' . $key]);
                    $email->template('IcingBlue.forgot')
                        ->emailFormat('html')
                        ->to($user->email)
                        ->from($noreplyEmail)
                        ->send();

                    $this->Flash->success(__('An email has been sent to you with a password reset link.'));
                    return $this->redirect('/');
                }
                $this->Flash->error(__('An Error has occurred please try again later.'));
            } else {
                $this->Flash->error(__('The username or email is not found in our database.'));
            }
        }
    }
    /**
     * reset method
     * @param String|null $key
     * @return VOID
     */
    public function reset($key = null)
    {
        if ($this->request->is('post')) {
            $user = $this->Users->find()
                ->where(['activation_key' => $key])
                ->first();
            if ($user) {
                $password = $this->request->data['password'];
                $confirm_password = $this->request->data['confirm_password'];
                if ($password == $confirm_password) {
                    $user->activation_key = '';
                    $user->password = $password;
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Your passwords has been reseted.'));
                        return $this->redirect('/');
                    } else {
                        $this->Flash->error(__('An Error has occurred please try again later.'));
                    }
                } else {
                    $this->Flash->error(__('Your passwords does not match'));
                }
            } else {
                $this->Flash->error(__('The User is not found in our database.'));
            }
        }
    }
}
