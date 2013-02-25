<?php

class SearchController{
	
	function __construct(){

	}

	function search(){
		$keyword = F3::get('POST.baseWord');
		
		$synonyms = new itbe\Synonyms();
	    $dribbble = new itbe\Dribbble();
		$pinterest = new itbe\Pinterest();
		$news = new itbe\News();

		F3::mset(
		    array(
		        'synonyms'=>$synonyms->search($keyword),
		        'dribbble'=>$dribbble->search($keyword),
		        'pinterest'=>$pinterest->search($keyword),
		        'news'=>$news->search($keyword)
		    )
		);

	    echo View::instance()->render('admin/dashboard.html');
	}

	function __destruct(){

	}
}
?>