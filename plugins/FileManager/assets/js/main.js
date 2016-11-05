
/** Golobal vars **/
var moveInProg = false, 
	deleteInProg = false,
	currentDir = '',
	view = '',
	serach = '';

$(function(){

	function ajaxify(url,element,is_callback, callback){
		$.get(ajaxPath + url,function(data){
			if(is_callback){
				callback(data);
			}else{
				$(element).html(data);
			}
		});
	}
	function initMove(){
		var dataToServer = {};
		var i = 1;
		var dir = '';
		if(currentDir !=''){
			dir = 'dir=' +currentDir+ '&';
		}
		dataToServer[0] = $('.moveTo').attr('data-path');
		$('.moveInProg').each(function(){
			dataToServer[i] =  $(this).attr('data-type') + ':' +$(this).attr('data-path');
			i++;
		});

		$.post(ajaxPath + '/movefiles?' + dir, dataToServer)
		.done(function( data ) {
		    alert( "Files Moved");
		});

		console.log(dataToServer);
	}
	function initDelete(){
		var dataToServer = {};
		var i = 1;
		var dir = '';
		if(currentDir !=''){
			dir = 'dir=' +currentDir+ '&';
		}
		$('.selected').each(function(){
			dataToServer[i] =  $(this).attr('data-type') + ':' +$(this).attr('data-path');
			i++;
		});

		$.post(ajaxPath + '/deletefiles?' + dir, dataToServer)
		.done(function( data ) {
		    alert( "Files Deleted");
		});

		console.log(dataToServer);
	}
	/**** Upload Functions ***/
	var fileUpload = {
		icon: {
			  def:   'fa fa-file',
			  image: 'fa fa-picture-o',
			  audio: 'fa fa-file-audio-o',
			  video: 'fa fa-film'
		},

		files: [],
		index: 0,
		active: false,

		add: function (file){
			fileUpload.files.push(file);

			if( /^image/.test(file.type) ){
				FileAPI.Image(file).preview(40).rotate('auto').get(function (err, img){
					if( !err ){
						fileUpload._getEl(file, '.uploading-icon')
							.html(img)
						;
					}
				});
			}
		},

		getFileById: function (id){
			var i = fileUpload.files.length;
			while( i-- ){
				if( FileAPI.uid(fileUpload.files[i]) == id ){
					return	fileUpload.files[i];
				}
			}
		},

		start: function (){
			if( !fileUpload.active && (fileUpload.active = fileUpload.files.length > fileUpload.index) ){
				fileUpload._upload(fileUpload.files[fileUpload.index]);
			}else{
				$('#refresh').click();
			}
		},

		abort: function (id){
			var file = this.getFileById(id);
			if( file.xhr ){
				file.xhr.abort();
			}
		},

		_getEl: function (file, sel){
			var $el = $('#file-'+FileAPI.uid(file));
			return	sel ? $el.find(sel) : $el;
		},

		_upload: function (file){
			var dir = '';
			if(currentDir !=''){
				dir = '?dir=' +currentDir;
			}

			if( file ){
				file.xhr = FileAPI.upload({
					url: uploadUrl+dir,
					files: { file: file },
					upload: function (){
						//anyfunction before upload
					},
					progress: function (evt){
						fileUpload._getEl(file, '.progress-bar').css('width', evt.loaded/evt.total*100+'%');
						fileUpload._getEl(file, '.file-progress').html((evt.loaded/evt.total*100).toFixed(0)+'% Done');
					},
					complete: function (err, xhr){
						data = JSON.parse(xhr.response);
						var state = "Done";
						if(err || data.msg == "Failed"){
							state = data.msg;
							fileUpload._getEl(file, '.progress-bar').addClass('progress-bar-danger');
						}

						fileUpload._getEl(file, '.file-upload-speed').html('<b>'+state+'</b>');
						fileUpload._getEl(file, '.uploadReason').html(data.reason);
						fileUpload.index++;
						fileUpload.active = false;

						fileUpload.start();
					}
				});
			}
		}
	};
	
	function onFiles(files){
		FileAPI.each(files, function (file){
			if( file.size >= 25*FileAPI.MB ){
				alert('Sorry.\nMax size 25MB')
			}else if( file.size === void 0 ){
				$('#uploader').html('Your browser is not supported.');
			}else {
				var uid = FileAPI.uid(file);
				var template = $('.file-upload-template').clone();
				template.removeClass('hide').removeClass('file-upload-template');
				template.attr('id','file-' + uid);
				template.find('.stop-upload').attr('data-id','file-' + uid);
				template.find('.dissmiss-file-uploading').attr('data-id','file-' + uid);
				template.find('.desc').html(file.name + ' ' + (file.size/FileAPI.KB).toFixed(2) + ' KB');
				template.find('.uploading-icon i').addClass(fileUpload.icon[file.type.split('/')[0]] || fileUpload.icon.def);
				$('.file-upload-list').append(template);
				fileUpload.add(file);
				fileUpload.start();
			}
		});
	}
	function setTab(show,title){
		$('.content-page').addClass('hide');
		$(show).removeClass('hide');
		$('.display-title').html(title);
	}

	function showSelected(){
		var count = 0;

		$('.selected').each(function(){
			count++;
		});

		if(count > 0){
			$('#move, #delete').removeClass('disabled');
		}else{
			$('#move, #delete').addClass('disabled');
		}
	}
	function getThisDir(row){
		var path = row.attr('data-path');
		var def = $('.def');
		if(currentDir !=''){
			path = currentDir + DS + path;
		}
		def.find('.defid').html(row.find('i').clone());
		def.find('p').removeClass('hide').html('Double click to browse folder');
		def.find('table').addClass('hide');
		
	}
	function getThisFile(row){
		var path = row.attr('data-path');
		var ext = row.attr('data-ext');
		var def = $('.def');
		if($.inArray(ext,imgFormats) > -1){
			var img = '<img src="' + filesUrl + path + '" alt="defimg" class="img-responsive"/>';
			def.find('.defid').html(img);
		}else if($.inArray(ext,vidFormats) > -1){
			var vid = '<video width="100%" height="100%" controls>'+
						  '<source src="' + filesUrl + path + '" type="video/mp4">'+
						  '<source src=' + filesUrl + path + '" type="video/ogg">'+
							'Your browser does not support the video tag.'+
						'</video>';
			def.find('.defid').html(vid);
		}else if($.inArray(ext,audFormats) > -1){
			var aud = '<audio controls>'+
						  '<source src="' + filesUrl + path + '" type="audio/ogg">' +
						  '<source src="' + filesUrl + path + '" type="audio/mpeg">' +
							'Your browser does not support the audio element.' +
						'</audio>';
			def.find('.defid').html(aud);
		}else{
			def.find('.defid').html(row.find('i').clone());
		}
		def.find('.fi-mtime').html(row.find('.fr-mtime').html());
		def.find('.fi-size').html(row.find('.fr-size').html());
		def.find('.fi-title').html(row.find('.name').html());
		def.find('.fi-url a').attr('href',filesUrl + path);
		def.find('p').addClass('hide');
		def.find('table').removeClass('hide');
		if(iframe){
			def.find('.insert').removeClass('hide').attr('data-path',filesUrl + path);
		}
		
	}
	$('#upload').click(function(e){
		setTab('#uploader','Upload');
		e.preventDefault();
	});

	$('#upload').click(function(e){
		setTab('#uploader','Upload');
		e.preventDefault()
	});

	if( !(FileAPI.support.cors || FileAPI.support.flash) ){
		$('#uploader').html('Your browser is not supported.');
	}
	if( FileAPI.support.dnd ){
		$('#drag-n-drop').removeClass('hide');
		$(document).dnd(function (over){
			if(over){
				$('#drag-n-drop').find('h1').html('Drop');
			}else{
				$('#drag-n-drop').find('h1').html('DRAG N DROP FILES HERE');
			}
		}, function (files){
			onFiles(files);
		});
	}
	$('#choose').on('change', function (evt){
		var files = FileAPI.getFiles(evt);
		onFiles(files);
		FileAPI.reset(evt.currentTarget);
	});
	$(document).on('click', '.stop-upload', function (evt){
		fileUpload.abort($(this).attr('data-id').split('-')[1]);
		evt.preventDefault();
	});
	$(document).on('click', '.dissmiss-file-uploading', function (evt){
		var id = '#' + $(this).attr('data-id');
		$(id).remove();
		evt.preventDefault();
	});

	/********* End Upload function ********/
	/********* List Functions      ********/
	var filter = "";
	$('#refresh').click(function(e){
		var dir = '';
		if(currentDir !=''){
			dir = 'dir=' +currentDir;
		}
		var setView = '';
		if(view != ''){
			setView = '&view=' + view;
		}
		var setsearch = '';
		if(search.length > 2 ){
			setsearch = '&search=' + search;
		}

		if(filter != ""){
			ajaxify('/getfiles?' +dir+ '&filter='+filter + setView + setsearch,'#library',false);
		}else{
			ajaxify('/getfiles?' +dir + setView + setsearch,'#library',false);
		}

		$('#move, #delete').addClass('disabled');

		e.preventDefault();
	});
	$('#refresh').click(); //load the files.

	$('.libcontent').click(function(e){
		
		var href = $(this).attr('href');
		filter = href.substring(1);
		if(filter == "sort-everything") filter = "";

		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		
		switch(href){
			case '#sort-image':
				setTab('#library','Images');
			break;

			case '#sort-video':
				setTab('#library','Videos');
			break;

			case '#sort-audio':
				setTab('#library','Audios');
			break;

			case '#sort-docs':
				setTab('#library','Documents');
			break;

			default:
				setTab('#library','Everything');
			break;

		}
		$('#refresh').click();
		e.preventDefault();
	});

	$(document).on('click', '.file-list-table tr',function(e){
		if(moveInProg){
			$('#move').html('<i class="fa fa-check"></i> Done');
			$('#move').addClass('done').removeClass('cancel');
			$(this).addClass('moveTo');
			$('.selected').addClass('moveInProg');
		}
		if(e.ctrlKey && !moveInProg){
			if($(this).hasClass('selected')){
				$(this).removeClass('selected');
			}else{
				$(this).addClass('selected');
				$('.def').find('p').html('Multiple Items Selected').removeClass('hide');
				$('.def').find('table').addClass('hide');
			}
		}else{
			$(this).siblings().removeClass('selected');
			$(this).addClass('selected');
			if($(this).hasClass('dir-row')){
				getThisDir($(this));
			}else{
				getThisFile($(this));
			}
			
		}

		showSelected();
		e.preventDefault();
	});
	$('#move').click(function(e){
		if($(this).hasClass('disabled')){
			//do noting move is not allowed
		}else if($(this).hasClass('cancel')){
			$(this).removeClass('cancel');
			$('#move').html('<i class="fa fa-reply-all fa-2"></i> Move').addClass('disabled');
			$('#refresh').click();
			moveInProg = false;
		}else if($(this).hasClass('done')){
			initMove();
			$(this).removeClass('done');
			$('#move').html('<i class="fa fa-reply-all fa-2"></i> Move');
			$('#refresh').click();
			moveInProg = false;
		}else{
			$('.file-row').addClass('hide');
			$('.dir-row.selected').hide();
			moveInProg = true;
			$(this).html('<i class="fa fa-ban"></i> Cancel');
			$(this).addClass('cancel');
		}
		
		e.preventDefault();
	});
	$('#delete').click(function(e){
		if($(this).hasClass('disabled')){
			//do noting delete is not allowed
		}else{
			if(confirm('Are you sure you want to DELETE files or/and Directories?')){
				initDelete();
				$('#refresh').click();
			}else{
				$('#refresh').click();
			}
		}
		
		e.preventDefault();
	});
	$('#addfolder').popover({
		html: true,
		content:function(){
			return '<div class="form-inline add-folder-popover">' +
			'<input type="text" class="form-control" id="folder-name" placeholder="Folder Name">'+
			'<button class="btn btn-primary" id="add-folder">Add</button>' +
			'</div>';
		},
		placement: 'bottom',
		title:'Add a Folder',
		trigger: 'click'
	});
	$('.chview').click(function(e){

		$('.chview').removeClass('active');
		$(this).addClass('active');
		view = $(this).attr('id');
		if(view == 'rows'){
			view = '';
		}
		$('#refresh').click();
		e.preventDefault();

	});
	$(document).on('click', '#add-folder',function(e){
		var dir = "";
		if(currentDir !=''){
			dir = 'dir=' +currentDir+ '&';
		}
		var folderName = $('#folder-name').val();
		if(folderName != ''){
			$('#addfolder').click();
			
			ajaxify('/addfolder?' + dir+'&dirname=' + folderName,'',true,function(data){
				$('#refresh').click();
			});
		}
		e.preventDefault();
	});
	$(document).on('click', '.cddir',function(e){
		if($(this).hasClass('last')){
			$('#refresh').click();
			return;
		}
		var path = $(this).attr('data-path');
		var newPath = '';
		if(path == DS){
			currentDir = "";
			$('#refresh').click();
		}else{
			currentDir = path;
			$('#refresh').click();
		}
	});
	$(document).on('dblclick', '.dir-row',function(e){
		var path = $(this).attr('data-path');
		if($(this).hasClass('parent')){
			if(currentDir == ""){
				currentDir = DS;
			}else{
				var goBack = currentDir.split(DS);
				goBack.pop();
				currentDir = goBack.join(DS);
			}
		}else{
			if(currentDir == ""){
				currentDir = path;
			}else{
				//currentDir = currentDir + '/' + path;
				currentDir = path;
			}
		}

		$('#refresh').click();
		e.preventDefault();
	});
	/*** search ***/
	var searchTimer;
	var typingintr = 500;
	$('#search').keyup(function(e){
		clearTimeout(searchTimer);
		var keywords = $(this).val();
		searchTimer = setTimeout(function(){
			if(keywords.length > 2){
				search = keywords;
				$('#refresh').click();
			}else{
				search = '';
				if(keywords.length < 1){
					$('#refresh').click();
				}
			}
		}, typingintr);
		e.preventDefault();
	});
	
	$('.insert').click(function(){
		var path = $(this).attr('data-path');
		if(CKEFuncNum){
			window.opener.CKEDITOR.tools.callFunction( CKEFuncNum, path );
            window.close();
		}else{
			parent.addPath(path);
		}
		
	});
	
})




			

