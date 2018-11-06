<?php
	$_REQUEST['id']='0';
	include ('connection.php');
	include ('encrypt.php');
	$error=0;
	if (isset($_REQUEST['sub']))
	{ 
		if(trim($_REQUEST['staffid'])=='')
		{
			$errormsg.= 'ENTER YOUR STAFF ID <br/>' ;  
			$error=1;
		}
		if(preg_match ("/[^0-9]/",$_REQUEST['staffid']))
		{
			$errormsg.= 'NOT A VALID STAFF ID<br/>';
			$error=1;
		}
		if(trim($_REQUEST['vpassword'])=='')
		{
			$errormsg.= 'ENTER YOUR PASSWORD <br/>' ;
			$error=1;
		}
		
					
		if ($error<>1)
		{
			$sql='select * from profile where staffid = "'.$_REQUEST['staffid'].'" and  vpassword="'.ecrypt(trim($_REQUEST['vpassword'])).'"';//echo $sql;
			$rsql=mysql_query($sql,connect_server())or die("Unable to query ".mysql_error());
			if(mysql_num_rows($rsql)==0)
			{
				$errormsg.='Wrong username or password';
			}else
			{
				$tab=mysql_fetch_array($rsql);
				$update='update profile set ucount="'.++$tab['ucount'].'" where staffid = "'.$_REQUEST['staffid'].'"';
				$rupdate=mysql_query($update, connect_server())or die("Unable to query ".mysql_error());
				if($tab['chgpwd']=='N')
				{
					setcookie(id,$tab["id"]);
					header('Location: changepass.php');
					// goto change password
				}else
				{
					setcookie(id,$tab["id"]);
					header('Location: mian.php');
					//goto fill register
				
				}
			}
			
	
		}
	}
	?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance Register</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="icon" href="favicon.ico" sizes="32x32" />
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

-->
</style>
<body onload="MM_preloadImages('images/fill _r2_c2_f2.jpg','images/make remarks_f2.jpg','images/generate_f2.jpg')">
<script  language="javascript" type="text/javascript">
		function pickframe(a)
		{
			switch(a)
			{
				case 1:dis.window.location="fill.php";
					break;
				case 2:dis.window.location="remark.php";
					break;
				case 3:dis.window.location="report1.php";
					break;
			}
		}
		
	</script>
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
        <td valign="top"><form  name="loginform" method="post" >	
          
          <table border="1" align="center" background="images/bg.png">
            <tr>
              <td width="508" height="215">	
                <table border="0" align="center">
                <?php 
				if($errormsg<>'')
				{?>
                   <tr>
                    <td colspan="4" bgcolor="#993366" align="center">
                    	<!--<P colspan="3" align="center" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"/>
          				<br /><h3 ></h3></p>-->
						<font size="+2"><?php echo $errormsg;?> </font>
                    </td>
                  </tr><?php
				}?>
                  <tr>
                    <td colspan="2">Enter your Staff id</td>
                    <td width="5">:</td>
                    <td width="213"><input name="staffid" type="text" size="50%" value="<?php echo $_REQUEST['staffid']?>"   /></td>
                  </tr>
                  <tr>
                    <td colspan="2">Enter Password</td>
                    <td>:</td>
                    <td><input name="vpassword" type="password" size="50%"  /></td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    <td><input name="sub" type="submit" value="Login" align="right" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    <td><a href="forgtpass.php" title="forgot_password" target="_parent"> <em>forgot your password</em></a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
            <td align="right"><font color="#0033CC"  size="-1" ><em><strong>Developed by NOUN ICT</strong></em></font></td>
          </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </form></td>
      </tr>
    </table>
</div>
</body>
</html>