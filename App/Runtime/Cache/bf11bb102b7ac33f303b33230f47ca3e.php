<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title><?php echo ($vo["title"]); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
        
   
    <style type="text/css">	
	body ,h1 ,p ,h2 {padding: 0;font-family: '宋体'; background: #fff;margin:0;}
	.page-bizinfo,#activity-detail .page-content{
		max-width: 700px; margin: 0 auto;padding: 20px 20px 0;border-left: 1px 	solid #ccc;border-right: 1px solid #ccc;
	}

	#activity-detail .page-content{padding-top: 4px;margin-top:0;}
		.page-bizinfo .header a.activity-meta{vertical-align: middle;}
		.activity-info{margin-top: 6px;}
		#activity-detail .page-content .media img{width: 100%;}
		#activity-detail .page-bizinfo .header #activity-name{ padding-bottom: 10px; border-bottom: 1px dotted #ccc;font-size:20px;}
		#activity-detail .page-content .text { line-height: 2em;color:#3e3e3e;font-size:14px;}
		#activity-detail .page-content .media{margin: 0 0 18px 0;padding-top:6px;}
		.line_title .tips{background-color:#FFFFFF;}
		.activity-info .text-ellipsis{max-width:500px;}
		.activity-info .text-ellipsis {
			display: inline-block;
			vertical-align: middle;
			max-width: 104px;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
		
	   </style>
</head> 

<body id="activity-detail">
         
        <div class="page-bizinfo" style="">
            <div class="header">
            <h1 id="activity-name"><?php echo ($vo["content"]); ?></h1>
            </div>
        </div>
       
        <div id="page-content" class="page-content" style="border-bottom: 1px solid #ccc;padding-bottom:50px;">
            <div id="img-content"><?php echo ($vo["content"]); ?></div>
       </div>
     
</body>
</html>