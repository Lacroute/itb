$(".add").bind('click', function(){
	console.log($(this));
	var url = '/itb/dashboard/'+$(this).attr('data-id')+'/remove';
	var postdata =  {'idBrain': $(this).attr('data-id')};
	var request = $.post(
		url,
		postdata,
		"json"
	);
	$(this).parent().fadeOut();
	return false;
});
