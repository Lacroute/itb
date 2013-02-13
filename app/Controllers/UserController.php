<?php
class UserController{
	
	function __construct(){

	}

	function register(){
		switch(F3::get('VERB')){
		case 'GET':
        	echo Views::instance()->render('register.php');
      		break;
      	case 'POST':
      		$data = array(
				"pseudo" => $_POST['pseudo'],
				"email" => $_POST['email'],
				"password" => $_POST['password'],
			);
			$addUser = UserModel::instance()->addUser($data);
			if($addUser){
				//si l'insertion a fonctionné
			}
			echo "ok";
      		break;
      	}
      /*
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
		*/
	}

	function login(){

	}

	function logout(){

	}

	function edit($id){
		
	}

	function delete(){
		$id = F3::get('PARAMS.id');
		$deleteUser = UserModel::instance()->removeUser($id);
		if($deleteUser){
			echo "User has been removed";
		}
	}

	function __destruct(){

	}

}
?>