<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>
网点分布
</title><br>
<link type="text/css" href="__PUBLIC__/css/style.css" rel="stylesheet" /></head>
<body>
 
    <div class="main">
              <h1>
            五羊本田网点分布</h1>
        <h2>
            <i></i>请选择地区</h2>
        <ul class="site_list">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(I('city_id')): ?><li><a href="<?php echo U('lists',array('city_id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo U('index',array('city_id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
           </div>
</body>
</html>