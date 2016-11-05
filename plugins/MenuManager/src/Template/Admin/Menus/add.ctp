<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Links'), ['controller' => 'Links', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Link'), ['controller' => 'Links', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Add Menu') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('key');
            echo $this->Form->input('tag');
            echo $this->Form->input('tag_attributes');
            echo $this->Form->input('list_tag');
            echo $this->Form->input('list_tag_attributes');
            echo $this->Form->input('dropdown_tag');
            echo $this->Form->input('dropdown_tag_attributes');
            echo $this->Form->input('dropdown_list_tag');
            echo $this->Form->input('dropdown_list_tag_attributes');
            echo $this->Form->input('active_class');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
