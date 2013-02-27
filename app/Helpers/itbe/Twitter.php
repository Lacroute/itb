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

		$request = $request->results;
		foreach($request as $i=>$twit) {
			$result[$i]['from_user'] = $twit->from_user;
			$result[$i]['text'] = $twit->text;
		}

		return json_encode($result);
	}
}
?>