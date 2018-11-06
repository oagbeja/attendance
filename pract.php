<?php
	//echo $today = date("D",strtotime("2012-10-01"));
	for($i=1;$i<=31;$i++)
	{
		$today = date("D",strtotime("2012-10-".$i));
		if($today<>'Sun'&&$today<>'Sat'){echo $i.'<br/>'; }
		
	}
?>