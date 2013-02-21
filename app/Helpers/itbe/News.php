<?php

namespace itbe;

class News extends api{

	/*
	$News = new itbe\News();
	$News->search('word');
	*/
	function search($keyword){
		$apiKey = "2c6153d1266fc1cc49cf3fe2c7023144:7:67347225";
		$query = "http://api.nytimes.com/svc/search/v1/article?format=json&query=".$keyword."&api-key=".$apiKey;
		$request = \Web::instance()->request($query);
		return $request['body'];
	}
}
?>