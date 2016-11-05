<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Link'), ['action' => 'edit', $link->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Link'), ['action' => 'delete', $link->id], ['confirm' => __('Are you sure you want to delete # {0}?', $link->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Link'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Links'), ['controller' => 'Links', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Link'), ['controller' => 'Links', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="links view large-9 medium-8 columns content">
    <h3><?= h($link->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Menu') ?></th>
            <td><?= $link->has('menu') ? $this->Html->link($link->menu->name, ['controller' => 'Menus', 'action' => 'view', $link->menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Parent Link') ?></th>
            <td><?= $link->has('parent_link') ? $this->Html->link($link->parent_link->name, ['controller' => 'Links', 'action' => 'view', $link->parent_link->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($link->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($link->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Attributes') ?></th>
            <td><?= h($link->attributes) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($link->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Order') ?></th>
            <td><?= $this->Number->format($link->order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($link->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($link->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Allow Html') ?></th>
            <td><?= $link->allow_html ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $link->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Links') ?></h4>
        <?php if (!empty($link->child_links)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Menu Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Attributes') ?></th>
                <th><?= __('Allow Html') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Order') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($link->child_links as $childLinks): ?>
            <tr>
                <td><?= h($childLinks->id) ?></td>
                <td><?= h($childLinks->menu_id) ?></td>
                <td><?= h($childLinks->parent_id) ?></td>
                <td><?= h($childLinks->name) ?></td>
                <td><?= h($childLinks->url) ?></td>
                <td><?= h($childLinks->attributes) ?></td>
                <td><?= h($childLinks->allow_html) ?></td>
                <td><?= h($childLinks->status) ?></td>
                <td><?= h($childLinks->order) ?></td>
                <td><?= h($childLinks->created) ?></td>
                <td><?= h($childLinks->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Links', 'action' => 'view', $childLinks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Links', 'action' => 'edit', $childLinks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Links', 'action' => 'delete', $childLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childLinks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
