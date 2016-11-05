<?php
	
	$this->assign('title', $page->name);
	$this->append('meta', $this->Html->meta('Keywords',['content' => $page->meta_title]));
	$this->append('meta', $this->Html->meta('Description', ['content' => $page->meta_description]));
?>
<!-- Schema.org markup for Google+ -->
<?php $this->append('meta', $this->Html->meta(null, ['itemprop' => 'name', 'content' => $page->meta_title]));?>
<?php $this->append('meta', $this->Html->meta(null, ['description' => 'name', 'content' => $page->meta_description]));?>
<?php $this->append('meta', $this->Html->meta(null, ['itemprop' => 'image', 'content' => $this->Url->build('/img/icing.png', true)]));?>
<!-- Twitter Card data -->
<?php $this->append('meta', $this->Html->meta('twitter:title', ['content' => $page->meta_title]));?>
<?php $this->append('meta', $this->Html->meta('twitter:description', ['content' => $page->meta_description]));?>
<?php $this->append('meta', $this->Html->meta('twitter:card', ['content' => $this->Url->build('/img/icing.png', true)]));?>
<!-- Twitter summary card with large image must be at least 280x150px -->
<?php $this->append('meta', $this->Html->meta('ttwitter:image:src', ['content' => $this->Url->build('/img/icing.png', true)]));?>
<!-- Open Graph data -->
<?php $this->append('meta', $this->Html->meta(null, ['property' => 'og:title', 'content' => $page->name]));?>
<?php $this->append('meta', $this->Html->meta(null, ['property' => 'og:type', 'content' => 'article']));?>
<?php $this->append('meta', $this->Html->meta(null, ['property' => 'og:url', 'content' => $this->Url->build('/', true)]));?>
<?php $this->append('meta', $this->Html->meta(null, ['property' => 'og:image', 'content' => $this->Url->build('/img/icing.png', true)]));?>
<?php $this->append('meta', $this->Html->meta(null, ['property' => 'og:description', 'content' => $page->meta_description]));?>
<?php $this->append('meta', $this->Html->meta(null, ['property' => 'og:site_name', 'content' => $this->Icing->settingsRead('Site.Title')]));?>

<?php
	$content = $this->Page->ee(
		'content',
		'Please add your content here',
		[
			'type' => 'richeditor'
		]
	);
?>
<div class="jombo">
	<div class="container">
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 logo">
			<?= $this->Html->image('IcingBlue.icingcms.png');?>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 info">
			<h1><?= $this->Icing->settingsRead('Site.Title');?></h1>
			<h3><?= $this->Icing->settingsRead('Site.Tagline');?></h3>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="sep">
	<div class="container">
		&nbsp;
	</div>
</div>
<div class="homepage-content">
	<div class="container">
			<?= $content;?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>