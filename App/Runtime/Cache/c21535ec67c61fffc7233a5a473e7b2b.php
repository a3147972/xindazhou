<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>
网点分布
</title>
<link type="text/css" href="__PUBLIC__/css/style.css" rel="stylesheet" />
<style>
    ul.site_list li{float:none;display:block;width:100%;}
</style>
</head>
<body>
<br />
    <div class="main">
        <h1>新大洲网点分布</h1>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h2><i></i><?php echo ($vo["company_name"]); ?></h2>
            <ul class="site_list">
                <li>公司地址:<?php echo ($vo["address"]); ?></li>
                <li>公司电话:<?php echo ($vo["phone"]); ?></li>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</body>
</html>