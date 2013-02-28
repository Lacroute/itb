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
			$addBrain = BrainModel::instance()->addBrain($data);
			
			F3::reroute('/dashboard/'.$addBrain.'/search/'.F3::get('POST.search-input'));
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

	function edit($id){
		// Ici on edite un brainstorming
		echo $id;
	}

	function remove($id){
		//On supprime les brainstorming ici
	}

	function afterRoute(){

	}

	function __destruct(){

	}
}