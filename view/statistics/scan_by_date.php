<html>
<head>
<title></title>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="show_select">
  <form action="scan_by_date.php" method="post">
    请输入时间&nbsp;&nbsp;&nbsp;
    <input type="text" name="date"  onfocus="cdr.show(this);"/>
    &nbsp;至
    <input type="text" name="date2" onFocus="cdr.show(this);"/>
    <input type="submit" value="确定"/>
  </form>
</div>
</body>
</html>
<?php
include_once '../../common.php';
include_once 'checkuseservice.inc.php';
$post = isset($_POST['date']) ? $_POST['date'] : '';
$post1 = isset($_POST['date2']) ? $_POST['date2'] : '';
if(isdate($post)&&isdate($post1)&&(strtotime($post) <= strtotime($post1)))
{
	$result = $main->getpricebydate($post,$post1);
	if(count($result)==0) echo "<div align = 'center'>查无此类记录</div>";
	else 
	{
		echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
			echo "<tr>";
				echo "<td bgcolor='#EAEAEA'>日期</td>";
				echo "<td bgcolor='#EAEAEA'>就诊人数(人)</td>";
				echo "<td bgcolor='#EAEAEA'>日总收入(元)</td>";
				echo "<td bgcolor='#EAEAEA'>人数较首日比例</td>";
				echo "<td bgcolor='#EAEAEA'>收入较首日比例</td>";
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
else if(strtotime($post) > strtotime($post1) ||($post == ''&&  isdate($post1)) ||($post1 == ''&&  isdate($post)) ) echo "<div align = 'center'>请输入正确的日期区间</div>";
else echo "<div align = 'center'>请输入正确的日期<格式:年-月-日></div>";
?>
