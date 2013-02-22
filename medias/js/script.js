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

	$('nav a.twitter').click(function(){
		$('#column1').toggleClass('big');
	});

	$('nav a:nth-child(n+2)').click(function(){
		$('#column1').removeClass('big');
	});

	/*$('#column5 dl dd:nth-child(3)').addClass('smaller');

	$('#column5 .slide').each(function(){
		$(this).click(function(){
			var size = $(this).prev();
			size.toggleClass('smaller');
		});
	});*/

});