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
      		$data = array(
				"name" => F3::get('POST.brain_name'),
			);
			$addBrain = BrainModel::instance()->addBrain($data);
			echo "ok";
      		break;
      	}
	}

	function edit($id){
		// Ici on edite un brainstorming
	}

	function remove($id){
		//On supprime les brainstorming ici
	}

	function __destruct(){

	}
}