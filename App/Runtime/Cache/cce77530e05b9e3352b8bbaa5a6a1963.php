<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?php echo ($vo["name"]); ?></title>
    <link rel="stylesheet" href="__PUBLIC__/css/style.css" />
    <link rel="stylesheet" href="__PUBLIC__/css/ui-dialog.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bigWheel.css" />
</head>
<body>
    <div class="content">
        <p class="question"><?php echo ($vo["content"]); ?></p>
        <div class="answer">
            <ul>
                <?php if(is_array($options_list)): $i = 0; $__LIST__ = $options_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$options_vo): $mod = ($i % 2 );++$i;?><li value="<?php echo ($i); ?>"><img src="<?php echo (getthumbpath($options_vo["options"])); ?>" alt="" class="blank"></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clr"></div>
            </ul>
        </div>
        <div class="form">
            <form action="<?php echo U('insert');?>" method="post" onsubmit="return AjaxForm(this)">
                <div class="form-contor">
                    <input type="text" name="mobile" id="" placeholder="手机号">
                </div>
                <div class="form-contor">
                    <input type="hidden" name="activity_id" value="<?php echo ($vo["id"]); ?>">
                    <input type="hidden" name="openid" value="<?php echo I('openid');?>">
                    <input type="submit" value="提&nbsp;&nbsp;交">
                </div>
            </form>
        </div>
        <div class="psize">
            <p class="title">活动奖品</p>
            <ul>
                <li>1. 摩托车使用权1年（1个）</li>
                <li>2. 摩托车使用权1年（2个）</li>
                <li>3. 摩托车使用权1年（3个）</li>
            </ul>
        </div>
        <div class="guize">
            <p class="title">活动规则</p>
            <p class="c">
                <?php echo ($vo["rule"]); ?>
            </p>
        </div>
        <script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>
        <script src="__PUBLIC__/js/dialog-plus-min.js"></script>
        <script>
            $('div.answer ul li').click(function(){
                var p = '<p style="background:#000;position:absolute;margin-top:-103px;height:102px;width:30%;opacity:0.7"></p>';
                $('div.answer ul li p').remove();
                $('div.answer ul li').removeAttr('checked');
                $(this).attr('checked','checked');
                $(this).siblings('li').append(p);
            })

            function AjaxForm(dom){
                var mobile = $('[name=mobile').val();
                var check_val = $('div.answer ul li[checked=checked]').val();
                var activity_id = $('[name=activity_id]').val();
                var openid = $('[name=openid]').val();
                var url = $(dom).attr('action');
                if(check_val == '' || check_val == undefined){
                    alert('请先选择答案');
                    return false;
                }
                if(mobile == ''){
                    alert('请输入手机号');
                    return false;
                }

                $.ajax({
                    url:url,
                    data:{
                        mobile:mobile,
                        openid:openid,
                        activity_id:activity_id,
                        answer:check_val
                    },
                    type:'post',
                    dataType:'json',
                    success:function(i){
                        alert(i.info);
                        // window.close();
                    }
                })

                return false;
            }
        </script>
    </body>
    </html>