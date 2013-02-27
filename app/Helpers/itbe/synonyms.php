<?php

namespace itbe;

class Synonyms extends api{

	/*
	$synonyms = new itbe\Synonyms();
	$synonyms->search('word');
	*/
	function search($keyword){
		$apiKey = "8e53955ed20a9f608e3e0d99ac330a23";
		$request = \Web::instance()->request('http://words.bighugelabs.com/api/2/'.$apiKey.'/'.$keyword.'/json ');

		/* this part convert multidimensionnal result array to a simple one */
		$request = json_decode($request['body']);
		$it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($request));
		$result = array();
		foreach($it as $v) {
		  $result[] = $v;
		}

		return json_encode($result);
	}
}
?>