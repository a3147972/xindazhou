<?php 
$site = require_once('./Conf/site.php');
$mysql = array(
	'DB_HOST'=>'192.168.1.111',
	'DB_USER' => 'root',
	'DB_PWD' => 'root',
	'DB_NAME' => 'xindazhou',
);

return array_merge($mysql,$site);