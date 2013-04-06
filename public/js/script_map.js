$(document).ready(function() {

	var widthDiv;
			var heightDiv;
			var widthDivs;
			var heightDivs;
			var widthWindow=window.innerWidth;
			var heightWindow=window.innerHeight;
			var margeTop;
			var margeLeft;
			var iframWidth;
			var iframeHeight;

			$('#container').click(function(){
				show();
			});

			$('#twitter').click(function(){
				hide();
				$("div[data-type='tweet']").css({"z-index" : 2});
				$("div[data-type='tweet']").css({"opacity" : 1});
			});
			$('#vimeo').click(function(){
				hide();
				$("div[data-type='vimeo']").css({"z-index" : 2});
				$("div[data-type='vimeo']").css({"opacity" : 1});
			});
			$('#pinterest').click(function(){
				hide();
				$("div[data-type='pinterest']").css({"z-index" : 2});
				$("div[data-type='pinterest']").css({"opacity" : 1});
			});
			$('#dribble').click(function(){
				hide();
				$("div[data-type='dribbble']").css({"z-index" : 2});
				$("div[data-type='dribbble']").css({"opacity" : 1});
			});
			$('#synonym').click(function(){
				hide();
				$("div[data-type='synonym']").css({"z-index" : 2});
				$("div[data-type='synonym']").css({"opacity" : 1});
			});
			$('#news').click(function(){
				hide();
				$("div[data-type='news']").css({"z-index" : 2});
				$("div[data-type='news']").css({"opacity" : 1});
			});


			function hide(){
				$('#container div').css({"z-index" : 1});
				$('#container div').css({"opacity" : 0.5});
			}

			function show(){
				$('#container div').css({"z-index" : 1});
				$('#container div').css({"opacity" : 1});
			}

			$('#wrapper').height(heightWindow);
			$("#container").width(widthWindow*4);
			$("#container").height(heightWindow*4);
			positionMap();

		   $( "#plus" ).click(function() {
		   		widthDiv = $('#container').width()*1.2;
		   		heightDiv = $('#container').height()*1.2;
		   		widthDivs = $('.blocs').width()*1.2;
		   		updateSize();
			});

		   $( "#moins" ).click(function() {
		   		widthDiv = $('#container').width()/1.2;
		   		heightDiv = $('#container').height()/1.2;
		   		widthDivs = $('.blocs').width()/1.2;
				updateSize();
			});

		   function positionMap()
		   {
		   		margeLeft = -($('#container').width()-widthWindow)/2;
	  			margeTop = -($('#container').height()-heightWindow)/2;
	  			$('#container').css({'margin-left' : margeLeft});
	  			$('#container').css({'margin-top' : margeTop});
		   }

		   function updateSize(){

			   	if (widthDiv>widthWindow) {
			   		$('#container').width(widthDiv);
					$('#container').height(heightDiv);
					$('.blocs').width(widthDivs);
					positionMap();
			    }else{
			   		alert("Can't zoom anymore");
			   	};

		   }

   initBoard();

   function jsonCreator(e, data){
   		if(e){
   			if(typeof e.target.attributes.id != 'undefined'){
				return false;
			}
   		}
		

		var json = {};
	    	json['idUser'] = 3;
	    	json['brainName'] = "Mon premier brain";
	    	json['items'] = [];

		$(".blocs").each(function(){
			var type = $(this).attr('data-type'),
				posX = $(this).position().left/$("#container").width()*100,
				posY = $(this).position().top/$("#container").height()*100,
				id = $(this).attr('data-id');

			switch(type){

				case "news":
					var title = $('h2 a', this).html(),
						text = $('p', this).html(),
						url = $('h2 a', this).attr('href');
						json['items'].push({type: type, title: title, text: text, url: url, posX: posX, posY: posY});
					break;

				case "synonym":
					var word = $("span",this).html();
						json['items'].push({type: type, word: word, posX: posX, posY: posY});
					break;

				case "tweet":
					var username = $('span', this).html(),
						userpic = $('img',this).attr('src'),
						text = $('p',this).html();
						json['items'].push({type: type, username: username, text: text, userpic: userpic, posX: posX, posY: posY});
					break;

				case "dribbble":
					var title = $('h2', this).html(),
						full = $('a.link-full',this).attr('href'),
						thumbnail = $('img.thumbnail',this).attr('src');
						json['items'].push({type: type, username: username, title: title, full: full, thumbnail: thumbnail, posX: posX, posY: posY});
					break;

				case "pinterest":
					var full = $('a.link-full',this).attr('href'),
						thumbnail = $('img.thumbnail',this).attr('src');
						json['items'].push({type: type, username: username, full: full, thumbnail: thumbnail, posX: posX, posY: posY});
					break;

				case "vimeo":
					var idVimeo = $(this).attr('data-idVimeo'),
						title = $('h2', this).html();
						json['items'].push({type: type, title: title, idVimeo: idVimeo, posX: posX, posY: posY});
					break;

			}
		});

		$.ajax({
			type: "POST",
			url: baseUrl+"/dashboard/"+brainId+"/edit",
			data: {json: json},
			success: function(){
				console.log("SUCCES");
			},
		});
	}

   function initBoard(){

	$.getJSON(baseUrl+'/public/brains/'+brainId+'/data.json', function(data) {
			var items = [];
			$.each(data.items, function(key, val) {
				var classType = data.items[key]['type'],
					posX = data.items[key]['posX'],
					posY = data.items[key]['posY'],
					itemId = key;
					if (posX=="" && posY=="") {
						posX=Math.floor(Math.random() * (55 - 45) + 45);
						posY=Math.floor(Math.random() * (55 - 45) + 45);
					};

				switch(classType){

					case "tweet":
						var text = data.items[key]['text'],
							username = data.items[key]['username'],
							twitpic = data.items[key]['userpic'];
						items.push('<div class="draggable '+classType+' blocs" data-id="'+itemId+'" data-type="'+classType+'" style="top: '+posY+'%; left: '+posX+'%; "><span>'+username+'</span><a class="btnplus"></a><p>'+text+'</p></div>');
						break;

					case "synonym":
						var word = data.items[key]['word'];
						items.push('<div class="draggable '+classType+' blocs" data-id="'+itemId+'" data-type="'+classType+'" style="top: '+posY+'%; left: '+posX+'%; "><a class="btnplus"></a><span>'+word+'</span></div>');
						break;

					case "vimeo":
						var idVimeo = data.items[key]['idVimeo'],
							title =  data.items[key]['title'];
						items.push('<div class="draggable '+classType+' blocs" data-id="'+itemId+'" data-type="'+classType+'" data-idVimeo="'+idVimeo+'" style="top: '+posY+'%; left: '+posX+'%; "><h2>'+title+'</h2><a class="btnplus"></a><iframe src="http://player.vimeo.com/video/'+idVimeo+'?byline=0&badge=0&color=222&title=0&portrait=0" width="267" height="170" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>');
						break;

					case "news":
						var title = data.items[key]['title'],
							text = data.items[key]['text'],
							url = data.items[key]['url'];
						items.push('<div class="draggable '+classType+' blocs" data-id="'+itemId+'" data-type="'+classType+'" style="top: '+posY+'%; left: '+posX+'%; "><h2><a href="'+url+'" target="blank">'+title+'</a></h2><a class="btnplus"></a><p>'+text+'</p></div>');
						break;

					case "dribbble":
						var title = data.items[key]['title'],
							full = data.items[key]['full'],
							thumbnail = data.items[key]['thumbnail'];
						items.push('<div class="draggable '+classType+' blocs" data-id="'+itemId+'" data-type="'+classType+'" style="top: '+posY+'%; left: '+posX+'%; "><h2>'+title+'</h2><a class="btnplus"></a><a class="link-full" href="'+full+'"><img class="thumbnail" src="'+thumbnail+'" /></a></div>');
						break;

					case "pinterest":
						var full = data.items[key]['full'],
							thumbnail = data.items[key]['thumbnail'];
						items.push('<div class="draggable '+classType+' blocs" data-id="'+itemId+'" data-type="'+classType+'" style="top: '+posY+'%; left: '+posX+'%; "><a class="btnplus"></a><a class="link-full" href="'+full+'"><img class="thumbnail" src="'+thumbnail+'" /></a></div>');
						break;
				}

				$("#container").html(items.join(''));
				$( ".draggable" ).draggable({
					stop: function( event, ui ) {jsonCreator(event, ui);},
					// containment: "parent",
				}).trigger('dragstop');

				$(".btnplus").click(function(e){
					if (confirm("Do you really want to delete this item ?")) { // Clic sur OK
						$(this).parent().fadeOut(500, function(){
							$(this).remove();
							jsonCreator();
						});
						
						return false;
					}	
				});


			});
		});

   }


		
});