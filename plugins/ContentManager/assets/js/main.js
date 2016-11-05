var fileManagerCallerID = '';
var baseFilePath = '';
var richEditors = [];
var aceEditors = {};
function addPath(path){
	path = path.replace('//','/');
	path = baseFilePath.length > 1 ? path.replace(baseFilePath,'/') : path;
	$('#' + fileManagerCallerID).val(path);
	$('.file-manager-frame').remove();
}

$(function(){

	$('form').submit(function(){
		richEditors.forEach(function(editor){
			editor.updateElement();
		});
		Object.keys(aceEditors).forEach(function(id){
			var aceEditor = aceEditors[id];
			var textareId = id.replace('code-','#');
			$(textareId).val(aceEditor.getValue());
		});
		
		return true;
	});
	$(window).bind('keydown', function(e) {
		if (e.ctrlKey || e.metaKey) {
			if(String.fromCharCode(e.which).toLowerCase() == 's'){
				$('form').submit();
				e.preventDefault();
				return false;
			}
		}
	});
	$('.filemanager').click(function(){
		var iframeLink = $(this).attr('iframe');
		fileManagerCallerID = $(this).attr('data-id');
		baseFilePath = $(this).attr('data-base-path');
		var fileManagerHtml = '<div class="file-manager-frame">' +
						  '<iframe src="' + iframeLink + '" width="100%" height="100%"></iframe>' +
						  '</div>';
		$('body').append(fileManagerHtml);		
	});
	$(document).on('click','.file-manager-frame',function(){
		$('.file-manager-frame').remove();
	});
	$('.richeditor').each(function(){
		var ckEditor = CKEDITOR.replace(this,{
			filebrowserBrowseUrl: $(this).attr('data-filemanager')
		});
		ckEditor.config.allowedContent = true;
		richEditors.push(ckEditor);
	});
	$('.ace-editor').each(function(){
		var id = $(this).attr('id');
		var editor = ace.edit(id);
		var textareId = id.replace('code-','#');
		editor.setTheme($(this).attr('data-theme'));
		editor.getSession().setMode($(this).attr('data-mode'));
		editor.setValue($(textareId).val());
		aceEditors[id] = editor;
	});
	
});