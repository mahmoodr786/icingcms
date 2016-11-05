<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Links'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parent Links'), ['controller' => 'Links', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Link'), ['controller' => 'Links', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="links form large-9 medium-8 columns content">
    <?= $this->Form->create($link) ?>
    <fieldset>
        <legend><?= __('Add Link') ?></legend>
        <?php
            echo $this->Form->input('menu_id', ['options' => $menus]);
            echo $this->Form->input('parent_id', ['options' => $parentLinks, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('url');
            echo $this->Form->input('attributes');
            echo $this->Form->input('allow_html');
            echo $this->Form->input('status');
            echo $this->Form->input('order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
