<?php
$common = require_once('./Conf/mysql.php');
$admin_config = array(
	//'配置项'=>'配置值'
    //自定义参数名
    'TMPL_PARSE_STRING'=>array(
        'PATH_CSS'=>__ROOT__.'/Admin/Tpl/Public/Css',
        'PATH_JS'=>__ROOT__.'/Admin/Tpl//Public/Js',
        'PATH_IMG'=>__ROOT__.'/Admin/Tpl//Public/Images',
        '__PUBLIC__'=>__ROOT__.'/Admin/Tpl//Public',

    ),
);

return array_merge($common,$admin_config);
?>