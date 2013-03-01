var word = $('#baseWord').val();

$("#itbSearch").submit(ajaxRequest);
if(word != ""){
  ajaxRequest();
}


function ajaxRequest(event){
  if(word == ""){
    word = $('#baseWord').val();
  }
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
      $('#nbSynonymsResults').append(data.length + ' synonymes trouvés');
      var parent = $(document.createElement('dl'));
      $('#synonymsResults').append(parent);
      var dd, a;

      for (var i = 0; i < data.length; i++) {
        dd = $(document.createElement('dd'));
        a = '<a href="/itb/dashboard/'+idBrain+'/search/'+data[i]+'">'+data[i]+'</a>';
        dd.append(a);
        parent.append(dd);
      }
    }

    function twitterGenerator(data){
      $('#nbTwitterResults').append(data.length + ' #tweets trouvés');
      var parent = $('#twitterResults');
      var dl, dd, dt;

      for (var i = 0; i < data.length; i++) {
        dl = $(document.createElement('dl'));
        dt = $(document.createElement('dt'));
        dt.append('> from <a href="#">@'+data[i]['from_user']+'</a>');
        dl.append(dt);
        dd = $(document.createElement('dd'));
        dd.append('<div class="sep"></div>');
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.append(data[i]['text']);
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.attr('class', 'add');
        dl.append(dd);
        parent.append(dl);
      }
    }

    function vimeoGenerator(data){
      $('#nbVimeoResults').append(data.length + ' vidéos trouvées');
      var parent = $('#vimeoResults');
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
        dd = $(document.createElement('dd'));
        dd.attr('class', 'add');
        dl.append(dd);
        parent.append(dl);
      }
    }

    function imageGenerator(data, api){
      if(api == 'pinterest'){
        $('#nbPinterestResults').append(data['results'].length + ' pins trouvés');
        var parent = $('#pinterestResults');
      }else if(api == 'dribbble'){
        $('#nbDribbbleResults').append(data['results'].length + ' shots trouvés');
        var parent = $('#dribbbleResults');
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
        dd = $(document.createElement('dd'));
        dd.attr('class', 'add');
        dl.append(dd);
        parent.append(dl);
      }
    }

    function newsGenerator(data){
      $('#nbNewsResults').append(data.length + ' articles trouvés');
      var parent = $('#newsResults');
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
        dl.append(dd);
        dd = $(document.createElement('dd'));
        dd.attr('class', 'add');
        dl.append(dd);
        parent.append(dl);
      }
    }

  }
  return false;
}