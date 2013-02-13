<?php
class UserModel extends Prefab{

	function __construct(){
		F3::set('dB',new DB\SQL('mysql:host='.F3::get('db_host').';port=3306;dbname='.F3::get('db_server'),F3::get('db_user'),F3::get('db_password')));
	}

	function addUser($data){
		$user=new DB\SQL\Mapper(F3::get('dB'),'user');
		//load in the article, set new values then save
		//if we don't load it first Axon will do an insert instead of update when we use save command
		//if ($id) $article->load("id='$id'");
		//overwrite with values just submitted
		$user->pseudo = $data['pseudo'];
		$user->email = $data['email'];
		$user->password = md5($data['password']);
		$user->save();
		// Return to admin home page, new blog entry should now be there
		return true;
	}

	function getUser($id){

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