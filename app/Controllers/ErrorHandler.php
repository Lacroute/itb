<?php
class ErrorHandler{
	
	function __construct(){

	}

	function errorCatcher() {
		// Logger::write('app error, code=' . F3::get('ERROR.code'), 'debug');
	    switch(F3::get('ERROR.code')){
	    	case 500 :
	    		F3::set('errorType','duplicat');
				F3::set('title','Problème de création');
				echo Views::instance()->render('securite.html');
	    	default:
	        break;
	    }}

	}
	?>