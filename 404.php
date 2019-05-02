<?php 
/**
 * 自定义404页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>404-Not Found</title>
	<style type="text/css">
		body,td,th { color: #FFFFFF; }
		body { background-color: #3385ff; }
		.STYLE7 { font-size: 24px; font-family: "微软雅黑"; }
		.STYLE9 {font-size: 16px}
		.STYLE12 { font-size: 100px; font-family: "微软雅黑"; }
	</style>
	<script src="https://blog.dyboy.cn/content/templates/dy_monkey/js/jquery.min.js"></script>
</head>
	<body>
	<span class="STYLE12"> :(</span>
	<p class="STYLE7"> 　　抱歉，您输入的网址本帅哥没有找到！<br />
	　　<span class="time_s">3</span>秒后为您跳转到首页...</p>
	<p class="STYLE7">　　<span class="STYLE9">ErrorCode： 404</span></p>
	<script language="javascript" type="text/javascript">
		var i = 3;
		setTimeout(function () { this.location.href = "https://blog.dyboy.cn" }, 3000);//定时器3s
		setInterval('update_time(i)',1000);
		function update_time(time){ time-=1;i=time;$(".time_s").text(time); }
	    
	</script>
</body>
</html>