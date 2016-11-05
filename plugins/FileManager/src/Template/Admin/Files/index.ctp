<?php 
	$this->Html->addCrumb('File Manager', ['plugin' => 'FileManager', 'controller' => 'Files', 'action' => 'index']);
	$this->assign('title', 'FileManager');
?>
<div class="file-manager">
	<div class="file-controls">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 file-nav-buttons">
			<div class="btn-group btn-group-md" role="group" aria-label="upload and add folder">
				<?= $this->Html->link('<i class="fa fa-upload fa-2"></i> Upload','#upload',['class' => 'btn btn-primary','id' => 'upload','escape' => false]);?>
				<?= $this->Html->link('<i class="fa fa-folder fa-2"></i> Add Folder','#addFolder',['class' => 'btn btn-primary','id' => 'addfolder','escape' => false]);?>
			</div>
			<?= $this->Html->link('<i class="fa fa-refresh fa-2"></i>','#refresh',['class' => 'btn btn-default','id' => 'refresh','escape' => false]);?>
			<div class="btn-group btn-group-md" role="group" aria-label="move and delete">
				<?= $this->Html->link('<i class="fa fa-reply-all fa-2"></i> Move','#move',['class' => 'btn btn-default disabled','id' => 'move','escape' => false]);?>
				<?= $this->Html->link('<i class="fa fa-trash fa-2"></i> Delete','#delete',['class' => 'btn btn-default disabled','id' => 'delete','escape' => false]);?>
			</div>
			<div class="btn-group btn-group-md" role="group" aria-label="view">
				<?= $this->Html->link('<i class="fa fa-align-justify fa-2"></i>','#rows',['class' => 'btn btn-default active chview','id' => 'rows','escape' => false]);?>
				<?php //echo $this->Html->link('<i class="fa fa-th fa-2"></i>','#icons',['class' => 'btn btn-default chview','id' => 'icons','escape' => false]);?>
				<?php //echo $this->Html->link('<i class="fa fa-th-large fa-2"></i>','#thumbs',['class' => 'btn btn-default chview','id' => 'thumbs','escape' => false]);?>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 file-search">
			<div class="form-group has-feedback">
			 	<span class="fa fa-search fa-3 form-control-feedback"></span>
			  	<input type="text" class="form-control" id="search" aria-describedby="search" placeholder="Please type at least 3 characters">
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="main">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 display">
			<h3>Display</h3>
			<div class="list-group">
			  <?= $this->Html->link('<i class="fa fa-files-o fa-2"></i> Everything','#sort-everything',['class' => 'list-group-item libcontent','id' => 'sort-everything','escape' => false]);?>
			<?= $this->Html->link('<i class="fa fa-file-image-o fa-2"></i> Image','#sort-image',['class' => 'list-group-item libcontent','id' => 'sort-image','escape' => false]);?>
			<?= $this->Html->link('<i class="fa fa-film fa-2"></i> Video','#sort-video',['class' => 'list-group-item libcontent','id' => 'sort-video','escape' => false]);?>
			<?= $this->Html->link('<i class="fa fa-file-audio-o fa-2"></i> Audio','#sort-audio',['class' => 'list-group-item libcontent','id' => 'sort-audio','escape' => false]);?>
			<?= $this->Html->link('<i class="fa fa-file-pdf-o fa-2"></i> Documents','#sort-docs',['class' => 'list-group-item libcontent','id' => 'sort-docs','escape' => false]);?>
			</div>
			<hr>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 file-view">
			<h3 class="display-title">Everything</h3>
			<div class="content-page" id="library">
				
			</div>
			<div class="hide content-page" id="uploader">
			    <div>
				    <!-- "js-fileapi-wrapper" -- required class -->
				    <div class="js-fileapi-wrapper upload-btn">
				      <div class="upload-btn__txt">Choose files</div>
				      <input id="choose" name="files" type="file" multiple />
				    </div>
				    <div id="images"><!-- previews --></div>
			    </div>
			    <div class="file-upload-list">
			    	<div class="file-uploading file-upload-template hide">
			    		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 uploading-icon">
			    			<i class="fa-3"></i>
			    		</div>
			    		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
			    			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 desc">
			    				Photo.png 25 MB
			    			</div>
			    			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 abbort">
			    				<a href="#" class="dissmiss-file-uploading"><i class="fa fa-times"></i></a>
			    			</div>
			    			<div class="clearfix"></div>
			    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 file-progress-bar">
			    				<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
								    <span class="sr-only">1% Complete</span>
								  </div>
								</div>
			    			</div>
			    			<div class="clearfix"></div>
			    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 file-progress">
			    				45% Done
			    			</div>
			    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 file-upload-speed">
			    				<a href="#" class="stop-upload">
			    					<i class="fa fa-stop-circle-o"></i> Abort
			    				</a>
			    			</div>
			    			<div class="clearfix"></div>
			    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    				<p class="uploadReason">Uploading...</p>
			    			</div>
			    			<div class="clearfix"></div>
			    		</div>
			    		<div class="clearfix"></div>
			    	</div>
			    </div>
				<div id="drag-n-drop" class="hide">
					<h1>Drag N Drop Files Here</h1>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 select-view">
			<div class="def">
				<div class="defid">
					<i class="fa fa-crop fa-4"></i>
				</div>
				<p class="defdesc">Noting is selected.</p>
				<table class="file-info hide table table-bordered table-striped">
					<tbody>
						<tr>
							<td>Title</td>
							<td class="fi-title"></td>
						</tr>
						<tr>
							<td>Size</td>
							<td class="fi-size"></td>
						</tr>
						<tr>
							<td>Public URL</td>
							<td class="fi-url">
								<a href="#" target="_blank">Click Here</a>
							</td>
						</tr>
						<tr>
							<td>Last Modified</td>
							<td class="fi-mtime"></td>
						</tr>
					</tbody>
				</table>
				<?php if(isset($params['iframe']) && $params['iframe']  == 1):?>
					<a href="#insert" class="insert btn btn-primary hide" data-path="">Insert File</a>
				<?php endif;?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>
	window.FileAPI = { staticPath: '/file_manager/js/FileAPI/dist/' }
	var DS = '<?= DS == '\\' ? '\\'.'\\' : DS ?>'; // you need \\ for js to see as \ //windows fix
	var uploadUrl = "<?= $this->Url->build(['plugin'=>'FileManager','controller'=>'files','action'=>'upload']);?>";
	var ajaxPath = "<?= $this->Url->build(['plugin'=>'FileManager','controller'=>'files']);?>";
	var filesUrl = "<?= $this->Url->build($filesUrl); ?>";
	var imgFormats = <?= json_encode($formats['img']);?>;
	var vidFormats = <?= json_encode($formats['video']);?>;
	var audFormats = <?= json_encode($formats['audio']);?>;
	var iframe = <?= (isset($params['iframe']) && $params['iframe']  == 1) ? 'true' : 'false';?>;
	var CKEFuncNum = <?= isset($params['CKEditorFuncNum']) ? "'{$params['CKEditorFuncNum']}'" : 'false';?>;
</script>
<?php
	$this->Html->script('FileManager.FileAPI/dist/FileAPI.min', ['block' => 'script']);
	$this->Html->script('FileManager.filemanager.min', ['block' => 'script']);
?>