(function() {

	$('#connect').addClass('connect');

	$('a[href^="#"]').click(function(){  
	    var the_id = $(this).attr("href");  
	    $('html, body').animate({  
	        scrollTop:$(the_id).offset().top
	    }, 'slow');  
	    return false;  
	});

	$('article.info').click(function(){
		$(this).toggleClass('active');
	});


	$('#search').hide();


	$('dl').click(function(){
		$('#search').slideDown(1000);		
	});

})();