<?php
class UserController{
	
	function __construct(){

	}

	function register(){
		if($_POST){
			// $data = array(
			// 	"pseudo" => $_POST['pseudo'],
			// 	"email" => $_POST['email'],
			// 	"password" => $_POST['password'],
			// );
			// $addUser = UserModel::instance()->addUser($data);
			// if($addUser){
			// 	//si l'insertion a fonctionné
			// }
			echo "ok";
		}else{
			echo Views::instance()->render('register.php');
		}
	}

	function login(){

	}

	function logout(){

	}

	function edit($id){
		
	}

	function __destruct(){

	}

}
?>