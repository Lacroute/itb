<?php

class Lycos{
	
	function __construct(){

	}

	function search(){
		$keyword = $_POST['baseWord'];

		$synonyms = new itbe\Synonyms();
	    F3::set('synonyms', $synonyms->search($keyword));

	    $dribble = new itbe\Dribble();
		F3::set('dribble', $dribble->search($keyword));

		$pinterest = new itbe\Dribble();
		F3::set('pinterest', $pinterest->search($keyword));

	    echo View::instance()->render('dashboard.html');
	}

	function __destruct(){

	}
}
?>