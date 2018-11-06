<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance Register</title>
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
    	<?php
			include('connection.php');
			if($_REQUEST['id']==''){$msg='<font color="#FF6699"><strong>You need to logout and login again</strong></font><br/> ';}
			$sql='select * from profile where id = "'.$_REQUEST['id'].'"';
			$rsql=mysql_query($sql,connect_server())or die("cannot query profile".mysql_error());
			$tab=mysql_fetch_array($rsql);
			$today=getdate();
			$sql1="select * from fill_attendance where vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' and staffid ='".$tab['staffid']."'";
			$rsql1=mysql_query($sql1,connect_server())or die("cannot query fill_attendance ".mysql_error());
			if(trim($_REQUEST['id'])<>'')
			{
				if(mysql_num_rows($rsql1)==0)
				{
					$sqlcheck=0;
				}else
				{
					$sqlcheck=1;
				}
				if(isset($_REQUEST['v8am']))
				{
					$stmt='v8am = 1';
					$isset=1;
				}elseif(isset($_REQUEST['v10am']))
				{
					$stmt='v10am = 1';
					$isset=1;
				}elseif(isset($_REQUEST['v12pm']))
				{
					$stmt='v12pm = 1';
					$isset=1;
				}elseif(isset($_REQUEST['v2pm']))
				{
					$stmt='v2pm = 1';
					$isset=1;
				}
				if($sqlcheck==0 && $isset ==1)
				{
					$sqlinsert="insert into fill_attendance set
									staffid = '".$tab['staffid']."' ,
									vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' ,".$stmt; //echo $sqlinsert;
					$rsqlinsert=mysql_query($sqlinsert,connect_server())or die("cannot insert into fill_attendance ".mysql_error());
				}elseif($sqlcheck==1 && $isset ==1)
				{
					$sqlupdate="update fill_attendance set ".
									$stmt.
									" where staffid = '".$tab['staffid']."' and
									vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' "; //echo $sqlupdate;
					$rsqlupdate=mysql_query($sqlupdate,connect_server())or die("cannot update into fill_attendance ".mysql_error());
				}
				$rsql1=mysql_query($sql1,connect_server())or die("cannot query fill_attendance ".mysql_error());//echo $sql1;
				$tab1=mysql_fetch_array($rsql1);//echo $tab1['v10am'].'aaaa';
				if($tab1['v8am']==1){$_REQUEST['v8am']=1;}
				if($tab1['v10am']==1){$_REQUEST['v10am']=1;}
				if($tab1['v12pm']==1){$_REQUEST['v12pm']=1;}
				if($tab1['v2pm']==1){$_REQUEST['v2pm']=1;}
				$alert=' <embed src="alert/'.$tab['alert'].'.mp3" width="1" height="1" autostart="true" ></embed>';
			}
		?>
     
        <table border="1" cellspacing="0" cellpadding="2" align="center">
          <?php /*?><tr>
            <td align="left">  
            	<strong>Welcome</strong> <?php echo $tab['title']." ".$tab['lastname']." ".$tab['firstname']."( ".$tab['designation']." )" ?>
            </td>
          </tr><?php */?>
          <tr>
            <td align="center">
            	<?php
					
					//echo '<b>Today :</b> '.$today['mday'].'/'.$today['mon'].'/'.$today['year']; 
					echo $msg.'<strong>Check the Time box </strong>';
					//$hour=$today['hours']-1;echo $hour;
					$hour=$today['hours'];//echo $hour;
					//$hour=strtolower($hour);
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
            </td>
          </tr>
          <tr>
            <td>
            	<strong>Time :</strong>&nbsp;<?php // echo $hour;?>
              <input name="v8am" type="checkbox"  <?php if($v8am>0 || $_REQUEST['v8am']==1 ){echo 'disabled'; } ?>    onclick="if(this.checked){this.value=1;}else{this.value=0;};frm.submit()" value="<?php echo $_REQUEST['v8am']?>" <?php if($_REQUEST['v8am']==1 && trim($_REQUEST['id'])<>'' ) {echo 'checked="checked"';}?> />8 - 9.29am&nbsp;&nbsp;
              <input name="v10am" type="checkbox" <?php if(($v10am>0 || $v8am<0)|| $_REQUEST['v10am']==1  ){echo 'disabled'; } ?> onclick="if(this.checked){this.value=1;}else{this.value=0;};frm.submit()" value="<?php echo $_REQUEST['v10am']?>" <?php if($_REQUEST['v10am']==1 && trim($_REQUEST['id'])<>'') {echo 'checked="checked"';}?>/>9.30am - 11.29am &nbsp;&nbsp;
              <input name="v12pm" type="checkbox" <?php if(($v12pm>0 || $v10am<0) ||$_REQUEST['v12pm']==1){echo 'disabled'; } ?> onclick="if(this.checked){this.value=1;}else{this.value=0;};frm.submit()" value="<?php echo $_REQUEST['v12pm']?>" <?php if($_REQUEST['v12pm']==1 && trim($_REQUEST['id'])<>'' ) {echo 'checked="checked"';}?>/>11.30 - 1.29pm&nbsp;&nbsp;
              <input name="v2pm" type="checkbox" <?php if( $v2pm<0 || $_REQUEST['v2pm']==1 ){echo 'disabled'; } ?> onclick="if(this.checked){this.value=1;}else{this.value=0;};frm.submit()" value="<?php echo $_REQUEST['v2pm']?>" <?php if($_REQUEST['v2pm']==1 && trim($_REQUEST['id'])<>'') {echo 'checked="checked"';}?>/>3.45 - 4.00pm&nbsp;&nbsp;
            </td>
          </tr>
    </table>

</form>
</body>
</html>