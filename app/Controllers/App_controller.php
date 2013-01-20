<?php
class App_controller{
	
	function __construct(){

	}

	function home(){
		$App = new App();
		F3::set('title', $App->getYo());

		$View = new View();
		echo $View->render('travelr.html');
	}

	function travel(){
		$App = new App();
		F3::set('title', $App->getTravel());

		echo View::instance()->render('travelr.html');
	}

	function doc(){
		echo View::instance()->render('userref.html');
	}

	function __destruct(){

	}
}
?>