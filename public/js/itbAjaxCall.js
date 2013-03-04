var word = $('#baseWord').val();

$("#itbSearch").submit(ajaxRequest);
if(word != ""){
  ajaxRequest();
}

function newSearch(event){
  $('#baseWord').val(event.data.newWord);
  ajaxRequest();
}

function addItem(event){
  var postdata = [];
  var data = event.data.item
  var dataType = $(this).attr('data-type');
  switch(dataType){
    case 'synonym':
      postdata = {'type': dataType, 'word': data, 'posX': '', 'posY': ''};
      break;
    case 'tweet':
      postdata = {'type': dataType, 'username': data['username'], 'text':data['text'], 'posX': '', 'posY': ''};
      break;
    case 'dribbble':
      postdata = {'type': dataType, 'title': data['title'], 'full':data['full'], 'thumbnail':data['thumbnail'], 'posX': '', 'posY': ''};
      break;
    case 'pinterest':
      postdata = {'type': dataType, 'title': data['title'], 'full':data['full'], 'thumbnail':data['thumbnail'], 'posX': '', 'posY': ''};
      break;
    case 'vimeo':
      postdata = {'type': dataType, 'title': data['title'], 'idVimeo':data['id'], 'posX': '', 'posY': ''};
      break;
    case 'news':
    postdata = {'type': dataType, 'title': data['title'], 'text':data['body'], 'url':data['url'], 'posX': '', 'posY': ''};
      break;
  }

  var url = '/itb/dashboard/'+idBrain+'/addItem';
  var request = $.post(
    url,
    postdata,
    "json"            
  );
  console.log($(this).parent());
  $(this).parent().fadeOut(500, function() { $(this).remove(); });
  return false;
}

function ajaxRequest(event){

  $('html, body').animate({  
    scrollLeft:$('#column1').offset().left - 350
  }, 'slow');

  word = $('#baseWord').val();
  form = $("#itbSearch");
  ajaxGenerator(form, 'synonyms');
  ajaxGenerator(form, 'twitter');
  ajaxGenerator(form, 'vimeo');
  ajaxGenerator(form, 'pinterest');
  ajaxGenerator(form, 'dribbble');
  ajaxGenerator(form, 'news');

  function ajaxGenerator(form, api){
    var url = word+'/'+api;
    var postdata = form.serialize();

    var request = $.post(
      url,
      postdata,
      formpostcompleted,
      "json"            
    );

    function formpostcompleted(data, status){
      console.log('search on '+api+' : '+status);
      switch(api){
        case 'synonyms':
          synonymsGenerator(data);
          break;
        case 'dribbble':
          imageGenerator(data, api);
          break;
        case 'pinterest':
          imageGenerator(data, api);
          break;
        case 'news':
          newsGenerator(data);
          break;
        case 'twitter':
          twitterGenerator(data);
          break;
        case 'vimeo':
          vimeoGenerator(data);
          break;
        default:
          console.log('impossible de récupérer '+api);
          break;
      }
    }

    function synonymsGenerator(data){
      $('#nbSynonymsResults').prepend($(document.createElement('li')).append(data.length + ' synonymes trouvés pour <span class="word-thesaurus">'+word+'</span>'));
      
      var parent = $(document.createElement('dl'));
      $('#synonymsResults').prepend(parent);
      var dd, a;

      for (var i = 0; i < data.length; i++) {
        dd = $(document.createElement('dd'));
        dd.append(data[i]);
        a = $(document.createElement('a'));
        a.attr('class', 'ajouter');
        a.attr('data-type', 'synonym');
        a.bind('click', {item: data[i]}, addItem);
        dd.append(a);
        a = $(document.createElement('a'));
        a.attr('class', 'relance');
        a.bind('click', {newWord: data[i]}, newSearch);
        dd.append(a);
        parent.append(dd);
      }
    }

    function twitterGenerator(data){
      $('#nbTwitterResults').prepend($(document.createElement('li')).append(data.length + ' #tweets trouvés <span class="word-twitter">'+word+'</span>'));
      var parent = $(document.createElement('div'));
      $('#twitterResults').prepend(parent);
      var dl, dd, dt;

      for (var i = 0; i < data.length; i++) {
        dl = $(document.createElement('dl'));
        dt = $(document.createElement('dt'));
        dt.append('> from <a href="#">@'+data[i]['username']+'</a>');
        dl.append(dt);
        dd = $(document.createElement('dd'));
        dd.append('<div class="sep"></div>');
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.append(data[i]['text']);
        dl.append(dd);
        a = $(document.createElement('a'));
        a.attr('class', 'add');
        a.attr('data-type', 'tweet');
        a.bind('click', {item: data[i]}, addItem);
        dl.append(a);
        parent.append(dl);
      }

      $('#'+api+'Loader').fadeOut(500, function() {$(this).remove();});
    }

    function vimeoGenerator(data){
      $('#nbVimeoResults').prepend($(document.createElement('li')).append(data.length + ' vidéos trouvées pour <span class="word-vimeo">'+word+'</span>'));
      var parent = $(document.createElement('div'));
      $('#vimeoResults').prepend(parent);
      var dl, dd, dt;

      for (var i = 0; i < data.length; i++) {
        dl = $(document.createElement('dl'));
        dt = $(document.createElement('dt'));
        dt.append('<p><a href="http://vimeo.com/'+data[i]['id']+'">'+data[i]['title']+'</a></p>');
        dl.append(dt);
        dd = $(document.createElement('dd'));
        dd.append('<div class="sep"></div>');
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.append('<iframe src="http://player.vimeo.com/video/'+data[i]['id']+'?byline=0&badge=0&color=d01e2f&title=0&portrait=0&" width="400" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
        dl.append(dd);
        a = $(document.createElement('a'));
        a.attr('class', 'add');
        a.attr('data-type', 'vimeo');
        a.bind('click', {item: data[i]}, addItem);
        dl.append(a);
        parent.append(dl);
      }

      $('#'+api+'Loader').fadeOut(500, function() {$(this).remove();});
    }

    function imageGenerator(data, api){
      var parent = $(document.createElement('div'));
      
      if(api == 'pinterest'){
        $('#nbPinterestResults').prepend($(document.createElement('li')).append(data['results'].length + ' pins trouvés pour <span class="word-pinterest">'+word+'</span>')); 
        $('#pinterestResults').prepend(parent);
      }else if(api == 'dribbble'){
        $('#nbDribbbleResults').prepend($(document.createElement('li')).append(data['results'].length + ' shots trouvés pour <span class="word-dribbble">'+word+'</span>'));
        $('#dribbbleResults').prepend(parent);
      }
      var dl, dd, dt;

      for (var i = 0; i < data['results'].length; i++) {
        dl = $(document.createElement('dl'));
        dt = $(document.createElement('dt'));
        dt.append(data['results'][i]['title']);
        dl.append(dt);
        dd = $(document.createElement('dd'));
        dd.append('<div class="sep"></div>');
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.append('<a href="'+data['results'][i]['full']+'"><img src="'+data['results'][i]['thumbnail']+'" width="100%"></a>');
        dl.append(dd);
        a = $(document.createElement('a'));
        a.attr('class', 'add');
        a.attr('data-type', api);
        a.bind('click', {item: data['results'][i]}, addItem);
        dl.append(a);
        parent.append(dl);
      }

      $('#'+api+'Loader').fadeOut(500, function() {$(this).remove();});
    }

    function newsGenerator(data){
      $('#nbNewsResults').prepend($(document.createElement('li')).append(data.length + ' articles trouvés pour <span class="word-times">'+word+'</span>'));
      var parent = $(document.createElement('div'));
      $('#newsResults').prepend(parent);
      var dl, dd, dt;

      for (var i = 0; i < data.length; i++) {
        dl = $(document.createElement('dl'));
        dt = $(document.createElement('dt'));
  
        dt.append('<p><a href="'+data[i]['url']+'" target="blank">'+data[i]['title']+'</a></p>');
        dl.append(dt);
        dd = $(document.createElement('dd'));
        dd.append('<div class="sep"></div>');
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.append(data[i]['body']);
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.attr('class', 'slide');
        a = $(document.createElement('a'));
        a.attr('class', 'add');
        a.attr('data-type', 'news');
        a.bind('click', {item: data[i]}, addItem);
        dl.append(a);
        parent.append(dl);
      }

      $('#'+api+'Loader').fadeOut(500, function() {$(this).remove();});
    }

  }
  return false;
}