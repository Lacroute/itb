<?php

class SearchController{
	
	function __construct(){

	}

	function search(){
		$keyword = F3::get('POST.baseWord');
		
		$synonyms = new itbe\Synonyms();
	    $dribble = new itbe\Dribble();
		$pinterest = new itbe\Pinterest();
		$news = new itbe\News();

		F3::mset(
		    array(
		        'synonyms'=>$synonyms->search($keyword),
		        'dribble'=>$dribble->search($keyword),
		        'pinterest'=>$pinterest->search($keyword),
		        'news'=>$news->search($keyword)
		    )
		);

		echo 'yep';
	    echo View::instance()->render('admin/dashboard.html');
	}

	function __destruct(){

	}
}
?>