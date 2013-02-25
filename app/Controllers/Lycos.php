<?php

class Lycos{
	
	function __construct(){

	}

	function search(){
		$keyword = $_POST['baseWord'];

		$synonyms = new itbe\Synonyms();
	    $dribble = new itbe\Dribble();
		$pinterest = new itbe\Pinterest();
		$news = new itbe\News();
		$test = 'zboub';
		F3::mset(
		    array(
		        'synonyms'=>$synonyms->search($keyword),
		        'dribbble'=>$dribble->search($keyword),
		        'pinterest'=>$pinterest->search($keyword),
		        'news'=>$news->search($keyword),
		        'test' => $test
		    );
		);
		echo 'yep';
	    echo View::instance()->render('admin/dashboard.html');
	}

	function __destruct(){

	}
}
?>