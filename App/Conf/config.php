<?php
$common = require_once('./Conf/mysql.php');
$admin_config = array(
	'TMPL_PARSE_STRING'=>array(
		'__PUBLIC__' =>__ROOT__.'/Public/App',

	), 
	'APP_AUTOLOAD_PATH' =>'ORG.Crypt,ORG.Net,ORG.Util,@.ORG',
	'WEIXIN_OPTIONS'=>array(
    	'TOKEN' => 'R8oieC',
    	'ENCODINGAESKEY' => 'TZQdD7KJSYLb7CXqQ3cxzQYfU0MzsbrjalVJuL19xjL',
    	'APPID' => 'wx3f7c564306037c73',
    	'APPSECRET' => '115b02ef642994f858a0fd2a7870a6e7',
    ),
    'VERSION'=>'20150706001'
);

return array_merge($common,$admin_config);
?>