<?php
    $this->Html->css('ContentManager.remodal', ['block' => 'css']);
    $this->Html->css('ContentManager.remodal-default-theme', ['block' => 'css']);
    $this->Html->css('ContentManager.bootstrap-tagsinput.css', ['block' => 'css']);
    $inputContainer = '<div class="input {{type}}{{required}} form-group col-sm-6 col-xs-12">{{content}}</div>';
?>
<div class="content-manager edit">
     <?= $this->Form->create($page) ?> 
    <div class="editor col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form">
            <div class="page-name">
                <?php
                
                    echo $this->Form->input('name',
                        [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Title'
                        ]
                    );
                ?>
            </div>
            <div class="page-url">
                <div class="base">
                    <label for="url">
                        <?= substr($this->Url->build('/',true), 0, -1); ?>
                    </label>
                </div>
                <div class="url">
                    <?= $this->Form->input('url', ['class' => 'form-control', 'label' => false]);  ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?= $this->Form->input('page_type_id',['options' => $pageTypes,'class' => 'hide','label' => false]); ?>
            <div class="form-feilds">
                <?= $html; ?>
            </div>
        </div>
    </div>
    <div class="editor-sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="page-options">
            <h3>Page Options</h3>
            <div class="pub">
                <div class="op form-inline">
                    <?php 
                        echo $this->Form->input('role_id', 
                            [
                                'options' => $roles,
                                'class' => 'form-control',
                                'label' => 'Visibility:',
                                'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} form-group">{{content}} <div class="clearfix"></div></div>'],
                            ]
                        );
                    ?>
                    <br class="clearfix"></br>
                    <?php
                        echo $this->Form->input('status',
                            [
                                'options' => [0 => 'Draft', 1 => 'Published'],
                                'class' => 'form-control',
                                'label' => 'Status:',
                                'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} form-group">{{content}} <div class="clearfix"></div></div>'],
                            ]
                        ); 
                    ?>
                    <br class="clearfix"></br>
                    <div class="pull-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
                    </div>
                    <div class="pull-right">
                        <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('Delete Permanently'), ['action' => 'delete', $page->id], ['confirm' => __('Are you sure you want to delete # {0}? This will delete all data.', $page->name), 'class' => 'btn btn-danger', 'escape' => false]) ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="desc">
                    <?= $this->Form->input('meta_description',
                            [
                                'class' => 'form-control'
                            ]
                        );
                    ?>
                </div>
                <div class="tags">
                    <?= $this->Form->input('meta_title',
                            [
                                'class' => 'form-control',
                                'data-role' => 'tagsinput',
                                'type' => 'text',
                                'label' => 'Meta Tags'
                            ]
                        );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix clear"></div>
    <?= $this->Form->end() ?>
</div>
<div class="remodal" id="editmodel" data-remodal-id="editmodel"
          data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Edit</h1>
    <br/>
    <div class="confirm-container input-hold">
        
    </div>
    <br/>
    <br/>
    <button  class="remodal-confirm btn btn-primary commit" data-remodal-action="close">Close</button>
</div>
<?php
    $this->Html->script('//cdn.ckeditor.com/4.5.9/standard/ckeditor.js', ['block' => 'script']);
    $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js', ['block' => 'script']);
    $this->Html->script('ContentManager.remodal.min', ['block' => 'script']);
    $this->Html->script('ContentManager.bootstrap-tagsinput.min', ['block' => 'script']);
    $this->Html->script('ContentManager.contentmanager.min', ['block' => 'script']);
?>
<script type="text/javascript">
    var fileManagerUrl = "<?= $this->Url->build(['plugin'=>'FileManager','controller'=>'files','action'=>'index']);?>?iframe=1";
</script>