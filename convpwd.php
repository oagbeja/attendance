<?php
include ('connection.php');
	include ('encrypt.php');
	$sql1='select * from profile';
	$rsql1=mysql_query($sql1, connect_server())or die("Unable to query ".mysql_error());
	while($tab1=mysql_fetch_array($rsql1))
	{	
		$sql='update profile set vpassword = "'.ecrypt($tab1['staffid']).'" where staffid = "'.$tab1['staffid'].'"';
		//$sql='update profile set chgpwd = "N" where staffid = "'.$tab1['staffid'].'"';
		$rsql=mysql_query($sql, connect_server())or die("Unable to query ".mysql_error());		
		
	

	}
	echo 'Successful';
?>
