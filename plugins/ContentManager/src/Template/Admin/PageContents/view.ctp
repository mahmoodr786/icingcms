<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page Content'), ['action' => 'edit', $pageContent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page Content'), ['action' => 'delete', $pageContent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageContent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Page Contents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Content'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pageContents view large-9 medium-8 columns content">
    <h3><?= h($pageContent->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Page') ?></th>
            <td><?= $pageContent->has('page') ? $this->Html->link($pageContent->page->name, ['controller' => 'Pages', 'action' => 'view', $pageContent->page->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($pageContent->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($pageContent->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($pageContent->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($pageContent->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Value') ?></h4>
        <?= $this->Text->autoParagraph(h($pageContent->value)); ?>
    </div>
</div>
