<?php 
if (isset($_REQUEST['Login']))
{
	$sql = "SELECT * FROM admited WHERE 
	cmatno = '".$_REQUEST['cmatno']."' AND 
	ref = '".$_REQUEST['ref']."'"; 
			
	$result = mysql_query($sql) or die (mysql_error()); 
	if(mysql_num_rows($result) == 0)
	{
		err_box('Please check your CMAT NUMBER and REF NUMBER');
	}
}
if (isset($_REQUEST['go']))
{
	$sql = "SELECT * FROM personal_info WHERE 
	matric_no = '".$_REQUEST['matric_no']."'"; 
			
	$result = mysql_query($sql) or die (mysql_error()); 
	$num = mysql_num_rows($result); 
	
	{
		err_box('<ul><li>Make sure you have registered and you have a MATRIC NO.</li><li> Please check your MATRIC NO. and try again</li></ul>');
	}
}


if (isset($_REQUEST['sbmt2']))
{
	if (isset($_REQUEST['v_title']) && $_REQUEST['v_title'] == '')
	{
		err_box('Please select your title in the personal information section ');
	}
	elseif (isset($_REQUEST['v_surname']) && trim($_REQUEST['v_surname']) == '')
	{
		echo err_box('Please enter  your surname in the personal information section ');
	}elseif (isset($_REQUEST['v_mname']) && trim($_REQUEST['v_mname']) == '')
	{
		echo err_box('Please enter  your middle name in the personal information section ');
	}elseif (isset($_REQUEST['v_oname']) && trim($_REQUEST['v_oname']) == '')
	{
		echo err_box('Please enter  your other name in the personal information section ');
	}
	
	if (isset($_REQUEST['v_gender']) && trim($_REQUEST['v_gender']) == '')
	{
		echo err_box('Please select your gender in the personal information section');
	}
	if (isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == '')
	{
		err_box('Please select your marital status in the personal information section ');
	}
	elseif (isset($_REQUEST['dob']) && trim($_REQUEST['dob']) == '')
	{
		echo err_box('Please select your date of birth in the personal information section ');
	}elseif (isset($_REQUEST['v_nationality']) && trim($_REQUEST['v_nationality']) == '')
	{
		echo err_box('Please select your nationality in the personal information section');
	}elseif (isset($_REQUEST['v_lga']) && trim($_REQUEST['v_lga']) == '')
	{
		echo err_box('Please select your local government area in the personal information section');
	}	
	if (isset($_REQUEST['v_htown']) && $_REQUEST['v_htown'] == '')
	{
	echo err_box('Please enter your home town in the personal information section');
		
	}elseif (isset($_REQUEST['v_address']) && trim($_REQUEST['v_address']) == '')
	{
		echo err_box('Please enter your contact address in the contact information section ');
	}elseif (isset($_REQUEST['v_tcity']) && trim($_REQUEST['v_tcity']) == '')
	{
		echo err_box('Please enter your city in the contact information section  ');
	}elseif (isset($_REQUEST['v_clga']) && trim($_REQUEST['v_clga']) == '')
	{
		echo err_box('Please select your local government area in the contact information section ');
	}
	
	if (isset($_REQUEST['v_cstate']) && trim($_REQUEST['v_cstate']) == '')
	{
		echo err_box('Please select your state in  the contact information section');
	}
	if (isset($_REQUEST['v_country']) && $_REQUEST['v_country'] == '')
	{
	echo err_box('Please select your Conutry in the contact information section');
		
	}elseif (isset($_REQUEST['v_phone']) && trim($_REQUEST['v_phone']) == '')
	{
		echo err_box('Please enter your phone number the contact information section ');
	}elseif (isset($_REQUEST['v_email']) && trim($_REQUEST['v_email']) == '')
	{
		echo err_box('Please enter your e-mail adress in the contact information section ');
	}elseif (isset($_REQUEST['v_ktitle']) && trim($_REQUEST['v_ktitle']) == '')
	{
		echo err_box('Please select title in the next of kin  section ');
	}
	if (isset($_REQUEST['vs_kname']) && trim($_REQUEST['vs_kname']) == '')
	{
		echo err_box('Please enter the surname of your  next of kin ');
	} 
	
	/*if (isset($_REQUEST['vo_kname']) && trim($_REQUEST['vo_kname']) == '');
	{
	   echo err_box('Please enter the other names of your  next of kin ');
	}*/
   if(isset($_REQUEST['v_krelation']) && $_REQUEST['v_krelation'] == '')
	{
		err_box('Please select your relationship with your next of kin  ');
	}
	elseif (isset($_REQUEST['v_kphone']) && trim($_REQUEST['v_kphone']) == '')
	{
		echo err_box('Please enter the number of your next of kin');
	}elseif (isset($_REQUEST['vcentre']) && trim($_REQUEST['vcentre']) == '')
	{
		echo err_box('Please select your centre in academic details  ');
	}elseif (isset($_REQUEST['programme']) && trim($_REQUEST['programme']) == '')
	{
		echo err_box('Please select your programme in academic details');
	}
	
	if (isset($_REQUEST['qual_1']) && trim($_REQUEST['qual_1']) == '')
	{
		echo err_box('Please select your qualification in academic details in table 1 ');
	}
	if (isset($_REQUEST['subject_1']) && $_REQUEST['subject_1'] == '')
	{
		err_box('Please select your subject area in academics details in table 1  ');
	}
	elseif (isset($_REQUEST['date_1']) && trim($_REQUEST['date_1']) == '')
	{
		echo err_box('Please select the date qualification obtained in academics details in table 1  ');
	}elseif (isset($_REQUEST['school_1']) && trim($_REQUEST['school_1']) == '')
	{
		echo err_box('Please enter school of qualification in academics details in table 1');
	}elseif (isset($_REQUEST['dos']) && trim($_REQUEST['dos']) == '')
	{
		echo err_box('Please select date of submisson ');
	}	
	//if (isset($_REQUEST['v_htown']) && $_REQUEST['v_htown'] == '')
//	{
//	echo err_box('Please enter your home town in the personal information section');
//		
//	}elseif (isset($_REQUEST['v_address']) && trim($_REQUEST['v_address']) == '')
//	{
//		echo err_box('Please enter your contact address in the contact information section ');
//	}elseif (isset($_REQUEST['v_tcity']) && trim($_REQUEST['v_tcity']) == '')
//	{
//		echo err_box('Please enter your city in the contact information section  ');
//	}elseif (isset($_REQUEST['v_clga']) && trim($_REQUEST['v_clga']) == '')
//	{
//		echo err_box('Please select your local government area in the contact information section ');
//	}
//	
//	if (isset($_REQUEST['v_cstate']) && trim($_REQUEST['v_cstate']) == '')
//	{
//		echo err_box('Please select your state in  the contact information section');
//	}
//	if (isset($_REQUEST['v_country']) && $_REQUEST['v_country'] == '')
//	{
//	echo err_box('Please select your Conutry in the contact information section');
//		
//	}elseif (isset($_REQUEST['v_phone']) && trim($_REQUEST['v_phone']) == '')
//	{
//		echo err_box('Please enter your phone number the contact information section ');
//	}elseif (isset($_REQUEST['v_email']) && trim($_REQUEST['v_email']) == '')
//	{
//		echo err_box('Please enter your e-mail adress in the contact information section ');
//	}elseif (isset($_REQUEST['v_ktitle']) && trim($_REQUEST['v_ktitle']) == '')
//	{
//		echo err_box('Please select title in the next of kin  section ');
//	}
//	
//	if (isset($_REQUEST['vs_kname']) && trim($_REQUEST['vs_kname']) == '')
//	{
//		echo err_box('Please enter the surname of your  next of kin ');
//	} 
//	if (isset($_REQUEST['vo_kname']) && trim ($_REQUEST['vo_kname'])== '');
//	{
//	echo err_box('Please enter the other names of your  next of kin ');
//	}
}

function err_box($msg)
{?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	background-image: url(file:///C|/xampp/htdocs/cemba/images/acde-page_r19_c7.gif);
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
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
		    <td width="78%" bgcolor="#FFFFFF"><div align="center">
              <p><strong>ADMISION /APPLICATION FORM<br />
                    <br />
                </strong><strong><em>for<br />
                <br />
              </em>THE COMMON WEALTH EXECUTIVE  PROGRAMME CEMBA/CEMPA&nbsp;&nbsp;&nbsp;</strong> &nbsp; </p>
	        </div></td>
		    <td width="12%" bgcolor="#FFFFFF"><div align="right"><img src="images/noun_logo.jpg" width="90" height="90" /></div></td>
		</tr>
		<tr>
			<td colspan="3" align="center" bgcolor="#FFFFFF"><hr  color="#006600"/>
		    </td>
		</tr>
		<tr>
		  <td colspan="3" align="center" bgcolor="#FFFFFF"><hr  color="#006600"/></td>
	  </tr>
		<tr><P></P>
		  <td colspan="3" align="center" bgcolor="#FFFFFF" class="style1"><p></p>
		    <p></p>
		    <p></p>
		    <p></p>
		    <?php echo $msg ?><p><input name="Back" type="button" value="Back" onClick="history.back()">
		    <p>            
		    <p>            
		    <p>
                        <hr  color="#006600"/>
	     </td>
	  </tr>
		<tr>
			<td colspan="3" align="center" bgcolor="#279654"><div align="center" class="style16">&copy;2010 E-Learning Unit National Open University of Nigeria </div></td>
		</tr>
	</table>
</div></body></html>
	<?php
	exit;
}?>
