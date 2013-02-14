<?php

namespace itbe;

class Pinterest extends api{

	/*
	$pinterest = new itbe\Pinterest();
	$pinterest->search('word');
	*/
	function search($keyword){

		$url = "http://pinterest.com/search/pins/?q=".$keyword;
		 
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, '1'); // Permet de suivre les redirection
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11");
		
		$response = curl_exec($curl);
		curl_close($curl);
		
		$dom = new DOMDocument();
		@$dom->loadHTML($response); // le @ n'affiche pas d'erreur
		
		$xpath = new DOMXPath($dom);
		$thumbnail = $xpath->keyword("//*[@class='PinImageImg']/@src");
		$full = $xpath->keyword("//*[@class='pin']/@data-closeup-url");
		$thumbnails = array();
		$fulls = array();

		foreach ($thumbnail as $thumb) {
			$thumbnails[] = $thumb->nodeValue;
		}
		foreach ($full as $thumb) {
			$fulls[] = $thumb->nodeValue;
		}

		$nbResults = count($thumbnails); //récupere le nombre de résultats
		$results = array();

		for($i=0; $i<$nbResults; $i++){
			$results[] = array(
				'title' => '',
				'thumbnail' => $thumbnails[$i],
				'full' => $fulls[$i]
			);
		}

		$output = array(
			'status' => 'OK',
			'msg' => 'The request work well',
			'results' => $results
		);

	return $output;

	}
}
?>