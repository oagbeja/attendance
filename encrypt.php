<?php
	function ecrypt($a)
	{
		$arr=str_split(trim($a));
		for($i=0;$i<count($arr);$i++)
		{
			if($i==0){$str.=ord($arr[$i])	;}else{$str.=','.ord($arr[$i])	;}
		}
		return $str;
	}
	function dcrypt($a)
	{
		$arr=explode(',',trim($a));
		for($i=0;$i<count($arr);$i++)
		{
			$str.=chr($arr[$i])	;
		}
		return $str;
	}
	
?>
