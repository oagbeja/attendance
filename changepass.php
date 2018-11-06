<?php include('reindex.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="icon" href="favicon.ico" sizes="32x32" />
<title>Attendance Register</title>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="attendance/images/css.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bg.png);
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
#Layer1 table tr td table {
	font-weight: bold;
}

-->
</style>
<body onload="MM_preloadImages('images/fill _r2_c2_f2.jpg','images/make remarks_f2.jpg','images/generate_f2.jpg')">
<div id="Layer1"  align="left" style="border: 1px black solid; width:1210px;">
	<table width="1209" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
      <tr bgcolor="#FFFFFF">
      	<td bgcolor="#FFFFFF">
   	    <table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
              <tr bgcolor="#FFFFFF">
                 <td colspan="2"><img src="images/servicom.png" width="1200" height="150" /></td>
             </tr>
              <tr bgcolor="#AEF18D">
                <td>&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
              </tr>
          </table>
        </td>
      <tr>
        <td valign="top" align="center"><p><?php
	include ('connection.php');
	include ('encrypt.php');
	$sql = 'select vpassword from profile where id="'.$_REQUEST['id'].'"';// echo $result; 
	$rsql=mysql_query($sql, connect_server())or die("Unable to query ".mysql_error());
	$tab=mysql_fetch_array($rsql);
	$sql1 = 'select * from secrettab';
	$rsql1=mysql_query($sql1, connect_server())or die("Unable to query ".mysql_error()); //echo $sql1;
	if (isset($_REQUEST['sub2']))
	{ 	
		if(trim($_REQUEST['vpassword'])=='')
		{
			$errormsg.= 'Enter your old password <br/>';
			$error=1;
		}
		elseif(ecrypt(trim($_REQUEST['vpassword'])) != $tab['vpassword'])
		{
			$errormsg.= 'Wrong password <br/>';
			$error=1;
		}
		elseif(trim($_REQUEST['newpassword'])!= trim($_REQUEST['confirmnewpassword']))
		{
			$errormsg.= "The new password and confirm new password fields must be the same <br/>";
			$error=1;
		}
		elseif (strlen(trim($_REQUEST['newpassword']))<6)
		{
			$errormsg.= 'Password too short(password must not be less than 6) <br/>' ;
			$error=1;
		}
		if(trim($_REQUEST['security'])=='')
		{
			$errormsg.= 'Select a security question <br/>' ;
			$error=1;
		}
		if(trim($_REQUEST['securityans'])=='')
		{
			$errormsg.= 'Enter your security answer <br/>' ;
			$error=1;
		}
		if($error<>1)
		{// work still to be done here 
			$sqlu='UPDATE profile SET vpassword="'.ecrypt(trim($_REQUEST['newpassword'])).'", sid="'.$_REQUEST['security'].'", sanswer="'.$_REQUEST['securityans'].'" , chgpwd = "Y" where id="'.$_REQUEST['id'].'"'; //echo $sql;
			$rsqlu=mysql_query($sqlu, connect_server())or die("Unable to query ".mysql_error());
			$succmsg.= 'Congratulations You have successfully changed your password <br/> <a href="index.php"> <input name="but" type="button" value="Log In" /></a>';
		}
	}
	?></p>
       <p>&nbsp;</p>
       <p><table border="1" align="center" background="attendance/images/bg.png">
         <tr>
           <td width="258"  align="center">
             Change Your Password
            </td>
           <td width="205" align="right">
             <a href="index.php" style="text-decoration:none" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#000'">Log in </a>
            </td>
          </tr><?php
          if($errormsg<>'')
			{?>
			   <tr>
				<td colspan="2" bgcolor="#993366" align="center">
					<!--<P colspan="3" align="center" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"/>
					<br /><h3 ></h3></p>-->
					<font size="+2"><?php echo $errormsg;?> </font>
				</td>
			  </tr><?php
			}elseif($succmsg<>'')
			{?>
            	<tr>
				<td colspan="2" bgcolor="#0066FF" align="center">
					<!--<P colspan="3" align="center" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"/>
					<br /><h3 ></h3></p>-->
					<font size="-1" ><?php echo $succmsg;?> </font>
				</td>
			  </tr>
            <?php
			}?>
         <tr>
           <td colspan="2">
             <form method="post" action=""/>
             <table border="0" align="center" >
               <tr>
                 <td width="176">Old Password</td>
                 <td width="5">:</td>
                 <td width="296"><input type="password" name="vpassword" size="50"></td>
                </tr>
               <tr>
                 <td>New Password</td>
                 <td>:</td>
                 <td><input type="password" name="newpassword" size="50"></td>
                </tr>
               <tr>
                 <td>Confirm Password</td>
                 <td>:</td>
                 <td><input type="password" name="confirmnewpassword" size="50"></td>
                </tr>
               <tr>  
                 <?php
                $sql1 = 'select * from secrettab';
                $rsql1=mysql_query($sql1, connect_server())or die("Unable to query ".mysql_error());?>
                 
                 <td>Select a security question</td>
                 <td>:</td>
                 <td>
                   <select name="security"> 
                     
                     <option value="" > </option>
                     <?php
							while($tab1=mysql_fetch_array($rsql1))
							{?>
                     <option value="<?php echo $tab1['sid']?>" <?php if($_REQUEST['security']==$tab1['sid']){echo 'selected';} ?> >
					 	<?php echo $tab1['vSecretQuestion']?> 
                     </option>
                     <?php
							}
						?>
                    </select>
                  </td>
                </tr>
               <tr>
                 <td>Answer to security question</td>
                 <td>:</td>
                 <td><input type="text" name="securityans"  size="50" value="<?php echo $_REQUEST['securityans']?>"></td>
                </tr>
               <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td><input type="submit" value="Change Password" name="sub2"></td>
                </tr>
               
              </table>
             </form>
            </td>
          </tr>
</table></p>
       <p>&nbsp;</p>
       <p>&nbsp;</p>
       <p>&nbsp;</p></td>
      </tr>
    </table>
</div>
</body>
</html>