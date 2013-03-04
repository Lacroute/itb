<?php

namespace itbe;

class Twitter extends api{

	/*
	$twitter = new itbe\Twitter();
	$twitter->search('word');
	*/
	function search($keyword){
		$request = \Web::instance()->request('http://search.twitter.com/search.json?q='.$keyword.'&rpp=10&include_entities=true&result_type=recent');
		$request = json_decode($request['body']);

		$request = $request->results;
		foreach($request as $i=>$tweet) {
			$result[$i]['username'] = $tweet->from_user;
			$result[$i]['text'] = $tweet->text;
		}

		return json_encode($result);
	}
}
?>