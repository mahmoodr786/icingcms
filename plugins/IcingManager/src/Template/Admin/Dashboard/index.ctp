<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
?>
<?php if (!extension_loaded('zlib')): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Error: ZLib module not found.</h4>
	<p>ZLib is required by Plugin and Theme installer.</p>
	<p>
		<a  class="btn btn-success" href="https://www.google.com/#q=install+php+zlip" target="_blank">Help me install this</a>
	</p>
</div>
<?php endif;?>
<?php if (!extension_loaded('zip')): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Error: zip module not found.</h4>
	<p>zip is required by Plugin and Theme installer.</p>
	<p>
		<a  class="btn btn-success" href="https://www.google.com/#q=install+php+zip" target="_blank">Help me install this</a>
	</p>
</div>
<?php endif;?>
<?php if (!extension_loaded('SimpleXML')): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Error: SimpleXML PHP module not found.</h4>
	<p>SimpleXML is required by MenuManager to read HTML Attributes.</p>
	<p>
		<a  class="btn btn-success" href="https://www.google.com/#q=install+php+simplexml" target="_blank">Help me install this</a>
	</p>
</div>
<?php endif;?>
<?php if (!is_writable(WWW_ROOT . 'uploads' . DS)): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Write permission error </h4>
	<p><?= WWW_ROOT . 'uploads' . DS;?> Is not writable</p>
	<p>
		<a  class="btn btn-success" href="https://www.icingcms.org/docs/filemanager#permissions" target="_blank">Help me fix this</a>
	</p>
</div>
<?php endif;?>
<?php if (!is_writable(ROOT . DS . 'plugins' . DS)): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Write permission error </h4>
	<p><?= ROOT . DS . 'plugins' . DS;?> Is not writable. You will not be able to install Themes and Plugins.</p>
	<p>
		<a  class="btn btn-success" href="https://www.icingcms.org/docs/plugins#permissions" target="_blank">Help me fix this</a>
	</p>
</div>
<?php endif;?>
<?php if (!is_writable(ROOT . DS . 'plugins' . DS . 'IcingManager' . DS . 'config' . DS . 'pluginLoad.json')): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Write permission error </h4>
	<p><?= ROOT . DS . 'plugins' . DS . 'IcingManager' . DS . 'config' . DS . 'pluginLoad.json';?> file is not writable. You will not be able to install Plugins.</p>
	<p>
		<a  class="btn btn-success" href="https://www.icingcms.org/docs/plugins#permissions" target="_blank">Help me fix this</a>
	</p>
</div>
<?php endif;?>
<?php if (!is_writable(ROOT . DS . 'plugins' . DS . 'IcingManager' . DS . 'config' . DS . 'themeLoad.json')): ?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4>Write permission error </h4>
	<p><?= ROOT . DS . 'plugins' . DS . 'IcingManager' . DS . 'config' . DS . 'themeLoad.json';?> file is not writable. You will not be able to install Plugins.</p>
	<p>
		<a  class="btn btn-success" href="https://www.icingcms.org/docs/themes#permissions" target="_blank">Help me fix this</a>
	</p>
</div>
<?php endif;?>

<div class="widget col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<label>Widget</label>
	<div class="dash">
		<a href="https://www.icingcms.org/docs/widget" target="_blank">
			<i class="fa fa-plus" aria-hidden="true"></i>
		</a>
	</div>
</div>
<div class="widget col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<label>Widget</label>
	<div class="dash">
		<a href="https://www.icingcms.org/docs/widget" target="_blank">
			<i class="fa fa-plus" aria-hidden="true"></i>
		</a>
	</div>
</div>
<div class="clearfix"></div>
<div class="widget col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<label>Widget</label>
	<div class="dash">
		<a href="https://www.icingcms.org/docs/widget" target="_blank">
			<i class="fa fa-plus" aria-hidden="true"></i>
		</a>
	</div>
</div>
<div class="widget col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<label>Widget</label>
	<div class="dash">
		<a href="https://www.icingcms.org/docs/widget" target="_blank">
			<i class="fa fa-plus" aria-hidden="true"></i>
		</a>
	</div>
</div>