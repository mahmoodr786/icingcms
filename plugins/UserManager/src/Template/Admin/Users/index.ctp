<?php
$this->Html->addCrumb('User Manager', ['plugin' => 'UserManager', 'controller' => 'users', 'action' => 'index']);
$this->assign('title', 'User Manager');
?>
<div class="users-index">
    <div class="users-table col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id',['label' => 'ID']) ?></th>
                        <th><?= $this->Paginator->sort('role_id') ?></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('username') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th><?= $this->Paginator->sort('status') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= $user->status == 1 ? "Active" : "Inactive" ?></td>
                        <td><?= date('m/d/Y', strtotime($user->created)) ?></td>
                        <td><?= date('m/d/Y', strtotime($user->modified)) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="stats">Active Users: <?= $totalActiveUsers; ?>, Inactive Users: <?= $totalInactiveUsers; ?>, Total Users: <?= $totalActiveUsers+$totalInactiveUsers; ?></div>
        <?= $this->Element('Admin/paginator'); ?>
    </div>
    <div class="user-sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="options">
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
            <?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'btn btn-warning']) ?>
            <?= $this->Html->link(__('Settings'), ['plugin' => 'IcingManager', 'controller' =>'settings', 'action' => 'view', 'User'], ['class' => 'btn btn-success']) ?>
            <hr>
            <?= $this->Form->create(null,['url' => ['action' => 'index'], 'type' => 'GET']) ?>
            <div class="filter-div">
                <h3>Filter</h3>
                <?= $this->Form->input('field',['options' => $searchFields,'label' => false, 'class' => 'form-control']);?>
                <?= $this->Form->input('search_type',['options' => $searchTypes,'label' => false, 'class' => 'form-control']);?>
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="is ...">
                </div>
                <button class="btn btn-success search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
                <input type="hidden" name="filter" value="1"/>
            </div>
            <div class="clearfix"></div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>