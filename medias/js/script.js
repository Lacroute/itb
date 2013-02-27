$(document).ready(function() {

	$('article').height($(window).height());

	$('a[href^="#"]').click(function(){  
	    var the_id = $(this).attr("href");  
	    $('html, body').animate({  
	        scrollLeft:$(the_id).offset().left - 300
	    }, 'slow');  
	    return false;  
	});

	$('#column2').click(function(){
		$(this).toggleClass('big');
	});

	$('nav a.twitter').click(function(){
		$('#column2').addClass('big');
	});


	$('nav a:first-child').click(function(){
		$('#column2').removeClass('big');
	});

	/*$('#column6 dl dd:nth-child(3)').addClass('smaller');

	$('#column6 .slide').each(function(){
		$(this).click(function(){
			var size = $(this).prev();
			size.toggleClass('smaller');
		});
	});*/

});