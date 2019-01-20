$(document).ready(function() {
	
	
		var window_height = $(window).height() - 400;
		var scroll_top1 = $(window).scrollTop();
		//var difference = scroll_top1 - window_height;
		
		
		if(scroll_top1 > window_height){
				$('#arrow_up').fadeIn(1000);
			}else{
				$('#arrow_up').css('display', 'none');
			}
		$(window).scroll(function(){
			var window_height = $(window).height() - 400;
			var scroll_top = $(window).scrollTop();
			
			if(scroll_top > window_height){
				$('#arrow_up').fadeIn(1000);
			}
			if(scroll_top < window_height){
				$('#arrow_up').fadeOut(1000);
			}
		});
		
		$('#arrow_up').click(function(){
			$('html, body').animate({ scrollTop: 0}, 1000, 'swing');
		});
		
		

});