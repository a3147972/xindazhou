<?php 
$site = require_once('./Conf/site.php');
$mysql = array(
	'DB_HOST'=>'hdm100004202.my3w.com',
	'DB_USER' => 'hdm100004202',
	'DB_PWD' => 'motuoche',
	'DB_NAME' => 'hdm100004202_db',
);

return array_merge($mysql,$site);