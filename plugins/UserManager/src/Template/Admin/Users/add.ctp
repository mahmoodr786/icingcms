<div class="users form add form-hold">
    <h3><?= __('Add User') ?></h3>
    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <br/>
    <br/>
    <?= $this->Form->create($user) ?>

        <?php
            echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true, 'class' => 'form-control']);
            echo $this->Form->input('name', ['class' => 'form-control']);
            echo $this->Form->input('username', ['class' => 'form-control']);
            echo $this->Form->input('password', ['class' => 'form-control']);
            echo $this->Form->input('email', ['class' => 'form-control']);
            echo $this->Form->input('activation_key', ['class' => 'form-control']);
            echo $this->Form->input('status');
        ?>
    <button class="btn btn-success" type="submit">Submit</button>
    <?= $this->Form->end() ?>
</div>
