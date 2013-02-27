<?php

namespace itbe;

class Twitter extends api{

	/*
	$twitter = new itbe\Twitter();
	$twitter->search('word');
	*/
	function search($keyword){

		$request = \Web::instance()->request('http://search.twitter.com/search.json?q='.$keyword.'&rpp=10&include_entities=true&result_type=recent');

		var_dump($request);
		die();
	}
}
?>