<?php 
$site = require_once('./Conf/site.php');
$mysql = array(
	'DB_HOST'=>'127.0.0.1',
	'DB_USER' => 'root',
	'DB_PWD' => '123456',
	'DB_NAME' => 'xindazhou',
);

return array_merge($mysql,$site);