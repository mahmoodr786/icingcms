<?php 
    $this->Html->addCrumb('Settings Overview', ['plugin' => 'IcingManager', 'controller' => 'settings', 'action' => 'index']);
    $this->assign('title', 'Settings')
?>
<div class="settings index large-9 medium-8 columns content">
    <h3><?= __('Settings') ?></h3>
   <?= $this->Html->link(__('New Setting'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    <br/>
    <br/>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('key') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('help') ?></th>
                <th><?= $this->Paginator->sort('input_type') ?></th>
                <th><?= $this->Paginator->sort('order') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($settings as $setting): ?>
            <tr>
                <td><?= $this->Number->format($setting->id) ?></td>
                <td><?= h($setting->key) ?></td>
                <td><?= h($setting->title) ?></td>
                <td><?= h($setting->help) ?></td>
                <td><?= h($setting->input_type) ?></td>
                <td><?= $this->Number->format($setting->order) ?></td>
                <?php
                    $key = explode('.', $setting->key);
                ?>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $key[0]]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $key[0]]) ?>
                    <?= $this->Html->link(__('Edit Properties'), ['action' => 'propedit', $setting->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Element('Admin/paginator'); ?>
</div>
