<?php 
    $this->Html->addCrumb('Content Manager', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']);
    $this->Html->addCrumb('Page Types', ['plugin' => 'ContentManager', 'controller' => 'PageTypes', 'action' => 'index']);
    $this->assign('title', 'Page Types')
?>
<div class="pageTypes index large-9 medium-8 columns content">
    <h3><?= __('Page Types') ?></h3>
    <?= $this->Html->link(__('New Page Type'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index'], ['class' => 'btn btn-info']) ?>
    <?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <br/>
    <br/>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('layout') ?></th>
                <th><?= $this->Paginator->sort('file_name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pageTypes as $pageType): ?>
            <tr>
                <td><?= $this->Number->format($pageType->id) ?></td>
                <td><?= h($pageType->name) ?></td>
                <td><?= h($pageType->layout) ?></td>
                <td><?= h($pageType->file_name) ?></td>
                <td><?= h($pageType->created) ?></td>
                <td><?= h($pageType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pageType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pageType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pageType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageType->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Element('Admin/paginator'); ?>
</div>
