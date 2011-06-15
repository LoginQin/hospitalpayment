<?php 
/**
* 方法:isdate()
* 功能:判断日期格式是否正确
* 参数:$str 日期字符串 $format日期格式
* 返回:布儿值
*/
function isdate($str,$format="Y-m-d"){
	$strArr = explode("-",$str);
	if(empty($strArr)){
		return false;
	}
	foreach($strArr as $val){
		if(strlen($val)<2){
			$val="0".$val;
		}
		$newArr[]=$val;
	}
	$str =implode("-",$newArr);
    $unixTime=strtotime($str);
    $checkDate= date($format,$unixTime);
    if($checkDate==$str)
        return true;
    else
        return false;
}
//return isdate(123);
?>