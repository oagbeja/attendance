<?php 
require_once('includes/enc_dec.php');
require_once('includes/local_lib.php');
require_once('includes/env_set.php');

connect_server();



if (isset($_REQUEST['sbmt2']))
{
	//require_once('CEMVAL.php');
	require_once('kardet2.php');
}

if (isset($_REQUEST['matric_no']))
{
	$sqcemba_rec = "SELECT *
	FROM personal_info
	WHERE matric_no = '".$_REQUEST['matric_no']."'";
	echo $sqcemba_rec;
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
#Layer1 form table tr td table tbody tr td table tbody tr td {
	text-align: left;
}
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
        </em>THE COMMON WEALTH EXECUTIVE  PROGRAMME (CEMBA/CEMPA&nbsp;)&nbsp;&nbsp;</strong> &nbsp; </p>
      </div></td>
      <td width="85"><img src="images/noun_logo.jpg" width="93" height="91" /></td>
    </tr>
    
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#FFFFFF"><hr  color="#006600"/>
        <p align="center">&nbsp;</p>
        <table bgcolor="#FFFFFF" border="0" cellpadding="3" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="67%" align="left"><span class="style14"><font face="Verdana, Arial, Tahoma" size="2">MATRICULATION NO </font></span><font face="Verdana, Arial, Tahoma" size="2"><span class="style11">.: </span></font><font color="#ff0000" face="Verdana, Arial, Tahoma" size="2"><strong></b></strong></font> <font color="#ff0000" face="Verdana, Arial, Tahoma" size="2"><strong>
              <input name="cfmno" type="visible" value="<?php if(isset($r_sformno['matric_no'])){echo stripslashes($r_sformno['matric_no']);}
														elseif(isset($_REQUEST['matric_no'])){echo strtoupper(stripslashes($_REQUEST['matric_no']));}else{echo $formno;} ?>" />
              </strong></font></td>
              <td width="8%" align="left"><span class="style14"><font face="Verdana, Arial, Tahoma" size="2">YEAR  </font></span> </td>
              <td width="25%" align="left"><strong class="style13">2009/2010</strong></td>
            </tr>
          </tbody>
        </table>
        <br />
        <br />
        <span class="style14"> 1. PERSONAL INFORMATION</span> <br />
        <br />
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
									<div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Title</font><font color="#ff0000">*</font> </div></td>
                <td colspan="4"> <div align="left"><?php  echo   $r_ssqlcemat ['titledesc']?> 
					    </div></td>
                <td width="3%" rowspan="11" align="right" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
									<div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Surname</font><font color="#ff0000">*</font> </div></td>
								<td colspan="4">
								  <div align="left">
								   <?php if(isset($r_rssqcemba_rec['vs_name'])){echo stripslashes($r_rssqcemba_rec['vs_name']);}
									elseif(isset($_REQUEST['vs_name'])){echo stripslashes($_REQUEST['vs_name']);} ?>
								  </div></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
									<div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Middle Name</font> <font color="#ff0000">*</font></div></td>
                <td colspan="4">
									<div align="left">
									  <?php if(isset($r_rssqcemba_rec['vs_name'])){echo stripslashes($r_rssqcemba_rec['vs_name']);}
									elseif(isset($_REQUEST['vs_name'])){echo stripslashes($_REQUEST['vs_name']);} ?>
									</div></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Other Names</font></div></td>
                <td colspan="4"><div align="left">
                  <?php if(isset($r_rssqcemba_rec['vm_name'])){echo stripslashes($r_rssqcemba_rec['vm_name']);}
									elseif(isset($_REQUEST['vm_name'])){echo stripslashes($_REQUEST['vm_name']);} ?>
                </div></td>
              </tr>
              <tr bgcolor="#279654">
                <td colspan="6">&nbsp;</td>
                </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td><div align="left">Gender<span class="style13">*</span></div></td>
                <td><div align="left">
                  <?php if(isset($r_rssqcemba_rec['v_sex'])){echo stripslashes($r_rssqcemba_rec['v_sex']);}
				elseif(isset($_REQUEST['v_sex'])){echo stripslashes($_REQUEST['v_sex']);} ?> <?php if(isset($_REQUEST['v_sex']) && $_REQUEST['v_sex'] == 'Male'){echo ' Male';}elseif(isset($r_rssqcemba_rec['v_sex']) && $r_rssqcemba_rec['v_sex'] == 'Male'){echo ' selected';} ?>
                          <?php if(isset($_REQUEST['v_sex']) && $_REQUEST['v_sex'] == 'Female'){echo ' Female';}elseif(isset($r_rssqcemba_rec['v_sex']) && $r_rssqcemba_rec['v_sex'] == 'Female'){echo ' selected';} ?>
                </div></td>
                <td>&nbsp;</td>
                <td><div align="left">Marital Status<span class="style13">*</span></div></td>
                <td><div align="left">
                          <?php if(isset($r_rssqcemba_rec['v_status'])){echo stripslashes($r_rssqcemba_rec['v_status']);}
				elseif(isset($_REQUEST['v_status'])){echo stripslashes($_REQUEST['v_status']);} ?>
                          <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Married'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Married'){echo 'selected';} ?>
                          <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'selected'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Single'){echo ' selected';} ?>
                          <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Divorced'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Divorced'){echo ' selected';} ?>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Date of Birth </font><font color="#ff0000">*</font> </div></td>
                <td colspan="4"><div align="left">
                  <?php if(isset($_REQUEST['dob'])){echo $_REQUEST['dob'];}
												elseif(isset($r_rssqcemba_rec['dob'])){echo formatdate( $r_rssqcemba_rec['dob'],'fromdb');}?>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left">Nationality<font color="#ff0000">*</font></div></td>
                <td width="17%"><div align="left">
                  <?php echo $r_ssqlcemat ['vcountrydesc']?>
                </div></td>
                <td width="10%">&nbsp;</td>
                <td width="21%"><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">State</font> <font size="2" face="Verdana, Arial, Helvetica, Tahoma"><span class="style13">*</span></font></div></td>
                <td width="21%"><div align="left">
                  <?php echo   $r_ssqlcemat ['vStateNamedesc']?>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left">LGA<span class="style13">* </span></div></td>
                <td><div align="left">
                  <?php echo   $r_ssqlcemat ['vLGADesc']?>
                </div></td>
                <td>&nbsp;</td>
                <td><div align="left">Home Town<font color="#ff0000">*</font></div></td>
                <td><div align="left">
                  <?php if(isset($r_rssqcemba_rec['vm_name'])){echo stripslashes($r_rssqcemba_rec['vm_name']);}
									elseif(isset($_REQUEST['vm_name'])){echo stripslashes($_REQUEST['vm_name']);} ?>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Disability</font> </div></td>
                <td><div align="left">
                  <?php if(isset($r_rssqcemba_rec['v_status'])){echo stripslashes($r_rssqcemba_rec['v_status']);}
				elseif(isset($_REQUEST['v_status'])){echo stripslashes($_REQUEST['v_status']);} ?>
                          <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Married'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Married'){echo 'selected';} ?>
                          <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'selected'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Single'){echo ' selected';} ?>
                          <?php if(isset($_REQUEST['v_status']) && $_REQUEST['v_status'] == 'Divorced'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_status']) && $r_rssqcemba_rec['v_status'] == 'Divorced'){echo ' selected';} ?>
                
                </div></td>
                <td>&nbsp;</td>
                <td><div align="left">Others</div></td>
                <td><div align="left"><?php if(isset($r_rssqcemba_rec['vm_name'])){echo stripslashes($r_rssqcemba_rec['vm_name']);}
									elseif(isset($_REQUEST['vm_name'])){echo stripslashes($_REQUEST['vm_name']);} ?></div></td>
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
                      <td width="27%" align="left" valign="top"><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Address</font><font color="#ff0000">*</font> </div></td>
                      <td colspan="4"><div align="left">
                       <?php if(isset($r_rssqcemba_rec['v_address'])){echo stripslashes($r_rssqcemba_rec['v_address']);}
									elseif(isset($_REQUEST['v_address'])){echo stripslashes($_REQUEST['v_address']);} ?>
                       
                      </div></td>
                    </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Town/City</font><font color="#ff0000">*</font> </div></td>
                      <td width="19%"><div align="left">
                      <?php if(isset($r_rssqcemba_rec['v_tcity'])){echo stripslashes($r_rssqcemba_rec['v_tcity']);}
									elseif(isset($_REQUEST['v_tcity'])){echo stripslashes($_REQUEST['v_tcity']);} ?>                      
                      </div></td>
                      <td width="12%">&nbsp;</td>
                      <td width="16%"><div align="left">LGA<span class="style13">* </span></div></td>
                      <td width="25%"><div align="left">
                         <?php echo   $r_ssqlcemat ['vLGADesc']?>
                      </div></td>
                    </tr>
                    
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">State</font> <font size="2" face="Verdana, Arial, Helvetica, Tahoma"><span class="style13">*</span></font></div></td>
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
                         <?php echo   $r_ssqlcemat ['vLGADesc']?>
                      </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left">Phone</div></td>
                      <td colspan="4"><div align="left">
                      <?php if(isset($r_rssqcemba_rec['v_phone'])){echo stripslashes($r_rssqcemba_rec['v_phone']);}
									elseif(isset($_REQUEST['v_phone'])){echo stripslashes($_REQUEST['v_phone']);} ?>
                                    
								
                      </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left">Fax no </div></td>
                      <td colspan="4"><div align="left">
                       <?php if(isset($r_rssqcemba_rec['v_fax'])){echo stripslashes($r_rssqcemba_rec['v_fax']);}
									elseif(isset($_REQUEST['v_fax'])){echo stripslashes($_REQUEST['v_fax']);} ?></div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left">e-Mail Address <font size="2" face="Verdana, Arial, Helvetica, Tahoma"><span class="style13">*</span></font></div></td>
                      <td colspan="4"><div align="left">
                        <?php if(isset($r_rssqcemba_rec['v_email'])){echo stripslashes($r_rssqcemba_rec['v_email']);}
									elseif(isset($_REQUEST['v_email'])){echo stripslashes($_REQUEST['v_email']);} ?>
                      </div></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>
        <p><span class="style14">3. NEXT OF KIN INFORMATION</span></p>
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
                    <td width="23%"><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Title</font><font color="#ff0000">*</font></div></td>
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
                    </div></td>
                  </tr>
                  <tr>
                    <td height="28">&nbsp;</td>
                    <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Surname</font><font color="#ff0000">*</font></div></td>
                    <td><div align="left">
                    <?php if(isset($r_rssqcemba_rec['vs_kname'])){echo stripslashes($r_rssqcemba_rec['vs_kname']);}
									elseif(isset($_REQUEST['vs_kname'])){echo stripslashes($_REQUEST['vs_kname']);} ?>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="28">&nbsp;</td>
                    <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Other Names </font> <font color="#ff0000">*</font></div></td>
                    <td><div align="left">
                      <?php if(isset($r_rssqcemba_rec['vo_kname'])){echo stripslashes($r_rssqcemba_rec['vo_kname']);}
									elseif(isset($_REQUEST['vo_kname'])){echo stripslashes($_REQUEST['vo_kname']);} ?>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="28">&nbsp;</td>
                    <td><div align="left">Relationship<span class="style13">*</span></div></td>
                    <td><div align="left">
                      <select name="v_krelation">
                        <option value="" selected></option>
                        <option value="Male" <?php if(isset($_REQUEST['v_sex']) && $_REQUEST['v_sex'] == 'Male'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_sex']) && $r_rssqcemba_rec['v_sex'] == 'Male'){echo ' selected';} ?>>Male</option>
                        <option value="Female" <?php if(isset($_REQUEST['v_sex']) && $_REQUEST['v_sex'] == 'Female'){echo ' selected';}elseif(isset($r_rssqcemba_rec['v_sex']) && $r_rssqcemba_rec['v_sex'] == 'Female'){echo ' selected';} ?>>Female</option>
                      </select>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="28">&nbsp;</td>
                    <td><div align="left">Phone <span class="style13">*</span></div></td>
                    <td><div align="left">
                     <?php if(isset($r_rssqcemba_rec['v_kphone'])){echo stripslashes($r_rssqcemba_rec['v_kphone']);}
									elseif(isset($_REQUEST['v_kphone'])){echo stripslashes($_REQUEST['v_kphone']);} ?>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="28">&nbsp;</td>
                    <td><div align="left">Fax<font size="2" face="Verdana, Arial, Helvetica, Tahoma"> </font><span class="style13">*</span></div></td>
                    <td><div align="left">
                     <?php if(isset($r_rssqcemba_rec['v_kfax'])){echo stripslashes($r_rssqcemba_rec['v_kfax']);}
									elseif(isset($_REQUEST['v_kfax'])){echo stripslashes($_REQUEST['v_kfax']);} ?>
                    </div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div align="left">e_Mail Address <font size="2"face="Verdana, Arial, Helvetica, Tahoma"><span class="style13">*</span></font></div></td>
                    <br />
                    <td><div align="left">
                    <?php if(isset($r_rssqcemba_rec['kvemail']))
						{echo stripslashes($r_rssqcemba_rec['kvemail']);}
									elseif(isset($_REQUEST['kvemail'])){echo stripslashes($_REQUEST['kvemail']);} ?>
                    </div></td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>
<p class="style14">4. ACADAMICS DETAILS</p>
        <table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#003300">
          <tbody>
            <tr>
              <td align="center"><table border="0" cellpadding="2" cellspacing="2" width="100%">
                  <tbody>
                    <tr bgcolor="#d3eed0">
                      <td colspan="4" bgcolor="#279654"><div align="left" class="style14">&nbsp;</div></td>
                    </tr>
                    <tr>
                      <td colspan="4"><div align="left" class="style14">A.CHOICE OF PROGRAMME AND STUDY CENTRE<font color="#ff0000">*</font></div></td>
                      </tr>
                    <tr>
                      <td height="28" colspan="4"><table width="100%" border="0" align="center">
                        <tr>
                          <td>&nbsp;</td>
                          <td><div align="left"><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Study centre </font></div></td>
                          <td width="71%"><div align="left">
                         <?php if(isset($r_rssqcemba_rec['vvcentre'])){echo stripslashes($r_rssqcemba_rec['vcentre']);}
				elseif(isset($_REQUEST['vvcentre'])){echo stripslashes($_REQUEST['vvcentre']);} ?>
                             <?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Abuja'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vvcentre']) && $r_rssqcemba_rec['vcentre'] == 'Abuja'){echo ' selected';} ?>
                              <?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Lagos'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vcentre']) && $r_rssqcemba_rec['vcentre'] == 'Lagos'){echo ' selected';} ?>
                              <?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Port Harcourt'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vcentre']) && $r_rssqcemba_rec['vcentre'] == 'Port Harcourt'){echo ' selected';} ?>
                            <?php if(isset($_REQUEST['vcentre']) && $_REQUEST['vcentre'] == 'Kaduna'){echo ' selected';}elseif(isset($r_rssqcemba_rec['vcentre']) && $r_rssqcemba_rec['vcentre'] == 'Kaduna'){echo ' selected';} ?>
                     
                          </div></td>
                          </tr>
                        <tr>
                          <td width="4%">&nbsp;</td>
                          <td width="25%"><div align="left">Programme</div></td>
                          <td><div align="left">
                          <?php if(isset($r_rssqcemba_rec['programme'])){echo stripslashes($r_rssqcemba_rec['programme']);}
				elseif(isset($_REQUEST['programme'])){echo stripslashes($_REQUEST['programme']);} ?>
                             <?php if(isset($_REQUEST['programme']) && $_REQUEST['programme'] == 'programme'){echo ' selected';}elseif(isset($r_rssqcemba_rec['programme']) && $r_rssqcemba_rec['programme'] == 'CEMBA'){echo ' selected';} ?>
                              <?php if(isset($_REQUEST['programme']) && $_REQUEST['programme'] == 'CEMPA'){echo ' selected';}elseif(isset($r_rssqcemba_rec['programme']) && $r_rssqcemba_rec['programme'] == 'CEMPA'){echo ' selected';} ?>
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
                            <td width="3%" rowspan="4" valign="top"><font size="2" face="Verdana, Arial, Tahoma" class="style11">1.</font></td>
                            <td width="23%"><font size="2" face="Verdana, Arial, Tahoma" class="style11"><b>Qualification</b></font></td>
                            <td width="28%"><font size="2" face="Verdana, Arial, Tahoma" class="style11"><b>Subject Area</b></font></td>
                            <td width="46%"><font size="2" face="Verdana, Arial, Tahoma" class="style11"><b>Date</b></font></td>
                          </tr>
                          <tr>
                            <td><div align="left">
                              <?php
									  echo $sqlcObtQualId ['vObtQualTitle'];
									?>
                            </div></td>
                            <td><div align="left">
                              <?php
										 echo $sqlcObtQualId ['vQualSubjectDesc'];
										?>
                            </div></td>
                            <td><div align="left"><div align="left">
                  <?php if(isset($_REQUEST['date_1'])){echo $_REQUEST['date_1'];}
												elseif(isset($r_rssqcemba_rec['date_1'])){echo formatdate( $r_rssqcemba_rec['date_1'],'fromdb');}?>
                </div>
             
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="left" class="style11"><strong>School Attended</strong></div></td>
                            <td><div align="left" class="style11"><strong>Matric no</strong></div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="left">
                              <?php if(isset($r_sqlql_rec['school_1'])){echo   stripslashes($r_sqlql_rec['school_1']);}
									elseif(isset($_REQUEST['school_1'])){echo stripslashes($_REQUEST['school_1']);} ?>
                                                    </div></td>
                            <td><div align="left">
                             <?php if(isset($r_sqlql_rec['mat_1'])){echo   stripslashes($r_sqlql_rec['mat_1']);}
									elseif(isset($_REQUEST['mat_1'])){echo stripslashes($_REQUEST['mat_1']);} ?>
                                                    </div></td>
                          </tr>
                        </table></td>
                      </tr></table>                        </td>
                    </tr>
                    <tr>
                      <td height="28" colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" colspan="4"><table width="100%" border="1" bordercolor="#003300"  >
                        <tr>
                          <td><table width="100%" border="0">

                              <tr>
                                <td width="3%" rowspan="4" valign="top"><font size="2" face="Verdana, Arial, Tahoma">2.</font></td>
                                <td width="23%"><font size="2" face="Verdana, Arial, Tahoma" class="style11"><b>Qualification</b></font></td>
                                <td width="38%"><font size="2" face="Verdana, Arial, Tahoma" class="style11"><b>Subject Area</b></font></td>
                                <td width="36%"><font size="2" face="Verdana, Arial, Tahoma"><b>Date</b></font></td>
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
										$rssqlcQualSubjectId = mysql_query($sqlcQualSubjectId, connect_server()) or die(mysql_error());?>
                                    <select name="subject_2">
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
                                <td colspan="2"><div align="left"><strong>School Attended</strong> </div></td>
                                <td><div align="left"><strong>Matric no</strong></div></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left">
                                    <input name="school_2" type="text" value="<?php if(isset($r_sqlql_rec['school_2'])){echo   stripslashes($r_sqlql_rec['school_2']);}
									elseif(isset($_REQUEST['school_2'])){echo stripslashes($_REQUEST['school_2']);} ?>
                          " size="50" />
                                </div></td>
                                <td><div align="left">
                      <input name="mat_2" type="text" value="<?php if(isset($r_sqlql_rec['mat_2'])){echo   stripslashes($r_sqlql_rec['mat_2']);}
									elseif(isset($_REQUEST['mat_2'])){echo stripslashes($_REQUEST['mat_2']);} ?>
                          " size="19" />
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
                          <td><table width="100%" border="0">
                              <tr>
                                <td width="5%" rowspan="4" valign="top"><font size="2" face="Verdana, Arial, Tahoma">3.</font></td>
                                <td width="21%"><font size="2" face="Verdana, Arial, Tahoma"><b>Qualification</b></font></td>
                                <td width="38%"><font size="2" face="Verdana, Arial, Tahoma"><b>Subject Area</b></font></td>
                                <td width="36%"><font size="2" face="Verdana, Arial, Tahoma"><b>Date</b></font></td>
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
                                <td><div align="left"><strong>Matric no</strong></div></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left">
                                    <input name="school_3" type="text" value="<?php if(isset($r_sqlql_rec['school_3'])){echo   stripslashes($r_sqlql_rec['school_3']);}
									elseif(isset($_REQUEST['school_3'])){echo stripslashes($_REQUEST['school_3']);} ?>
                          " size="50" />
                                </div></td>
                                <td><div align="left">
                                    <input name="mat_3" type="text" value="<?php if(isset($r_sqlql_rec['mat_3'])){echo   stripslashes($r_sqlql_rec['mat_3']);}
									elseif(isset($_REQUEST['mat_3'])){echo stripslashes($_REQUEST['mat_3']);} ?>
                          " size="19" />
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
                      <td width="3%" height="28">4.</td>
                      <td width="37%"><div align="left"><strong><font face="Verdana, Arial, Helvetica, Tahoma" size="2">Other </font></strong></div></td>
                      <td width="24%" class="style20"><div align="left">Subject</div></td>
                      <td width="36%"><div align="left"><strong>Date</strong></div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="o_qual" type="text" size="40" value="<?php if(isset($r_rssqcemba_rec['o_qual'])){echo stripslashes($r_rssqcemba_rec['o_qual']);}
									elseif(isset($_REQUEST['o_qual'])){echo stripslashes($_REQUEST['o_qual']);} ?>" /></td>
                      <td><div align="left">
                        <input name="o_subject" type="text" size="20" value="<?php if(isset($r_rssqcemba_rec['o_subject'])){echo stripslashes($r_rssqcemba_rec['o_subject']);}
									elseif(isset($_REQUEST['o_subject'])){echo stripslashes($_REQUEST['o_subject']);} ?>" />
                      </div></td>
                      <td><div align="left">
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
                      <td width="24%" align="left" valign="top"><div align="left">Employer's Type </div></td>
                      <td colspan="3"><div align="left">
<textarea name="emp_type" cols="30"><?php if(isset($r_rssqcemba_rec['emp_type'])){echo stripslashes
		($r_rssqcemba_rec['emp_type']);}elseif(isset($_REQUEST['emp_type'])){echo stripslashes($_REQUEST['emp_type']);}?></textarea>
                      </div></td>
                      </tr>
                    <tr>
                      <td height="28">&nbsp;</td>
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, Tahoma">Employer's Name </font></div></td>
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
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, Tahoma">Employer's Address </font></div></td>
                      <td colspan="3"><div align="left">
                          <textarea name="emp_add" cols="50" rows="3"><?php if(isset($r_rssqcemba_rec['emp_add'])){echo stripslashes
						  ($r_rssqcemba_rec['emp_add']);}elseif(isset($_REQUEST['emp_add'])){echo stripslashes($_REQUEST['emp_add']);} ?></textarea>
                      </div></td>
                      </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="left">Position </div></td>
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
                    <span class="style13">Please indicate any other type of experience,other than work that you consider pertinent to admission.  It can be publication,research,intellectual or professional contributions.                <br />
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
        <p class="style14">6. DECLEARATION BY APPLICANT<br />
        </p>
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
                      <td width="95%" colspan="3" align="left" valign="top"><div align="left" class="style13"><font size="2" face="Verdana, Arial, Helvetica, Tahoma" class="style19">I  declare that I have read and understood the conditions of eligibility for the programme for which i seek admission and fulfill the minimum criteria .In the event of any information being fonud incorrect or misleading,my candidature shall be lable to cancelation by the university at anytime and shall not be entilted to any claim for admission. </div></td>
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
                      <td width="38%"><div align="right"></div></td>
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
            <td width="67%" align="left" valign="top"><p align="left" class="style19"> School of Business $ Human Resourses Management,
              Office of the Co-ordinator CEMBA/CEMPA Programmes,NOUN 14/16 Ahmadu Bello way,Victorial Island,Lagos. </p>              </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" background="images/noun_ocl_r5_c1.gif"><hr  color="#006633"/></td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top" bgcolor="#279654"><div align="center" class="style16">&copy;2010 E-learning Unit National open university of Nigeria </div></td>
    </tr>
  </table>
</form>
</div>
</body>
</html>
