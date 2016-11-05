<?php
use Cake\Core\Configure;
$this->layout = "ajax";
function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
?>
<ol class="breadcrumb">
	<?php
		$i = 1;
		$len = count($crumbs);
		$parentPath = '';
		$addPath = '';
	?>
	<?php foreach ($crumbs as $crumb => $path):?>
		<?php
			if($i > 1){
				$addPath = $addPath . DS .$path; 
			}
		?>
		<?php if($i == $len):?>
			<li><a href="#" class="cddir last" data-path="<?php echo $addPath;?>"><?php echo $crumb; ?></a></li>
		<?php elseif($i == 1):?>
			<li><a href="#" class="cddir" data-path="/"><?php echo $crumb; ?></a></li>
		<?php else: ?>
			<li><a href="#" class="cddir" data-path="<?php echo $addPath;?>"><?php echo $crumb; ?></a></li>
		<?php endif;?>
		<?php 
			if($i == ($len - 1)){
				$parentPath = $addPath;
			}
		?>
		<?php $i++; ?>
	<?php endforeach;?>
</ol>
<?php if($view == 'icons'):?>

<?php elseif($view == 'thumbs'):?>
	
<?php else: ?>
<table class="table table-striped table-hover file-list-table">
	<tbody>
		<?php if($len > 1):?>
			<?php
				if(empty($parentPath)) $parentPath = '/'; 
			?>
			<tr class="dir-row parent" data-path="<?php echo $parentPath;?>">
				<td>
					<div class="dir">
						<div class="icon col-lg-1 col-md-1 col-sm-1 col-xs-1">
							<i class="fa fa-folder"></i>
						</div>
						<div class="name col-lg-7 col-md-7 col-sm-7 col-xs-7">
							.. 
						</div>
						<div class="info col-lg-4 col-md-4 col-sm-4 col-xs-4">
							 Parent Directory	
						</div>
					</div>
				</td>
			</tr>
		<?php endif;?>
		<?php foreach ($list as $fileOrDir):?>
			<?php if($fileOrDir['type'] == "dir"):?>
				<tr class="dir-row" data-type="dir" data-path="<?php echo $relativePath . DS . $fileOrDir['path'];?>">
					<td>
						<div class="dir">
							<div class="icon col-lg-1 col-md-1 col-sm-1 col-xs-1">
								<i class="fa fa-folder"></i>
							</div>
							<div class="name col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<?php echo $fileOrDir['filename'];?> 
							</div>
							<div class="info col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<?php echo $fileOrDir['count'];?> item(s) 	
							</div>
						</div>
					</td>
				</tr>
			<?php endif; ?>
		<?php endforeach;?>
		<?php foreach ($list as $fileOrDir):?>
			<?php if($fileOrDir['type'] == "file"):?>
					<?php
						$ext = isset($fileOrDir['extension']) ? $fileOrDir['extension'] : 'None';
					?>
					<tr class="file-row" data-type="file" data-path="<?php echo $relativePath . DS . $fileOrDir['path'];?>" data-ext="<?php echo $ext; ?>">
						<td>
							<div class="file">
								<div class="icon col-lg-1 col-md-1 col-sm-1 col-xs-1">
									<i class="<?php echo $fileOrDir['icon'];?>"></i>
								</div>
								<div class="name col-lg-7 col-md-7 col-sm-7 col-xs-7">
									<?php echo $fileOrDir['basename'];?> 
								</div>
								<div class="info col-lg-4 col-md-4 col-sm-4 col-xs-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fr-size">
										<?php echo human_filesize($fileOrDir['size']);?>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 fr-mtime">
										Last Modified: <?php echo date('M d, Y',$fileOrDir['timestamp']);?>
									</div>
									<div class="clearfix"></div>	
								</div>
							</div>
						</td>
					</tr>
			<?php endif;?>
		<?php endforeach;?>
		
	</tbody>
</table>
<?php endif;?>