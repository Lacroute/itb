$(document).ready(function() {

	$('article').height($(window).height());

	$('a[href^="#"]').click(function(){  
	    var the_id = $(this).attr("href");  
	    $('html, body').animate({  
	        scrollLeft:$(the_id).offset().left - 350
	    }, 'slow');  
	    return false;  
	});

	$('#column2').click(function(){
		$(this).toggleClass('big');
	});

	$('nav a.twitter').click(function(){
		$('#column2').addClass('big');
		$('#twitterResults').addClass('columns');
		$('#column2 .data ul').addClass('clic');
	});

	$('nav a.news').click(function(){
		$('#column6').addClass('big');
	});

	$('nav a:not(.news)').click(function(){
		$('#column6').removeClass('big');
	});

	$('nav a:first-child').click(function(){
		$('#column2').removeClass('big');
		$('#twitterResults').removeClass('columns');
		$('#column2 .data ul').removeClass('clic');
	});

	/*$('#column6 dl dd:nth-child(3)').addClass('smaller');

	$('#column6 .slide').each(function(){
		$(this).click(function(){
			var size = $(this).prev();
			size.toggleClass('smaller');
		});
	});*/

});