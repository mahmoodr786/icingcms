<?php 
    $this->Html->addCrumb('Themes', ['theme' => 'IcingManager', 'controller' => 'themes', 'action' => 'index']);
    $this->assign('title', 'Themes')
?>
<div class="themes index large-9 medium-8 columns content">
    <h3><?= __('Themes') ?></h3>
    <?= $this->Html->link(__('Add New Themes'), ['action' => 'download'], ['class' => 'btn btn-primary']) ?>
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
            <?php foreach ($themes as $theme): ?>
            <tr>
                <td>
                    <?= $this->Html->image($theme['image'], ['class' => 'theme-image']);?>
                    <?= h($theme['name']) ?>
                </td>
                <td><?= $this->Html->link($theme['author'], $theme['author_url'], ['target' => '_blank']);?></td>
                <td><?= h($theme['version']);?></td>
                <td><?= $theme['active'];?></td>
                <td class="actions">
                    <?php if(!$theme['is_primary'] && $theme['active'] == 'Yes'):?>
                        <?= $this->Html->link(__('Make Primary'), ['action' => 'activate', $theme['folder_name'], 1],['class' => 'btn btn-success']) ?>
                    <?php endif;?>
                    <?php if($theme['active'] == 'No'):?>
                        <?= $this->Html->link(__('Activate'), ['action' => 'activate', $theme['folder_name']],['class' => 'btn btn-success']) ?>
                    <?php else:?>
                        <?= $this->Html->link(__('Deactivate'), ['action' => 'deactivate', $theme['folder_name']], ['class' => 'btn btn-info']) ?>
                    <?php endif;?>
                    <?= $this->Html->link(__('Delete Only'), ['action' => 'delete', $theme['folder_name']], ['confirm' => 'This will delete all theme files. Are you sure?','class' => 'btn btn-warning']) ?>
                    <?php if($theme['active'] == 'Yes'):?>
                        <?= $this->Html->link(__('Delete + Data'), ['action' => 'delete', $theme['folder_name'], 1], ['confirm' => 'This will delete all theme files and migrations + data. Are you sure?','class' => 'btn btn-danger']) ?>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
