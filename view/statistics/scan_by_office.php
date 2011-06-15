<html>
<head>
<title>无标题文档</title>
<style type="text/css">
div#show_select{
text-align: center;
}
</style>
<script language="javascript" src="../js/Calendar.js"></script>
<script language="javascript">
  var cdr = new Calendar("cdr");
  document.write(cdr);
  cdr.showMoreDay = true;
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div id="show_select">
  <form action="scan_by_office.php" method="post">
    请输入时间&nbsp;&nbsp;&nbsp;
    <input type="text" name="date" onFocus="cdr.show(this);"/>
    <input type="submit" value="确定"/>
  </form>
</div>
</body>
</html>
<?php
include_once '../../common.php';
include_once 'checkuseservice.inc.php';
$post = isset($_POST['date']) ? $_POST['date'] : '';
if(isdate($post))
{
	$result = $main->getpricebyoffice($post);
	if(count($result)==0) echo "<div align = 'center'>查无此类记录</div>";
	else 
	{
		echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
			echo "<tr>";
				echo "<td bgcolor='#EAEAEA'>科室</td>";
				echo "<td bgcolor='#EAEAEA'>日总收入(元)</td>";
				echo "<td bgcolor='#EAEAEA'>就诊人数(人)</td>";
				echo "<td bgcolor='#EAEAEA'>时间</td>";
				echo "<td bgcolor='#EAEAEA'>占总就诊人数比例</td>";
			echo "</tr>"; 
		foreach($result as $k1 =>$v1)
		{   
			if($k1%2 != 0) echo "<tr bgcolor='#EFEFEF'>";
			else echo "<tr>";
			foreach($v1 as $v2)
			{
				echo "<td align='center'>".$v2."</td>";					
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}
else echo "<div align = 'center'>请输入正确的日期格式<年-月-日></div>";
?>
