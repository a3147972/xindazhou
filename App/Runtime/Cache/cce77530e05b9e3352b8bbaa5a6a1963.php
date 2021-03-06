<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?php echo ($vo["name"]); ?></title>
    <style>
        @charset "utf-8";
/* CSS Document */
html, ul ,li, h1, div,h2,h3,h4,h5,h6,p{ margin:0; padding:0;}
ul,li{ list-style:none;}
body {margin:0; color:#666; background:#fff;  font: normal 100% "Microsoft Yahei","Tahoma","SimSun"; letter-spacing:inherit;}
img, object { max-width: 100%;}
img{ -ms-interpolation-mode: bicubic; *width: 100%;}
a {color: #5FB000; outline: 0; -webkit-transition: all 0.25s ease-out 0s; -moz-transition: all 0.25s ease-out 0s; -ms-transition: all 0.25s ease-out 0s; -o-transition: all 0.25s ease-out 0s; transition: all 0.25s ease-out 0s; text-decoration:none;}
a:hover {color: #7DC328; text-decoration: none; outline: 0;}
h1 {font-size: 1.3em; font-weight: 200; line-height: 24px; text-transform: uppercase; color: #363636; padding:0px 10px;}
h2 {font-size: 1em; font-weight: 500; line-height: 18px; text-transform: uppercase; color: #8f44ad; padding:5px 0; background:#F3F3F3;}
h3 {color: #363636; font-size: 1em; line-height: 18px; text-transform: uppercase; font-weight: 200; padding:15px 10px;}
i{ width:0; height:12px; overflow:hidden; margin:0 10px; border-left:3px solid #9c59b8; font-size:0; line-height:12; display:inline-block; vertical-align:-1px;}
.netWork_info{ margin:2.12766% 0;}
p{ font-size:0.9em;  text-align:justify;}
strong:last-child{ margin-top:20px;}
p strong{ display:inline-block; color:#9c59b8; font-weight:600; float:left;  }

body{background: url("__PUBLIC__/img/bg.jpg") no-repeat;width:100%;height:100%; font-family: "黑体";}
div.content{width:94%;margin:0 auto;color:#fff;margin-top: 20px;padding-left: 15px;}
div.content p.question{font-size: 20px;margin-bottom: 20px;line-height: 120%;width: 95%;}
div.content div.answer ul li{float: left;width:32%;margin-right: 1px;}
.blank{height:100px;}
p.title{font-size: 20px;margin-top: 20px;margin-bottom: 20px;}
div.clr{clear: both;}
div.content div.psize ul li{line-height: 150%;}
div.content div.guize p.c{line-height: 150%;}
.red{border:1px solid #d00;}
div.form{margin-top: 20px;margin-left: 1px;width:95%;}
div.form div.form-contor{font-size: 20px;}
div.form div.form-contor input[type=text]{width:95%;height:50px;font-size: 20px;}
div.form div.form-contor input[type=submit]{color: #fff;background-color: #5cb85c;border-color: #4cae4c;display: inline-block;padding: 6px 30px;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;touch-action: manipulation;cursor: pointer;-webkit-user-select: none;  background-image: none;border: 1px solid transparent;border-radius: 4px;margin-top: 10px;width:97%;height:50px;font-size: 20px;}
div.guize{width:95%;}
    </style>
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
            <form action="<?php echo U('insert');?>" method="post" id="form">
                <div class="form-contor">
                    <input type="text" name="mobile" placeholder="手机号" maxlength="11" id="mobile">
                </div>
                <div class="form-contor">
                    <input type="hidden" name="activity_id" value="<?php echo ($vo["id"]); ?>" id="activity_id">
                    <input type="hidden" name="openid" value="<?php echo I('openid');?>" id="openid">
                    <input type="submit" value="提&nbsp;&nbsp;交">
                </div>
            </form>
        </div>
        <div class="psize">
            <p class="title">活动奖品</p>
            <ul>
                <?php if(is_array($psize_list)): $i = 0; $__LIST__ = $psize_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$psize_vo): $mod = ($i % 2 );++$i;?><li><?php echo ($i); ?>.<?php echo ($psize_vo["name"]); ?>: <?php echo ($psize_vo["prize"]); ?>（<?php echo ($psize_vo["people"]); ?>个）</li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="guize">
            <p class="title">活动规则</p>
            <p class="c">
                <?php echo ($vo["rule"]); ?>
            </p>
        </div>
        <script src="__PUBLIC__/js/jquery.min.js"></script>
        <script>
            $('div.answer ul li').click(function(){
                var p = '<p style="background:#000;position:absolute;margin-top:-106px;height:102px;width:30%;opacity:0.7"></p>';
                $('div.answer ul li p').remove();
                $('div.answer ul li').removeAttr('checked');
                $(this).attr('checked','checked');
                $(this).siblings('li').append(p);
            })

            $('#form').submit(function(){
                var mobile = $('#mobile').val();
                var check_val = $('div.answer ul li[checked=checked]').attr('value');
                var activity_id = $('#activity_id').val();
                var openid = $('#openid').val();
                var url = $(this).attr('action');
                
                if(check_val == '' || check_val == undefined){
                    alert('请先选择答案');
                    return false;
                }

                if(mobile == ''){
                    alert('请输入手机号');
                    return false;
                }
                if (!mobile.match(/^(((13[0-9]{1})|(15[0-9]{1})|17[0-9]{1}|18[0-9]{1})+\d{8})$/)) { 
                    alert("手机号码格式不正确！");
                    return false;
                }

                var flag = true;
                $.ajax({
                    url:"<?php echo U('checkStatus');?>",
                    async:false,
                    data:{
                        openid:openid,
                        activity_id:activity_id,
                    },
                    type:'post',
                    dataType:'json',
                    success:function(i){
                        if(i.status == 0){
                            alert(i.info);
                            flag = false;
                        }
                    }
                })
                
                if(flag == false){
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
                    async:false,
                    type:'post',
                    dataType:'json',
                    success:function(i){
                        alert(i.info);
                    }
                })
                return false;
            })
        </script>
    </body>
    </html>