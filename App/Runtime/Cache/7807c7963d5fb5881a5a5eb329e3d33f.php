<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>
新大洲本田车型
</title><br>
<link type="text/css" href="__PUBLIC__/css/style.css" rel="stylesheet" /></head>
<style type="text/css">
.site_list{
    margin: 0 auto;
    width:90%;
}
.site_list li a, .netWork_list li a{
    padding: 0 0;
}
.site_list li, .netWork_list li {
    width: 50%;
    text-align: center;
}
</style>
<body>
 
    <div class="main">
              <h1>
            <?php echo ($info["name"]); ?></h1>
        <h2>
        </h2>
        <ul class="site_list">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="font-size:20px;">
                    <a href="<?php echo U('Product/info',array('id'=>$vo['id']));?>">
                    <img src="<?php echo (ltrim($vo["thumb"],'.')); ?>"/></a>
                    <?php if(($product_list) == "1"): ?><a href="<?php echo U('Product/info',array('id'=>$vo['id']));?>" style="font-size:18px;"><?php echo ($vo["name"]); ?></a>
                    <?php else: ?>
                         <a href="<?php echo U('ProductClass/index',array('id'=>$vo['id']));?>" style="font-size:18px;"><?php echo ($vo["name"]); ?></a><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clr"></div>
        </ul>
           </div>
    
</body>
</html>