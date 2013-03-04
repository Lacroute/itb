<?php
class BrainController{
	
	function __construct(){

	}

	function create(){
		switch(F3::get('VERB')){
		case 'GET':
        	echo Views::instance()->render('new_brain.php');
      		break;
      	case 'POST':
      	    $check=array('name-input'=>'required','search-input'=>'required');
	        $error=Datas::instance()->check(F3::get('POST'),$check);
	        if($error){
	          F3::set('errorMsg',$error);
	          F3::reroute('/dashboard');
	          return;
	        }
      		$data = array(
				"name" => F3::get('POST.name-input'),
			);
			$idBrain = BrainModel::instance()->addBrain($data);
			//on crée le dossier avec comme nom l'id du Brain inséré.
			mkdir(F3::get('brain_path').'/'.$idBrain, 0777, true);

			//on crée le fichier json vierge
			$jsonFile = fopen(F3::get('brain_path').'/'.$idBrain.'/data.json', 'w');
			$jsonData = array(
				"idUser" => F3::get('SESSION.idUser'),
				"brainName" => $data['name'],
				"items" => "[]",
			);
			fwrite($jsonFile, json_encode($jsonData));
			fclose($jsonFile);

			F3::reroute('/dashboard/'.$idBrain.'/search/'.F3::get('POST.search-input'));
      		break;
      	}
	}

	function search(){
	    F3::set('title', 'Dashboard');

	    echo View::instance()->render('admin/debugajax.html'); 
  	}

  	function map(){
	    F3::set('title', 'Map');

	    switch(F3::get('VERB')){
		case 'GET':
	    	echo View::instance()->render('admin/map.html'); 
	    	break;
	    case 'POST':
	    	$check=array('baseWord'=>'required');
	        $error=Datas::instance()->check(F3::get('POST'),$check);
	        if($error){
	          F3::set('errorMsg',$error);
	          F3::reroute('/dashboard/'.F3::get('PARAMS.id').'/map');
	          return;
	        }
	        F3::reroute('/dashboard/'.F3::get('PARAMS.id').'/search/'.F3::get('POST.baseWord'));
	        break;
	    }
  	}

  	function addItem($item){
  		$jsonFile = fopen(F3::get('brain_path').'/'.F3::get('PARAMS.id').'/data.json', 'r+');
  		$jsonArray = json_decode(fgets($jsonFile));
  		$jsonArray->items = json_decode($item);
  		file_put_contents(F3::get('brain_path').'/'.F3::get('PARAMS.id').'/data.json', json_encode($jsonArray));
  		fclose($jsonFile);
  	}

	function edit(){
		$json = F3::get('POST.json');
		file_put_contents(F3::get('brain_path').'/'.F3::get('PARAMS.id').'/data.json', json_encode($json));
	}

	function remove($id){
		//On supprime les brainstorming ici
	}

	function afterRoute(){

	}

	function __destruct(){

	}
}