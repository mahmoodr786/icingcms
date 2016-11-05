<nav class="navbar navbar-default navbar-fixed-top clear-nav">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="<?= $menu->key;?>" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= $this->Html->link($this->Icing->settingsRead('Site.Title'), '/', ['class' => 'navbar-brand']); ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="<?= $menu->key;?>">
    	<?= $this->Menus->create($menu);?>
      <!--<ul class="nav navbar-nav">
        <li class="active"><?= $this->Html->link('Home', '/');?></li>
        <li><?= $this->Html->link('Documentation', '/documentation');?></li>
        <li><?= $this->Html->link('Themes', '/themes');?></li>
        <li><?= $this->Html->link('Plugins', '/plugins');?></li>
        <li><?= $this->Html->link('Download', 'https://github.com/');?></li>
        <li><?= $this->Html->link('Support', '/support');?></li>
        <li><?= $this->Html->link('Contribute', '/contribute');?></li>
        <li><?= $this->Html->link('FAQ', '/faq');?></li>
      </ul>-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>