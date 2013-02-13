<?php

class Lycos{
	
	function __construct(){

	}

	function search(){
		$synonyms = new itbe\Synonyms();
	    F3::set('synonyms', $synonyms->search($_POST['baseWord']));

	    echo View::instance()->render('dashboard.html');
	}

	function __destruct(){

	}
}
?>