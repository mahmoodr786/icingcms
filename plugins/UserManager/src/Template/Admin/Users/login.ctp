
<div class="users-login">
    <?= $this->Form->create('auth') ?>
    <div class="login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php
            echo $this->Form->input(
                'username',
                [
                    'label'=>'Username or Email',
                    'class' => 'form-control',
                    'templates' => [
                        'inputContainer' => '<div class="input {{type}}{{required}} form-group">{{content}}</div>'
                    ]
                ]
            );
            echo $this->Form->input(
                'password',
                [
                    'class' => 'form-control',
                    'templates' => [
                        'inputContainer' => '<div class="input {{type}}{{required}} form-group">{{content}}</div>'
                    ]
                ]
            );
        ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
           <div class="row">
                <?php
                    echo $this->Form->input(
                        'remember_me',
                        [
                            'type' => 'checkbox',
                            'label' => false,
                            'templates' => [
                                'inputContainer' => '<div class="input {{type}}{{required}}"><label>{{content}} Remember Me</label></div>'
                            ]
                        ]
                    );
                ?>
           </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 login-button">
            <div class="row">
                <button type="submit" class="btn btn-success">Login</button>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="forgot-button">
            <?= $this->Html->link('Forgot Password?','/admin/user-manager/users/forgot');?>
        </div>
    <?= $this->Form->end() ?>
</div>

