<?php 
    $this->Html->addCrumb('Menu Manager', ['plugin' => 'MenuManager', 'controller' => 'Menus', 'action' => 'index']);
    $this->Html->addCrumb('Menus', ['plugin' => 'MenuManager', 'controller' => 'Menus', 'action' => 'index']);
    $this->assign('title', 'Menus')
?>
<div class="menus index large-9 medium-8 columns content">
    <h3><?= __('Pages') ?></h3>
    <?= $this->Html->link(__('New Menu'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Links'), ['controller' => 'Links', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Link'), ['controller' => 'links', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <br/>
    <br/>
    <br/>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('key') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= $this->Number->format($menu->id) ?></td>
                <td><?= h($menu->name) ?></td>
                <td><?= h($menu->key) ?></td>
                <td><?= h($menu->status) ?></td>
                <td><?= h($menu->created) ?></td>
                <td><?= h($menu->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $menu->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Element('Admin/paginator'); ?>
</div>
