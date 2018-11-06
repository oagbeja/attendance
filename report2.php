<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Absentee Report</title>
</head>

<body>
	<?php 
		
		include('connection.php');
		include('fn.php');
		if($_REQUEST['id']==''){$msg='<font color="#FF6699"><strong>You need to logout and login again</strong></font><br/> ';}
	?>
    <form action="" method="post" name="frm">
    	
	<?php
            $P=array();$comm=array();
            if ($_REQUEST['and']==1)
			{
				$_REQUEST['directorate']=str_replace('aand','&',$_REQUEST['directorate']);	
			}
			?>
      <table border="1" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo $msg;?>
                    <strong>DAILY WORK ATTENDANCE <br/>
                    <?php echo $_REQUEST['directorate']; ?>
                </strong></td>
                <td><strong><?php echo mth($_REQUEST['mnth']).','.$_REQUEST['yr']?></strong></td>
              </tr>
              <tr>
                <td colspan="2" >
                    <table border="1" cellspacing="0" cellpadding="2">
                      <tr>
                        <td><strong>S/n</strong></td>
                        <td nowrap="nowrap" ><strong>Name</strong></td>
                        <td><strong>Designation</strong></td>
                        <td><strong>No. of Absent Days</strong></td>
                      </tr>
                      <?php
                            $sql3=" select * from profile where directorate = '".$_REQUEST['directorate']."' order by remarkrole desc , designation, vname ";
                            $rsql3=mysql_query($sql3,connect_server())or die("cannot query profile".mysql_error());//echo $sql3;
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
									$tdsum=0;
                                    for($i=1;$i<=mthnumdays($_REQUEST['mnth'],$_REQUEST['yr']);$i++)
                                    {
                                        $today = date("D",strtotime($_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i));
                                        if($today<>'Sun'&&$today<>'Sat')
                                        {
                                            ++$tdsum;
                                            //$sql4=" select * from fill_attendance where staffid ='".$tab3['staffid']."' and vdate ='".$_REQUEST['yr']."-".$_REQUEST['mnth']."-".$i."' ";
//                                            $rsql4=mysql_query($sql4,connect_server())or die("cannot query attendance".mysql_error());
//                                            $tab4=mysql_fetch_array($rsql4);
//                                            if($tab4['v8am']==1||$tab4['v10am']==1||$tab4['v12pm']==1||$tab4['v2pm']==1)
//                                            {
//                                                //echo '<td>P</td>'; 
//                                                $P[$tab4['staffid']]+=1;
//                                            }else
//                                            {
//                                                //echo '<td>'.$tab4['remark'].'</td>'; 
//                                                if($tab4['remark']<>'')
//                                                {
//                                                    $comm[$tab4['staffid']][$tab4['remark']]+=1;
//                                                }
//                                                
//                                            }

                                        }
                                        
                                        
                                    }
									
									$sql29='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and remark = "NC" and !(v8am = 1 and v10am = 1 and v12pm = 1 and v2pm = 1) and  staffid ="'.$tab3['staffid'].'"';
									$rsql29=mysql_query($sql29,connect_server())or die("cannot query attendance".mysql_error());
									$tab29=mysql_fetch_array($rsql29);
									$sql29b='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'" and (remark = "" or remark is null) and (v8am = 0 and v10am = 0 and v12pm = 0 and v2pm = 0) and  staffid ="'.$tab3['staffid'].'"';
									$rsql29b=mysql_query($sql29b,connect_server())or die("cannot query attendance".mysql_error());
									$tab29b=mysql_fetch_array($rsql29b);
									$sql29c='select count(*)as cnt from fill_attendance where vdate like "'.$_REQUEST['yr']."-".$_REQUEST['mnth']."%".'"  and  staffid ="'.$tab3['staffid'].'"';
									$rsql29c=mysql_query($sql29c,connect_server())or die("cannot query attendance".mysql_error());
									$tab29c=mysql_fetch_array($rsql29c);
									//$sql29d='select (count(*)*'.$tdsum.')'.' as cnt from profile where directorate ="'.$tab3['directorate'].'" and  staffid ="'.$tab3['staffid'].'"';
									//echo $sql6;
									//$rsql29d=mysql_query($sql29d,connect_server())or die("cannot query attendance".mysql_error());
									//$tab29d=mysql_fetch_array($rsql29d);
									$tab29sum= (int)$tab29['cnt'] + (int)$tab29b['cnt'] + ((int)$tdsum - (int)$tab29c['cnt']);
									//echo $tab29sum;
									
									echo '<td>'.$tab29sum.'</td>';
                                    $nctotal+=(int)$tab29sum;
                                
                                  //  $day=$tdsum;
//                                    $atotal+=(int)$tdsum -(int)$P[$tab3['staffid']];														
//                                    $allptotal+=(int)$P[$tab3['staffid']]+(int)$comm[$tab3['staffid']]["P1"]+(int)$comm[$tab3['staffid']]["P2"]+(int)$comm[$tab3['staffid']]["P3"]+(int)$comm[$tab3['staffid']]["P4"];
//                                    $a1total+=(int)$comm[$tab3['staffid']]["A1"];
//                                    $a8total+=(int)$comm[$tab3['staffid']]["A8"];
//                                    $a10total+=(int)$comm[$tab3['staffid']]["A10"];
//                                    $a2total+=(int)$comm[$tab3['staffid']]["A2"];
//                                    $a3total+=(int)$comm[$tab3['staffid']]["A3"];
//                                    $a4total+=(int)$comm[$tab3['staffid']]["A4"];
//                                    $a5total+=(int)$comm[$tab3['staffid']]["A5"];
//                                    $a6total+=(int)$comm[$tab3['staffid']]["A6"];
//                                    $a7total+=(int)$comm[$tab3['staffid']]["A7"];
//                                    $a9total+=(int)$comm[$tab3['staffid']]["A9"];
//                                    $a11total+=(int)$comm[$tab3['staffid']]["A11"];
//                                    $a12total+=(int)$comm[$tab3['staffid']]["A12"];
//                                    $a16total+=(int)$comm[$tab3['staffid']]["A16"];
//                                    $a17total+=(int)$comm[$tab3['staffid']]["A17"];
//                                    $a18total+=(int)$comm[$tab3['staffid']]["A18"];
//                                    $a19total+=(int)$comm[$tab3['staffid']]["A19"];
//                                    $a20total+=(int)$comm[$tab3['staffid']]["A20"];
//                                    $a21total+=(int)$comm[$tab3['staffid']]["A21"];
//                                    $nctotal+=(int)$comm[$tab3['staffid']]["NC"];
                                   // $result=$tdsum -((int)$P[$tab3['staffid']]+(int)$comm[$tab3['staffid']]["P1"]+(int)$comm[$tab3['staffid']]["P2"]+(int)$comm[$tab3['staffid']]["P3"]+(int)$comm[$tab3['staffid']]["P4"]+
//                                                        (int)$comm[$tab3['staffid']]["A1"]+(int)$comm[$tab3['staffid']]["A8"]+(int)$comm[$tab3['staffid']]["A10"]+(int)$comm[$tab3['staffid']]["A2"]+(int)$comm[$tab3['staffid']]["A3"]+(int)$comm[$tab3['staffid']]["A4"]+
//                                                        (int)$comm[$tab3['staffid']]["A5"]+(int)$comm[$tab3['staffid']]["A6"]+(int)$comm[$tab3['staffid']]["A7"]+(int)$comm[$tab3['staffid']]["A9"]+(int)$comm[$tab3['staffid']]["A11"]+(int)$comm[$tab3['staffid']]["A12"]+
//                                                        (int)$comm[$tab3['staffid']]["A16"]+(int)$comm[$tab3['staffid']]["A17"]+(int)$comm[$tab3['staffid']]["A18"]+(int)$comm[$tab3['staffid']]["A19"]+(int)$comm[$tab3['staffid']]["A20"]+(int)$comm[$tab3['staffid']]["A21"]);	
//                                    echo '<td>'.$result.'</td>';
                        }
                        
                        ?>
                        </tr>
                    </table>

                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>

    </form>
</body>
</html>