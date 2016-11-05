
<div class="users-login">
    <?= $this->Form->create('forgot') ?>
    <div class="login">
        <h2 class="form-signin-heading">Forgot Password?</h2>
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
        ?>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forgot-submit">
            <div class="row">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="forgot-button">
            <?= $this->Html->link('Login','/admin/user-manager/users/login');?>
        </div>
    <?= $this->Form->end() ?>
</div>

