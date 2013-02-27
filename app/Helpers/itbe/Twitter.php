<?php

namespace itbe;

class Twitter extends api{

	/*
	$twitter = new itbe\Twitter();
	$twitter->search('word');
	*/
	function search($keyword){
		$keyword = 'love';
		$request = \Web::instance()->request('http://search.twitter.com/search.json?q='.$keyword.'&rpp=10&include_entities=true&result_type=recent');
		$request = json_decode($request['body']);

		$it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($request));
		$result = array();
		foreach($it as $v) {
		  $result[] = $v[from_user];
		}

		var_dump($result);
		die();
	}
}
?>