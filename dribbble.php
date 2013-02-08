<?php
if(isset($_GET['q']) && isset($_GET['s'];)){
	$query = $_GET['q'];
	$sort = $_GET['s'];
	$url = "http://dribbble.com/search?q=".$query."&s=".$sort; //s = 'latest' or ''
	 
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
	$images = $xpath->query("//*[@class='dribbble-img']/a/div/div[1]/@data-src");
	echo "<ul>";
	$imgs = array(); // array to encode to get json
	foreach ($images as $image) {
		//echo '<li><img src="'.$image->nodeValue.'" /></li>';
		$imgs[] = $image->nodeValue;
	}
	echo "</ul>";
else{
	echo ":(";
}
?>
