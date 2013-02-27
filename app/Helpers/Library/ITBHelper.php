<?php 

class ITBHelper extends prefab{
	
	function baseUrl(){
		return F3::hive()['HEADERS']['Host'];
	}

}

?>