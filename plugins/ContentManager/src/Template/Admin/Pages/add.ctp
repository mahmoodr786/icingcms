<?php 
    $this->Html->addCrumb('Content Manager', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'index']);
    $this->Html->addCrumb('Add Page', ['plugin' => 'ContentManager', 'controller' => 'Pages', 'action' => 'add']);
    $this->assign('title', 'Add Page')
?>
<div class="content-manager edit">
    <div class="editor col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <div class="row">
            <div class="pages">
                <?= $this->Form->create($page) ?>
                <div class="form">
                    <?php
                        echo $this->Form->input('name',
                            [
                                'class' => 'form-control',
                                 'templates' => [
                                    'inputContainer' => '<div class="input {{type}}{{required}} form-group col-sm-6 col-xs-12">{{content}}</div>'
                                ]
                            ]
                        );
                    ?>
                    <?php 
                        echo $this->Form->input('page_type_id',
                            [
                                'options' => $pageTypes,
                                'class' => 'form-control',
                                'templates' => [
                                    'inputContainer' => '<div class="input {{type}}{{required}} form-group col-sm-6 col-xs-12">{{content}}</div>'
                                ]
                            ]
                        );
                    ?>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="clearfix clear"></div>
</div>

<?php
    $this->Html->script('ContentManager.contentmanager.min', ['block' => 'script']);
?>