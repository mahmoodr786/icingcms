<?php
use Cake\Utility\Inflector;
?>
<div class="users form edit form-hold">
    <h3><?= __('Edit User') ?></h3>
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $user->id],
            ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
        )
    ?>
    <br/>
    <br/>
    <?= $this->Form->create($user) ?>
        <?php
            echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true, 'class' => 'form-control']);
            echo $this->Form->input('name', ['class' => 'form-control']);
            echo $this->Form->input('username', ['class' => 'form-control']);
            echo $this->Form->input('password', ['class' => 'form-control', 'label' => 'New Password or Leave Blank', 'value' => '']);
            $fileButton = $this->Html->link(
                '<i class="fa fa-files-o" aria-hidden="true"></i> Choose File','#filemanager',
                [
                    'class' =>'btn btn-primary filemanager pull-right',
                    'iframe' => $this->Url->build(['plugin' => 'FileManager', 'controller' => 'files', 'action' => 'index']) . '?iframe=1',
                    'data-id' => Inflector::slug('img_url'),
                    'data-base-path' => $this->Url->build('/'),
                    'escape' =>false
                ]
            );
            echo $this->Form->input(
                'img_url',
                [
                    'class' => 'form-control',
                    'label' => false,
                    'templates' => [
                    'inputContainer' => '<div class="input {{type}}{{required}} form-group">
                                            <label for="img-url">Image Url</label>
                                            <div class="input-append">
                                                {{content}} '. $fileButton .'
                                            </div>
                                         </div>'
            ]
                ]
            );
            echo $this->Form->input('email', ['class' => 'form-control']);
            echo $this->Form->input('activation_key', ['class' => 'form-control']);
            echo $this->Form->input('status');
        ?>
    <button class="btn btn-success" type="submit">Submit</button>
    <?= $this->Form->end() ?>
</div>
<?php
    $this->Html->script('UserManager.usermanager.min', ['block' => 'script']);
?>