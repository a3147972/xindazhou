<?php
$common = require_once('./Conf/mysql.php');
$admin_config = array(
    //'配置项'=>'配置值'
    //自定义参数名
    'TMPL_PARSE_STRING'=>array(
        'PATH_CSS'=>__ROOT__.'/Admin/Tpl/Public/css',
        'PATH_JS'=>__ROOT__.'/Admin/Tpl/Public/js',
        'PATH_IMG'=>__ROOT__.'/Admin/Tpl/Public/img',
        '__PUBLIC__'=>__ROOT__.'/Admin/Tpl/Public',
    ),
    'APP_AUTOLOAD_PATH' =>'ORG.Crypt,ORG.Net,ORG.Util,@.ORG',
    'WEIXIN_OPTIONS'=>array(
        'TOKEN' => 'R8oieC',
        'ENCODINGAESKEY' => 'TZQdD7KJSYLb7CXqQ3cxzQYfU0MzsbrjalVJuL19xjL',
        'APPID' => 'wx3f7c564306037c73',
        'APPSECRET' => '115b02ef642994f858a0fd2a7870a6e7',
    )
);

return array_merge($common, $admin_config);
