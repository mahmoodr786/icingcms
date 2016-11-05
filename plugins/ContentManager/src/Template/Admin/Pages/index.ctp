<?php 
    $this->Html->addCrumb('Content Manager', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']);
    $this->Html->addCrumb('Pages', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']);
    $this->assign('title', 'Pages')
?>
<div class="pages index large-9 medium-8 columns content">
    <h3><?= __('Pages') ?></h3>
    <?= $this->Html->link(__('New Page'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <br/>
    <br/>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('page_type_id') ?></th>
                <th><?= $this->Paginator->sort('role_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('url') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= $this->Number->format($page->id) ?></td>
                <td><?= $page->has('page_type') ? $this->Html->link($page->page_type->name, ['controller' => 'PageTypes', 'action' => 'view', $page->page_type->id]) : '' ?></td>
                <td><?= $page->has('role') ? $this->Html->link($page->role->name, ['controller' => 'Roles', 'action' => 'view', $page->role->id]) : '' ?></td>
                <td><?= h($page->name) ?></td>
                <td><?= h($page->url) ?></td>
                <td><?= h($page->status) ?></td>
                <td><?= h($page->created) ?></td>
                <td><?= h($page->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $page->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $page->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $page->id], ['confirm' => __('Are you sure you want to delete # {0}?', $page->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Element('Admin/paginator'); ?>
</div>
<?php
    $this->Html->script('ContentManager.contentmanager.min', ['block' => 'script']);
?>