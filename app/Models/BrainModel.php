<?php
class BrainModel extends Prefab{
	private $brain;


	function __construct(){
		F3::set('dB',new DB\SQL('mysql:host='.F3::get('db_host').';port=3306;dbname='.F3::get('db_server'),F3::get('db_user'),F3::get('db_password')));	
	}

	function addBrain($data){
		$brain=new DB\SQL\Mapper(F3::get('dB'),'brain');

		//On ajoute le nouveau brain ici
		$brain->idUser = F3::get('SESSION.idUser');
		$brain->name = $data['name'];
		$brain->save();

		// On récupére l'ID du brain inséré précedemment
		$idBrain=$brain->_id; 

		return $idBrain;
	}

	function listBrains(){
		$brains=new DB\SQL\Mapper(F3::get('dB'),'brain');
		return $brains->find(array('idUser=?',F3::get('SESSION.idUser')));
	}

	function updateBrain($data){

	}

	function removeBrain($id){
		
	}

	function __destruct(){

	}
}