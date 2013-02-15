$(document).ready(function() {

	$('article').height($(window).height());

	$('a[href^="#"]').click(function(){  
	    var the_id = $(this).attr("href");  
	    $('html, body').animate({  
	        scrollLeft:$(the_id).offset().left - 300
	    }, 'slow');  
	    return false;  
	});

	$('#column1').click(function(){
		$(this).toggleClass('big');
	});

	$('#column5 .slide').each(function(){
		$(this).click(function(){
			var size = $(this).prev();
			if(size.height()=='110'){
				var test = size.height('100%');
				size.animate({height: test + 'px'}, 'slow');
				//size.height('100%');
			}else{
				size.animate({height:'110px'}, 'slow');
			}
		});
	});
});