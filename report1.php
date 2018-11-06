<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
</head>

<body>
	<?php 
		
		include('connection.php');
		include('fn.php');
		if($_REQUEST['id']==''){$msg='<font color="#FF6699"><strong>You need to logout and login again</strong></font><br/> ';}
	?>
    <form action="" method="post" name="frm">
    	<table border="1" cellspacing="0" cellpadding="2" align="center">
          <tr>
            <td align="center" colspan="2"><strong>Servicom Report</strong></td>
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
						?>
                    	<select name="directorate" onchange='if(this.value!=""&&mnth.value!=""&&mode.value!=""){frm.submit()};if(this.value=="all"){frm.submit()}'>
                        	<option selected="selected" value=""></option>
                            <?php
								while($tab1=mysql_fetch_array($rsql1))
								{
							?>		<option value="<?php echo $tab1['directorate'];?>" <?php if($_REQUEST['directorate']==$tab1['directorate']){echo 'selected';} ?>>
										<?php echo ucwords(strtolower($tab1['directorate']));?>
                                    </option><?php
                            	}?>
                              <option value="all" <?php if($_REQUEST['directorate']=='all'){echo 'selected';} ?>>
                              	ALL
                              </option>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Month:</td>
                    <td>
                    	<select name="mnth"  onchange='if(directorate.value!=""&&this.value!=""&&mode.value!=""){frm.submit()}' >
                          <option value="" selected="selected"></option>
                    	  <option value="01" <?php if($_REQUEST['mnth']=="01"){echo 'selected';}?> >JAN</option>
                    	  <option value="02" <?php if($_REQUEST['mnth']=="02"){echo 'selected';}?> >FEB</option>
                    	  <option value="03" <?php if($_REQUEST['mnth']=="03"){echo 'selected';}?> >MAR</option>
                    	  <option value="04" <?php if($_REQUEST['mnth']=="04"){echo 'selected';}?> >APR</option>
                    	  <option value="05" <?php if($_REQUEST['mnth']=="05"){echo 'selected';}?> >MAY</option>
                    	  <option value="06" <?php if($_REQUEST['mnth']=="06"){echo 'selected';}?> >JUN</option>
                    	  <option value="07" <?php if($_REQUEST['mnth']=="07"){echo 'selected';}?> >JUL</option>
                    	  <option value="08" <?php if($_REQUEST['mnth']=="08"){echo 'selected';}?> >AUG</option>
                    	  <option value="09" <?php if($_REQUEST['mnth']=="09"){echo 'selected';}?> >SEP</option>
                    	  <option value="10" <?php if($_REQUEST['mnth']=="10"){echo 'selected';}?> >OCT</option>
                    	  <option value="11" <?php if($_REQUEST['mnth']=="11"){echo 'selected';}?> >NOV</option>
                    	  <option value="12" <?php if($_REQUEST['mnth']=="12"){echo 'selected';}?> >DEC</option>
                        </select>
                    </td>
                    <td>
                    	Year 
                        <select name="yr"  > 
                        	<option value="2012">2012</option>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Mode:</td>
                    <td>
                    	<select name="mode" onchange='if(directorate.value!=""&& mnth.value!=""&& this.value!=""){frm.submit()};if(this.value!=""){frm.submit()}' >
                        	<option value="Table" <?php if($_REQUEST['mode']=="Table"){echo 'selected';}?> >Table Only</option>
                            <?php 
							if($_REQUEST['directorate']=='all')
							{?>
                                <option value="pie" <?php if($_REQUEST['mode']=="pie"){echo 'selected';}?> >Pie Chart</option>
                                <option value="bar" <?php if($_REQUEST['mode']=="bar"){echo 'selected';}?> >Bar Chart</option>
                        	<?php
							}?>
                        </select>
                    </td>
                    <td>
                    	<?php
							if($_REQUEST['mode']=='pie'||$_REQUEST['mode']=='bar')
							{
								
								$sql2="select * from report_type order by reportdesc";
								$rsql2=mysql_query($sql2,connect_server())or die("cannot query profile".mysql_error());
							?>
                               
								<select name="piemode" onchange='frm.submit()' >
                                	<?php
										while($tab2=mysql_fetch_array($rsql2))
										{?>
									
                                    		<option value="<?php echo $tab2['rid'];?>" <?php if($_REQUEST['piemode']==$tab2['rid']){echo 'selected';} ?> > <?php echo ucwords($tab2['reportdesc']); ?></option><?php
										}?>
                                    
                                </select>
                                <?php
								$rsql2=mysql_query($sql2,connect_server())or die("cannot query profile".mysql_error());
								$tab2=mysql_fetch_array($rsql2);
								if($_REQUEST['piemode']==''){$_REQUEST['piemode']=$tab2['rid'];}
								
							}
							 echo $msg;
						?>
                    </td>
                  </tr>
                </table>

            </td>
          </tr>
          <tr>
            <td>
            	<?php
					if($_REQUEST['mode']<>"" && $_REQUEST['directorate']<>'all' && $_REQUEST['directorate']<>''&& $_REQUEST['mnth']<>'')
					{
						$P=array();$comm=array();
						?>
						<table border="1" cellspacing="0" cellpadding="2">
                          <tr>
                            <td>
                            	<strong>DAILY WORK ATTENDANCE <br/>
                                <?php echo $_REQUEST['directorate']; 
									if(count(explode('&',$_REQUEST['directorate']))>0){$and = 1;}else{$and=0;}
									$dir=str_replace('&','aand',$_REQUEST['directorate']);//echo $dir;
								?>
                             </strong></td>
                            <td>
							    <strong><?php echo mth($_REQUEST['mnth']).','.$_REQUEST['yr'];
									
								?><br/>
                                  <a href="#"   style="text-decoration:none" onclick="window.open('report2.php?mnth=<?php echo $_REQUEST['mnth']?>&yr=<?php echo $_REQUEST['yr']?>&and=<?php echo $and  ?>&directorate=<?php echo $dir  ?>','admwrkwin','toolbar=no,resizable=yes,scrollbars=yes,status=yes,height=500,width=400');" >
                           			View Absentees</a></strong>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" >
                            	<table border="1" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td><strong>S/n</strong></td>
                                    <td nowrap="nowrap" ><strong>Name</strong></td>
                                    <td><strong>Designation</strong></td>
                                    <?php
										for($i=1;$i<=mthnumdays($_REQUEST['mnth'],$_REQUEST['yr']);$i++)
										{
											$today = date("D",strtotime($_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i));
											if($today<>'Sun'&&$today<>'Sat')
											{
												++$tdsum;
												//echo '<td>&nbsp;</td>'; 
											}?>
											
											<?php
											
											
										}
									?>
                                    <td colspan="<?php echo $tdsum?>">&nbsp;</td>
                                    <td colspan="9">&nbsp;</td>
                                    <td><strong>PRESENT TOTAL + PARTIAL P</strong></td>
                                    <td colspan="3"><strong>MEDICAL</strong></td>
                                    <td colspan="8"><strong>LEAVE</strong></td>
                                    <td><strong>OTHERS</strong></td>
                                    <td colspan="5"><strong> ACADEMIC</strong></td>
                                    <td colspan="2"><strong>OFFICIAL</strong></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                     <?php
										for($i=1;$i<=mthnumdays($_REQUEST['mnth'],$_REQUEST['yr']);$i++)
										{
											$today = date("D",strtotime($_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i));
											if($today<>'Sun'&&$today<>'Sat'){echo '<td><strong>'. $i.'</strong></td>'; } 
											
										}
									?>
                                    <td>&nbsp;</td>
                                    <td><strong>#Day</strong></td>
                                    <td width="26"><strong>P</strong></td>
                                    <td width="26"><strong>A</strong></td>
                                    <td width="26"><strong>P1</strong></td>
                                    <td width="26"><strong>P2</strong></td>
                                    <td width="26"><strong>P3</strong></td>
                                    <td width="26"><strong>P4</strong></td>
                                    <td width="26"><strong>P5</strong></td>
                                    <td width="26"><strong>P+P1+P2+P3+P4+P5</strong></td>
                                    <td width="26"><strong>A1</strong></td>
                                    <td width="26"><strong>A8</strong></td>
                                    <td width="26"><strong>A10</strong></td>
                                    <td width="26"><strong>A2</strong></td>
                                    <td width="26"><strong>A3</strong></td>
                                    <td width="26"><strong>A4</strong></td>
                                    <td width="26"><strong>A5</strong></td>
                                    <td width="26"><strong>A6</strong></td>
                                    <td width="26"><strong>A7</strong></td>
                                    <td width="26"><strong>A9</strong></td>
                                    <td width="26"><strong>A11</strong></td>
                                    <td width="26"><strong>A12</strong></td>
                                    <td width="26"><strong>A16</strong></td>
                                    <td width="26"><strong>A17</strong></td>
                                    <td width="26"><strong>A18</strong></td>
                                    <td width="26"><strong>A19</strong></td>
                                    <td width="26"><strong>A20</strong></td>
                                    <td width="26"><strong>A21</strong></td>
                                    <td width="26"><strong>NC</strong></td>
                                  </tr>
                                  <?php
										$sql3=" select * from profile where directorate = '".$_REQUEST['directorate']."' order by remarkrole desc , designation, vname";
										$rsql3=mysql_query($sql3,connect_server())or die("cannot query profile".mysql_error());
										while($tab3=mysql_fetch_array($rsql3))
										{
										  ?>
										  <tr>
											<td><?php echo ++$cnt;?></td>
											<td nowrap="nowrap" >
                                            	<?php
													 echo ucwords($tab3['title']." ".$tab3['vname']);
												?>
                                            </td>
											<td>
                                            	<?php
													 echo ucwords($tab3['designation']);
												?>
                                            </td>
											<?php
												
												for($i=1;$i<=mthnumdays($_REQUEST['mnth'],$_REQUEST['yr']);$i++)
												{
													$today = date("D",strtotime($_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i));
													if($today<>'Sun'&&$today<>'Sat')
													{
														$sql4=" select * from fill_attendance where staffid ='".$tab3['staffid']."' and vdate ='".$_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i."' ";
														$rsql4=mysql_query($sql4,connect_server())or die("cannot query attendance".mysql_error());
														$tab4=mysql_fetch_array($rsql4);
														if($tab4['v8am']==1&&$tab4['v10am']==1&&$tab4['v12pm']==1&&$tab4['v2pm']==1)
														{
															echo '<td>P</td>'; 
															$P[$tab3['staffid']]+=1;
														}else
														{
															if(!($tab4['v8am']==1&&$tab4['v10am']==1&&$tab4['v12pm']==1&&$tab4['v2pm']==1)
																&& ($tab4['v2pm']==0&&$tab4['v8am']==1&&$tab4['v10am']==1&&$tab4['remark']==''))
															{
																echo '<td>P1</td>';
																$comm[$tab3['staffid']]['P1']+=1;
															}elseif(!($tab4['v8am']==1&&$tab4['v10am']==1&&$tab4['v12pm']==1&&$tab4['v2pm']==1)
																&& (($tab4['v2pm']==1||$tab4['v12pm']==1)&&$tab4['v8am']==0&&$tab4['v10am']==0&&$tab4['remark']==''))
															{
																echo '<td>P4</td>';
																$comm[$tab3['staffid']]['P4']+=1;
															}elseif(($tab4['v8am']==0&&$tab4['v10am']==0&&$tab4['v12pm']==0&&$tab4['v2pm']==0)
																&&$tab4['remark']=='')
															{
																
																echo '<td>NC</td>';
																$comm[$tab3['staffid']]["NC"]+=1;
															}elseif(!($tab4['v8am']==1&&$tab4['v10am']==1&&$tab4['v12pm']==1&&$tab4['v2pm']==1)
																&&($tab4['v8am']==1||$tab4['v10am']==1||$tab4['v12pm']==1||$tab4['v2pm']==1)
																&&$tab4['remark']=='')
															{
																
																echo '<td>P5</td>';
																$comm[$tab3['staffid']]["P5"]+=1;
															}else
															{
																echo '<td>'.$tab4['remark'].'</td>'; 
																if($tab4['remark']<>'')
																{
																	$comm[$tab3['staffid']][$tab4['remark']]+=1;
																}
															}
															
														}
													}
													
													
												}
												
											?>
												<td>&nbsp;</td>
											 	<td align="center" ><?php echo $day=$tdsum;?></td>
                                                <td align="center" >
													<?php 
														echo (int)$P[$tab3['staffid']];
														$ptotal+=(int)$P[$tab3['staffid']];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$tdsum -(int)$P[$tab3['staffid']];
														$atotal+=(int)$tdsum -(int)$P[$tab3['staffid']];														
													?>
                                                </td>
                                                <td align="center" >
													<?php
														
                                                     	echo (int)$comm[$tab3['staffid']]["P1"];
														$p1total+=(int)$comm[$tab3['staffid']]["P1"];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	echo (int)$comm[$tab3['staffid']]["P2"];
														$p2total+=(int)$comm[$tab3['staffid']]["P2"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["P3"];
														$p3total+=(int)$comm[$tab3['staffid']]["P3"];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["P4"];
														$p4total+=(int)$comm[$tab3['staffid']]["P4"];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["P5"];
														$p5total+=(int)$comm[$tab3['staffid']]["P5"];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                        echo (int)$P[$tab3['staffid']]+(int)$comm[$tab3['staffid']]["P1"]+(int)$comm[$tab3['staffid']]["P2"]+(int)$comm[$tab3['staffid']]["P3"]+(int)$comm[$tab3['staffid']]["P4"]+(int)$comm[$tab3['staffid']]["P5"];
                                                   		$allptotal+=(int)$P[$tab3['staffid']]+(int)$comm[$tab3['staffid']]["P1"]+(int)$comm[$tab3['staffid']]["P2"]+(int)$comm[$tab3['staffid']]["P3"]+(int)$comm[$tab3['staffid']]["P4"]+(int)$comm[$tab3['staffid']]["P5"];
												    ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["A1"];
														$a1total+=(int)$comm[$tab3['staffid']]["A1"];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                        echo (int)$comm[$tab3['staffid']]["A8"];
														$a8total+=(int)$comm[$tab3['staffid']]["A8"];
                                                    ?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                        echo (int)$comm[$tab3['staffid']]["A10"];
														$a10total+=(int)$comm[$tab3['staffid']]["A10"];
                                                    ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["A2"];
														$a2total+=(int)$comm[$tab3['staffid']]["A2"];
													?>
                                                </td>
                                                <td align="center" >
													<?php
														 echo (int)$comm[$tab3['staffid']]["A3"];
														 $a3total+=(int)$comm[$tab3['staffid']]["A3"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                        echo (int)$comm[$tab3['staffid']]["A4"];
														$a4total+=(int)$comm[$tab3['staffid']]["A4"];
                                                    ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	echo (int)$comm[$tab3['staffid']]["A5"];
														$a5total+=(int)$comm[$tab3['staffid']]["A5"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	echo (int)$comm[$tab3['staffid']]["A6"];
														$a6total+=(int)$comm[$tab3['staffid']]["A6"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php
                                                         echo (int)$comm[$tab3['staffid']]["A7"];
														 $a7total+=(int)$comm[$tab3['staffid']]["A7"];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php
														 echo (int)$comm[$tab3['staffid']]["A9"];
														 $a9total+=(int)$comm[$tab3['staffid']]["A9"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["A11"];
														$a11total+=(int)$comm[$tab3['staffid']]["A11"];
													?>
                                                </td>
                                                <td align="center" >
													<?php
                                                        echo (int)$comm[$tab3['staffid']]["A12"];
														$a12total+=(int)$comm[$tab3['staffid']]["A12"];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	echo (int)$comm[$tab3['staffid']]["A16"];
														$a16total+=(int)$comm[$tab3['staffid']]["A16"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["A17"];
														$a17total+=(int)$comm[$tab3['staffid']]["A17"];
													?>
                                                </td>
                                                <td align="center" >
													<?php
														 echo (int)$comm[$tab3['staffid']]["A18"];
														 $a18total+=(int)$comm[$tab3['staffid']]["A18"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["A19"];
														$a19total+=(int)$comm[$tab3['staffid']]["A19"];
													?>
                                                </td>
                                                <td align="center" >
													<?php
													 	echo (int)$comm[$tab3['staffid']]["A20"];
														$a20total+=(int)$comm[$tab3['staffid']]["A20"];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php
                                                         echo (int)$comm[$tab3['staffid']]["A21"];
														 $a21total+=(int)$comm[$tab3['staffid']]["A21"];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php 
														echo (int)$comm[$tab3['staffid']]["NC"];
														$nctotal+=(int)$comm[$tab3['staffid']]["NC"];
													?>
                                                </td>
										  </tr><?php
									}?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="<?php echo $tdsum; ?>">&nbsp;</td>
                                        <td align="right"><strong>Total</strong></td>
                                        <td>&nbsp;</td>
                                        <td width="26"  align="center"><strong><?php echo $ptotal;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $atotal;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p1total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p2total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p3total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p4total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p5total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $allptotal;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a1total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a8total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a10total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a2total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a3total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a4total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a5total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a6total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a7total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a9total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a11total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a12total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a16total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a17total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a18total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a19total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a20total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a21total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $nctotal;?></strong></td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>

						<?php //secoooooooooooooooooond one
					}elseif($_REQUEST['mode']<>"" && $_REQUEST['directorate']=='all' && $_REQUEST['directorate']<>''&& $_REQUEST['mnth']<>'')
					{
						$P=array();$comm=array();
						//$other=array("P1","P2","P3","P4","A8","A10","A2","A3","A4","A5","A6","A7","A9","A11","A12","A16","A17","A18","A19","A20","A21","ABS");
						?>
						<table border="1" cellspacing="0" cellpadding="2">
                          <tr>
                            <td>
                            	<strong>DAILY WORK ATTENDANCE <br/>
                                <?php //echo $_REQUEST['directorate']; ?>
                             </strong></td>
                            <td><strong><?php echo mth($_REQUEST['mnth']).','.$_REQUEST['yr']?></strong></td>
                          </tr>
                          <tr>
                            <td colspan="2" >
                            	<table border="1" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td><strong>S/n</strong></td>
                                    <td nowrap="nowrap" ><strong>Directorate</strong></td>
                                    <td colspan="7">&nbsp;</td>
                                    <td><strong>PRESENT TOTAL + PARTIAL P</strong></td>
                                    <td colspan="3"><strong>MEDICAL</strong></td>
                                    <td colspan="8"><strong>LEAVE</strong></td>
                                    <td><strong>OTHERS</strong></td>
                                    <td colspan="5"><strong> ACADEMIC</strong></td>
                                    <td colspan="2"><strong>OFFICIAL</strong></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>&nbsp;</td>
                                    
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    
                                    <td>&nbsp;</td>
                                    
                                    <td width="26"><strong>P</strong></td>
                                    <td width="26"><strong>A</strong></td>
                                    <td width="26"><strong>P1</strong></td>
                                    <td width="26"><strong>P2</strong></td>
                                    <td width="26"><strong>P3</strong></td>
                                    <td width="26"><strong>P4</strong></td>
                                    <td width="26"><strong>P5</strong></td>
                                    <td width="26"><strong>P+P1+P2+P3+P4+P5</strong></td>
                                    <td width="26"><strong>A1</strong></td>
                                    <td width="26"><strong>A8</strong></td>
                                    <td width="26"><strong>A10</strong></td>
                                    <td width="26"><strong>A2</strong></td>
                                    <td width="26"><strong>A3</strong></td>
                                    <td width="26"><strong>A4</strong></td>
                                    <td width="26"><strong>A5</strong></td>
                                    <td width="26"><strong>A6</strong></td>
                                    <td width="26"><strong>A7</strong></td>
                                    <td width="26"><strong>A9</strong></td>
                                    <td width="26"><strong>A11</strong></td>
                                    <td width="26"><strong>A12</strong></td>
                                    <td width="26"><strong>A16</strong></td>
                                    <td width="26"><strong>A17</strong></td>
                                    <td width="26"><strong>A18</strong></td>
                                    <td width="26"><strong>A19</strong></td>
                                    <td width="26"><strong>A20</strong></td>
                                    <td width="26"><strong>A21</strong></td>
                                    <td width="26"><strong>NC</strong></td>
                                    <td>&nbsp;</td>
                                    <td><strong>MEDICAL</strong></td>
                                    <td><strong>LEAVE</strong></td>
                                    <td><strong>OTHERS</strong></td>
                                    <td><strong>ACADEMIC</strong></td>
                                    <td><strong>ROUTINE DUTIES</strong></td>
                                    <td><strong>ABSENT</strong></td>
                                  </tr>
                                  <?php
										for($i=1;$i<=mthnumdays($_REQUEST['mnth'],$_REQUEST['yr']);$i++)
										{
											$today = date("D",strtotime($_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i));
											if($today<>'Sun'&&$today<>'Sat')
											{
												++$tdsum;
												//echo '<td>&nbsp;</td>'; 
											}?>
											
											<?php
											
											
										}
										$sql3="select distinct directorate from profile order by directorate";
										$rsql3=mysql_query($sql3,connect_server())or die("cannot query directorate".mysql_error());
										while($tab3=mysql_fetch_array($rsql3))
										{
										  ?>
										  <tr>
											<td><?php echo ++$cnt;?></td>
											<td nowrap="nowrap" >
                                            	<?php
													 echo strtoupper($tab3['directorate']);
												?>
                                            </td>
											
											<?php /*?><?php
												
												for($i=1;$i<=mthnumdays($_REQUEST['mnth'],$_REQUEST['yr']);$i++)
												{
													$today = date("D",strtotime($_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i));
													if($today<>'Sun'&&$today<>'Sat')
													{
														$sql4=" select * from fill_attendance where staffid ='".$tab3['staffid']."' and vdate ='".$_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i."' ";
														$rsql4=mysql_query($sql4,connect_server())or die("cannot query attendance".mysql_error());
														$tab4=mysql_fetch_array($rsql4);
														if($tab4['v8am']==1&&$tab4['v10am']==1&&$tab4['v12pm']==1&&$tab4['v2pm']==1)
														{
															echo '<td>P</td>'; 
															$P[$tab4['staffid']]+=1;
														}else
														{
															echo '<td>'.$tab4['remark'].'</td>'; 
															if($tab4['remark']<>'')
															{
																$comm[$tab4['staffid']][$tab4['remark']]+=1;
															}
															
														}
													}
													
													
												}
												
											?><?php */
											?>
                                            
												
                                                <td align="center" >
													<?php 
														$sql5='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql5=mysql_query($sql5,connect_server())or die("cannot query attendance".mysql_error());
														$tab5=mysql_fetch_array($rsql5);
														echo (int)$tab5['cnt'];//echo $sql5;
														$ptotal+=(int)$tab5['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql6='select ((count(*)*'.$tdsum.')-'.(int)$tab5['cnt'].') as cnt from profile where directorate ="'.$tab3['directorate'].'"';
														//echo $sql6;
														$rsql6=mysql_query($sql6,connect_server())or die("cannot query attendance".mysql_error());
														$tab6=mysql_fetch_array($rsql6);
														echo (int)$tab6['cnt'];
														$atotal+=(int)$tab6['cnt'];														
													?>
                                                </td>
                                                <td align="center" >
													<?php
														$sql7='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "P1" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql7=mysql_query($sql7,connect_server())or die("cannot query attendance".mysql_error());
														$tab7=mysql_fetch_array($rsql7);
														$sql7B='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and (remark = "" or remark is null) and (v8am = 1 and v10am = 1  and v2pm = 0) and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql7B=mysql_query($sql7B,connect_server())or die("cannot query attendance".mysql_error());
														$tab7B=mysql_fetch_array($rsql7B);//echo $sql7B;
														(int)$tab7sum=(int)$tab7B['cnt']+(int)$tab7['cnt'];
                                                     	echo $tab7sum;
														$p1total+=(int)$tab7sum;
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	$sql8='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "P2" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql8=mysql_query($sql8,connect_server())or die("cannot query attendance".mysql_error());
														$tab8=mysql_fetch_array($rsql8);
                                                     	echo (int)$tab8['cnt'];
														$p2total+=(int)$tab8['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql9='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "P3" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql9=mysql_query($sql9,connect_server())or die("cannot query attendance".mysql_error());
														$tab9=mysql_fetch_array($rsql9);
                                                     	echo (int)$tab9['cnt'];
														$p3total+=(int)$tab9['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql10='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "P4" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql10=mysql_query($sql10,connect_server())or die("cannot query attendance".mysql_error());
														$tab10=mysql_fetch_array($rsql10);
														$sql10b='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and (remark = "" or remark is null) and ((v2pm = 1 or v12pm = 1)and v8am = 0 and v10am = 0 ) and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql10b=mysql_query($sql10b,connect_server())or die("cannot query attendance".mysql_error());
														$tab10b=mysql_fetch_array($rsql10b);
                                                     	(int)$tab10sum=(int)$tab10b['cnt']+(int)$tab10['cnt'];
                                                     	echo (int)$tab10sum;
														$p4total+=(int)$tab10sum;
													?>
                                                </td>
                                                 <td align="center" >
													<?php 
														$sql10ex='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "P5" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql10ex=mysql_query($sql10ex,connect_server())or die("cannot query attendance".mysql_error());
														$tab10ex=mysql_fetch_array($rsql10ex);
														$sql10exb='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'"
																	 and (remark = "" or remark is null) and !((v2pm = 1 or v12pm = 1)and v8am = 0 and v10am = 0 )
																	 and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)
																	 and !(v8am = 1 and v10am = 1  and v2pm = 0)
																	 and (v8am = 1 or v10am = 1 or v12pm = 1 or v2pm = 1)
																	 and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql10exb=mysql_query($sql10exb,connect_server())or die("cannot query attendance".mysql_error());
														$tab10exb=mysql_fetch_array($rsql10exb);
                                                     	(int)$tab10exsum=(int)$tab10exb['cnt']+(int)$tabex10['cnt'];
                                                     	echo (int)$tab10exsum;
														$p5total+=(int)$tab10exsum;
													?>
                                                </td>
                                                <td align="center" >
													<?php ///PUT P5
                                                        echo (int)$tab7sum+(int)$tab8['cnt']+(int)$tab9['cnt']+(int)$tab10sum+(int)$tab10exsum+(int)$tab5['cnt'] ;
                                                   		$allptotal+=(int)$tab7sum+(int)$tab8['cnt']+(int)$tab9['cnt']+(int)$tab10sum+(int)$tab10exsum+(int)$tab5['cnt'] ;
												    ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql11='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A1" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql11=mysql_query($sql11,connect_server())or die("cannot query attendance".mysql_error());
														$tab11=mysql_fetch_array($rsql11);
                                                     	echo (int)$tab11['cnt'];
														$a1total+=(int)$tab11['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                        $sql12='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A8" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql12=mysql_query($sql12,connect_server())or die("cannot query attendance".mysql_error());
														$tab12=mysql_fetch_array($rsql12);
                                                     	echo (int)$tab12['cnt'];
														$a8total+=(int)$tab12['cnt'];
                                                    ?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                        $sql13='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A10" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql13=mysql_query($sql13,connect_server())or die("cannot query attendance".mysql_error());
														$tab13=mysql_fetch_array($rsql13);
                                                     	echo (int)$tab13['cnt'];
														$a10total+=(int)$tab13['cnt'];
                                                    ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql14='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A2" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql14=mysql_query($sql14,connect_server())or die("cannot query attendance".mysql_error());
														$tab14=mysql_fetch_array($rsql14);
                                                     	echo (int)$tab14['cnt'];
														$a2total+=(int)$tab14['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php
														$sql15='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A3" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql15=mysql_query($sql15,connect_server())or die("cannot query attendance".mysql_error());
														$tab15=mysql_fetch_array($rsql15);
                                                     	echo (int)$tab15['cnt'];
														$a3total+=(int)$tab15['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
                                                       	$sql16='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A4" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql16=mysql_query($sql16,connect_server())or die("cannot query attendance".mysql_error());
														$tab16=mysql_fetch_array($rsql16);
                                                     	echo (int)$tab16['cnt'];
														$a4total+=(int)$tab16['cnt'];
                                                    ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	$sql18='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A5" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql18=mysql_query($sql18,connect_server())or die("cannot query attendance".mysql_error());
														$tab18=mysql_fetch_array($rsql18);
                                                     	echo (int)$tab18['cnt'];
														$a5total+=(int)$tab18['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	$sql17='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A6" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql17=mysql_query($sql17,connect_server())or die("cannot query attendance".mysql_error());
														$tab17=mysql_fetch_array($rsql17);
                                                     	echo (int)$tab17['cnt'];
														$a6total+=(int)$tab17['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php
                                                        $sql19='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A7" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql19=mysql_query($sql19,connect_server())or die("cannot query attendance".mysql_error());
														$tab19=mysql_fetch_array($rsql19);
                                                     	echo (int)$tab19['cnt'];
														$a7total+=(int)$tab19['cnt'];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php
														$sql20='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A9" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql20=mysql_query($sql20,connect_server())or die("cannot query attendance".mysql_error());
														$tab20=mysql_fetch_array($rsql20);
                                                     	echo (int)$tab20['cnt'];
														$a9total+=(int)$tab20['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql21='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A11" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql21=mysql_query($sql21,connect_server())or die("cannot query attendance".mysql_error());
														$tab21=mysql_fetch_array($rsql21);
                                                     	echo (int)$tab21['cnt'];
														$a11total+=(int)$tab21['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php
                                                       $sql22='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A12" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql22=mysql_query($sql22,connect_server())or die("cannot query attendance".mysql_error());
														$tab22=mysql_fetch_array($rsql22);
                                                     	echo (int)$tab22['cnt'];
														$a12total+=(int)$tab22['cnt'];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php
													 	$sql23='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A16" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql23=mysql_query($sql23,connect_server())or die("cannot query attendance".mysql_error());
														$tab23=mysql_fetch_array($rsql23);
                                                     	echo (int)$tab23['cnt'];
														$a16total+=(int)$tab23['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql24='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A17" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql24=mysql_query($sql24,connect_server())or die("cannot query attendance".mysql_error());
														$tab24=mysql_fetch_array($rsql24);
                                                     	echo (int)$tab24['cnt'];
														$a17total+=(int)$tab24['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php
														$sql25='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A18" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql25=mysql_query($sql25,connect_server())or die("cannot query attendance".mysql_error());
														$tab25=mysql_fetch_array($rsql25);
                                                     	echo (int)$tab25['cnt'];
														$a18total+=(int)$tab25['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql26='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A19" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql26=mysql_query($sql26,connect_server())or die("cannot query attendance".mysql_error());
														$tab26=mysql_fetch_array($rsql26);
                                                     	echo (int)$tab26['cnt'];
														$a19total+=(int)$tab26['cnt'];
													?>
                                                </td>
                                                <td align="center" >
													<?php
													 	$sql27='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A20" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql27=mysql_query($sql27,connect_server())or die("cannot query attendance".mysql_error());
														$tab27=mysql_fetch_array($rsql27);
                                                     	echo (int)$tab27['cnt'];
														$a20total+=(int)$tab27['cnt'];
													 ?>
                                                </td>
                                                <td align="center" >
													<?php
                                                        $sql28='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "A21" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1)and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql28=mysql_query($sql28,connect_server())or die("cannot query attendance".mysql_error());
														$tab28=mysql_fetch_array($rsql28);
                                                     	echo (int)$tab28['cnt'];
														$a21total+=(int)$tab28['cnt'];
                                                     ?>
                                                </td>
                                                <td align="center" >
													<?php 
														$sql29='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "NC" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1) and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql29=mysql_query($sql29,connect_server())or die("cannot query attendance".mysql_error());
														$tab29=mysql_fetch_array($rsql29);
														$sql29b='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and (remark = "" or remark is null) and (v8am = 0 and v10am = 0 and v12pm = 0 and v2pm = 0) and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql29b=mysql_query($sql29b,connect_server())or die("cannot query attendance".mysql_error());
														$tab29b=mysql_fetch_array($rsql29b);
														$sql29c='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'"  and  staffid in (select staffid from profile where directorate ="'.$tab3['directorate'].'" )';
														$rsql29c=mysql_query($sql29c,connect_server())or die("cannot query attendance".mysql_error());
														$tab29c=mysql_fetch_array($rsql29c);
														$sql29d='select (count(*)*'.$tdsum.')'.' as cnt from profile where directorate ="'.$tab3['directorate'].'"';
														//echo $sql6;
														$rsql29d=mysql_query($sql29d,connect_server())or die("cannot query attendance".mysql_error());
														$tab29d=mysql_fetch_array($rsql29d);
                                                     	$tab29sum= (int)$tab29['cnt'] + (int)$tab29b['cnt'] + ((int)$tab29d['cnt'] - (int)$tab29c['cnt']);
														echo $tab29sum;
														$nctotal+=(int)$tab29sum;
													?>
                                                </td>
                                                <td>&nbsp;</td>
                                                <td align="center" ><?php  echo (int)$tab11['cnt']+(int)$tab12['cnt']+(int)$tab13['cnt'];?></td>
                                                <td align="center" ><?php  echo (int)$tab14['cnt']+(int)$tab15['cnt']+(int)$tab16['cnt']+(int)$tab17['cnt']+(int)$tab18['cnt']+(int)$tab19['cnt']+(int)$tab20['cnt']+(int)$tab21['cnt'];?></td>
                                                <td align="center" ><?php  echo (int)$tab22['cnt'];?></td>
                                                <td align="center" ><?php  echo (int)$tab23['cnt']+(int)$tab24['cnt']+(int)$tab25['cnt']+(int)$tab26['cnt']+(int)$tab27['cnt'];?></td>
                                                <td align="center" ><?php  echo (int)$tab28['cnt'];?></td>
                                                <td align="center" ><?php  echo (int)$tab29sum;?></td>
                                                
										  </tr><?php
									}?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td width="26"  align="center"><strong><?php echo $ptotal;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $atotal;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p1total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p2total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p3total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p4total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $p5total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $allptotal;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a1total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a8total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a10total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a2total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a3total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a4total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a5total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a6total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a7total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a9total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a11total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a12total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a16total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a17total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a18total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a19total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a20total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $a21total;?></strong></td>
                                        <td width="26"  align="center"><strong><?php echo $nctotal;?></strong></td>
                                        <td>&nbsp;</td>
                                        <td align="center" ><strong><?php echo $medical=$a1total+$a8total+$a10total; ?></strong></td>
                                        <td align="center" ><strong><?php echo $leave=$a2total+$a3total+$a4total+$a5total+$a6total+$a7total+$a9total+$a11total; ?></strong></td>
                                        <td align="center" ><strong><?php echo $other=$a12total ; ?></strong></td>
                                        <td align="center" ><strong><?php echo $academic=$a16total+$a17total+$a18total+$a19total+$a20total; ?></strong></td>
                                        <td align="center" ><strong><?php echo $routine=$a21total ; ?></strong></td>
                                        <td align="center" ><strong><?php echo $absent=$nctotal ; ?></strong></td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td>
                            	<?php
									 echo $msg;
									if($_REQUEST['mode']=='pie')
									{
										// gen pie chart
										$a=$_REQUEST['piemode'];
										//echo  pickitems($a);
										$itemval=explode(',',pickitem_values($a));
										for($i=0;$i<count($itemval);$i++)
										{
											$chk+=$itemval[$i];
										}
										if($chk==0)
										{
											echo '<strong>Chart not available</strong>' ;
										}else
										{?>
											<iframe  src="hpiechart/piechart1.php?pitems=<?php echo  pickitems($a)?>&abbritems=<?php echo  abbritems($a)?>&pvalues=<?php echo  pickitem_values($a)?>&ptitle=<?php echo  titleofchart($a)?>" height="400px" width="800px"  frameborder="0" scrolling="no" name="piec" id="piec" >ok </iframe><!--src="hpiechart/piechart.php"-->

										<?php
										}
										//echo pickitems($a);
										//echo pickitem_values($a);
										//findpie(pickitems($a),pickitem_values($a),titleofchart($a));
									}elseif($_REQUEST['mode']=='bar')
									{
										$a=$_REQUEST['piemode'];
										$itemval=explode(',',pickitem_values($a));
										for($i=0;$i<count($itemval);$i++)
										{
											$chk+=$itemval[$i];
										}
										if($chk==0)
										{
											echo '<strong>Chart not available</strong>';
										}else
										{?>
                                            <table cellspacing="0" cellpadding="2">
                                              <tr>
                                                <td align="center"><font size="+1"><?php echo strtoupper(titleofchart($a));?></font> </td>
                                              </tr>
                                              <tr>
                                                <td valign="top" >
                                                    <iframe  src="bar.php?pitems=<?php echo  pickitems($a)?>&abbritems=<?php echo  abbritems($a)?>&pvalues=<?php echo  pickitem_values($a)?>&ptitle=<?php echo  titleofchart($a)?>" height="400px" width="400px"  frameborder="0" scrolling="no" name="piec" id="piec" >ok </iframe>
                                                </td>
                                                <td valign="top" align="left">
                                                    <table border="1" cellspacing="0" cellpadding="2">
                                                      <tr>
                                                        <td colspan="2"><strong>Legends</strong></td>
                                                      </tr>
                                                      
                                                        <?php
                                                            $pfullnam=explode(',',pickitems($a));
                                                            $itemnam=explode(',',abbritems($a));
                                                            $itemval=explode(',',pickitem_values($a));
                                                            for($i=0;$i<count($itemnam);$i++)
                                                            {
                                                                $itemnam[$i]=strtoupper($itemnam[$i]);
                                                            }
                                                            for($i=0;$i<count($pfullnam);$i++)
                                                            {
                                                            ?><tr>
                                                                <td><?php echo strtoupper($itemnam[$i])?></td>
                                                                <td><?php echo ucwords(strtolower($pfullnam[$i]))?></td>
                                                               </tr><?php
                                                            }?>
                                                      
                                                    </table>
                                        
                                                </td>
                                              </tr>
                                            </table>
										<!--src="hpiechart/piechart.php"-->
										<?php
										}
									}
								?>
                            </td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>

						<?php
					}
				?>
            
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<?php
			function pickitem_values($a)
			{
				switch($a)
				{
					CASE 1:$str=$GLOBALS['allptotal'].','.$GLOBALS['atotal'];//
						break;
					CASE 2:$str=$GLOBALS['a1total'].','.$GLOBALS['a8total'].','.$GLOBALS['a10total'];//
						break;
					CASE 3:$str=$GLOBALS['ptotal'].','.$GLOBALS['allptotal']-$GLOBALS['ptotal'];//
						break;
					CASE 4:$str=$GLOBALS['p1total'].','.$GLOBALS['p2total'].','.$GLOBALS['p3total'].','.$GLOBALS['p4total'].','.$GLOBALS['p5total'];//
						break;
					CASE 5:$str=$GLOBALS['medical'].','.$GLOBALS['leave'].','.$GLOBALS['other'].','.$GLOBALS['academic'].','.$GLOBALS['routine'].','.$GLOBALS['absent'];//
						break;     
					CASE 6:$str=$GLOBALS['a16total'].','.$GLOBALS['a17total'].','.$GLOBALS['a18total'].','.$GLOBALS['a19total'].','.$GLOBALS['a20total'];//
						break;
					CASE 7:$str=$GLOBALS['atotal']-$GLOBALS['nctotal'].','.$GLOBALS['nctotal'];//
						break;
					CASE 8:$str=$GLOBALS['a2total'].','.$GLOBALS['a3total'].','.$GLOBALS['a4total'].','.$GLOBALS['a5total'].','.$GLOBALS['a6total'].','.$GLOBALS['a7total'].','.$GLOBALS['a9total'].','.$GLOBALS['a11total'];//
						break;
				}
				return $str;
			}
			function abbritems($a)
			{
				switch($a)
				{
					CASE 1:$str='pre'.','.'abs';//
						break;
					CASE 2:$str='ante'.','.'med'.','.'sick';//
						break;
					CASE 3:$str='full'.','.'part';//
						break;
					CASE 4:$str='clo'.','.'Nur'.','.'Exi'.','.'Late'.','.'Inc';//
						break;
					CASE 5:$str='Med'.','.'Leave'.','.'others'.','.'acad'.','.'ROUT'.','.'abs';//
						break;     
					CASE 6:$str='SWC'.','.'CMW'.','.'CCM'.','.'RM'.','.'DDH';//
						break;
					CASE 7:$str='ABR'.','.'ABW';//
						break;
					CASE 8:$str='ANNF'.','.'ANNP'.','.'CAS'.','.'EXAM'.','.'LOA'.','.'MAT'.','.'SAB'.','.'STUDY';//
						break;
				}
				return $str;
			}
			function pickitems($a)
			{
				switch($a)
				{
					CASE 1:$str='present'.','.'absent';//
						break;
					CASE 2:$str='ante-natal'.','.'medical'.','.'sickness';//
						break;
					CASE 3:$str='fully present'.','.'partially present';//
						break;
					CASE 4:$str='closing before time'.','.'Nursing mother'.','.'Exigency'.','.'Late / not signing 1st or 2nd session'.','.'Inconsistent Signing';//
						break;
					CASE 5:$str='Medical'.','.'Leave'.','.'others'.','.'academic'.','.'ROUTINE DUTIES OUTSIDE HQ'.','.'absent';//
						break;     
					CASE 6:$str='Semr/Wshp/Conf'.','.'To meet course material writers'.','.'To collect course materials'.','.'Research mission'.','.'Dean / Dir/HOUs errand';//
						break;
					CASE 7:$str='absent with reasons'.','.'absent without reasons';//
						break;
					CASE 8:$str='ANNUAL (FULL)'.','.'ANNUAL (PART)'.','.'CASUAL / COMPASSIONATE'.','.'EXAM'.','.'LEAVE OF ABSENCE'.','.'MAT / PAT'.','.'SABBATICAL'.','.'STUDY';//
						break;
				}
				return $str;
			}
			function titleofchart($a)
			{
				$sql='select reportdesc from report_type where rid ="'.$a.'"';
				$rsql=mysql_query($sql,connect_server())or die("cannot query report_type".mysql_error());
				$tab=mysql_fetch_array($rsql);
				return $tab['reportdesc'];
				
			}
		?>
    </form>
</body>
</html>