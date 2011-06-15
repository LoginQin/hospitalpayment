<html>
<head>
<style type="text/css">
div#show_select{
text-align: center;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div id="show_select">
  <form action="scan_tables.php" method="post">
    <select name="find">
      <option selected="selected">--</option>
      <option value="medicines">药品类价目</option>
      <option value="tariff">非药品类价目</option>
    </select>
    <input type="submit" value="查询"/>
  </form>
</div>
</body>
</html>
<?php
include_once '../../common.php';
include_once 'checkuseservice.inc.php';
$post = isset($_POST['find']) ? $_POST['find'] : '';
switch($post){
case 'medicines':
		$result = $main->checkMedicines();
		echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
			echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>药品ID</td>";
						echo "<td bgcolor='#EAEAEA'>药品名称</td>";
						echo "<td bgcolor='#EAEAEA'>单价(元)</td>";
						echo "<td bgcolor='#EAEAEA'>库存</td>";
						echo "</tr>"; 
						foreach($result as $k1 =>$v1)
							{   
								if($k1%2 != 0) echo "<tr bgcolor='#EFEFEF'>";
								else echo "<tr>";
								foreach($v1 as $v2){
									echo "<td align='center'>".$v2."</td>";					
							}
								echo "</tr>";
							}
						echo "</table>";
			break;
case 'tariff':
		$result = $main->checkTarff();
		echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
			echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>收费项目ID</td>";
						echo "<td bgcolor='#EAEAEA'>收费项目</td>";
						echo "<td bgcolor='#EAEAEA'>收费价格(元)</td>";
						echo "</tr>"; 
						foreach($result as $k1 =>$v1)
							{   
								if($k1%2 != 0) echo "<tr bgcolor='#EFEFEF'>";
								else echo "<tr>";
								foreach($v1 as $v2){
									echo "<td align='center'>".$v2."</td>";					
							}
								echo "</tr>";
							}
						echo "</table>";
							break;
		}
?>
