<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alert</title>
</head>

<body>
	
	<form action="" method="post" name="frm" id="frm">
    	<script language="JavaScript">
			var intervall;
			function timeIntervals()
			{ 
				intervall=setInterval('document.getElementById("frm").submit()', 1200000);
			}
			timeIntervals()
		</script>
        <input name="hi" type="hidden" value="" />
    	<?php
			include('connection.php');
			$sql='select * from profile where id = "'.$_REQUEST['id'].'"';
			$rsql=mysql_query($sql,connect_server())or die("cannot query profile".mysql_error());
			$tab=mysql_fetch_array($rsql);
			$today=getdate();
			$sql1="select * from fill_attendance where vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' and staffid ='".$tab['staffid']."'";
			$rsql1=mysql_query($sql1,connect_server())or die("cannot query fill_attendance ".mysql_error());
			$tab1=mysql_fetch_array($rsql1);//echo $tab1['v10am'].'aaaa';
			if($tab1['v8am']==1){$_REQUEST['v8am']=1;}
			if($tab1['v10am']==1){$_REQUEST['v10am']=1;}
			if($tab1['v12pm']==1){$_REQUEST['v12pm']=1;}
			if($tab1['v2pm']==1){$_REQUEST['v2pm']=1;}
			$alert=' <embed src="alertsign3.mp3" width="1" height="1" autostart="true" ></embed>';
			$hour=$today['hours']-1;
			$v8am=strtotime($hour.':'.$today['minutes'])-strtotime('9:29');
			$v10am=strtotime($hour.':'.$today['minutes'])-strtotime('11:29');
			$v12pm=strtotime($hour.':'.$today['minutes'])-strtotime('13:29');
			$v2pm=strtotime($hour.':'.$today['minutes'])-strtotime('15:44');//echo '<br/>'.$v10am;
			if(!($v8am>0 || $_REQUEST['v8am']==1 )){$chk=1;}
			if(!(($v10am>0 || $v8am<0)|| $_REQUEST['v10am']==1  )){$chk=1;}
			if(!(($v12pm>0 || $v10am<0) ||$_REQUEST['v12pm']==1)){$chk=1;}
			if(!( $v2pm<0 || $_REQUEST['v2pm']==1 )){$chk=1;}
			if($chk==1){ echo $alert;}
				?>
</form>
</body>
</html>