<?php

namespace itbControllers;
class BrainController{
	
	function __construct(){

	}

	function new(){
		switch(F3::get('VERB')){
		case 'GET':
        	echo Views::instance()->render('new_brain.php');
      		break;
      	case 'POST':
      		//TODO => traiter les données du nouveau brainqsto et créer dossier (mkdir) dans BainModel
      		$data = array(
				"pseudo" => $_POST['pseudo'],
				"email" => $_POST['email'],
				"password" => $_POST['password'],
			);
			$addUser = UserModel::instance()->addUser($data);
			if($addUser){
				//si l'insertion a fonctionné
				$this->login();
			}
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