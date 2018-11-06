<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<form action="" name="frm" method="post">
    <?php if($_REQUEST['id']==''){$msg='<font color="#FF6699"><strong>You need to logout and login again</strong></font><br/> ';} ?>
	<table border="1" cellspacing="2" cellpadding="2" align="center">
      <tr>
        <td colspan="2" align="center"><?php echo $msg;?><strong>Alert Tones</strong></td>
      </tr>
      <?php 
	  include ('connection.php');
	  
	  $sql="select * from profile where id ='".$_REQUEST['id']."' ";
	  $rsql=mysql_query($sql,connect_server())or die("cannot query profile".mysql_error());
	  $tab=mysql_fetch_array($rsql);
	  if($_REQUEST['RadioGroup1']=='')
	  {
		 $_REQUEST['RadioGroup1']=$tab['alert']; 
	  }else
	  {
		 $sqlu='UPDATE profile SET alert="'.$_REQUEST['RadioGroup1'].'" where id="'.$_REQUEST['id'].'"'; //echo $sql;
		 $rsqlu=mysql_query($sqlu, connect_server())or die("Unable to update ".mysql_error()); 
	  }
	  $alert=' <embed src="alert/'.$_REQUEST['RadioGroup1'].'.mp3" width="1" height="1" autostart="true" ></embed>';
	  echo $alert;
	  for($i=1;$i<=5;$i++)
	  { ?>
          <tr>
            <td>
            	<input type="radio" name="RadioGroup1" value="<?php echo $i;?>" id="RadioGroup1_<?php echo $i;?>" onclick="frm.submit()" <?php if($_REQUEST['RadioGroup1']==$i){echo 'checked';}?>  />
            </td>
            <td>
            	Alert <?php echo $i;?>
            </td>
          </tr>
	  <?php
	  }?>
      <tr>
        <td>
            <input type="radio" name="RadioGroup1" value="def" id="RadioGroup1_def"  onclick="frm.submit()" <?php if($_REQUEST['RadioGroup1']=='def'){echo 'checked';}?>  />
        </td>
        <td>
            Default
        </td>
      </tr>
    </table>
  </form>

</body>
</html>