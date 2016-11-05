<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->fetch('title') ?>
        </h1>
        <?php
            echo $this->Html->getCrumbList(
                [
                    'firstClass' => false,
                    'lastClass' => 'active',
                    'class' => 'breadcrumb'
                ],
                [
                    'text' => '<i class="fa fa-dashboard"></i> Dashboard',
                    'url' => ['plugin'=>'IcingManager','controller' => 'dashboard', 'action' => 'index'],
                    'escape' => false
                ]
            );
        ?>
    </div>
</div>