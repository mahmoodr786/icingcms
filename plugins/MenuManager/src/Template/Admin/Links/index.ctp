<?php 
    $this->Html->addCrumb('Menu Manager', ['plugin' => 'MenuManager', 'controller' => 'Menus', 'action' => 'index']);
    $this->Html->addCrumb('Links', ['plugin' => 'MenuManager', 'controller' => 'Links', 'action' => 'index']);
    $this->assign('title', 'Links')
?>
<div class="menus index large-9 medium-8 columns content">
    <h3><?= __('Pages') ?></h3>
    <?= $this->Html->link(__('New Link'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <br/>
    <br/>
    <br/>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('menu_id') ?></th>
                <th><?= $this->Paginator->sort('parent_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('url') ?></th>
                <th><?= $this->Paginator->sort('allow_html') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($links as $link): ?>
            <tr>
                <td><?= $this->Number->format($link->id) ?></td>
                <td><?= $link->has('menu') ? $this->Html->link($link->menu->name, ['controller' => 'Menus', 'action' => 'view', $link->menu->id]) : '' ?></td>
                <td><?= $link->has('parent_link') ? $this->Html->link($link->parent_link->name, ['controller' => 'Links', 'action' => 'view', $link->parent_link->id], ['escape' => false]) : '' ?></td>
                <td><?= $link->name ?></td>
                <td><?= h($link->url) ?></td>
                <td><?= h($link->allow_html) ?></td>
                <td><?= h($link->status) ?></td>
                <td><?= h($link->created) ?></td>
                <td><?= h($link->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $link->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $link->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $link->id], ['confirm' => __('Are you sure you want to delete # {0}?', $link->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Element('Admin/paginator'); ?>
</div>
