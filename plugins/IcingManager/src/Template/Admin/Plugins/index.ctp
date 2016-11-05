<?php 
    $this->Html->addCrumb('Plugins', ['plugin' => 'IcingManager', 'controller' => 'plugins', 'action' => 'index']);
    $this->assign('title', 'Plugins')
?>
<div class="plugins index large-9 medium-8 columns content">
    <h3><?= __('Plugins') ?></h3>
    <?= $this->Html->link(__('Add New Plugins'), ['action' => 'download'], ['class' => 'btn btn-primary']) ?>
    <br/>
    <br/>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Author</th>
                <th>version</th>
                <th>Activated</th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plugins as $plugin): ?>
            <tr>
                <td>
                    <?= $this->Html->image($plugin['image'], ['class' => 'plugin-image']);?>
                    <?= h($plugin['name']) ?>
                </td>
                <td><?= $this->Html->link($plugin['author'], $plugin['author_url'], ['target' => '_blank']);?></td>
                <td><?= h($plugin['version']);?></td>
                <td><?= $plugin['active'];?></td>
                <td class="actions">
                    <?php if($plugin['active'] == 'No'):?>
                        <?= $this->Html->link(__('Activate'), ['action' => 'activate', $plugin['folder_name']],['class' => 'btn btn-success']) ?>
                    <?php else:?>
                        <?= $this->Html->link(__('Deactivate'), ['action' => 'deactivate', $plugin['folder_name']], ['class' => 'btn btn-info']) ?>
                    <?php endif;?>
                    <?= $this->Html->link(__('Delete Only'), ['action' => 'delete', $plugin['folder_name']], ['confirm' => 'This will delete all plugin files. Are you sure?','class' => 'btn btn-warning']) ?>
                    <?php if($plugin['active'] == 'Yes'):?>
                        <?= $this->Html->link(__('Delete + Data'), ['action' => 'delete', $plugin['folder_name'], 1], ['confirm' => 'This will delete all plugin files and migrations + data. Are you sure?','class' => 'btn btn-danger']) ?>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
