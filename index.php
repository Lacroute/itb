<?php
$f3 = require('library/base.php');

$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');

// On set la DB
// $db=new DB\SQL(
//     'mysql:host=localhost;port=3306;dbname=mysqldb',
//     'admin',
//     'p455w0rD'
// );



$f3->run();
