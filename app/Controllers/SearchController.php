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

	function searchForAjax(){
		$api = F3::get('PARAMS.api');
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		switch ($api) {
			case 'synonyms':
				$result = F3::get('synonyms');
				break;
			case 'dribbble':
				$result = F3::get('dribbble');
				break;
			case 'pinterest':
				$result = F3::get('pinterest');
				break;
			case 'news':
				$result = F3::get('news');
				break;
			default:
				$result = "nixamere";
				break;
		}
		echo $result;
	}

	function __destruct(){

	}
}
?>