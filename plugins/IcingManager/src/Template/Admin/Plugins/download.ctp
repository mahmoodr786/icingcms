<?php
	$plugins = json_decode($plugins);
	$plugins = $plugins->plugins;
?>
<div class="plugins-download">
	<?php foreach ($plugins as $plugin):?>
		
		<div class="row">
		  <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		    <div class="thumbnail">
		      <img src="<?= $plugin->image;?>" alt="plugin image" class="img-responsive">
		      <div class="caption">
		        <h3><?= $plugin->name;?></h3>
		        <p><?= $plugin->description;?></p>
		        <p>
		        	<?= $this->Html->link(
				        	'Install','/icing-manager/admin/plugins/add?url=' . $plugin->url . '&folder_name=' . $plugin->folder_name,
				        	['class' => 'btn btn-primary']
				        	);
		        	?>
		        	<a href="<?= $plugin->author_url;?>" class="btn btn-default" role="button" rel="nofallow">View Website</a>
		        </p>
		      </div>
		    </div>
		  </div>
		</div>
	<?php endforeach;?>
</div>