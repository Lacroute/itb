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
		return $request['body'];
	}
}
?>