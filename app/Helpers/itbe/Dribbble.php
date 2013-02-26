<?php

namespace itbe;

class Dribbble extends api{

	/*
	// usage
	$dribble = new itbe\Dribble();
	$dribble->search('word');
	*/
	function search($keyword){


			//if(isset($_GET['q']) && isset($_GET['s'])){
			//$query = $_GET['q'];
			//$sort = $_GET['s'];
			
			$url = "http://dribbble.com/search?q=".$keyword."&s=latest";/*.$sort; //s = 'latest' or ''*/
			 
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, '1'); // Permet de suivre les redirection
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11");
			$response = curl_exec($curl);
			curl_close($curl);
			
			/*
			$web = new \Web;
			$result = $web->request(
				"http://dribbble.com/search?q=".$keyword."&s=latest",
				array(
				'headers'=>array(
						'Accept: text/html,application/xhtml+xml,application/xml',
						'Accept-Language: en-us'
					),
					'follow_location'=>FALSE,
					'max_redirects'=>30,
					'ignore_errors'=>TRUE
				)
			);
*/

			$dom = new \DOMDocument();
			@$dom->loadHTML($response); // le @ n'affiche pas d'erreur
			
			$xpath = new \DOMXPath($dom);
			$thumbnail = $xpath->query("//*[@class='dribbble-img']/a/div/div[1]/@data-src");
			$full = $xpath->query("//*[@class='dribbble-img']/a/div/div[2]/@data-src");
			$title = $xpath->query("//*[@class='dribbble-link']/div[1]/@data-alt");

			$thumbnails = array();
			$fulls = array();
			$titles = array();

			foreach ($thumbnail as $thumb) {
				$thumbnails[] = $thumb->nodeValue;
			}
			foreach ($full as $thumb) {
				$fulls[] = $thumb->nodeValue;
			}
			foreach ($title as $thumb) {
				$titles[] = $thumb->nodeValue;
			}

			$nbResults = count($thumbnails); //récupere le nombre de résultats
			$results = array();

			for($i=0; $i<$nbResults; $i++){
				$results[] = array(
					'title' => $titles[$i],
					'thumbnail' => $thumbnails[$i],
					'full' => $fulls[$i]
				);
			}

			$output = array(
				'status' => 'OK',
				'msg' => 'The request work well',
				'results' => $results
			);
		
		$output = json_encode($output);
		return ($output);
	}
}
?>