<?php
	$content = $this->Page->ee(
		'content',
		'Please add your content here',
		[
			'type' => 'richeditor'
		]
	);

	$siteTitle = $this->Page->ee(
		'site_title',
		'Defult Value',
		[
			'type'=>'text',
			'placeholder'=>'Site Title',
			'class' => 'form-control',
			'templates' => [
				'inputContainer' => '<div class="input {{type}}{{required}} form-group col-sm-6 col-xs-12">{{content}}</div>'
			]
		]
	);
	$siteTagLine = $this->Page->ee(
		'site_tag_line',
		'Defult Value',
		[
			'type'=>'text',
			'placeholder'=>'Site Tag Line',
			'class' => 'form-control',
			'templates' => [
				'inputContainer' => '<div class="input {{type}}{{required}} form-group col-sm-6 col-xs-12">{{content}}</div>'
			]
		]
	);
	$siteDesc = $this->Page->ee(
		'site_description',
		'Defult Value',
		[
			'type'=>'textarea',
			'placeholder'=>'Site Description',
			'class' => 'form-control',
			'templates' => [
				'inputContainer' => '<div class="input {{type}}{{required}} form-group col-sm-12 col-xs-12">{{content}}</div>'
			]
		]
	);
	$oneselect = $this->Page->ee(
		'oneselect',
		'c',
		[
			'type'=>'select',
			'class' => 'form-control',
			'options' => [
				'a' => 'Select A',
				'c' => 'Select C',
				'e' => 'Select e'
			]
		]
	);
	$alphas = $this->Page->ee(
		'alphas',
		['a','c'],
		[
			'type'=>'select',
			'multiple'=> 'checkbox',
			'options' => [
				'a' => 'Select A',
				'c' => 'Select C',
				'e' => 'Select e'
			]
		]
	);
	$radios = $this->Page->ee(
		'radios',
		'test002',
		[
			'type'=>'radio',
			'options' => [
				['value' => 'test001', 'text' => 'Select Test 1', 'class' => 'radio'],
				['value' => 'test002', 'text' => 'Select Test 2'],
				['value' => 'test003', 'text' => 'Select Test 3']
			]
		]
	);
	$brandImg = $this->Page->ee(
		'brand_image',
		'IcingBlue.brand.png',
		[
			'type' => 'FileManager',
			'class' => 'form-control',
			'label' => false,
			'templates' => [
				'inputContainer' => '<div class="input {{type}}{{required}} form-group col-sm-12 col-xs-12">
										<label for="brand-image">Brand Image</label>
										<div class="input-append">
											{{content}} {{button}}
										</div>
									 </div>'
			]
		]
	);
	
	$color = $this->Page->ee(
		'color',
		'blue',
		[
			'type' => 'color'
		]
	);
	$mselects = $this->Page->ee(
		'mselect',
		['a','c'],
		[
			'type'=>'select',
			'multiple'=> true,
			'options' => [
				'a' => 'Select A',
				'c' => 'Select C',
				'e' => 'Select e'
			]
		]
	);
?>
<div class="element">
	<p>Element</p>
	<?= $this->element('ContentManager.widget');?>
</div>
<?= $this->cell('ContentManager.Content');?>
<h1><?= $siteTitle;?></h1>
<h3><?= $siteTagLine;?></h3>
<p><?= $siteDesc;?></p>
<ul>
	<?php foreach ($alphas as $alpha): ?>
	<li><?=$alpha;?></li>
	<?php endforeach;?>
</ul>
<ul>
	<?php foreach ($mselects as $mselect): ?>
	<li><?=$mselect;?></li>
	<?php endforeach;?>
</ul>
<?= $this->Html->image($brandImg);?>
<?= $content;?>
<div style="width:100px; height:100px; background: <?=$color;?>;">
	Hi
</div>
<div class="clearfix"></div>
<div id="custom_data_form" class="hide">
	<?= $this->Page->form; ?>
</div>
