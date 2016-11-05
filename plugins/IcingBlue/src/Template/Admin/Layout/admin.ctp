<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('IcingBlue.admin/theme') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
        
    <div id="wrapper">
        <?= $this->Element('Admin/nav'); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?= $this->Element('Admin/crumbs'); ?>
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    <?= $this->Html->script('IcingBlue.jquery.min') ?>
    <?= $this->Html->script('IcingBlue.bootstrap.min') ?>
    <?= $this->Html->script('IcingBlue.admin/theme') ?>
    <?= $this->fetch('script') ?>
</body>
</html>