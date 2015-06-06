<?php
$common = require_once('./Conf/mysql.php');
$admin_config = array(
	'TMPL_PARSE_STRING'=>array(
		'__PUBLIC__' =>__ROOT__.'/Public/App',
	), 
);

return array_merge($common,$admin_config);
?>