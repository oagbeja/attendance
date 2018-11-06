<?php 
require_once('includes/enc_dec.php');
require_once('includes/local_lib.php');
require_once('includes/env_set.php');
//require_once('includes/val_frm.php');
connect_server();

if (isset($_REQUEST['sbmt2']))
{
	require_once('cemval.php');
	require_once('kardet2.php');
}

if (isset($_REQUEST['matric_no']))
{
	$sqcemba_rec = "SELECT *
	FROM personal_info
	WHERE matric_no = '".$_REQUEST['matric_no']."'";
	//echo $sqcemba_rec;
	$rssqcemba_rec = mysql_query($sqcemba_rec, connect_server()) or die(mysql_error());
	$r_rssqcemba_rec = mysql_fetch_array($rssqcemba_rec);
	}else
	{
	$sqlcemat = "SELECT a.*, b.vStateNamedesc,c.vLGADesc,d.titledesc,e.vcountrydesc
	FROM personal_info a, ng_state b, localarea c,title d,country e
	WHERE a.v_state = b.cStateId and
	c.cLGAId = a.v_lga and d.title_id=a.v_title and e.ccountryid=a.v_country  and
	matric_no = '".$_REQUEST['matric_no']."'"; 
	//echo $sqlcemat;
	$r_sqlcemat= mysql_query($sqlcemat, connect_server()) or die(mysql_error());
	   $r_ssqlcemat = mysql_fetch_array($r_sqlcemat);
	   
	   
	}  


/*if (isset($_REQUEST['ps_on']))
{
	vali_as_user($cappno);
	require_once('kardet.php');
}



if ((isset($_REQUEST['lgin'])  || isset($_REQUEST['nap'])) && !isset($_REQUEST['ps_on']))
{
	require_once('CEMVAL.php');
}


if (isset($_REQUEST['lgin']) || isset($_REQUEST['sbmt2']))
{
	require_once('kardet.php');
} */?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NOUN ::.CEMBA/CEMPA ONLINE REGISTRATION .::</title>
<style type="text/css">
<!--
/*@import url("ACDE QAAASTYLE.css");*/
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

-->
</style>
<script type="text/JavaScript">

function validate()
{
	with (cemba)
	{
		if (v_title.value == '')
		{
			alert('Please select your title')
			v_title.focus()
			return false
		}
		
		if (trim(v_surname.value) == '')
		{
			alert('Please enter your surname')
			v_surname.focus()
			return false
		}
		 
		 if (trim(v_mname.value) == '')
		{
			alert('Please enter your middle name')
			v_mname.focus()
			return false
		}
		
		if (trim(v_oname.value) == '')
		{
			alert('Please enter your other name')
			v_oname.focus()
			return false
	   }
		 
		if (trim(v_address.value) == '')
		{
			alert('Please enter your Address')
			v_address.focus()
			return false
		 }
		 
		if (trim(v_htown.value) == '')
		{
			alert('Please enter your Town/city')
			v_htown.focus()
			return false
		 }
		 
		if (v_phone.value == '')
		{
			alert('Please Enter your Phone')
			v_phone.focus()
			return false
		}
		
		if (v_lga.value == '')
		{
			alert('Please select your LGA')
			v_lga.focus()
			return false
		}
		
		if (v_state.value == '')
		{
			alert('Please select your state')
			v_state.focus()
			return false
		}
		
		if (v_country.value == '')
		{
			alert('Please select your country')
			v_country.focus()
			return false
		}
				
		if (v_sex.value == '')
		{
			alert('Please select your sex')
			v_sex.focus()
			return false
		}	
				
			if (v_status.value == '')
			{
				alert('Please select your status')
				v_status.focus()
				return false
			}
			
			if (v_nationality.value == '')
			{
				alert('Please select your Nationality')
				v_nationality.focus()
				return false
			}
			
			if (v_disablity.value == '')
			{
				alert('Please select your employment status')
				v_disablity.focus()
				return false
			}			   
			
			if (dob.value == '' || dob.value.length != 10)
			{
				alert('Please select your date of birth')
				dday1.focus()
				return false
			}
          
		  if (d_o_s.value == '' || d_o_s.value.length != 10)
			{
				alert('Please select your date of submission ')
				dday2.focus()
				return false
			}
			if (v_industry.value == '')
			{
				alert('Please select your employment status')
				v_industry.focus()
				return false
			}	
			if (!decl.checked)
			{
				alert('Please indicate your declearation ')
				decl.focus()
				return false
			}
			
			if (isNaN(v_phone.value))
			{
				alert ('Please enter your Phone number')
				v_phone.focus()
				return false
			} 
			return chk_mail(v_email)
	}
	return true
}


function trim(totrim)
{
	var trimed = "";
	for (j = 0; j <= totrim.length-1; j++)
	{
		if (totrim.charAt(j) != " "){trimed = trimed + totrim.charAt(j);}
	}
	return trimed;
}


function chk_mail(tempobj)
{
	if(tempobj.value.indexOf("@") == -1)
	{
		alert("The \'@\' character is missing in the email address");
		tempobj.focus(); return false
	}else if (tempobj.value.indexOf("@") == tempobj.value.length-1)
	{
		alert("E-mail address cannot end with the \'@\' character");
		tempobj.focus(); return false
	}else if (tempobj.value.indexOf(".") == tempobj.value.length-1)
	{
		alert('E-mail address cannot end with the \'.\' character,'+'\n'+'it should be  \'.something\'');
		tempobj.focus(); return false
	}
	var emailinval = new String("~`!#$%^&*()+=:;|'{} []|\/?,<>. ")
	for (n = 0; n < emailinval.length-1; n++)
	{
		for (j = 0; j < tempobj.value.length-1; j++)
		{
			if (tempobj.value.charAt(j) == emailinval.charAt(n))
			{
				var invalchar = tempobj.value.charAt(j);
				if  (invalchar == ".")
				{
					if  (j < tempobj.value.indexOf("@"))
					{
						var pos = j + parseInt("1");
						alert("Please remove the dot character at position "+pos);
						tempobj.focus(); return false;
					}
				}else
				{
					alert("E-mail contains an invalid character: \'"+invalchar+"\'");
					tempobj.focus(); return false;
				}
			}
		}
	}
	if (tempobj.value.indexOf(".") == -1)
	{
		alert("There should be a dot \(.\) somewhere after the \'@\' character");
		tempobj.focus(); return false;
	}
	return true
}
<!--




function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<style>
<!--
.styling{
background-color:white;
color:green;
font: bold 18px MS Sans Serif;
padding: 3px;
}
.style11 {color: #000000}
.style13 {color: #FF0000}
.style14 {
	color: #279654;
	font-weight: bold;
}
.style16 {font-size: 9px}
.style19 {color: #FF0000; font-style: italic; }
.style20 {color: #000000; font-weight: bold; }
.style22 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style25 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
</head>

<body>
<div id="Layer1" style="border: 1px black solid; width:750px;">
<form method="post" name="cemba" enctype="multipart/form-data" onsubmit="/*return validate()*/">
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
        </em>THE COMMONWEALTH EXECUTIVE  PROGRAMME (CEMBA/CEMPA&nbsp;)&nbsp;&nbsp;</strong> &nbsp; </p>
      </div></td>
      <td width="85"><img src="images/noun_logo.jpg" width="93" height="91" /></td>
    </tr>
    
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"/>
        <p align="center">&nbsp;</p>
        <table bgcolor="#FFFFFF" border="0" cellpadding="3" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="67%" align="left"><span class="style14"><font face="Verdana, Arial, Tahoma" size="2">MATRICULATION NO </font></span><font face="Verdana, Arial, Tahoma" size="2"><span class="style11">: </span></font><font color="#ff0000" face="Verdana, Arial, Tahoma" size="2"><?php 
				  $formno="select * from matriculation 
				where status='A'
				 order by matric_no
				limit 1"; 
				//echo $formno;
			$r_formno= mysql_query($formno, connect_server()) or die(mysql_error());
			$r_sformno = mysql_fetch_array($r_formno);
			 ?>
				 <?php if(isset($r_sformno['matric_no']))
				 {
					echo stripslashes($r_sformno['matric_no']);
				 }elseif(isset($_REQUEST['matric_no']))
				 {
					echo strtoupper(stripslashes($_REQUEST['matric_no']));}else{echo $formno;
				 } ?></b>
			 	<input name="matric_no" type="hidden" 
				value="<?php if(isset($r_sformno['matric_no']))
				{
					echo stripslashes($r_sformno['matric_no']);
				}elseif(isset($_REQUEST['matric_no']))
				{
					echo strtoupper(stripslashes($_REQUEST['matric_no']));
				}else{echo $formno;} ?>" />
              </font> </td>
              <td width="8%" align="left"><span class="style14"><font face="Verdana, Arial, Tahoma" size="2">YEAR  </font></span> </td>
              <td width="25%" align="left"><strong class="style13">2011/2012</strong></td>
            </tr>
          </tbody>
        </table>
        <p align="center" class="style13">
          Please note that the asterisk (*) fields are to be filled. </p>
        <p>
          <span class="style14"> 1. PERSONAL INFORMATION</span></p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
        <tbody><tr>
          <td align="center">
            <table border="0" cellpadding="2" cellspacing="2" width="100%">
              <tbody><tr bgcolor="#27A8AE">
                <td colspan="7" bgcolor="#279654">
					  <div align="left" class="style14">&nbsp;</div></td>
                </tr>
              <tr>
                <td width="2%">&nbsp;</td>
                <td width="26%">
						<div align="left" class="style22">Title<font color="#ff0000">*</font> </div></td>
                <td colspan="4"> <div align="left"><?php
									$sqltitle = "SELECT * FROM title ORDER BY titledesc";
									$rstitle = mysql_query($sqltitle, connect_server()) or die(mysql_error());?>
                    <select name="v_title">
                      <option value="" selected></option>
                      <?php
									while ($r_rstitle = mysql_fetch_array($rstitle))
									{?>
                      <option value="<?php echo $r_rstitle[0];?>"
										<?php if(isset($_REQUEST['v_title']))
										{
											if($_REQUEST['v_title'] == $r_rstitle[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_title']))
										{
											if($r_rssqcemba_rec['v_title'] == $r_rstitle[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rstitle[1];?></option>
                      <?php
									}
									mysql_free_result($rstitle);?>
                    </select><?php /*$errr = v_lidate($_REQUEST['v_title']); echo v_lidate($_REQUEST['v_title'])*/?>
                </div></td>
                <td width="3%" rowspan="11" align="right" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
						<div align="left" class="style22">Surname<font color="#ff0000">*</font> </div></td>
								<td colspan="4">
								  <div align="left">
								   <input name="v_surname" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_surname'])){echo stripslashes($r_rssqcemba_rec['v_surname']);}
									elseif(isset($_REQUEST['v_surname'])){echo stripslashes($_REQUEST['v_surname']);} ?>" />
								  </div></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
						<div align="left" class="style22">Middle Name <font color="#ff0000">*</font></div></td>
                <td colspan="4">
									<div align="left">
									  <input name="v_mname" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_mname'])){echo stripslashes($r_rssqcemba_rec['v_mname']);}
									elseif(isset($_REQUEST['v_mname'])){echo stripslashes($_REQUEST['v_mname']);} ?>" />
									</div></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left" class="style22">Other Names</div></td>
                <td colspan="4"><div align="left">
                  <input name="v_oname" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_oname'])){echo stripslashes($r_rssqcemba_rec['v_oname']);}
									elseif(isset($_REQUEST['v_oname'])){echo stripslashes($_REQUEST['v_oname']);} ?>" />
                </div></td>
              </tr>
              <tr>
                <td colspan="6">&nbsp;</td>
                </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td><div align="left" class="style22">Gender<span class="style13">*</span></div></td>
                <td><div align="left">
                  <select name="v_gender">
                    <option value="" selected="selected"></option>
                    <option value="Male" <?php if(isset($_REQUEST['v_gender']) && $_REQUEST['v_gender'] == 'Male'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_gender']) && $r_rssqcemba_rec['v_gender'] == 'Male'){echo ' selected';} ?>>Male</option>
                    <option value="Female" <?php if(isset($_REQUEST['v_gender']) && $_REQUEST['v_gender'] == 'Female'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_gender']) && $r_rssqcemba_rec['v_gender'] == 'Female'){echo ' selected';} ?>>Female</option>
                  </select>
                </div></td>
                <td>&nbsp;</td>
                <td><div align="left">Marital Status<span class="style13">*</span></div></td>
                <td><div align="left">
                  <select name="v_status">
                    <option value="" selected="selected"></option>
                    <option value="Married" <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Married'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Married'){echo ' selected';} ?>>Married</option>
                    <option value="Single" <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Single'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Single'){echo ' selected';} ?>>Single</option>
                    <option value="Divorced" <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Divorced'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Divorced'){echo ' selected';} ?>>Divorced</option>
                  </select>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left" class="style22">Date of Birth <font color="#ff0000">*</font> </div></td>
                <td colspan="4"><div align="left">
                  <select name="dday" onchange="dob.value=dday.value+'-'+mmonth.value+'-'+yyear.value;/*mdchng.value=1*/">
                    <option value="" selected="selected">dd</option>
                    <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                    <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['dob']) && substr($_REQUEST['dob'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['dob']) && substr($r_rssqcemba_rec['dob'],8,2) == $f){echo ' selected';}?>>
                    <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                    </option>
                    <?php
													}?>
                  </select>
                  <select name="mmonth" onchange="dob.value=dday.value+'-'+mmonth.value+'-'+yyear.value;/*mdchng.value=1*/">
                    <option value="" selected="selected">mm</option>
                    <?php
													for ($f = 1; $f <= 12; $f++)
													{?>
                    <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['dob']) && substr($_REQUEST['dob'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['dob']) && substr($r_rssqcemba_rec['dob'],5,2) == $f){echo ' selected';}?>>
                    <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                    </option>
                    <?php
													}?>
                  </select>
                  <select name="yyear" onchange="dob.value=dday.value+'-'+mmonth.value+'-'+yyear.value;/* alert(dob.value); */">
                    <option value="" selected="selected">yyyy</option>
                    <?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
                    <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['dob']) && substr($_REQUEST['dob'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['dob']) && substr($r_rssqcemba_rec['dob'],0,4) == $f){echo ' selected';}?>>
                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                      </option>
                    <?php
													}?>
                  </select>
                  <input name="dob" type="hidden" value="<?php if(isset($_REQUEST['dob'])){echo $_REQUEST['dob'];}
												elseif(isset($r_rssqcemba_rec['dob'])){echo $r_rssqcemba_rec['dob'];}?>" />
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left" class="style22">Nationality<font color="#ff0000">*</font></div></td>
                <td width="17%"><div align="left">
                  <?php $sqlcountry = "SELECT * FROM country ORDER BY vcountrydesc";
									$rscountry= mysql_query($sqlcountry, connect_server()) or die(mysql_error());?>
                  <select name="v_nationality" onblur="if(this.value==152){v_state.disabled=false}else{v_state.disabled=true}">
                    <option value=""  select="Select" one="One"></option>
                    <?php
									while ($r_rscountry = mysql_fetch_array($rscountry))
									{?>
                    <option value="<?php echo $r_rscountry[0];?>"
										<?php if(isset($_REQUEST['v_nationality']))
										{
											if($_REQUEST['v_nationality'] == $r_rscountry[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec ['v_nationality']))
										{
											if($r_rssqcemba_rec ['v_nationality'] == $r_rscountry[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rscountry[1];?></option>
                    <?php
									}
									mysql_free_result($rscountry);?>
                  </select>
                </div></td>
                <td width="10%">&nbsp;</td>
                <td width="21%"><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">State</font> <font size="2" face="Verdana, Arial, Helvetica, Tahoma"><span class="style13">*</span></font></div></td>
                <td width="21%"><div align="left">
                  <?php $sqlstate = "SELECT cStateId,vStateNamedesc FROM ng_state ";
									$rsstate= mysql_query($sqlstate, connect_server()) or die(mysql_error());?>
                  <select name="v_state" onblur="if(this.value!==void){v_lga.disabled=false}else{v_lga.disabled=true}" >
                    <option value=""  select="Select" one="One"></option>
                    <?php
									while ($r_rsstate = mysql_fetch_array($rsstate))
									{?>
                    <option value="<?php echo $r_rsstate[0];?>"
										<?php if(isset($_REQUEST['v_state']))
										{
											if($_REQUEST['v_state'] == $r_rsstate[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_state']))
										{
											if($r_rssqcemba_rec['v_state'] == $r_rsstate[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rsstate[1];?></option>
                    <?php
									}
									mysql_free_result($rsstate);?>
                  </select>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left" class="style22">LGA<span class="style13">* </span></div></td>
                <td><div align="left">
                  <?php $sqllocal = "SELECT cLGAId,vLGADesc FROM localarea ";
									$rslocal= mysql_query($sqllocal, connect_server()) or die(mysql_error());?>
                  <select name="v_lga" >
                    <option value=""  select="Select" one="One"></option>
                    <?php
									while ($r_rslocal = mysql_fetch_array($rslocal))
									{?>
                    <option value="<?php echo $r_rslocal[0];?>"
										<?php if(isset($_REQUEST['v_lga']))
										{
											if($_REQUEST['v_lga'] == $r_rslocal[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_lga']))
										{
											if($r_rssqcemba_rec['v_lga'] == $r_rslocal[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rslocal[1];?></option>
                    <?php
									}
									mysql_free_result($rslocal);?>
                  </select>
                </div></td>
                <td>&nbsp;</td>
                <td><div align="left">Home Town<font color="#ff0000">*</font></div></td>
                <td><div align="left">
                  <input name="v_htown" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['v_htown'])){echo stripslashes($r_rssqcemba_rec['v_htown']);}
									elseif(isset($_REQUEST['v_htown'])){echo stripslashes($_REQUEST['v_htown']);} ?>" />
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left" class="style22">Disability </div></td>
                <td><div align="left">
                  <select name="v_disablity">
                    <option value="<?php if(isset($r_rssqcemba_rec['v_disablity'])){echo stripslashes($r_rssqcemba_rec['v_disablity']);}
				elseif(isset($_REQUEST['v_disablity'])){echo stripslashes($_REQUEST['v_disablity']);} ?>" selected="selected">None</option>
                    <option value="Blind" <?php if(isset($_REQUEST['v_disablity']) && $_REQUEST['v_disablity'] == 'Blind'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_disablity']) && $r_rssqcemba_rec['v_disablity'] == 'Blind'){echo ' selected';} ?>>Blind</option>
                    <option value="Deaf"<?php if(isset($_REQUEST['v_disablity']) && $_REQUEST['v_disablity'] == 'Deaf'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_disablity']) && $r_rssqcemba_rec['v_disablity'] == 'Deaf'){echo ' selected';} ?>>Deaf</option>
                    <option value="Dumb"<?php if(isset($_REQUEST['v_disablity']) && $_REQUEST['v_disablity'] == 'Dumb'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_disablity']) && $r_rssqcemba_rec['v_disablity'] == 'Dumb'){echo ' selected';} ?>> Dumb</option>
                    <option value="Crippled"<?php if(isset($_REQUEST['v_disablity']) && $_REQUEST['v_disablity'] == 'Crippled'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_disablity']) && $r_rssqcemba_rec['v_disablity'] == 'Crippled'){echo ' selected';} ?>>Crippled </option>
                  </select>
                </div></td>
                <td>&nbsp;</td>
                <td>Others</td>
                <td><input name="v_others" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['v_others'])){echo stripslashes($r_rssqcemba_rec['v_others']);}
									elseif(isset($_REQUEST['v_others'])){echo stripslashes($_REQUEST['v_others']);} ?>" /></td>
              </tr>
              <tr>
                <td colspan="6"><label></label></td>
                </tr>
            </tbody></table>			  </td>
        </tr>
      </tbody></table>
        <p><span class="style14">2. CONTACT INFORMATION </span></p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>
                    <tr bgcolor="#d3eed0">
                      <td colspan="6" bgcolor="#279654"><div align="left" class="style14">&nbsp;</div></td>
                    </tr>

                    <tr>
                      <td width="1%">&nbsp;</td>
                      <td width="27%" align="left" valign="top"><div align="left" class="style22">Contact  Address <font color="#ff0000">*</font> </div></td><td colspan="4"><div align="left"><textarea name="v_address" cols="31" rows="3"><?php if(isset($r_rssqcemba_rec['v_address'])){echo stripslashes($r_rssqcemba_rec['v_address']);}elseif(isset($_REQUEST['v_address'])){echo stripslashes($_REQUEST['v_address']);} ?></textarea>
                      </div></td>
                    </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Town/City<font color="#ff0000">*</font> </div></td>
                      <td width="19%"><div align="left">
                        <input name="v_tcity" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['v_tcity'])){echo stripslashes($r_rssqcemba_rec['v_tcity']);}
									elseif(isset($_REQUEST['v_tcity'])){echo stripslashes($_REQUEST['v_tcity']);} ?>">                      
                      </div></td>
                      <td width="12%">&nbsp;</td>
                      <td width="16%"><div align="left">LGA<span class="style13">* </span></div></td>
                      <td width="25%"><div align="left">
                        <?php $sqllocal = "SELECT cLGAId,vLGADesc FROM localarea ";
									$rslocal= mysql_query($sqllocal, connect_server()) or die(mysql_error());?>
                        <select name="v_clga" >
                          <option value=""  select="Select" one="One"></option>
                          <?php
									while ($r_rslocal = mysql_fetch_array($rslocal))
									{?>
                          <option value="<?php echo $r_rslocal[0];?>"
										<?php if(isset($_REQUEST['v_clga']))
										{
											if($_REQUEST['v_clga'] == $r_rslocal[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_clga']))
										{
											if($r_rssqcemba_rec['v_clga'] == $r_rslocal[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rslocal[1];?></option>
                          <?php
									}
									mysql_free_result($rslocal);?>
                        </select>
                      </div></td>
                    </tr>
                    
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left" class="style22">State <span class="style13">*</span></div></td>
                      <td><div align="left">
                        <?php $sqlstate = "SELECT cStateId,vStateNamedesc FROM ng_state ";
									$rsstate= mysql_query($sqlstate, connect_server()) or die(mysql_error());?>
                        <select name="v_cstate" >
                          <option value=""  select="Select" one="One"></option>
                          <?php
									while ($r_rsstate = mysql_fetch_array($rsstate))
									{?>
                          <option value="<?php echo $r_rsstate[0];?>"
										<?php if(isset($_REQUEST['v_cstate']))
										{
											if($_REQUEST['v_cstate'] == $r_rsstate[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_cstate']))
										{
											if($r_rssqcemba_rec['v_cstate'] == $r_rsstate[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rsstate[1];?></option>
                          <?php
									}
									mysql_free_result($rsstate);?>
                        </select>
                      </div></td>
                      <td>&nbsp;</td>
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, Tahoma">Country<span class="style13">*</span></font></div></td>
                      <td><div align="left">
                        <?php $sqlcountry = "SELECT * FROM country ORDER BY vcountrydesc";
									$rscountry= mysql_query($sqlcountry, connect_server()) or die(mysql_error());?>
                        <select name="v_country" >
                          <option value=""  select="Select" one="One"></option>
                          <?php
									while ($r_rscountry = mysql_fetch_array($rscountry))
									{?>
                          <option value="<?php echo $r_rscountry[0];?>"
										<?php if(isset($_REQUEST['v_country']))
										{
											if($_REQUEST['v_country'] == $r_rscountry[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec ['v_country']))
										{
											if($r_rssqcemba_rec ['v_country'] == $r_rscountry[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rscountry[1];?></option>
                          <?php
									}
									mysql_free_result($rscountry);?>
                        </select>
                      </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left" class="style22">Phone <span class="style13">*</span></div></td>
                      <td colspan="4"><div align="left">
                        <input name="v_phone" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_phone'])){echo stripslashes($r_rssqcemba_rec['v_phone']);}
									elseif(isset($_REQUEST['v_phone'])){echo stripslashes($_REQUEST['v_phone']);} ?>" />
								
                      </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left" class="style22">Fax no </div></td>
                      <td colspan="4"><div align="left">
                        <input name="v_fax" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_fax'])){echo stripslashes($r_rssqcemba_rec['v_fax']);}
									elseif(isset($_REQUEST['v_fax'])){echo stripslashes($_REQUEST['v_fax']);} ?>" />
                      </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left" class="style22">e-Mail Address <span class="style13">*</span></div></td>
                      <td colspan="4"><div align="left">
                        <input name="v_email" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_email'])){echo stripslashes($r_rssqcemba_rec['v_email']);}
									elseif(isset($_REQUEST['v_email'])){echo stripslashes($_REQUEST['v_email']);} ?>">
                      </div></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>
        <p><span class="style14">3. NEXT OF KIN INFORMATION</span> <span class="style13"><em>(The person  most be closely related to you) </em></span></p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>
                    <tr bgcolor="#d3eed0">
                      <td colspan="3" bgcolor="#279654"><div align="left" class="style14">&nbsp;</div></td>
                    </tr>
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="23%"><div align="left" class="style22">Title<font color="#ff0000">*</font> </div></td>
                      <td width="72%" valign="middle"><div align="left">
                        <?php
									$sqltitle = "SELECT * FROM title ORDER BY titledesc";
									$rstitle = mysql_query($sqltitle, connect_server()) or die(mysql_error());?>
                        <select name="v_ktitle">
                          <option value="" selected="selected"></option>
                          <?php
									while ($r_rstitle = mysql_fetch_array($rstitle))
									{?>
                          <option value="<?php echo $r_rstitle[0];?>"
										<?php if(isset($_REQUEST['v_ktitle']))
										{
											if($_REQUEST['v_ktitle'] == $r_rstitle[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_ktitle']))
										{
											if($r_rssqcemba_rec['v_ktitle'] == $r_rstitle[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rstitle[1];?></option>
                          <?php
									}
									mysql_free_result($rstitle);?>
                        </select>
                      </div>
                    <tr><td height="28">&nbsp;</td><td><div align="left" class="style22">Surname<font color="#ff0000">*</font> </div></td>
                      <td><div align="left">
                        <input name="vs_kname" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['vs_kname'])){echo stripslashes($r_rssqcemba_rec['vs_kname']);}
									elseif(isset($_REQUEST['vs_kname'])){echo stripslashes($_REQUEST['vs_kname']);} ?>" />
                      </div></td></tr><tr><td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Other Names  <font color="#ff0000">*</font></div></td>
                      <td><div align="left">
                        <input name="vo_kname" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['vo_kname'])){echo stripslashes($r_rssqcemba_rec['vo_kname']);}
									elseif(isset($_REQUEST['vo_kname'])){echo stripslashes($_REQUEST['vo_kname']);} ?>" />
                      </div></td>
                    </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Relationship<span class="style13">*</span></div></td>
                      <td><div align="left">
                        <?php
									$sqlrelate = "SELECT * FROM relationship ORDER BY relate";
									$rsrelate = mysql_query($sqlrelate, connect_server()) or die(mysql_error());?>
                        <select name="v_krelation">
                          <option value="" selected="selected"></option>
                          <?php
									while ($r_rsrelate = mysql_fetch_array($rsrelate))
									{?>
                          <option value="<?php echo $r_rsrelate[0];?>"
										<?php if(isset($_REQUEST['v_krelation']))
										{
											if($_REQUEST['v_krelation'] == $r_rsrelate[0])
											{
												echo ' selected';
											}
										}else if(isset($r_rssqcemba_rec['v_krelation']))
										{
											if($r_rssqcemba_rec['v_krelation'] == $r_rsrelate[0])
											{
												echo ' selected';
											}
										}?>><?php echo $r_rsrelate[1];?></option>
                          <?php
									}
									mysql_free_result($rsrelate);?>
                        </select>
                      </div></td>
                    </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Phone <span class="style13">*</span></div></td>
                      <td><div align="left">
                        <input name="v_kphone" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_kphone'])){echo stripslashes($r_rssqcemba_rec['v_kphone']);}
									elseif(isset($_REQUEST['v_kphone'])){echo stripslashes($_REQUEST['v_kphone']);} ?>" />
                      </div></td>
                    </tr>
                    <tr><td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Fax </div></td>
                      <td><div align="left"><input name="v_kfax" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['v_kfax'])){echo stripslashes($r_rssqcemba_rec['v_kfax']);}
									elseif(isset($_REQUEST['v_kfax'])){echo stripslashes($_REQUEST['v_kfax']);} ?>"/>
                      </div></td></tr><tr> <td>&nbsp;</td><td><div align="left" class="style22">e-mail Address</div></td>
                      <br />
					  <td><div align="left">
                        <input name="kvemail" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['kvemail']))
						{echo stripslashes($r_rssqcemba_rec['kvemail']);}
									elseif(isset($_REQUEST['kvemail'])){echo stripslashes($_REQUEST['kvemail']);} ?>" />
                      </div></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>        
        <p class="style14">4. ACADEMIC DETAILS</p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>
                    <tr bgcolor="#d3eed0">
                      <td colspan="4" bgcolor="#279654"><div align="left" class="style14">&nbsp;</div></td>
                    </tr>
                    <tr>
                      <td colspan="4"><div align="left" class="style14">A. CHOICE OF PROGRAMME AND STUDY CENTRE<font color="#ff0000">*</font></div></td>
                      </tr>
                    <tr>
                      <td height="28" colspan="4"><table width="100%" border="0" align="center">
                        <tr>
                          <td>&nbsp;</td>
                          <td><div align="left" class="style22">Study centre </div></td>
                          <td width="71%"><div align="left">
                            <select name="vcentre">
                              <option value="<?php if(isset($r_rssqcemba_rec['vcentre'])){echo stripslashes($r_rssqcemba_rec['vcentre']);}elseif(isset($_REQUEST['vcentre'])){echo stripslashes($_REQUEST['vcentre']);} ?>" selected="selected"></option>
                              <option value="Abuja" <?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Abuja'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vvcentre']) && $r_rssqcemba_rec['vcentre'] == 'Abuja'){echo ' selected';} ?>>Abuja</option>
                              <option value="Lagos"<?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Lagos'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vcentre']) && $r_rssqcemba_rec['vcentre'] == 'Lagos'){echo ' selected';} ?>>Lagos</option>
                              <option value="Port Harcourt" <?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Port Harcourt'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vcentre']) && $r_rssqcemba_rec['vcentre'] == 'Port Harcourt'){echo ' selected';} ?>>Port Harcourt</option>
                              <option value="Kaduna"<?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Kaduna'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vcentre']) && $r_rssqcemba_rec['vcentre'] == 'Kaduna'){echo ' selected';} ?>>Kaduna</option>
                            </select>
                          </div></td>
                          </tr>
                        <tr>
                          <td width="4%">&nbsp;</td>
                          <td width="25%"><div align="left" class="style22">Programme</div></td>
                          <td><div align="left">
                            <select name="programme">
                              <option value="<?php if(isset($r_rssqcemba_rec['programme'])){echo stripslashes($r_rssqcemba_rec['programme']);}
				elseif(isset($_REQUEST['programme'])){echo stripslashes($_REQUEST['programme']);} ?>" selected="selected"></option>
                              <option value="CEMBA" <?php if(isset($_REQUEST['programme']) && $_REQUEST['programme'] == 'programme'){echo ' selected';}elseif(isset($r_rssqcemba_rec['programme']) && $r_rssqcemba_rec['programme'] == 'CEMBA'){echo ' selected';} ?>>CEMBA</option>
                              <option value="CEMPA"<?php if(isset($_REQUEST['programme']) && $_REQUEST['programme'] == 'CEMPA'){echo ' selected';}elseif(isset($r_rssqcemba_rec['programme']) && $r_rssqcemba_rec['programme'] == 'CEMPA'){echo ' selected';} ?>>CEMPA</option>
                              </select>
                          </div></td>
                          </tr>
                        <tr>
                          <td colspan="3"><font size="2" face="Verdana, Arial, Tahoma" class="style14"><b></font></td>
                          </tr>
                        
                      </table></td>
                      </tr>
                    <tr>
                      <td height="28" colspan="4"><div align="left"><span class="style14">B. QUALIFICATIONS</font><font color="#FF0000"></span><span class="style13">*
                      </span> </div>
                        <br />
                        <table width="100%" border="1" bordercolor="#003300"  >
                        <tr>
                        <td><table width="100%" border="0">
                          <tr>
                            <td colspan="4">&nbsp;</td>
                            </tr>
                          <tr>
                            <td width="3%" rowspan="4" valign="top"><font class="style25">1.</font></td>
                            <td width="23%"><font class="style25"><b>Qualification</b></font></td>
                            <td width="28%"><font class="style25"><b>Subject Area</b></font></td>
                            <td width="46%"><font class="style25"><b>Date</b></font></td>
                          </tr>
                          <tr>
                            <td><div align="left" class="style22">
                              <?php
									$sqlcObtQualId = "SELECT cObtQualId, vObtQualTitle FROM obtainablequal ORDER BY vObtQualTitle";
									$rssqlcObtQualId = mysql_query($sqlcObtQualId, connect_server()) or die(mysql_error());?>
                              <select name="qual_1">
                                <option value="" selected="selected"></option>
                                <?php
										while ($r_rssqlcObtQualId = mysql_fetch_array($rssqlcObtQualId))
										{?>
                                <option value="<?php echo $r_rssqlcObtQualId[0]; ?>"<?php
											if (isset($r_sqlql_rec['qual_1']))
											{
												if ($r_rssqlcObtQualId['cObtQualId'] == $r_sqlql_rec['qual_1']){echo ' selected';}
											}elseif (isset($_REQUEST['qual_1']))
											{
												if ($r_rssqlcObtQualId['cObtQualId'] == $_REQUEST['qual_1']){echo ' selected';}
											}?>><?php echo $r_rssqlcObtQualId['vObtQualTitle'] ?></option>
                                <?php
										}?>
                              </select>
                            </div></td>
                            <td><div align="left" class="style22">
                              <?php
										$sqlcQualSubjectId = "SELECT * FROM qualsubject ORDER BY vQualSubjectDesc";
										$rssqlcQualSubjectId = mysql_query($sqlcQualSubjectId, connect_server()) or die(mysql_error());?>
                              <select name="subject_1">
                                <option value="" selected="selected"></option>
                                <?php
											while ($r_rssqlcQualSubjectId = mysql_fetch_array($rssqlcQualSubjectId))
											{?>
                                <option value="<?php echo $r_rssqlcQualSubjectId[0]; ?>"<?php 
												if (isset($r_sqlql_rec['subject_1']))
												{
													if ($r_rssqlcQualSubjectId['cQualSubjectId'] == $r_sqlql_rec['subject_1']){echo ' selected';}
												}elseif (isset($_REQUEST['subject_1']))
												{
													if ($r_rssqlcQualSubjectId['cQualSubjectId'] == $_REQUEST['subject_1']){echo ' selected';}
												}?>><?php echo ucwords(strtolower($r_rssqlcQualSubjectId[1]));?></option>
                                <?php
											}?>
                              </select>
                            </div></td>
                            <td><div align="left" class="style22">
                              <select name="dday1" onchange="date_1.value=dday1.value+'-'+mmonth1.value+'-'+yyear1.value;/*mdchng.value=1*/">
                                <option value="" selected="selected">dd</option>
                                <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                                <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['date_1']) && substr($_REQUEST['date_1'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_1']) && substr($r_rssqcemba_rec['date_1'],8,2) == $f){echo ' selected';}?>>
                                <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                </option>
                                <?php
													}?>
                              </select>
                              <select name="mmonth1" onchange="date_1.value=dday1.value+'-'+mmonth1.value+'-'+yyear1.value;/*mdchng.value=1*/">
                                <option value="" selected="selected">mm</option>
                                <?php
													for ($f = 1; $f <= 12; $f++)
													{?>
                                <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['date_1']) && substr($_REQUEST['date_1'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_1']) && substr($r_rssqcemba_rec['date_1'],5,2) == $f){echo ' selected';}?>>
                                <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                </option>
                                <?php
													}?>
                              </select>
                              <select name="yyear1" onchange="date_1.value=dday1.value+'-'+mmonth1.value+'-'+yyear1.value;/* alert(date_1.value); */">
                                <option value="" selected="selected">yyyy</option>
                                <?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
                                <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['date_1']) && substr($_REQUEST['date_1'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_1']) && substr($r_rssqcemba_rec['date_1'],0,4) == $f){echo ' selected';}?>>
                                <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                </option>
                                <?php
													}?>
                              </select>
                              <input name="date_1" type="hidden" value="<?php if(isset($_REQUEST['date_1'])){echo $_REQUEST['date_1'];}
												elseif(isset($r_rssqcemba_rec['date_1'])){echo $r_rssqcemba_rec['date_1'];}?>" />
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="left" class="style25"><strong>School Attended</strong></div></td>
                            <td><div align="left" class="style25"><strong>Matric. No.</strong></div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="left" class="style22">
                              <input name="school_1" type="text" value="<?php if(isset($r_sqlql_rec['school_1'])){echo   stripslashes($r_sqlql_rec['school_1']);}elseif(isset($_REQUEST['school_1'])){echo stripslashes($_REQUEST['school_1']);} ?>"size="50" />
                            </div></td>
                            <td><div align="left" class="style22"><input name="mat_1" type="text" value="<?php if(isset($r_sqlql_rec['mat_1'])){echo   stripslashes($r_sqlql_rec['mat_1']);}elseif(isset($_REQUEST['mat_1'])){echo stripslashes($_REQUEST['mat_1']);} ?>"size="19" /></div></td></tr>
                        </table></td>
                      </tr></table>                        </td>
                    </tr>
                    <tr>
                      <td height="28" colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" colspan="4"><table width="100%" border="1" bordercolor="#003300"  >
                        <tr>
                          <td class="style22"><table width="100%" border="0">

                              <tr>
                                <td width="3%" rowspan="4" valign="top">2.</td>
                                <td width="23%"><font class="style11"><b>Qualification</b></font></td>
                                <td width="38%"><font class="style11"><b>Subject Area</b></font></td>
                                <td width="36%"><b>Date</b></td>
                              </tr>
                              <tr>
                                <td><div align="left">
                                    <?php
									$sqlcObtQualId = "SELECT cObtQualId, vObtQualTitle FROM obtainablequal ORDER BY vObtQualTitle";
									$rssqlcObtQualId = mysql_query($sqlcObtQualId, connect_server()) or die(mysql_error());?>
                                    <select name="qual_2">
                                      <option value="" selected="selected"></option>
                                      <?php
										while ($r_rssqlcObtQualId = mysql_fetch_array($rssqlcObtQualId))
										{?>
                                      <option value="<?php echo $r_rssqlcObtQualId[0]; ?>"<?php
											if (isset($r_sqlql_rec['qual_2']))
											{
												if ($r_rssqlcObtQualId['cObtQualId'] == $r_sqlql_rec['qual_2']){echo ' selected';}
											}elseif (isset($_REQUEST['qual_2']))
											{
												if ($r_rssqlcObtQualId['cObtQualId'] == $_REQUEST['qual_2']){echo ' selected';}
											}?>><?php echo $r_rssqlcObtQualId['vObtQualTitle'] ?></option>
                                      <?php
										}?>
                                    </select>
                                </div></td>
                                <td><div align="left">
                                    <?php
										$sqlcQualSubjectId = "SELECT * FROM qualsubject ORDER BY vQualSubjectDesc";
										$rssqlcQualSubjectId = mysql_query($sqlcQualSubjectId, connect_server()) or die(mysql_error());?><select name="subject_2">
                                      <option value="" selected="selected"></option>
                                      <?php
											while ($r_rssqlcQualSubjectId = mysql_fetch_array($rssqlcQualSubjectId))
											{?>
                                      <option value="<?php echo $r_rssqlcQualSubjectId[0]; ?>"<?php 
												if (isset($r_sqlql_rec['subject_2']))
												{
													if ($r_rssqlcQualSubjectId['cQualSubjectId'] == $r_sqlql_rec['subject_2']){echo ' selected';}
												}elseif (isset($_REQUEST['subject_2']))
												{
													if ($r_rssqlcQualSubjectId['cQualSubjectId'] == $_REQUEST['subject_2']){echo ' selected';}
												}?>><?php echo ucwords(strtolower($r_rssqlcQualSubjectId[1]));?></option>
                                      <?php
											}?>
                                    </select>
                                </div></td>
                                <td><div align="left">
                                    <select name="dday2" onchange="date_2.value=dday2.value+'-'+mmonth2.value+'-'+yyear2.value;/*mdchng.value=1*/">
                                      <option value="" selected="selected">dd</option>
                                      <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                                      <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['date_2']) && substr($_REQUEST['date_2'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_2']) && substr($r_rssqcemba_rec['date_2'],8,2) == $f){echo ' selected';}?>>
                                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                      </option>
                                      <?php
													}?>
                                    </select>
                                    <select name="mmonth2" onchange="date_2.value=dday2.value+'-'+mmonth2.value+'-'+yyear2.value;/*mdchng.value=1*/">
                                      <option value="" selected="selected">mm</option>
                                      <?php
													for ($f = 1; $f <= 12; $f++)
													{?>
                                      <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['date_2']) && substr($_REQUEST['date_2'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_2']) && substr($r_rssqcemba_rec['date_2'],5,2) == $f){echo ' selected';}?>>
                                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                      </option>
                                      <?php
													}?>
                                    </select>
                                    <select name="yyear2" onchange="date_2.value=dday2.value+'-'+mmonth2.value+'-'+yyear2.value;/* alert(date_2.value); */">
                                      <option value="" selected="selected">yyyy</option>
                                      <?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
                                      <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['date_2']) && substr($_REQUEST['date_2'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_2']) && substr($r_rssqcemba_rec['date_2'],0,4) == $f){echo ' selected';}?>>
                                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                      </option>
                                      <?php
													}?>
                                    </select>
                                    <input name="date_2" type="hidden" value="<?php if(isset($_REQUEST['date_2'])){echo $_REQUEST['date_2'];}
												elseif(isset($r_rssqcemba_rec['date_2'])){echo $r_rssqcemba_rec['date_2'];}?>" />
                                </div></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left"><strong>School Attended</strong></div></td>
                                <td><div align="left"><strong>Matric. No.</strong></div></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left">
                                    <input name="school_2" type="text" value="<?php if(isset($r_sqlql_rec['school_2'])){echo   stripslashes($r_sqlql_rec['school_2']);}elseif(isset($_REQUEST['school_2'])){echo stripslashes($_REQUEST['school_2']);} ?>"size="50" />
                                </div></td>
                                <td><div align="left">
                      <input name="mat_2" type="text" value="<?php if(isset($r_sqlql_rec['mat_2'])){echo   stripslashes($r_sqlql_rec['mat_2']);}elseif(isset($_REQUEST['mat_2'])){echo stripslashes($_REQUEST['mat_2']);} ?>"size="19" />
                                </div></td>
                              </tr>
                          </table></td>
                        </tr>
                      </table></td>
                      </tr>
                    <tr>
                      <td height="28" colspan="4">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="28" colspan="4"><table width="100%" border="1" bordercolor="#003300"  >
                        <tr>
                          <td class="style22"><table width="100%" border="0">
                              <tr>
                                <td width="3%" rowspan="4" valign="top">3.</td>
                                <td width="23%"><b>Qualification</b></td>
                                <td width="38%"><b>Subject Area</b></td>
                                <td width="36%"><b>Date</b></td>
                              </tr>
                              <tr>
                                <td><div align="left">
                                    <?php
									$sqlcObtQualId = "SELECT cObtQualId, vObtQualTitle FROM obtainablequal ORDER BY vObtQualTitle";
									$rssqlcObtQualId = mysql_query($sqlcObtQualId, connect_server()) or die(mysql_error());?>
                                    <select name="qual_3">
                                      <option value="" selected="selected"></option>
                                      <?php
										while ($r_rssqlcObtQualId = mysql_fetch_array($rssqlcObtQualId))
										{?>
                                      <option value="<?php echo $r_rssqlcObtQualId[0]; ?>"<?php
											if (isset($r_sqlql_rec['qual_3']))
											{
												if ($r_rssqlcObtQualId['cObtQualId'] == $r_sqlql_rec['qual_3']){echo ' selected';}
											}elseif (isset($_REQUEST['qual_3']))
											{
												if ($r_rssqlcObtQualId['cObtQualId'] == $_REQUEST['qual_3']){echo ' selected';}
											}?>><?php echo $r_rssqlcObtQualId['vObtQualTitle'] ?></option>
                                      <?php
										}?>
                                    </select>
                                </div></td>
                                <td><div align="left">
                                    <?php
										$sqlcQualSubjectId = "SELECT * FROM qualsubject ORDER BY vQualSubjectDesc";
										$rssqlcQualSubjectId = mysql_query($sqlcQualSubjectId, connect_server()) or die(mysql_error());?>
                                    <select name="subject_3">
                                      <option value="" selected="selected"></option>
                                      <?php
											while ($r_rssqlcQualSubjectId = mysql_fetch_array($rssqlcQualSubjectId))
											{?>
                                      <option value="<?php echo $r_rssqlcQualSubjectId[0]; ?>"<?php 
												if (isset($r_sqlql_rec['subject_3']))
												{
													if ($r_rssqlcQualSubjectId['cQualSubjectId'] == $r_sqlql_rec['subject_3']){echo ' selected';}
												}elseif (isset($_REQUEST['subject_3']))
												{
													if ($r_rssqlcQualSubjectId['cQualSubjectId'] == $_REQUEST['subject_3']){echo ' selected';}
												}?>><?php echo ucwords(strtolower($r_rssqlcQualSubjectId[1]));?></option>
                                      <?php
											}?>
                                    </select>
                                </div></td>
                                <td><div align="left">
                                    <select name="dday3" onchange="date_3.value=dday3.value+'-'+mmonth3.value+'-'+yyear3.value;/*mdchng.value=1*/">
                                      <option value="" selected="selected">dd</option>
                                      <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                                      <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['date_3']) && substr($_REQUEST['date_3'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_3']) && substr($r_rssqcemba_rec['date_3'],8,2) == $f){echo ' selected';}?>>
                                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                      </option>
                                      <?php
													}?>
                                    </select>
                                    <select name="mmonth3" onchange="date_3.value=dday3.value+'-'+mmonth3.value+'-'+yyear3.value;/*mdchng.value=1*/">
                                      <option value="" selected="selected">mm</option>
                                      <?php
													for ($f = 1; $f <= 12; $f++)
													{?>
                                      <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['date_3']) && substr($_REQUEST['date_3'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_3']) && substr($r_rssqcemba_rec['date_3'],5,2) == $f){echo ' selected';}?>>
                                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                      </option>
                                      <?php
													}?>
                                    </select>
                                    <select name="yyear3" onchange="date_3.value=dday3.value+'-'+mmonth3.value+'-'+yyear3.value;/* alert(date_3.value); */">
                                      <option value="" selected="selected">yyyy</option>
                                      <?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
                                      <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['date_3']) && substr($_REQUEST['date_3'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['date_3']) && substr($r_rssqcemba_rec['date_3'],0,4) == $f){echo ' selected';}?>>
                                      <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                                      </option>
                                      <?php
													}?>
                                    </select>
                                    <input name="date_3" type="hidden" value="<?php if(isset($_REQUEST['date_3'])){echo $_REQUEST['date_3'];}
												elseif(isset($r_rssqcemba_rec['date_3'])){echo $r_rssqcemba_rec['date_3'];}?>" />
                                </div></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left"><strong>School Attended</strong></div></td>
                                <td><div align="left"><strong>Matric. No</strong>.</div></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left">
                                    <input name="school_3" type="text" value="<?php if(isset($r_sqlql_rec['school_3'])){echo   stripslashes($r_sqlql_rec['school_3']);}elseif(isset($_REQUEST['school_3'])){echo stripslashes($_REQUEST['school_3']);} ?>"size="50" />
                                </div></td>
                                <td><div align="left">
                                    <input name="mat_3" type="text" value="<?php if(isset($r_sqlql_rec['mat_3'])){echo   stripslashes($r_sqlql_rec['mat_3']);}elseif(isset($_REQUEST['mat_3'])){echo stripslashes($_REQUEST['mat_3']);} ?>"size="19" />
                                </div></td>
                              </tr>
                          </table></td>
                        </tr>
                      </table></td>
                      </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="3%" height="28"><span class="style22">4.</span></td>
                      <td width="37%"><div align="left" class="style22"><strong>Others </strong></div></td>
                      <td width="24%" class="style20"><div align="left" class="style22">Subject</div></td>
                      <td width="36%"><div align="left" class="style22"><strong>Date</strong></div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="o_qual" type="text" value="<?php if(isset($r_rssqcemba_rec['o_qual'])){echo stripslashes($r_rssqcemba_rec['o_qual']);}
									elseif(isset($_REQUEST['o_qual'])){echo stripslashes($_REQUEST['o_qual']);} ?>" size="40" /></td>
                      <td><div align="left" class="style22">
                        <input name="o_subject" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['o_subject'])){echo stripslashes($r_rssqcemba_rec['o_subject']);}
									elseif(isset($_REQUEST['o_subject'])){echo stripslashes($_REQUEST['o_subject']);} ?>" />
                      </div></td>
                      <td><div align="left" class="style22">
                        <select name="dday4" onchange="o_date.value=dday4.value+'-'+mmonth4.value+'-'+yyear4.value;/*mdchng.value=1*/">
                          <option value="" selected="selected">dd</option>
                          <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['o_date']) && substr($_REQUEST['o_date'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['o_date']) && substr($r_rssqcemba_rec['o_date'],8,2) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>
                        <select name="mmonth4" onchange="o_date.value=dday4.value+'-'+mmonth4.value+'-'+yyear4.value;/*mdchng.value=1*/">
                          <option value="" selected="selected">mm</option>
                          <?php
													for ($f = 1; $f <= 12; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['o_date']) && substr($_REQUEST['o_date'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['o_date']) && substr($r_rssqcemba_rec['o_date'],5,2) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>
                        <select name="yyear4" onchange="o_date.value=dday4.value+'-'+mmonth4.value+'-'+yyear4.value;/* alert(o_date.value); */">
                          <option value="" selected="selected">yyyy</option>
                          <?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['o_date']) && substr($_REQUEST['o_date'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['o_date']) && substr($r_rssqcemba_rec['o_date'],0,4) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>
                        <input name="o_date" type="hidden" value="<?php if(isset($_REQUEST['o_date'])){echo $_REQUEST['o_date'];}
												elseif(isset($r_rssqcemba_rec['o_date'])){echo $r_rssqcemba_rec['o_date'];}?>" />
                      </div></td>
                    </tr>
                    
                    <tr>
                      <td colspan="4">&nbsp;</td>
                      </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>
        <p class="style14">5.WORK EXPERIENCE </p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>
                    <tr bgcolor="#d3eed0">
                      <td colspan="5" bgcolor="#279654"><div align="left" class="style14">&nbsp;</div></td>
                    </tr>
                    <tr>
                      <td width="1%">&nbsp;</td>
                      <td width="24%" align="left" valign="top"><div align="left" class="style22">Employer's Type </div></td>
                      <td colspan="3"><div align="left">
                        <select name="emp_type">
                    <option value="" selected="selected"></option>
                          <option value="<?php if(isset($r_rssqcemba_rec['emp_type'])){echo stripslashes($r_rssqcemba_rec['emp_type']);}
				elseif(isset($_REQUEST['emp_type'])){echo stripslashes($_REQUEST['emp_type']);} ?>" selected="selected"></option>
                          <option value="Public" <?php if(isset($_REQUEST['emp_type']) && $_REQUEST['emp_type'] == 'emp_type'){echo ' selected';}elseif(isset($r_rssqcemba_rec['emp_type']) && $r_rssqcemba_rec['emp_type'] == 'Public'){echo ' selected';} ?>>Public</option>
                          <option value="Private"<?php if(isset($_REQUEST['emp_type']) && $_REQUEST['emp_type'] == 'Private'){echo ' selected';}elseif(isset($r_rssqcemba_rec['emp_type']) && $r_rssqcemba_rec['emp_type'] == 'Private'){echo ' selected';} ?>>Private</option>
                        </select>
                      </div></td>
                      </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Employer's Name </div></td>
                      <td width="37%"><div align="left">
                        <input name="emp_name" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['emp_name'])){echo stripslashes($r_rssqcemba_rec['emp_name']);}
									elseif(isset($_REQUEST['emp_name'])){echo stripslashes($_REQUEST['emp_name']);} ?>" />
                      </div></td>
                      <td width="17%"><div align="left">Rank/Job</div></td>
                      <td width="21%"><input name="emp_rank" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['emp_rank'])){echo stripslashes($r_rssqcemba_rec['emp_rank']);}
									elseif(isset($_REQUEST['emp_rank'])){echo stripslashes($_REQUEST['emp_rank']);} ?>" /></td>
                    </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Date Employed </div></td>
                      <td colspan="3"><div align="left">
                        <select name="dday5" onchange="doe.value=dday5.value+'-'+mmonth5.value+'-'+yyear5.value;/*mdchng.value=1*/">
                          <option value="" selected="selected">dd</option>
                          <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['doe']) && substr($_REQUEST['doe'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['doe']) && substr($r_rssqcemba_rec['doe'],8,2) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>
                        <select name="mmonth5" onchange="doe.value=dday5.value+'-'+mmonth5.value+'-'+yyear5.value;/*mdchng.value=1*/">
                          <option value="" selected="selected">mm</option>
                          <?php
													for ($f = 1; $f <= 12; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['doe']) && substr($_REQUEST['doe'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['doe']) && substr($r_rssqcemba_rec['doe'],5,2) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>
                        <select name="yyear5" onchange="doe.value=dday5.value+'-'+mmonth5.value+'-'+yyear5.value;/* alert(doe.value); */">
                          <option value="" selected="selected">yyyy</option>
                          <?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['doe']) && substr($_REQUEST['doe'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['doe']) && substr($r_rssqcemba_rec['doe'],0,4) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>
                        <input name="doe" type="hidden" value="<?php if(isset($_REQUEST['doe'])){echo $_REQUEST['doe'];}
												elseif(isset($r_rssqcemba_rec['doe'])){echo $r_rssqcemba_rec['doe'];}?>" />
                      </div></td>
                    </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left" class="style22">Employer's Address </div></td>
                      <td colspan="3"><div align="left">
                          <textarea name="emp_add" cols="50" rows="3"><?php if(isset($r_rssqcemba_rec['emp_add'])){echo stripslashes
						  ($r_rssqcemba_rec['emp_add']);}elseif(isset($_REQUEST['emp_add'])){echo stripslashes($_REQUEST['emp_add']);} ?></textarea>
                      </div></td>
                      </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left" class="style22">Position </div></td>
                      <td><input name="emp_position" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['emp_position'])){echo stripslashes($r_rssqcemba_rec['emp_position']);}
									elseif(isset($_REQUEST['emp_position'])){echo stripslashes($_REQUEST['emp_position']);} ?>" /></td>
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, Tahoma">Staff  ID </font></div></td>
                      <td><div align="left">
                        <input name="emp_id" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['emp_id'])){echo stripslashes($r_rssqcemba_rec['emp_id']);}
									elseif(isset($_REQUEST['emp_id'])){echo stripslashes($_REQUEST['emp_id']);} ?>" />
                      </div></td>
                    </tr>
                  </tbody>
              </table>
                <div align="left">
                  <p><span class="style14"><br />
                    OTHER RELEVANT EXPERIENCE</span>                  <br />
                    <br />
                    <span class="style13">Please indicate any other type of experience,other than work that you consider pertinent to the admission.  It can be publication,research,intellectual or professional contributions.                <br />
                    </span></p>
                  </div>
                <table width="100%" border="0">
                  <tr>
                    <td width="2%">&nbsp;</td>
                    <td width="21%" valign="top"><div align="left">Other Experience </div></td>
                    <td width="77%"><div align="left">
<textarea name="votherexp" cols="50" rows="3"><?php if(isset($r_rssqcemba_rec['votherexp'])){echo stripslashes
($r_rssqcemba_rec['votherexp']);}elseif(isset($_REQUEST['votherexp'])){echo stripslashes($_REQUEST['votherexp']);}?>
</textarea>
                    </div></td>
                    </tr>
                </table>                <p></td>
            </tr>
          </tbody>
        </table>
        <p class="style14">6. DECLARATION BY APPLICANT</p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>
                    <tr bgcolor="#d3eed0">
                      <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    
                    <tr>
                      <td width="5%" height="28" align="center" valign="top">
                        <label>
							<input name="decl" type="checkbox"  value="1" 
																	<?php  /*if(isset($r_rssqlcemba_rec['decl'])){echo 'checked';}
																elseif(isset($_REQUEST['decl'])){echo 'checked';} */ ?> 								
							<?php if(isset($_REQUEST['decl']) && $_REQUEST['decl'] == '1'){echo ' selected';}elseif(isset($r_rssqcemba_rec['decl']) && $r_rssqcemba_rec['decl'] == '1'){echo ' selected';} ?>/>
                        </label></td>
                      <td width="95%" colspan="3" align="left" valign="top"><div align="left" class="style13"><font size="2" face="Verdana, Arial, Helvetica, Tahoma" class="style19">I  declare that I have read and understood the conditions of eligibility for the programme for which i seek admission and fulfill the minimum criteria .In the event of any information being found incorrect or misleading,my candidature shall be liable to cancellation by the university at anytime and shall not be entitled to any claim for admission. </div></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>        
        <br />
        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" bordercolor="#279654">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>  <tr>
                      <td width="27%"><div align="left">Date of submission<span class="style13">*</span></div></td>
                      <td width="35%"><div align="left">
											
											
                        <select name="dday5" onchange="dos.value=dday5.value+'-'+mmonth5.value+'-'+yyear5.value;/*mdchng.value=1*/">
                          <option value="" selected>dd</option>
                          <?php
													for ($f = 1; $f <= 31; $f++)
													{?>
                          <option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>"<?php 
													if (isset($_REQUEST['dos']) && substr($_REQUEST['dos'],0,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['dos']) && substr($r_rssqcemba_rec['dos'],0,2) == $f){echo ' selected';}?>>
                          <?php if ($f > 9){echo $f;}else{echo '0'.$f;}?>
                          </option>
                          <?php
													}?>
                        </select>												
                        <select name="mmonth5" onChange="dos.value=dday5.value+'-'+mmonth5.value+'-'+yyear5.value;/*mdchng.value=1*/">
													<option value="" selected>mm</option><?php
													for ($f = 1; $f <= 12; $f++)
													{?>
													<option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['dos']) && substr($_REQUEST['dos'],3,2) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['dos']) && substr($r_rssqcemba_rec['dos'],3,2) == $f){echo ' selected';}?>><?php if ($f > 9){echo $f;}else{echo '0'.$f;}?></option><?php
													}?>
							</select>
												<select name="yyear5" onChange="dos.value=dday5.value+'-'+mmonth5.value+'-'+yyear5.value;/* alert(dos.value); */">
													<option value="" selected>yyyy</option><?php
													for ($f = 1949; $f <= substr(comp_date(),6,4) - $lastyr; $f++)
													{?>
													<option value="<?php if ($f > 9){echo $f;}else{echo '0'.$f;} ?>"<?php 
													if (isset($_REQUEST['dos']) && substr($_REQUEST['dos'],6,4) == $f){echo ' selected';}
													elseif (isset($r_rssqcemba_rec['dos']) && substr($r_rssqcemba_rec['dos'],6,4) == $f){echo ' selected';}?>><?php if ($f > 9){echo $f;}else{echo '0'.$f;}?></option><?php
													}?>
												</select>
												<input name="dos" type="hidden" value="<?php if(isset($_REQUEST['dos'])){echo $_REQUEST['dos'];}
                       elseif (isset($r_rssqcemba_rec['dos'])){echo $r_rssqcemba_rec['dos'];}?>">
											  </div></td>
                      <td width="38%"><div align="right">
                        <input name="sbmt2" value="Submit" type="submit" />
                      </div></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>        
        <hr  color="#006633"/>
        <table width="100%" border="0" align="center">
          <tr>
            <td width="33%" valign="top"><div align="left"><strong>For Further Information Pls Contact</strong>: </div></td>
            <td width="67%" align="left" valign="top"><p align="left" class="style19">            Office of the Co-ordinator CEMBA/CEMPA Programmes, School of Business $ Human Resources Management, National Open University of Nigeria, 14/16 Ahmadu Bello way,Victoria Island,Lagos. </p>              </td>
          </tr>
        </table></td>
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
</html><?php 

function v_lidate($val)
{
	
	if (isset($_REQUEST['sbmt2']))
	{
		echo 'called';
		//if ($val == ''){return 'Please select your title';}
	}
	//return '';
}?>
