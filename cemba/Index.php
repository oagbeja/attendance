
<?php 
require_once('includes/enc_dec.php');
require_once('includes/local_lib.php');
require_once('includes/env_set.php');
connect_server();
//$user_cmat = mysql_real_escape_string($_POST['cmatno']);

$num = 0;
if (isset($_REQUEST['Login']))
{
	$sql = "SELECT * FROM admited WHERE 
	cmatno = '".$_REQUEST['cmatno']."' AND 
	ref = '".$_REQUEST['ref']."'"; 
			
	$result = mysql_query($sql) or die (mysql_error()); 
	$num = mysql_num_rows($result);
}

//if (isset($_REQUEST['Login']) && isset($_REQUEST['cmatno']) && $_REQUEST['cmatno'] <> '' && isset($_REQUEST['ref']) && $_REQUEST['ref'] <> '')
//{
//$ref = $_POST['ref'];


  if ($num > 0) 
	{  
	  //require_once('form.php');?>
	   <script language="JavaScript" type="text/javascript">
      location.href='http://localhost/cemba/form.php'
       </script>
	   <?php

	   
	   /*session_start(); 
	   list($cmatno,$ref) = mysql_fetch_row($result);
		
		$_SESSION['cmatno']= $cmatno;  
		
		if (isset($_GET['cmatno']) && !empty($_GET['cmatno']))
		{
		header("Location:form.php");
		}
		//echo "Logged in...";
		exit();*/
    }else if (isset($_REQUEST['Login']))
	{
		require_once('cemval.php');
		echo ' <table width="750" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
    <tr>
      <td colspan="3"><hr  color="#006600"/></td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    <tr>
     <td width="78" bgcolor="#FFFFFF"><img src="images/col_logo.gif" width="70" height="88" />
   <div align="center"></div></td>
      <td width="567" bgcolor="#FFFFFF"><div align="center">
        <p><strong>REGISTRATION/ADMISSION <br />
          <br />
        </strong><strong><em>for<br />
        <br />
          </em>THE COMMONWEALTH EXECUTIVE  PROGRAMME (CEMBA/CEMPA&nbsp;)&nbsp;&nbsp;</strong>
  &nbsp;        </p>
        </div></td>
      <td width="85"><img src="images/noun_logo.jpg" width="93" height="91" /></td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"/>
        <p><br /><h3 >please check your CMAT NUMBER  and REF NUMBER </h3><h3><a href="index.php?conf=1"> Click here to Try again</a></h3>
        </p>
        </td>
            </tr>
        </table>
        <p align="center">&nbsp;</p>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" background="images/noun_ocl_r5_c1.gif"><hr  color="#006633"/></td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#279654"><div align="center" class="style16">&copy;2010 E-Learning Unit National Open University of Nigeria </div></td>
    </tr>
  </table>';exit;
	//}

//header("Location: index.php?msg=Invalid cmatno or refrence");
//echo "Error:";
//exit();		
}

?>
<?php if (isset($_GET['msg'])) { echo "<div class=\"msg\"> $_GET[msg] </div>"; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NOUN ::.CEMBA/CEMPA ONLINE REGISTRATION .::</title>
<style type="text/css">
<!--  
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bg_colbate.png); 
	background-attachment:fixed;
	}
#Layer1 {
	text-align: left; /* counter the body center */
	width:188px;
	height:auto;
	z-index:1;
	visibility: inherit;
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
	}
#Layer2 {
	width:750px;
	height:46px;
	z-index:1;
	background-image: url(images/acde-page_r19_c7.gif);
	position: inherit;
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
a:link {
	color: #000099;
	text-decoration: none;
}
a:visited {
	color: #000099;
	text-decoration: none;
}
a:hover {
	color: #000099;
	text-decoration: underline;
}
a:active {
	color: #000099;
	text-decoration: none;
}


<style>
<!--
.styling{
background-color:white;
color:green;
font: bold 18px MS Sans Serif;
padding: 3px;
}
.style16 {font-size: 9px}
-->
</style>
<link href="images/login.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
@import url("images/cemba.css");
-->
</style>
</head>

<body>
<div id="Layer1" style="border: 1px black solid; width:750px;">
<form method="post" name="cemba" enctype="multipart/form-data" onsubmit= "return validate()">
  <table width="750" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
    <tr>
      <td colspan="3"><hr  color="#006600"/></td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    

    <tr>
      <td width="78" bgcolor="#FFFFFF"><img src="images/col_logo.gif" width="70" height="88" />
   

      <div align="center"></div></td>
      <td width="567" bgcolor="#FFFFFF"><div align="center">
        <p><strong>REGISTRATION/ADMISSION <br />
          <br />
        </strong><strong><em>for<br />
        <br />
          </em>THE COMMONWEALTH EXECUTIVE  PROGRAMME (CEMBA/CEMPA&nbsp;)&nbsp;&nbsp;</strong>
  &nbsp;        </p>
        </div></td>
      <td width="85"><img src="images/noun_logo.jpg" width="93" height="91" /></td>
    </tr>
    
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"  />
        <p><strong>Instructions </strong>:</p>
        <ul><li>You must have printed your Admission letter. </li>
          <li>You must have paid the recommended fee.</li>
            <li>You 
          must have recieved your CMAT NO. and Reference No. </li>
          <li>Logon using the CMAT NO.  and Reference No.
          to complete your registration form and submit online.</li>
          <li>Preview and print out the completed form and attach three (3) recent passport photographs. </li>
          <li>Submit the printed form at your Study Centre
        to collect your course materials.</li>
        <li>Alternatively <a href="index12.php">click here to Download your course materials</a></li> 
        </ul><br>
        </p>
        <table width="94%" border="1" align="center" bordercolor="#003300">
          <tr>
            <td colspan="3"><table width="90%" border="0" align="center" >
              <tr>
                <td width="6%">&nbsp;</td>
                <td width="25%">&nbsp;</td>
                <td width="69%">&nbsp;</td>
              </tr>
              <tr>
                <td><p> </p></td>
                <td><div align="right">CMAT FORM NUMBER </div></td>
                <td><label>
                  <input name="cmatno" type="text" size="20" maxlength="20" />
                  eg. CMAT00480 </label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="right">REFERENCE NUMBER </div></td>
                <td><input name="ref" type="password" size="20" maxlength="20" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><label>
                  <input type="submit" name="Login" value="Login" />
                </label></td>
              </tr>
            </table></td>
            </tr>
        </table>
        <p align="center">&nbsp;</p>
        <p>&nbsp;</p>
        <br />
        <p align="center">&nbsp;</p></td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" background="images/noun_ocl_r5_c1.gif"><hr  color="#006633"/></td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#279654"><div align="center" class="style16">&copy;2010 E-Learning Unit National Open University of Nigeria </div></td>
    </tr>
  </table>
</form>
</div>
</body>
</html>