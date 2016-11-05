
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->Icing->settingsRead('Site.Title');?> | <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('IcingBlue.theme') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?= $this->Element('IcingBlue.header');?>
    <?= $this->Flash->render() ?>
    <section class="wrapper">
        <?= $this->fetch('content') ?>
    </section>
    <?= $this->Element('IcingBlue.footer');?>
    <?= $this->Html->script('IcingBlue.jquery.min') ?>
    <?= $this->Html->script('IcingBlue.bootstrap.min') ?>
    <?= $this->Html->script('IcingBlue.theme') ?>
    <?= $this->fetch('script') ?>
</body>
</html>