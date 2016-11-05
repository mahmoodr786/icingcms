<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page Type'), ['action' => 'edit', $pageType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page Type'), ['action' => 'delete', $pageType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pageType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Page Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pageTypes view large-9 medium-8 columns content">
    <h3><?= h($pageType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($pageType->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Layout') ?></th>
            <td><?= h($pageType->layout) ?></td>
        </tr>
        <tr>
            <th><?= __('File Name') ?></th>
            <td><?= h($pageType->file_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($pageType->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($pageType->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($pageType->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Pages') ?></h4>
        <?php if (!empty($pageType->pages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Page Type Id') ?></th>
                <th><?= __('Role Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Meta Title') ?></th>
                <th><?= __('Meta Description') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Custom Data') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pageType->pages as $pages): ?>
            <tr>
                <td><?= h($pages->id) ?></td>
                <td><?= h($pages->page_type_id) ?></td>
                <td><?= h($pages->role_id) ?></td>
                <td><?= h($pages->name) ?></td>
                <td><?= h($pages->url) ?></td>
                <td><?= h($pages->meta_title) ?></td>
                <td><?= h($pages->meta_description) ?></td>
                <td><?= h($pages->status) ?></td>
                <td><?= h($pages->custom_data) ?></td>
                <td><?= h($pages->created) ?></td>
                <td><?= h($pages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pages', 'action' => 'view', $pages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pages', 'action' => 'edit', $pages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pages', 'action' => 'delete', $pages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
