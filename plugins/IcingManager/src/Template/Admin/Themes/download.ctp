<?php
    $themes = json_decode($themes);
    $themes = $themes->themes;
?>
<div class="themes-download">
    <?php foreach ($themes as $theme):?>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
          <div class="thumbnail">
            <img src="<?= $theme->image;?>" alt="theme image" class="img-responsive">
            <div class="caption">
              <h3><?= $theme->name;?></h3>
              <p><?= $theme->description;?></p>
              <p>
                  <?= $this->Html->link(
                          'Install','/icing-manager/admin/themes/add?url=' . $theme->url . '&folder_name=' . $theme->folder_name,
                          ['class' => 'btn btn-primary']
                          );
                  ?>
                  <a href="<?= $theme->author_url;?>" class="btn btn-default" role="button" rel="nofallow">View Website</a>
              </p>
            </div>
          </div>
        </div>
    <?php endforeach;?>
</div>