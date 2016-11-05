<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page'), ['action' => 'edit', $page->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page'), ['action' => 'delete', $page->id], ['confirm' => __('Are you sure you want to delete # {0}?', $page->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Page Contents'), ['controller' => 'PageContents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Content'), ['controller' => 'PageContents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pages view large-9 medium-8 columns content">
    <h3><?= h($page->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Page Type') ?></th>
            <td><?= $page->has('page_type') ? $this->Html->link($page->page_type->name, ['controller' => 'PageTypes', 'action' => 'view', $page->page_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= $page->has('role') ? $this->Html->link($page->role->name, ['controller' => 'Roles', 'action' => 'view', $page->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($page->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($page->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($page->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($page->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($page->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $page->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Meta Title') ?></h4>
        <?= $this->Text->autoParagraph(h($page->meta_title)); ?>
    </div>
    <div class="row">
        <h4><?= __('Meta Description') ?></h4>
        <?= $this->Text->autoParagraph(h($page->meta_description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Page Contents') ?></h4>
        <?php if (!empty($page->page_contents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Page Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($page->page_contents as $pageContents): ?>
            <tr>
                <td><?= h($pageContents->id) ?></td>
                <td><?= h($pageContents->page_id) ?></td>
                <td><?= h($pageContents->name) ?></td>
                <td><?= h($pageContents->created) ?></td>
                <td><?= h($pageContents->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PageContents', 'action' => 'view', $pageContents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PageContents', 'action' => 'edit', $pageContents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PageContents', 'action' => 'delete', $pageContents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageContents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
