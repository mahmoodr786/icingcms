<?php
namespace IcingManager\Shell;

use Cake\Console\Shell;

/**
 * Icingcms shell command.
 */
class IcingcmsShell extends Shell
{

    /**
     * initialize method
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('UserManager.Users');
    }
    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $this->out('<info>Available bake commands:</info>');
        $this->out($this->nl(1));
        $this->out('- adminuser');
        $this->out($this->nl(1));
        $this->out('By using <info>`cake icingcms [name]`</info> you can invoke a specific IcingCMS task.');
    }
    /**
     * adminUser method.
     * will create a admin user.
     * @return bool|int Success or error code.
     */
    public function adminUser()
    {
        $username = $this->in('Username?', [], 'admin');
        $user = $this->Users->findByUsername($username)->first();
        if (isset($user->id) && $user->id > 0) {
            $this->error('The username already exists in the DB');
        } else {
            $password = $this->in('Password?');
            if ($password == '') {
                $this->error('Password is empty');
            } else {
                $fullName = $this->in('Full Name?');
                $email = $this->in('Email Address?');
                $userData = [
                    'username' => $username,
                    'password' => $password,
                    'name' => $fullName,
                    'email' => $email,
                    'role_id' => 1,
                    'activation_key' => '',
                    'status' => 1,
                    'img_url' => '',
                ];
                $user = $this->Users->newEntity();
                $user = $this->Users->patchEntity($user, $userData);
                if ($this->Users->save($user)) {
                    $this->out('<success>The Admin user has been saved.</success>');
                } else {
                    $errors = $user->errors();
                    foreach ($errors as $field => $error) {
                        foreach ($error as $rule => $msg) {
                            $this->out("<error>$field:  $msg</error>");
                        }
                    }
                    $this->error('The user could not be saved. Please, try again.');
                }
            }
        }
    }
}
