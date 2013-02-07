<?php
$f3 = require('library/base.php');

$f3->config('config/globals.ini');
$f3->config('config/routes.ini');

// On set la DB
// $db=new DB\SQL(
//     'mysql:host=localhost;port=3306;dbname=mysqldb',
//     'admin',
//     'p455w0rD'
// );



$f3->run();
