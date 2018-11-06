<?php
if (isset($_REQUEST['sbmt2']))
{
	$sqlcemba_rec = "DELETE FROM cemba_rec
	WHERE cfmno = '".$_REQUEST['cfmno']."'";
	
	//echo $sqlcemba_rec.'<p>';
	if (!@mysql_query($sqlcemba_rec))
	{die('Error deleting cemba_rec record ' . mysql_error());}
	
	$sqlcemba_rec = "INSERT INTO cemba_rec SET
	cfmno = '".$_REQUEST['cfmno']."',
	vtitle = '".$_REQUEST['vtitle']."',
	vs_name = '".strtoupper(addslashes(trim($_REQUEST['vs_name'])))."',
	vm_name = '".ucwords(strtolower(trim($_REQUEST['vm_name'])))."',
	vo_name = '".ucwords(strtolower(trim($_REQUEST['vo_name'])))."',
	v_address = '".ucwords(strtolower(trim($_REQUEST['v_address'])))."',
	v_town = '".ucwords(strtolower(trim($_REQUEST['v_town'])))."', 
	v_lga= '".$_REQUEST['v_lga']."',
    v_state = '".$_REQUEST['v_state']."',
    v_country = '".$_REQUEST['v_country']."',
    d_o_b = '".formatdate($_REQUEST['d_o_b'],'todb')."',
    d_o_s = '".formatdate($_REQUEST['d_o_s'],'todb')."',
	v_sex = '".$_REQUEST['v_sex']."',
	v_status = '".$_REQUEST['v_status']."',
     expereince = '".$_REQUEST['expereince']."',
	 v_national = '".$_REQUEST['v_national']."',
     v_employment = '".$_REQUEST['v_employment']."',
     centre='".$_REQUEST['centre']."',
	 cog_exp = '".strtolower(trim($_REQUEST['cog_exp']))."',
	 v_industry= '".strtolower(trim($_REQUEST['v_industry']))."',
	 v_phone = '".trim($_REQUEST['v_phone'])."',
	 v_email = '".$_REQUEST['v_email']."'";
	//echo $sqlcemba_rec.'<p>';
	 if (!@mysql_query($sqlcemba_rec))
	 {die('Error updating cemba_rec record ' . mysql_error());}
	
	$sqlcemba_rec="update cmatfm set status = 'N' where cfmno = '".$_REQUEST['cfmno']."'";
	if (!@mysql_query($sqlcemba_rec))
	{die('Error updating  cmatfm  record ' . mysql_error());}
	
	   $sqlfmud ="select * from cmatfm 
		where status='A'
		order by cfmno
		limit 1"; 
	//echo "File is valid, and was successfully uploaded.\n";
	//echo $uploadfile;
        }  
      else 
	     {
   // echo "Possible file upload attack!\n";
       
   }
	
	/*$sqlcemba_rec = "DELETE FROM cemba_rec
	WHERE cfmno = '".$_REQUEST['cfmno']."'";
	echo $sqlcemba_rec.'<p>';
	if (!@mysql_query($sqlcemba_rec))
	{die('Error deleting cemba_rec record ' . mysql_error());}
	
	$sqlcemba_rec = "INSERT INTO cemba_rec SET
	cfmno = '".$_REQUEST['cfmno']."',
	vtitle = '".$_REQUEST['vtitle']."',
	vs_name = '".strtoupper(addslashes(trim($_REQUEST['vs_name'])))."',
	vm_name = '".ucwords(strtolower(trim($_REQUEST['vm_name'])))."',
	vo_name = '".ucwords(strtolower(trim($_REQUEST['vo_name'])))."',
	v_address = '".ucwords(strtolower(trim($_REQUEST['v_address'])))."',
	v_town = '".ucwords(strtolower(trim($_REQUEST['v_town'])))."', 
	v_lga= '".$_REQUEST['v_lga']."',
    v_state = '".$_REQUEST['v_state']."',
    v_country = '".$_REQUEST['v_country']."',
	d_o_b = '".formatdate($_REQUEST['d_o_b'],'todb')."',
    d_o_s = '".formatdate($_REQUEST['d_o_s'],'todb')."',
	v_sex = '".$_REQUEST['v_sex']."',
    userfile='".upload($_REQUEST['photo'],'uppixs')."',
	v_status = '".$_REQUEST['v_status']."',
     expereince = '".$_REQUEST['expereince']."',
	 v_national = '".$_REQUEST['v_national']."',
     v_employment = '".$_REQUEST['v_employment']."',
     centre='".$_REQUEST['centre']."',
	 cog_exp = '".strtolower(trim($_REQUEST['cog_exp']))."',
	 v_industry= '".strtolower(trim($_REQUEST['v_industry']))."',
	 v_phone = '".trim($_REQUEST['v_phone'])."',
	 v_email = '".$_REQUEST['v_email']."'";
	echo $sqlcemba_rec.'<p>';
	 if (!@mysql_query($sqlcemba_rec))
	 {die('Error updating cemba_rec record ' . mysql_error());}
	
	$sqlcemba_rec="update cmatfm set status = 'N' where cfmno = '".$_REQUEST['cfmno']."'";
	if (!@mysql_query($sqlcemba_rec))
	{die('Error updating  cmatfm  record ' . mysql_error());}
	
	   $sqlfmud ="select * from cmatfm 
		where status='A'
		order by cfmno
		limit 1";*/
	
	
	/* $sqlmst_rec = "SELECT *
	FROM cemba_rec
	WHERE cfmno = '".$_REQUEST['cfmno']."'";
	//echo $sqlmst_rec.'<br>';
	$rssqlmst_rec = mysql_query($sqlmst_rec, connect_server()) or die(mysql_error());
	
	//echo $_FILES['gpassport']['size'].' '.$_FILES['gpassport']['type'].' '.$_FILES['gpassport']['name'];
	if ($_FILES['gpassport']['size'] > 2000)
	{
		echo 'The file size of your picture is too large; should be 2KB or less<br>
		Your passport photo must not be more than 50pixel in width and 66pixel in height';
	}
	//echo $_FILES['gpassport']['type'];
	if ($_FILES['gpassport']['type'] <> 'image/jpeg' && $_FILES['gpassport']['type'] <> 'image/pjpeg')
	{
		echo 'The file must be in JPEG format';
	}

	$sqlmst_rec = "SELECT *
	FROM cemba_rec
	WHERE cfmno = '". substr($_FILES['gpassport']['name'],0,strlen($_FILES['gpassport']['name'])-4)."'";
	//echo $sqlmst_rec;
	$rssqlmst_rec = mysql_query($sqlmst_rec, connect_server()) or die(mysql_error());
	if( mysql_num_rows($rssqlmst_rec) == 0)
	{
		echo 'Please rename the file of passport picture to the staff number of the owner of the picture<br>Do <b>not</b> change the file name extension please';
		//exit();
	}
	//echo $up_ld_dir . 'p' . $_REQUEST['cfmno'].'.jpg';
	if (!move_uploaded_file($_FILES['gpassport']['tmp_name'], 'http://localhost/cemba/pp/' . $_FILES['gpassport']['name']))
	{
		echo 'Upload failed, please try again';
		//exit();
	} */
	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NOUN ::.CEMBA/CEMPA ONLINE REGISTRATION .::</title>

	<style type="text/css">
<style>
<!--
.styling{
background-color:white;
color:green;
font: bold 18px MS Sans Serif;
padding: 3px;
}
-->

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
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #009900;
}

-->
    </style>
	<script type="text/JavaScript">
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
</head><body onload="MM_preloadImages('images/preview_r2_c2_f2.gif')">
<div id="Layer1"  align="center" style="border: 1px black solid; width:750px;">
	
	<table width="750"  border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
      <td bgcolor="#FFFFFF"colspan="3"><hr  color="#006600"/></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" colspan="3"></td>
    </tr><tr>
			<td width="10%" bgcolor="#FFFFFF"><div align="left"><img src="images/col_logo.gif" width="70" height="88" /></div></td>
		    <td width="78%" bgcolor="#FFFFFF"><div align="center"><strong>THE COMMONWEALTH   OF LEARNING<br />
              <br />
            </strong><strong><em>In Partnership with<br />
            </em><br />
          NATIONAL OPEN  UNIVERSITY OF NIGERIA&nbsp;&nbsp;&nbsp;</strong> &nbsp; </div></td>
		    <td width="12%" bgcolor="#FFFFFF"><div align="right"><img src="images/noun_logo.jpg" width="93" height="91" /></div></td>
		</tr>
		<tr>
			<td colspan="3" align="center" bgcolor="#FFFFFF"><hr  color="#006600"/>
			  <p>&nbsp;</p>
		    <p>&nbsp;</p>
		    <p>&nbsp;</p>
		    <p class="style1">Congratulations!<br />your submission was successful.</p>
		    <p class="style1">Please make sure you print and attach your passport photograph to your form before submitting at the study center </p></td>
		</tr>
		<tr>
		  <td colspan="3" align="center" bgcolor="#FFFFFF"><hr  color="#006600"/></td>
	  </tr>
		<tr>
		  <td colspan="3" align="center" bgcolor="#FFFFFF"><p><a href="preview.php?cfmno=<?php echo $_REQUEST['cfmno'];?>" target="_blank" onmouseover="MM_swapImage('preview','','images/preview_r2_c2_f2.gif',1)" onmouseout="MM_swapImgRestore()"><img src="images/preview_r2_c2.gif" name="preview" width="157" height="22" border="0" id="preview" /></a></p>
		    <p class="style1">&nbsp;</p>
		    <hr  color="#006600"/>
      </td>
	  </tr>
		<tr>
			<td colspan="3" align="center" bgcolor="#279654"><div align="center" class="style16">&copy;2009 E-learning Unit National open university of Nigeria </div></td>
		</tr>
	</table>
</div></body></html>
	<?php
	exit();		
		
	
	
	/* if (isset($_REQUEST['lgin']))
	{
$sqlcemba_rec = "select * from  cemba_rec SET 
	cfmno = '".$_REQUEST['cfmno']."',
	vtitle = '".$_REQUEST['vtitle']."',
	vs_name = '".strtoupper(addslashes(trim($_REQUEST['vs_name'])))."',
	vm_name = '".addslashes(ucwords(strtolower(trim($_REQUEST['vm_name']))))."',
	vo_name = '".addslashes(ucwords(strtolower(trim($_REQUEST['vo_name']))))."',
	v_address = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_address']))))."',
	v_town = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_town']))))."',
    v_state = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_state']))))."',
    v_conutry = '".strtoupper(addslashes(trim($_REQUEST['v_country'])))."',
	d_o_b = '".addslashes(ucwords(strtolower(trim($_REQUEST['d_o_b']))))."',
    d_o_s = '".addslashes(ucwords(strtolower(trim($_REQUEST['d_o_s']))))."',
	v_sex = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_sex']))))."',
    v_status = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_status ']))))."',
	v_national = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_national ']))))."',
    v_employment = '".addslashes(ucwords(strtolower(trim($_REQUEST['v_employment']))))."',
	v_industry= '".addslashes(strtolower($_REQUEST['v_industry']))."',
	v_phone = '".$_REQUEST['v_phone']."',
	vphone2 = '".$_REQUEST['vphone2']."'";
	//echo $sqlbd_rec.'<p>';
	if (!@mysql_query($sqlcemba_rec,connect_server() ))

{die('Error updating  cemba_rec record ' . mysql_error());
$r_sqlcemba_rec = mysql_fetch_array($rssqlcemba_rec); 
} */
//$sqlodlt_rec = "SELECT *
	//FROM odlt_rec
	//WHERE cappno = '$cappno'";
	//echo $sqlodlt_rec.'<p>';
	//$rssqlodlt_rec = mysql_query($sqlodlt_rec, connect_server()) or die(mysql_error());
	//$r_sqlodlt_rec = mysql_fetch_array($rssqlodlt_rec); 
  ?> 