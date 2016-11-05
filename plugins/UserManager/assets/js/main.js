var fileManagerCallerID = '';
var baseFilePath = '';
function addPath(path){
	path = path.replace('//','/');
	path = baseFilePath.length > 1 ? path.replace(baseFilePath,'/') : path;
	$('#' + fileManagerCallerID).val(path);
	$('.file-manager-frame').remove();
}

$(function(){
	
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
	
});