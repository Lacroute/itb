<?php
class UserController{
	
	function __construct(){
	}

	function create(){
		switch(F3::get('VERB')){
		case 'GET':
        	F3::reroute('/dashboard');
      		break;
      	case 'POST':
      		$check = array('pseudo'=>'required', 'email'=>'required','password'=>'required');
      		F3::set('POST', Datas::instance()->secure(F3::get('POST')));
	        $error = Datas::instance()->check(F3::get('POST'),$check);
	        if($error){
				F3::set('errorMsg',$error);
				F3::set('errorType','create');
				F3::set('title','Problème de création');
				echo Views::instance()->render('securite.html');
				return;
	        }
      		$data = array(
				"pseudo" => F3::get('POST.pseudo'),
				"email" => F3::get('POST.email'),
				"password" => F3::get('POST.password'),
			);
			if($addUser = UserModel::instance()->addUser($data)){
				$this->login();
			}
      		break;
      	}
	}

	function login(){
		switch(F3::get('VERB')){
    	case 'GET':
        	echo Views::instance()->render('login.php');
    		break;
    	case 'POST':
	        $check=array('email'=>'required','password'=>'required');
	        F3::set('POST', Datas::instance()->secure(F3::get('POST')));
	        $error=Datas::instance()->check(F3::get('POST'),$check);
	        if($error){
				F3::set('errorMsg',$error);
				F3::set('errorType','login');
				F3::set('title','Problème de connexion');
				echo Views::instance()->render('securite.html');
				return;
	        }
	        $data = array(
	        	'email' => F3::get('POST.email'),
	        	'password' => F3::get('POST.password')
	        );
	        if($user = UserModel::instance()->getUser($data)){
				F3::set('SESSION.idUser',$user['idUser']);
				F3::set('SESSION.pseudo',$user['pseudo']);
				F3::reroute('/dashboard');
				return;
	        }
	        F3::set('errorMsg',array('email'=>true,'password'=>true));
	        F3::set('title','Problème de connexion');
	        F3::set('errorType','login');
	        echo Views::instance()->render('securite.html');
    		break;
    	}
	}

	function logout(){
		echo '<pre>';
		//print_r(F3::get('SESSION.user'));
		echo '</pre>';
		//print_r(F3::hive());
		session_start();
		session_destroy();
		F3::reroute(F3::get('baseUrl'));
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