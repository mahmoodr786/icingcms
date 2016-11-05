$(function(){
	var url = window.location.protocol + "//" + window.location.hostname;
	if(url == window.location.href || window.location.href == url + '/'){
		$(window).scroll(function(){
			if($(this).scrollTop() < 50){
				if(!$('.navbar').hasClass('clear-nav')){
					$('.navbar').addClass('clear-nav');
				}
			}

			if($(this).scrollTop() > 50){
				if($('.navbar').hasClass('clear-nav')){
					$('.navbar').removeClass('clear-nav');
				}
			}
		});
	}else{
		$('.navbar').removeClass('clear-nav');
	}
})