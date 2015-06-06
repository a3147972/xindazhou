<?php 
$site = require_once('./Conf/site.php');
$mysql = array(
	'DB_HOST'=>'192.168.1.111',
	'DB_USER' => 'admin',
	'DB_PWD' => 'admin',
	'DB_NAME' => 'xindazhou',
);

return array_merge($mysql,$site);