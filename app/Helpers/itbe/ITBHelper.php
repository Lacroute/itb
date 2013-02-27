<?php 

class ITBHelper{
	
	function baseUrl(){
		return F3::hive()['HEADERS']['Host'];
	}

}

?>