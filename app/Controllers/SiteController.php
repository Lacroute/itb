<?php
class SiteController{
	
	function __construct(){

	}

	function home(){
		F3::set('title', 'In Tha Brain');
		   
		   
		   
		   

		echo View::instance()->render('inthabrain.html');
	}

	function dashboard(){
		F3::set('title', 'Dashboard');

		echo View::instance()->render('dashboard.html');
	}

	function doc(){
		echo View::instance()->render('userref.html');
	}

	function __destruct(){

	}
}
?>