<?php
	$sqltmptab = "SELECT *
	FROM tmptab
	WHERE id = $dl and cappno = '".strtoupper($cappno)."'";
	//echo $sqltmptab.'<p>';
	$rssqltmptab = mysql_query($sqltmptab, connect_server()) or die(mysql_error());
	if (mysql_num_rows($rssqltmptab) == 0) 
	{
		echo err_msg('If you want to get back to your form, logout and login again.','Login','','');
	}
	
	if (isset($_REQUEST['vtitle']) && $_REQUEST['vtitle'] == '')
	{
		echo err_msg('Please select title in section A','Error of Omission','','');
	}elseif (isset($_REQUEST['vs_name']) && trim($_REQUEST['vs_name']) == '')
	{
		echo err_msg('Please enter surname in section A','Error of Omission','','');
	}elseif (isset($_REQUEST['vo_name']) && trim($_REQUEST['vo_name']) == '')
	{
		echo err_msg('Please enter other name in section A','Error of Omission','','');
	}elseif (isset($_REQUEST['vrank']) && trim($_REQUEST['vrank']) == '')
	{
		echo err_msg('Please enter value for rank in section A','Error of Omission','','');
	}
	
	if (isset($_REQUEST['vu_addr']) && trim($_REQUEST['vu_addr']) == '')
	{
		echo err_msg('Please enter university or institutional address in section B','Error of Omission','','');
	}elseif (isset($_REQUEST['vemail']) && trim($_REQUEST['vemail']) == '')
	{
		echo err_msg('Please enter e-mail address in section B','Error of Omission','','');
	}elseif (isset($_REQUEST['vphone1']) && trim($_REQUEST['vphone1']) == '')
	{
		echo err_msg('Please enter phone number in section B','Error of Omission','','');
	}
	
	$empty = 1;
	for ($s = 1; $s <= 4; $s++)
	{
		if ($_REQUEST["cObtQualId$s"] <> '' && 
		$_REQUEST["cQualSubjectId$s"] <> '' && $_REQUEST["dqdate$s"] <> '')
		{
			$empty = 0;
		}
		
		if (($_REQUEST["cObtQualId$s"] == '' || $_REQUEST["cQualSubjectId$s"] == '' || 
		$_REQUEST["dqdate$s"] == '') &&
		($_REQUEST["cObtQualId$s"] <> '' || $_REQUEST["cQualSubjectId$s"] <> '' || 
		$_REQUEST["dqdate$s"] <> '' ))
		{
			echo err_msg("Incomplete information in section C, row $s is not allowed","Error of Omission",'','');
		}
	}
	if ($empty == 1){echo err_msg("Please fill at least one row of qualification record in section C","Error of Omission",'','');}
	
	
	
	$empty = 1; $empty2 = 1;
	for ($s = 1; $s <= 4; $s++)
	{
		if ($_REQUEST["ctc_level$s"] <> '' && $_REQUEST["tiyr_expr$s"] <> '')
		{
			$empty = 0;
		}
		
		if (($_REQUEST["ctc_level$s"] == '' || $_REQUEST["tiyr_expr$s"] == '' ) &&
		($_REQUEST["ctc_level$s"] <> '' || $_REQUEST["tiyr_expr$s"] <> ''))
		{
			echo err_msg("Incomplete information in section D, row $s is not allowed","Error of Omission",'','');
		}
		
		if (isset($_REQUEST["caint$s"]))
		{
			$empty2 = 0;
		}
		
	}
	if ($empty == 1){echo err_msg("Please fill at least one row of teaching experience record in section D","Error of Omission",'','');}
	if ($empty2 == 1){echo err_msg("Please indcate area of interest by checking the apprpriate box in section D, row 5","Error of Omission",'','');}
	
	
	
	
	if ((($_REQUEST["ctc_level1"] == $_REQUEST["ctc_level2"] || $_REQUEST["ctc_level1"] == $_REQUEST["ctc_level3"] || $_REQUEST["ctc_level1"] == $_REQUEST["ctc_level4"]) ||
	($_REQUEST["ctc_level2"] == $_REQUEST["ctc_level1"] || $_REQUEST["ctc_level2"] == $_REQUEST["ctc_level3"] || $_REQUEST["ctc_level2"] == $_REQUEST["ctc_level4"]) ||
	($_REQUEST["ctc_level3"] == $_REQUEST["ctc_level1"] || $_REQUEST["ctc_level3"] == $_REQUEST["ctc_level2"] || $_REQUEST["ctc_level3"] == $_REQUEST["ctc_level4"]) ||
	($_REQUEST["ctc_level4"] == $_REQUEST["ctc_level1"] || $_REQUEST["ctc_level4"] == $_REQUEST["ctc_level2"] || $_REQUEST["ctc_level4"] == $_REQUEST["ctc_level3"])) && 
	$_REQUEST["ctc_level1"] <> '' && $_REQUEST["ctc_level3"] <> '' && $_REQUEST["ctc_level3"] <> '' && $_REQUEST["ctc_level4"] <> '') 
	{
		echo err_msg("Repeated selection in section D is not allowed","Error of Repetition",'','');
	}
	
	
	
	if (isset($_REQUEST['codlexpr']) && $_REQUEST['codlexpr'] == '1')
	{
		if (!isset($_REQUEST['cexpras1']) && !isset($_REQUEST['cexpras2']))
		{
			echo err_msg("Please inidicate area of experience in ODL by checking the appropriate box in section E, row 1","Error of Omission",'','');
		}
		
		if (isset($_REQUEST['vinstexpr']) && (trim($_REQUEST['vinstexpr']) == 'which institution? Enter name here') || trim($_REQUEST['vinstexpr']) == '')
		{
			echo err_msg("Please enter name of institution at which ODL experience was gathered in section E, row 1","Error of Omission",'','');
		}
	}
	
	$empty = 1;
	for ($s = 1; $s <= 5; $s++)
	{
		if ((trim($_REQUEST["vttitle$s"]) == '' || trim($_REQUEST["vcthm$s"]) == '' || 
		$_REQUEST["cplctr$s"] == '' || $_REQUEST["ddttr$s"] == '') &&
		(trim($_REQUEST["vttitle$s"]) <> '' || trim($_REQUEST["vcthm$s"]) <> '' || 
		$_REQUEST["cplctr$s"] <> '' || $_REQUEST["ddttr$s"] <> '' ))
		{
			echo err_msg("Incomplete information in section E, row ". ($s+1) ." is not allowed","Error of Omission",'','');
		}
	}
	
	
	
	$empty = 0;
	for ($s = 1; $s <= 3; $s++)
	{
		if (trim($_REQUEST["vrefname$s"]) == '' && trim($_REQUEST["vrefaddr$s"]) == '' && 
		trim($_REQUEST["vrefeml$s"]) == '' && trim($_REQUEST["vrefph$s"]) == '')
		{
			$empty = 1;
		}
		
		if ((trim($_REQUEST["vrefname$s"]) == '' || trim($_REQUEST["vrefaddr$s"]) == '' || 
		trim($_REQUEST["vrefeml$s"]) == '' || trim($_REQUEST["vrefph$s"]) == '') &&
		(trim($_REQUEST["vrefname$s"]) <> '' || trim($_REQUEST["vrefaddr$s"]) <> '' || 
		trim($_REQUEST["vrefeml$s"]) <> '' || trim($_REQUEST["vrefph$s"]) <> '' ))
		{
			echo err_msg("Incomplete information in section F, row $s  is not allowed","Error of Omission",'','');
		}
	}
	if ($empty == 1){echo err_msg("Please fill all the three rows in section F","Error of Omission",'','');}
	
	
	if (isset($_REQUEST['vemail']) && trim($_REQUEST['vemail']) <> '')
	{
		if (chk_mail($_REQUEST['vemail']) <> '')
		{
			echo err_msg(chk_mail($_REQUEST['vemail']). " in section B","Error of eMail address",'','');
		}
	}
	
	
	for ($s = 1; $s <= 3; $s++)
	{
		if (isset($_REQUEST["vrefeml$s"]) && trim($_REQUEST["vrefeml$s"]) <> '')
		{
			if (chk_mail($_REQUEST["vrefeml$s"]) <> '')
			{
				echo err_msg(chk_mail($_REQUEST["vrefeml$s"]). " in section F, row $s","Error of eMail address",'','');
			}
		}
	}
	
	
	
	if (isset($_REQUEST['vphone1']) && !is_numeric($_REQUEST['vphone1']))
	{
		echo err_msg('Please enter a numeric value for phone number 1 in section B','Error of Mismatch','','');
	}if (isset($_REQUEST['vphone2']) && trim($_REQUEST['vphone2']) <> '' && !is_numeric($_REQUEST['vphone2']))
	{
		echo err_msg('Please enter a numeric value for phone number 2 in section B','Error of Mismatch','','');
	}
	
	
	for ($s = 1; $s <= 3; $s++)
	{
		if (isset($_REQUEST["vrefph$s"]) && !is_numeric(trim($_REQUEST["vrefph$s"])))
		{
			echo err_msg("Please enter a numeric value for phone number in section F, row $s","Error of Mismatch",'','');
		}
	}
	
	
	for ($s = 1; $s <= 4; $s++)
	{
		if (improperdate($_REQUEST["dqdate$s"],''))
		{
			echo err_msg("Future date in section C, row $s is not allowed","Date Error",'','');
		}
	}
	
	
	for ($s = 1; $s <= 5; $s++)
	{
		if (improperdate($_REQUEST["ddttr$s"],''))
		{
			echo err_msg("Future date in section E, row ". ($s+1) ." is not allowed","Date Error",'','');
		}
	}
	
	
	
	if (!isset($_REQUEST['decl']))
	{
		echo err_msg('Please check the box in section G to declare validity and correctness of supplied pieces of information','Error of Omission','','');
	}
	
	echo  err_msg('Form successfully submitted','Congratulations','','');
}
	function err_msg($msg, $err_cat,$cappno,$dl)
{?>
<center>
<table width="100%" border="0" cellspacing="5"><?php
if ($err_cat <> 'Congratulations')
{?>
  <tr>
    <td align="center">
			<table width="100%" border="0" cellspacing="0" bordercolor="#006666">
				<tr>
					<td width="100%" align="left">
						<hr color="#FF0000" noshade="noshade" size="3">
						<hr color="#FF0000" noshade="noshade" size="1">
					</td>
					</tr>
			</table>
		</td>
  </tr><?php
	}?>
  <tr>
    <td align="center">
			<table width="60%" border="1" cellspacing="0" bordercolor="#003300">
				<tr bgcolor="#D3EED0">
					<td>
						<font size="2" face="Verdana, Arial, Helvetica, Tahoma">
							<b><?php echo $err_cat; ?></b>
						</font>
					</td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td align="center">
			<table width="60%" border="1" cellspacing="0" bordercolor="#003300">
				<tr>
					<td align="center">
						<font size="2" face="Verdana, Arial, Helvetica, Tahoma" color="#FF0000"><br><br><br><?php
							echo $msg;
						?><br><br><br>
						</font>
					</td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td align="center">
			<table width="60%" border="1" cellspacing="0" bordercolor="#003300">
				<tr bgcolor="#D3EED0">
					<td align="center"><?php
						if ($err_cat <> 'Congratulations'  && !isset($_REQUEST['nap']) && is_bool(strpos($msg, "chance")))
						{?>
							<input name="back" type="button" value="Back" onClick="history.back()"><?php
						}elseif (isset($_REQUEST['nap']) || isset($_REQUEST['lgin']))
						{?>
							
							<form action="advert.php" method="post" enctype="application/x-www-form-urlencoded">
								<input name="dl" type="hidden" value="<?php if(isset($_REQUEST['dl'])){echo $_REQUEST['dl'];}else{echo $dl;} ?>">
								<input name="cappno" type="hidden" value="<?php echo $cappno; ?>"><?php
								if (isset($_REQUEST['nap']))
								{?>
									<input name="nap" type="hidden" value="1"><?php
									
								}
								
								if (!isset($_REQUEST['lgin']))
								{?>
								<input name="ps_bk" type="button" value="Back" onClick="location.href='<?php echo "index.php?bkout=1&cappno=$cappno"; ?>'"><?php
								}?>
								<input name="ps_on" type="submit" value="Ok">
							</form><?php
						}else
						{?>
						<form action="index.php" method="post" enctype="application/x-www-form-urlencoded">
							<input name="dl" type="hidden" value="<?php if(isset($_REQUEST['dl'])){echo $_REQUEST['dl'];}else{echo $dl;} ?>">
							<input name="lgout" type="submit" value="Logout">
							</form><?php
						}?>
					</td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td align="center"><hr color="#FF0000" noshade="noshade" size="3"></td>
  </tr>
</table>
</center><?php
if ($err_cat <> 'Congratulations'){exit();}
}



function chk_mail($tempobj)
{
	if (strpos($tempobj, "@") === false)
	{
		return "The '@' character is missing in the email address";
	}elseif (strpos($tempobj, "@") == 0)
	{
		return "The '@' character cannot begin the email address";
	}else if (strpos($tempobj, "@") == strlen($tempobj)-1)
	{
		return "eMail address cannot end with the '@' character";
	}else if (strpos($tempobj, ".") == strlen($tempobj)-1)
	{
		return "eMail address cannot end with the '.' character, it should be  .something";
	}
	$emailinval = "~`!#$%^&*()+=:;|'{} []|\/?,<>. "; $invalchar = '';
	for ($n = 0; $n < strlen($emailinval)-1; $n++)
	{
		for ($j = 0; $j < strlen($tempobj)-1; $j++)
		{
			if ($tempobj{$j} == $emailinval{$n})
			{
				$invalchar = $tempobj{$j};
				if  ($invalchar == ".")
				{
					if  ($j < strpos($tempobj, "@"))
					{
						$pos = $j + 1;
						return "Please remove the dot character at position ". $pos;
					}
				}else
				{
					return "eMail contains an invalid character: '$invalchar'";
				}
			}
		}
	}
	if (strpos($tempobj, ".") === false)
	{
		return "There should be a dot (.) somewhere after the '@' character";
	}
	return '';
}




function improperdate($dt1,$dt2)
{
	if (trim($dt2) == '')
	{
		$today = getdate();
		$day = '';$mnth = '';$currdate = '';
		if ($today['mon'] < 10 ){$mnth = '0'.$today['mon'];}else{$mnth = $today['mon'];}
		if ($today['mday'] < 10 ){$day = '0'.$today['mday'];}else{$day = $today['mday'];}
		$dt2 = $day.'-'.$mnth.'-'.$today['year'];
	}
	
	return (substr($dt1,6,4) > substr($dt2,6,4)) ||
	((substr($dt1,6,4) == substr($dt2,6,4)) &&
	(substr($dt1,3,2) > substr($dt2,3,2))) ||
	((substr($dt1,6,4) == substr($dt2,6,4)) &&
	(substr($dt1,3,2) == substr($dt2,3,2))
	&& (substr($dt1,0,2) > substr($dt2,0,2)));
}?>