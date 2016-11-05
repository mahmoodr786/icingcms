<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pageContent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pageContent->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Page Contents'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pageContents form large-9 medium-8 columns content">
    <?= $this->Form->create($pageContent) ?>
    <fieldset>
        <legend><?= __('Edit Page Content') ?></legend>
        <?php
            echo $this->Form->input('page_id', ['options' => $pages]);
            echo $this->Form->input('name');
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
