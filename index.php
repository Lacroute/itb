<?php
$f3 = require('library/base.php');

$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');

/*
$f3->route('GET /ref', function(){
	/* methode avec instance
	$view = new View();
	echo $view->render('manual/userref.html');
	

	/* methode statique
	echo View::instance()->render('manual/userref.html');
});
*/

$f3->run();
