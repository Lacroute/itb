<?php

class SearchController{
	
	function __construct(){

	}

	function search(){
		switch (F3::get('PARAMS.api')) {
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
			case 'twitter':
				$result = new itbe\Twitter();
				break;
			case 'vimeo':
				$result = new itbe\Vimeo();
				break;
			default:
				$result = 'PETIT MALIN';
				break;
		}
		
		switch (F3::get('VERB')) {
			case 'GET':
				$this->searchForOther($result);
				break;
			
			case 'POST':
				$this->searchForAjax($result);
				break;

		}
	}

	function searchForOther($api){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		print_r($api->search(F3::get('PARAMS.word')));
	}

	function searchForAjax($api){
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		echo $api->search(F3::get('POST.baseWord'));
	}

	function __destruct(){

	}
}
?>