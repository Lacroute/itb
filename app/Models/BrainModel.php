<?php
class BrainModel extends Prefab{
	private $brain;


	function __construct(){
		F3::set('dB',new DB\SQL('mysql:host='.F3::get('db_host').';port=3306;dbname='.F3::get('db_server'),F3::get('db_user'),F3::get('db_password')));
		$brain=new DB\SQL\Mapper(F3::get('dB'),'brain');
	}

	function addBrain($data){

		//On ajoute le nouveau brain ici
		$brain->idUser = F3::get('SESSION.idUser');
		$brain->name = $data['name'];
		$brain->save();

		// On récupére l'ID du brain inséré précedemment
		$idBrain=$brain->_id; 

		// //On ajoute le lien contributeur/brain
		// $contributor=new DB\SQL\Mapper(F3::get('dB'),'contributors');
		// $contributor->idUser = F3::get('SESSION.idUser');
		// $contributor->idBrain = $idBrain;
		// $contributor->save();

		//on crée le dossier avec comme nom l'id du Brain inséré.
		mkdir(F3::get('brain_path')'/'.$idBrain, 0777, true);

	}

	function getBrain($data){

	}

	function listBrains($idUser){


		//TODO faire la jointure entre les tabml

		// $combined=new DB\SQL\Mapper($db,'combined');
		// $combined->load(array('project=?',123));
		// echo $combined->name;
	}

	function updateBrain($data){

	}

	function removeBrain($id){
		
	}

	function __destruct(){

	}
}