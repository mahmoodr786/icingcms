<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Links'), ['controller' => 'Links', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Link'), ['controller' => 'Links', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($menu->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Key') ?></th>
            <td><?= h($menu->key) ?></td>
        </tr>
        <tr>
            <th><?= __('Tag') ?></th>
            <td><?= h($menu->tag) ?></td>
        </tr>
        <tr>
            <th><?= __('List Tag') ?></th>
            <td><?= h($menu->list_tag) ?></td>
        </tr>
        <tr>
            <th><?= __('Dropdown Tag') ?></th>
            <td><?= h($menu->dropdown_tag) ?></td>
        </tr>
        <tr>
            <th><?= __('Dropdown List Tag') ?></th>
            <td><?= h($menu->dropdown_list_tag) ?></td>
        </tr>
        <tr>
            <th><?= __('Active Class') ?></th>
            <td><?= h($menu->active_class) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($menu->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($menu->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $menu->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Tag Attributes') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->tag_attributes)); ?>
    </div>
    <div class="row">
        <h4><?= __('List Tag Attributes') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->list_tag_attributes)); ?>
    </div>
    <div class="row">
        <h4><?= __('Dropdown Tag Attributes') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->dropdown_tag_attributes)); ?>
    </div>
    <div class="row">
        <h4><?= __('Dropdown List Tag Attributes') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->dropdown_list_tag_attributes)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Links') ?></h4>
        <?php if (!empty($menu->links)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Menu Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Allow Html') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->links as $links): ?>
            <tr>
                <td><?= h($links->id) ?></td>
                <td><?= h($links->menu_id) ?></td>
                <td><?= h($links->parent_id) ?></td>
                <td><?= $links->name ?></td>
                <td><?= h($links->url) ?></td>
                <td><?= h($links->allow_html) ?></td>
                <td><?= h($links->status) ?></td>
                <td><?= h($links->created) ?></td>
                <td><?= h($links->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Links', 'action' => 'view', $links->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Links', 'action' => 'edit', $links->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Links', 'action' => 'delete', $links->id], ['confirm' => __('Are you sure you want to delete # {0}?', $links->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
