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
<body onload="MM_preloadImages('images/fill _r2_c2_f2.jpg','images/make remarks_f2.jpg','images/generate_f2.jpg','images/change_f2.jpg')">
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
				case 4:dis.window.location="chgalert.php";
					break;
				case 5:dis.window.location="edit.php";
					break;
			}
		}
		
	</script>
	<?php 
		
		include('connection.php');
		$sql="select * from profile where id ='".$_REQUEST['id']."' ";
		$rsql=mysql_query($sql,connect_server())or die("cannot query profile".mysql_error());
		$tab=mysql_fetch_array($rsql);
		$today=getdate();
	?><div id="Layer1"  align="left" style="border: 1px black solid; width:1210px;">
	<table width="1209" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
      <tr bgcolor="#FFFFFF">
      	<td bgcolor="#FFFFFF" colspan="2">
   	    <table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
              <tr bgcolor="#FFFFFF">
                 <td colspan="2"><img src="images/servicom.png" width="1200" height="150" /></td>
             </tr>
              <tr bgcolor="#AEF18D">
                <td>  
                    <strong>Welcome</strong> <?php echo $tab['title']." ".$tab['vname']."( ".$tab['designation']." )    " ?>
                    <strong>Directorate :</strong><?php echo $tab['directorate'] ; ?>
                    <?php echo '       <b>Today :</b> '.$today['mday'].'/'.$today['mon'].'/'.$today['year'];$cnt=0; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <a href="changepass.php" style="text-decoration:none" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#000'">Change Password</a>
                   <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td align="right" valign="top"><a href="logout.php" style="text-decoration:none" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#000'">Log Out</a></td>
              </tr>
          </table>
        </td>
      <tr>
        <td width="152" valign="top">
        	<table border="0" cellspacing="0" cellpadding="2" bgcolor="#FFFFFF">
              <tr bgcolor="#FFFFFF">
                <td><a href="javascript:pickframe(1)"  onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('fill','','images/fill _r2_c2_f2.jpg',1)"><img src="images/fill _r2_c2.jpg" name="fill" width="158" height="22" border="0" id="fill" /></a></td>
              </tr>
              <?php
			  	if($tab['remarkrole']=='1')
				{ 
			  ?>
                  <tr>
                    <td><a href="javascript:pickframe(2)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('make daily','','images/make remarks_f2.jpg',1)"><img src="images/make remarks.jpg" name="make daily" width="160" height="26" border="0" id="make daily" /></a></td>
                  </tr><?php
                }
				if(strtolower($tab['directorate'])=='servicom' )
				{ ?>
                  <tr>
                    <td><a href="javascript:pickframe(3)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('generate','','images/generate_f2.jpg',1)"><img src="images/generate.jpg" name="generate" width="160" height="26" border="0" id="generate" /></a></td>
                  </tr><?php
                }
                if(strtolower($tab['staffid'])=='01246' )
				{ ?>
                  <tr>
                    <td><a href="javascript:pickframe(5)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('editprofile','','images/editprofile1.png',1)"><img src="images/editprofile.png" name="editprofile" width="160" height="26" border="0" id="editprofile" /></a></td>
                  </tr><?php
                }?>
                 <tr>
                <td height="30"><a href="javascript:pickframe(4)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('alert','','images/change_f2.jpg',1)"><img src="images/change.jpg" name="alert" width="160" height="26" border="0" id="alert" /></a></td>
              </tr>
            </table>

        </td>
        <td width="1049">
        	<table border="0" cellspacing="0" cellpadding="2"  bgcolor="#FFFFFF">
              <tr>
                <td width="1000" bgcolor="#FFFFFF">
               	     <iframe   height="500px" width="1000px"  frameborder="1" name="dis" scrolling="auto" >ok </iframe>
                     <iframe   height="0px" width="0px"  frameborder="0" name="dis2" scrolling="no" src="alrt.php" >ok </iframe>
                </td>
              </tr>
          </table>
        </td>
      </tr>
    </table>
</div>
</body>
</html>