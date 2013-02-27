<?php

class SearchController{
	
	function __construct(){

	}

	function search(){
		//$keyword = F3::get('POST.baseWord');
		$keyword = 'love';
		
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

		var_dump(F3::get('synonyms'));
	    die();
	}

	function searchForAjax(){
		$api = F3::get('PARAMS.api');

		$keyword = F3::get('POST.baseWord');

		switch ($api) {
			case 'synonyms':
				$result = new itbe\Synonyms();
				break;
			case 'dribbble':
				$result = new itbe\Dribbble();
				break;
			case 'pinterest':
				$result = new itbe\Pinterest();
				break;
			case 'news':
				$result = new itbe\News();
				break;
			default:
				$result = "nixamere";
				break;
		}
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		echo $result->search($keyword);
	}

	function __destruct(){

	}
}
?>