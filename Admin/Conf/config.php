<?php
$common = require_once('./Conf/mysql.php');
$admin_config = array(
	//'配置项'=>'配置值'
);

return array_merge($common,$admin_config);
?>