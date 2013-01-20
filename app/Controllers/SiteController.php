<?php
class AppController{
	
	function __construct(){

	}

	function home(){
		$App = new App();
		F3::set('title', $App->getYo());

		echo View::instance()->render('inthabrain.html');
	}

	function dashboard(){
		$App = new App();
		F3::set('title', $App->getDashboard());

		echo View::instance()->render('dashboard.html');
	}

	function doc(){
		echo View::instance()->render('userref.html');
	}

	function __destruct(){

	}
}
?>