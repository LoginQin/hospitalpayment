<html>
<head>
<title>后台统计</title>
<?php
	//判断$_SESSION['name']是否为空，即判断是否有用户登录，没有就跳转会登录页面
	include_once '../../common.php';
	include_once 'checkuseservice.inc.php';
	if(!isset($_SESSION['name'])) {
		header('Location: ../index.php');
		die();
	}

?>
<link rel="stylesheet" href="../css/statistics.css" type="text/css"/>
<script type="text/javascript" src="../js/change_color.js"></script>
<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("1","2","3","4","5","6","7","8","9","10","11","12");
var TODAY = d.getFullYear()+ " 年 "+ monthname[d.getMonth()] + " 月 " + d.getDate() + " 日 ";
//---------------   END LOCALIZEABLE   ---------------
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body id="homestyle">
	<div id="wrapper">
		<div id="header_index"><!--logo -->
			<div id="logo"></div>
 			<div id="login_area" align="right">
				<script language="JavaScript" type="text/javascript">document.write(TODAY);</script>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-family:'新宋体'">您好，</a>&nbsp;<?php echo $_SESSION['name']?>&nbsp;&nbsp;------&nbsp;&nbsp;<a href="signout.php">退出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</div>
		<div id="show_choice">
			<table width="937" height="30">
				<tr>
					<td width="234" align="center"><a href="scan_tables.php" target="main">收费价目</a></td>
					<td width="234" align="center"><a href="scan_by_register.php" target="main">按挂号浏览</a></td>
					<td width="234" align="center"><a href="scan_by_doctor.php" target="main">按医生浏览</a></td>
					<td width="234" align="center"><a href="scan_by_office.php" target="main">按科室浏览</a></td>
					<td width="234" align="center"><a href="scan_by_date.php" target="main">按日期浏览</a></td>
				</tr>
		  </table>
		</div><!--统计分类选项 -->
		<div id="iframe">
			<iframe name="main" width="937" height="516" frameborder="0"></iframe>
		</div><!--框架显示区域 -->
	</div>
</body>
</html>