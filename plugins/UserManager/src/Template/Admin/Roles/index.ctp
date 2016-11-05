<?php
$this->Html->addCrumb('User Manager', ['plugin' => 'UserManager', 'controller' => 'users', 'action' => 'index']);
$this->Html->addCrumb('User Roles', ['plugin' => 'UserManager', 'controller' => 'roles', 'action' => 'index']);
$this->assign('title', 'User Roles');
?>
<br/><br/>
<?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?> 
<?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index'], ['class' => 'btn btn-info']) ?> 
<?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add'], ['class' => 'btn btn-primary']) ?> 
<?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-info']) ?> 
<?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
<br/>

<div class="roles index large-9 medium-8 columns content">
    <h3><?= __('Roles') ?></h3>
    <table cellpadding="0" cellspacing="0"  class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= $this->Number->format($role->id) ?></td>
                <td><?= h($role->name) ?></td>
                <td><?= h($role->created) ?></td>
                <td><?= h($role->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Element('Admin/paginator'); ?>
</div>
 