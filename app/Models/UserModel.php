<?php
class UserModel extends Prefab{

	function __construct(){
		F3::set('dB',new DB\SQL('mysql:host='.F3::get('db_host').';port=3306;dbname='.F3::get('db_server'),F3::get('db_user'),F3::get('db_password')));
	}

	function addUser($data){
		$user=new DB\SQL\Mapper(F3::get('dB'),'user');
		$user->pseudo = $data['pseudo'];
		$user->email = $data['email'];
		$user->password = md5($data['password']);
		$user->save();
		return true;
	}

	//on passe a cette fonction un tableau de donnée. Si l'id est présent, il retourne les infos du 
	function getUser($data){
		if(isset($data['idUser'])){

		}elseif (isset($data['email']) && isset($data['password'])) {
			$user=new DB\SQL\Mapper(F3::get('dB'),'user');
			$user->load(array('email=? AND password=?',$data['email'],md5($data['password'])));
			if($user->email){
				$output = array(
					'pseudo' => $user->pseudo,
					'email' => $user->email,
					'idUser' => $user->idUser, 
				);
				return $output;
			}else{
				return false;
			}
		}
	}

	function updateUser($data){

	}

	function removeUser($id){
		$user=new DB\SQL\Mapper(F3::get('dB'),'user');
		$user->load(array('idUser=?',$id));
		$user->erase();
		return true;
	}

	function __destruct(){

	}
}