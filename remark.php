<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Remarks</title>
</head>

<body>
	<?php
		include('connection.php');
		if($_REQUEST['id']==''){$msg='<font color="#FF6699"><strong>You need to logout and login again</strong></font><br/> ';}
		$sql='select * from profile where id = "'.$_REQUEST['id'].'"';
		$rsql=mysql_query($sql,connect_server())or die("cannot query profile".mysql_error());
		$tab=mysql_fetch_array($rsql);
		$today=getdate();
		$remk=array();//prob
		
		//prob
		$sql1='select * from profile where directorate = "'.$tab['directorate'].'"';
		$rsql1=mysql_query($sql1,connect_server())or die("cannot query profile".mysql_error());
		while($tab1=mysql_fetch_array($rsql1))
		{
			//echo $tab1['staffid'];
			if($_REQUEST['rmkhid'.$tab1['staffid']]==1)
			{
				$rmkstaff=$tab1['staffid'];
				$rmkcomm=$_REQUEST['rmk'.$tab1['staffid']];
				$stmt='remark'. '='."'". $rmkcomm."'";
			}
		}
		if($rmkstaff<>'')
		{
			$sql5="select * from fill_attendance where vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' and staffid ='".$rmkstaff."'";
			$rsql5=mysql_query($sql5,connect_server())or die("cannot query fill_attendance ".mysql_error());
			if(mysql_num_rows($rsql5)==0)
			{
				$sqlinsert="insert into fill_attendance set
								staffid = '".$rmkstaff."' ,
								vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' ,".$stmt; //echo $sqlinsert;
				$rsqlinsert=mysql_query($sqlinsert,connect_server())or die("cannot insert into fill_attendance ".mysql_error());
			}else
			{
				$sqlupdate="update fill_attendance set ".
								$stmt.
								" where staffid = '".$rmkstaff."' and
								vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' "; //echo $sqlupdate;
				$rsqlupdate=mysql_query($sqlupdate,connect_server())or die("cannot update into fill_attendance ".mysql_error());
			}
		}
		
	?>
    <form action="" method="post" name="frm" id="frm">
    	<table border="1" cellspacing="0" cellpadding="2" align="center">
          <?php /*?><tr>
            <td align="left">  
            	<strong>Welcome</strong> <?php echo $tab['title']." ".$tab['lastname']." ".$tab['firstname']."( ".$tab['designation']." )" ?><br/>
                <strong>Directorate :</strong><?php echo $tab['directorate'] ; ?><br/>
                <?php echo '<b>Today :</b> '.$today['mday'].'/'.$today['mon'].'/'.$today['year'];$cnt=0; ?>
            </td>
          </tr><?php */?>
          <tr>
            <td align="center"><?php echo $msg;?>
            	<strong>List of staff</strong><br/>
                <table border="1" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><strong>S/n</strong></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Designation</strong></td>
                    <td><strong>8am</strong></td>
                    <td><strong>10am</strong></td>
                    <td><strong>12am</strong></td>
                    <td><strong>2pm</strong></td>
                    <td align="center"><strong>Remark</strong></td>
                  </tr>
                  <?php
				  	$sql1='select * from profile where directorate = "'.$tab['directorate'].'" order by remarkrole desc , designation , vname';
					$rsql1=mysql_query($sql1,connect_server())or die("cannot query profile".mysql_error());
					while($tab1=mysql_fetch_array($rsql1))
					{
				  ?>
                      <tr>
                        <td><?php echo ++$cnt;?></td>
                        <td><?php echo $tab1['title']." ".$tab1['vname'] ?></td>
                        <td><?php echo $tab1['designation'];  ?></td>
                        <?php
							$sql2="select * from fill_attendance where vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' and staffid ='".$tab1['staffid']."'";
							$rsql2=mysql_query($sql2,connect_server())or die("cannot query fill_attendance ".mysql_error());
							$tab2=mysql_fetch_array($rsql2);
							
						?>
                        <td><input name="v8am<?php echo $tab1['staffid'] ?>" type="checkbox" disabled <?php if($tab2['v8am']==1){echo 'checked';}?>  /></td>
                        <td><input name="v10am<?php echo $tab1['staffid'] ?>" type="checkbox" disabled <?php if($tab2['v10am']==1){echo 'checked';}?>  /></td>
                        <td><input name="v12pm<?php echo $tab1['staffid'] ?>" type="checkbox" disabled <?php if($tab2['v12pm']==1){echo 'checked';}?>  /></td>
                        <td><input name="v2pm<?php echo $tab1['staffid'] ?>" type="checkbox" disabled <?php if($tab2['v2pm']==1){echo 'checked';}?>  /></td>
                        <td>
                        	<input name="rmkhid<?php echo $tab1['staffid'] ?>" type="hidden" />
                            <?php
								$sql4="select * from fill_attendance 
										where vdate = '".$today['year']."-".$today['mon']."-".$today['mday']."' 
										and staffid ='".$tab1['staffid']."'";
								$rsql4=mysql_query($sql4,connect_server())or die("cannot query fill and profile".mysql_error());
								$tab4=mysql_fetch_array($rsql4);
							?>
                        	<select name="rmk<?php echo $tab1['staffid'] ?>" onchange="rmkhid<?php echo $tab1['staffid'] ?>.value=1;frm.submit()" >
                            	<option selected="selected" value=""></option>
                                <?php
									$sql3="select * from remark";
									$rsql3=mysql_query($sql3,connect_server())or die("cannot query fill_attendance ".mysql_error());
									while($tab3=mysql_fetch_array($rsql3))
									{?>  
										<option value="<?php echo $tab3['remark_key'];?>" <?php if($_REQUEST['rmk'.$tab1['staffid']]==$tab3['remark_key']){echo 'selected';}elseif($tab4['remark']<>''&& $tab4['remark']==$tab3['remark_key']){echo 'selected';}?> >
                                        	 <?php echo "[".$tab3['remark_key']."] <strong>".$tab3['desc']."</strong>" ; ?> 
                                        </option><?php
									}?>
                            </select>
                        </td>
                      </tr><?php 
					}?>
                </table>

            </td>
          </tr>
          <tr>
            <td>
            </td>
          </tr>
   		</table>
    </form>
</body>
</html>