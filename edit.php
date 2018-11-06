<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit</title>
</head>

<body>
	<?php 
		include ('encrypt.php');
		include('connection.php');
		include('fn.php');
		if($_REQUEST['id']==''){$msg='<font color="#FF6699"><strong>You need to logout and login again</strong></font><br/> ';}
		// update all the rows
		//if the last table insert    designation sex remarkrole
		
	?>
<form action="" method="post" name="frm">

  <table border="1" cellspacing="0" cellpadding="2" align="center">
          <tr>
            <td align="center" colspan="2">
            	<strong>Manage Profile</strong>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            	<table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td>Directorate:</td>
                    <td>
                    	<?php
							$sql1="select distinct directorate from profile order by directorate";
							$rsql1=mysql_query($sql1,connect_server())or die("cannot query directorate".mysql_error());
							//echo $_REQUEST['directorate'].'<br/>';
							$_REQUEST['directorate']=str_replace("\'","'",$_REQUEST['directorate']);
							if($_REQUEST['directorate']==$_REQUEST['hiddir'])
							{
								$chk=1;
							}else
							{
								$chk=0;	
							}
						?>
                    	<select name="directorate" onchange='frm.submit()' >
                        	<option selected="selected" value=""></option>
                            <?php
								while($tab1=mysql_fetch_array($rsql1))
								{
							?>		<option value="<?php echo $tab1['directorate'];?>" <?php if($_REQUEST['directorate']==$tab1['directorate']){echo 'selected';} ?>>
										<?php echo ucwords(strtolower($tab1['directorate']));?>
                                    </option><?php
                            	}?>
                        </select>
                        <input name="hiddir" type="hidden" value="<?php echo $_REQUEST['directorate']?>" />
                        <?php
							$_REQUEST['directorate']=str_replace("'","\'",$_REQUEST['directorate']);
						?>
                    </td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  
                  
                </table>

            </td>
          </tr>
          <tr>
            <td colspan="2" align="center" >
            	<?php
					echo $msg;
					//if($_REQUEST['hidres']==1){echo 'Reset Password';}
					if( $_REQUEST['directorate']<>'')
					{
						if($chk==1)
						{
							$sql3=" select * from profile where directorate = '".$_REQUEST['directorate']."' order by remarkrole desc , designation, vname";
							$rsql3=mysql_query($sql3,connect_server())or die("cannot query profile".mysql_error());
							while($tab3=mysql_fetch_array($rsql3))
							{
								$sqlupdate='update profile set 
												staffid = "'.trim($_REQUEST[$tab3['staffid'].'staffid']).'" ,
												title = "'.trim($_REQUEST[$tab3['staffid'].'title']).'" ,
												vname = "'.trim($_REQUEST[$tab3['staffid'].'vname']).'" ,
												sex = "'.trim($_REQUEST[$tab3['staffid'].'sex']).'" ,
												designation = "'.trim($_REQUEST[$tab3['staffid'].'designation']).'" ,
												remarkrole = "'.trim($_REQUEST[$tab3['staffid'].'remarkrole']).'" 
												where id = "'.trim($_REQUEST['hidid'.$tab3['id']]).'" ';
								$rsqlupdate=mysql_query($sqlupdate,connect_server())or die("cannot update into profile".mysql_error());
								if($_REQUEST['hidres'.$tab3['staffid']]==1)
								{
										$sqlu1='update profile set 
												vpassword = "'.ecrypt(trim($_REQUEST[$tab3['staffid'].'staffid'])).'",
												chgpwd = "N"
												where id = "'.trim($_REQUEST['hidid'.$tab3['id']]).'" ';//echo $sqlu1;
										$rsqlu1=mysql_query($sqlu1,connect_server())or die("cannot update into profile".mysql_error());
								}
								
							}
							$succ= 'Successful';
						}
						if(trim($_REQUEST['staffid'])=='' && trim($_REQUEST['vname'])<>'')
						{
							echo '<br/>Enter Values of Staffid';
							$_REQUEST['hidvname'] = trim($_REQUEST['vname']);
						}
						if(trim($_REQUEST['staffid'])<>'' && trim($_REQUEST['vname'])=='')
						{
							$_REQUEST['hidstaffid'] = trim($_REQUEST['staffid']);
							$_REQUEST['hidtitle'] = trim($_REQUEST['title']);
							$_REQUEST['hiddesignation'] = trim($_REQUEST['designation']);
							$_REQUEST['hidsex'] = trim($_REQUEST['sex']);
							$_REQUEST['hidremarkrole'] = trim($_REQUEST['remarkrole']);
							
							//echo '<br/>Enter Values of Staffid';
						}
						if(trim($_REQUEST['staffid'])<>'' && trim($_REQUEST['vname'])<>'')
						{
							$sql4=" select * from profile where staffid = '".$_REQUEST['staffid']."' ";
							$rsql4=mysql_query($sql4,connect_server())or die("cannot query profile".mysql_error());
							if(mysql_num_rows($rsql4)<>0)
							{
								echo '<br/>Staffid already exist';
								$_REQUEST['hidvname'] = trim($_REQUEST['vname']);
								$_REQUEST['hidstaffid'] = trim($_REQUEST['staffid']);
								$_REQUEST['hidtitle'] = trim($_REQUEST['title']);
								$_REQUEST['hiddesignation'] = trim($_REQUEST['designation']);
								$_REQUEST['hidsex'] = trim($_REQUEST['sex']);
								$_REQUEST['hidremarkrole'] = trim($_REQUEST['remarkrole']);
							}else
							{
								$sqlinsert='insert into profile set 
												staffid = "'.trim($_REQUEST['staffid']).'" ,
												vpassword = "'.ecrypt(trim($_REQUEST['staffid'])).'" ,
												title = "'.trim($_REQUEST['title']).'" ,
												vname = "'.trim($_REQUEST['vname']).'" ,
												sex = "'.trim($_REQUEST['sex']).'" ,
												designation = "'.trim($_REQUEST['designation']).'" ,
												remarkrole = "'.trim($_REQUEST['remarkrole']).'" ,
												directorate = "'.trim($_REQUEST['directorate']).'" ';
								$rsqlinsert=mysql_query($sqlinsert,connect_server())or die("cannot insert into profile".mysql_error());
								$succ= 'Successful';
							}
						}
						  	
						    echo '<font color="#0000FF">'.$succ.'</font>';
						?>
						
                            	<table border="1" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td><strong>S/n</strong></td> 
                                    <td ><strong>STAFF ID</strong></td>    
                                    <td nowrap="nowrap" ><strong>TITLE</strong></td>
                                    <td ><strong>NAME</strong></td>
                                    <td ><strong>DESIGNATION</strong></td>
                                    <td><strong>SEX</strong></td>
                                    <td ><strong>ASSIGN REMARK</strong></td>
                                    <td ><strong>ACTION</strong></td>
                                  </tr>
                                  
                                  <?php
								  		//echo $_REQUEST['2staffid'];
										$sql3=" select * from profile where directorate = '".$_REQUEST['directorate']."' order by remarkrole desc , designation, vname";
										$rsql3=mysql_query($sql3,connect_server())or die("cannot query profile".mysql_error());
										while($tab3=mysql_fetch_array($rsql3))
										{
										  ?>
										  <tr>
											<td align="center"><?php echo ++$cnt;?></td>
                                            <td nowrap="nowrap" >
                                               <input name="<?php echo $tab3['staffid']?>staffid" type="text" value="<?php echo $tab3['staffid'] ?>" size="3" onchange='frm.submit()' />
                                            	<?php //insert textfield
													// echo $tab3['staffid'];
												?>
                                                <input name="hidid<?php echo $tab3['id']?>" type="hidden" value="<?php echo $tab3['id']?>" />
                                            </td>
											<td nowrap="nowrap" >
                                            	<input name="<?php echo $tab3['staffid']?>title" type="text" value="<?php echo $tab3['title'] ?>" size="1" onchange='frm.submit()' />
                                            	<?php //insert textfield
													 //echo $tab3['title'];
												?>
                                            </td>
                                            <td align="center">
                                            	<input name="<?php echo $tab3['staffid'] ?>vname" type="text" value="<?php echo ucwords($tab3['vname']) ?>" onchange='frm.submit()' />
                                            	<?php
													 //echo ucwords($tab3['vname']);
												?>
                                            </td>
											<td align="center">
                                            	<input name="<?php echo $tab3['staffid'] ?>designation" type="text" value="<?php echo ucwords($tab3['designation']); ?>" onchange='frm.submit()' />
                                            	<?php
													// echo ucwords($tab3['designation']);
												?>
                                            </td>
											
                                            <td align="center">
                                            	<select name="<?php echo $tab3['staffid'] ?>sex" onchange='frm.submit()' >
                                                	<option value=""></option>
                                                    <option value="M" <?php if($tab3['sex']=='M'){echo 'selected';}?>>M</option>
                                                    <option value="F" <?php if($tab3['sex']=='F'){echo 'selected';}?>>F</option>
                                                </select>
                                            	<?php
													// echo $tab3['sex'];
												?>
                                            </td>
                                            <td align="center">
                                            	<select name="<?php echo $tab3['staffid'] ?>remarkrole" onchange='frm.submit()'>
                                                    <option value="1" <?php if($tab3['remarkrole']=='1'){echo 'selected';}?> >YES</option>
                                                    <option value="0" <?php if($tab3['remarkrole']=='0'){echo 'selected';}?> >NO</option>
                                                </select>
                                                
                                            </td>
                                            <td align="center">
                                            	<input name="hidres<?php echo $tab3['staffid'] ?>" type="hidden"  id="hidres<?php echo $tab3['staffid'] ?>" />
                                                <label onclick="hidres<?php echo $tab3['staffid'] ?>.value=1;frm.submit();"><img src="reset.png" name="res<?php echo $tab3['staffid'] ?>"  width="20" height="20" title="Reset Password" /></label>
                                            </td>
												
										  </tr><?php
									}?>
                                    <tr>
                                        <td align="center"><?php echo ++$cnt;?></td>
                                        <td nowrap="nowrap" >
                                           <input name="staffid" type="text" size="3" value="<?php echo $_REQUEST['hidstaffid'];?>" />
                                        </td>
                                        <td nowrap="nowrap" >
                                            <input name="title" type="text"  size="1" onchange='frm.submit()' value="<?php echo $_REQUEST['hidtitle'];?>" />
                                        </td>
                                        <td align="center">
                                            <input name="vname" type="text"  onchange='frm.submit()' value="<?php echo $_REQUEST['hidvname'];?>"  />
                                        </td>
                                        <td align="center">
                                            <input name="designation" type="text"  onchange='frm.submit()' value="<?php echo $_REQUEST['hiddesignation'];?>" />
                                        </td>
                                        
                                        <td align="center">
                                            <select name="sex" onchange='frm.submit()' >
                                                <option value="" selected="selected"></option>
                                                <option value="M" <?php if($_REQUEST['hidsex']=='M'){echo 'selected';}?> >M</option>
                                                <option value="F" <?php if($_REQUEST['hidsex']=='F'){echo 'selected';}?>>F</option>
                                            </select>
                                        </td>
                                        <td align="center">
                                            <select name="remarkrole" onchange='frm.submit()'>
                                                <option value="1" <?php if($_REQUEST['hidremarkrole']=='1'){echo 'selected';}?> >YES</option>
                                                <option value="0"  <?php if($_REQUEST['hidremarkrole']<>'1'){echo 'selected';}?> >NO</option>
                                            </select>
                                        </td>
                                        <td align="center">&nbsp;
                                            
                                        </td>
                                            
                                      </tr>
                                    </table>
						<?php //secoooooooooooooooooond one
					}
				?>
            	
            </td>
        </tr>
        
        <tr>
            <td align="center" colspan="2">
            	<input name="sub" type="submit" value="Save All Actions" />
            </td>
          </tr>
    </table>
  </form>
</body>
</html>