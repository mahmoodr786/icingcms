<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Page Content'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pageContents index large-9 medium-8 columns content">
    <h3><?= __('Page Contents') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('page_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pageContents as $pageContent): ?>
            <tr>
                <td><?= $this->Number->format($pageContent->id) ?></td>
                <td><?= $pageContent->has('page') ? $this->Html->link($pageContent->page->name, ['controller' => 'Pages', 'action' => 'view', $pageContent->page->id]) : '' ?></td>
                <td><?= h($pageContent->name) ?></td>
                <td><?= h($pageContent->created) ?></td>
                <td><?= h($pageContent->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pageContent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pageContent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pageContent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageContent->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
