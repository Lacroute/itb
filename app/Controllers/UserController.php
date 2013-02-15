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
      		$check = array('pseudo'=>'required', 'email'=>'required','password'=>'required');
	        $error = Datas::instance()->check(F3::get('POST'),$check);
	        if($error){
	          F3::set('errorMsg',$error);
	          echo Views::instance()->render('login.php');
	          return;
	        }
      		$data = array(
				"pseudo" => F3::get('POST.pseudo'),
				"email" => F3::get('POST.email'),
				"password" => F3::get('POST.password'),
			);
			$addUser = UserModel::instance()->addUser($data);
			if($addUser){
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
	        $error=Datas::instance()->check(F3::get('POST'),$check);
	        if($error){
	          F3::set('errorMsg',$error);
	          echo Views::instance()->render('login.php');
	          return;
	        }
	        if($user = UserModel::instance()->getUser(F3::get('POST.email'),F3::get('POST.password'))){
	          F3::set('SESSION.idUser',$user->id);
	          F3::set('SESSION.pseudo',$user->firstname);
	          F3::reroute('/dashboard');
	          return;
	        }else{
	        	var_dump($user);
	        }
	        F3::set('errorMsg',array('email'=>true,'password'=>true));
	        echo Views::instance()->render('login.php');
    		break;
    	}
	}

	function logout(){
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