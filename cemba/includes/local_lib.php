<?php
function formatdate($date,$dir)
{
	if ($dir == 'fromdb')
	{
		if ($date == ''){return '00-00-0000';}
		return substr($date,8,2) . '-' . substr($date,5,2) . '-' . substr($date,0,4);
	}else if ($dir == 'todb')
	{
		if ($date == ''){return '0000-00-00';}
		return substr($date,6,4) . '-' . substr($date,3,2) . '-' . substr($date,0,2);
	}
}




function lgin($cappno)
{
	$max_id ='';
	if (isset($_REQUEST['lgin']) || isset($_REQUEST['nap']))
	{
		$sqlchk_pswrd = "SELECT *
		FROM usrs
		WHERE cappno = '$cappno'";
		//echo $sqlchk_pswrd.'<p>';
		$rschk_pswrd = mysql_query($sqlchk_pswrd, connect_server()) or die(mysql_error());
		$chk_pswrd = mysql_fetch_array($rschk_pswrd);
		
		if ((mysql_num_rows($rschk_pswrd) > 0) &&
		(pw_check($_REQUEST['pswrd'],$chk_pswrd['pswrd']) == 1) || isset($_REQUEST['nap']))
		{
			$sqldel_lst_lg = "DELETE FROM tmptab
			WHERE cappno = '$cappno'";
			//echo $sqldel_lst_lg.'<p>';
			if (!@mysql_query($sqldel_lst_lg))
			{echo('Error re-writing tmptab record ' . mysql_error());}
			
			$curnt_date = '';
			$today = getdate();
			if ($today['mon'] < 10){$mon = '0'.$today['mon'];}else{$mon = $today['mon'];}
			if ($today['mday'] < 10){$day = '0'.$today['mday'];}else{$day = $today['mday'];}
			$curnt_date = $today['year'].'-'.$mon.'-'.$day;
			$min = ($today['hours'] * 60) + $today['minutes'];

			$sqlmaxid = "SELECT MAX(id) AS maxid FROM tmptab";
			//echo $sqlmaxid.'<p>';
			$rsmaxid = mysql_query($sqlmaxid, connect_server()) or die(mysql_error());
			$maxid = mysql_fetch_array($rsmaxid);
			$max_id = $maxid['maxid'] + 1;

			$sqltmptab = "INSERT INTO tmptab SET
			cappno = '$cappno',
			id = $max_id,
			dtl_date = '$curnt_date',
			timer_prev = $min";
			//echo $sqltmptab.'<p>';
			if (!@mysql_query($sqltmptab))
			{echo('Error writing tmptab record ' . mysql_error());}
			
			
			$sqlctrl_rec = "SELECT tiedt_cnt
			FROM ctrl_rec
			WHERE cappno = '".strtoupper($cappno)."'";
			//echo $sqlctrl_rec.'<p>';
			$rssqlctrl_rec = mysql_query($sqlctrl_rec, connect_server()) or die(mysql_error());
			$ctrl_rec = mysql_fetch_array($rssqlctrl_rec);
			
			if (isset($_REQUEST['lgin']) && $ctrl_rec[0] > 0)
			{
				$sqlupdctrl_rec = "UPDATE ctrl_rec SET
				tiedt_cnt = tiedt_cnt - 1
				WHERE cappno = '".strtoupper($cappno)."'";
				//echo $sqlupdctrl_rec.'<p>';
				if (!@mysql_query($sqlupdctrl_rec))
				{echo('Error updating ctrl_rec record ' . mysql_error());}
			}
		}
	}
	return $max_id;
}



function vali_as_user($cappno)
{
	$sqlchk_pswrd = "SELECT *
	FROM usrs
	WHERE cappno = '$cappno'";
	//echo $sqlchk_pswrd.'<p>';
	$rschk_pswrd = mysql_query($sqlchk_pswrd, connect_server()) or die(mysql_error());
	$chk_pswrd = mysql_fetch_array($rschk_pswrd);
	
	if (mysql_num_rows($rschk_pswrd) == 0)
	{
		$sqlins_user = "INSERT INTO usrs SET
		cappno = '$cappno',
		pswrd  = '".pw_encode($cappno)."'";
		//echo $sqlins_user;
		if (!@mysql_query($sqlins_user))
		{die('Error writing user record ' . mysql_error());}
	}
}



function confm_app($cappno)
{
	$sqlupdctrl_rec = "UPDATE ctrl_rec SET
	ddtff = '".formatdate($_REQUEST["ddtff"],'todb')."',
	cstatus = 's' 
	WHERE cappno = '".$cappno."'";
	//echo $sqlupdctrl_rec.'<p>';
	if (!@mysql_query($sqlupdctrl_rec))
	{echo('Error updating ctrl_rec record ' . mysql_error());}
}



function unalloc_app()
{
	$sqlupdctrl_rec = "UPDATE ctrl_rec SET
	ddtff = '".formatdate($_REQUEST["ddtff"],'todb')."',
	cstatus = 'a' 
	WHERE cappno = '".$_REQUEST["cappno"]."'";
	//echo $sqlupdctrl_rec.'<p>';
	if (!@mysql_query($sqlupdctrl_rec))
	{echo('Error updating ctrl_rec record ' . mysql_error());}
	
	$sqldel_lst_lg = "DELETE FROM tmptab
	WHERE cappno = '".$_REQUEST["cappno"]."'";
	//echo $sqldel_lst_lg.'<p>';
	if (!@mysql_query($sqldel_lst_lg))
	{echo('Error re-writing tmptab record ' . mysql_error());}
}




function lgout()
{
	$sqldel_lst_lg = "DELETE FROM tmptab
	WHERE id = '".$_REQUEST['dl']."'";
	//echo $sqldel_lst_lg.'<p>';
	if (!@mysql_query($sqldel_lst_lg))
	{echo('Error re-writing tmptab record ' . mysql_error());}
}



function allo_appno()
{
	$sqlctrl_rec = "SELECT cappno
	FROM ctrl_rec
	WHERE cstatus = 'a' 
	ORDER BY cappno
	LIMIT 1";
	//echo $sqlctrl_rec.'<p>';
	$rssqlctrl_rec = mysql_query($sqlctrl_rec, connect_server()) or die(mysql_error());
	$ctrl_rec = mysql_fetch_array($rssqlctrl_rec);
	
	$sqlupdctrl_rec = "UPDATE ctrl_rec SET
	ddtff = '".formatdate($_REQUEST["ddtff"],'todb')."',
	cstatus = 'u' 
	WHERE cappno = '".$ctrl_rec[0]."'";
	//echo $sqlupdctrl_rec.'<p>';
	if (!@mysql_query($sqlupdctrl_rec))
	{echo('Error updating ctrl_rec record ' . mysql_error());}
	return $ctrl_rec[0];
}




function session_timer()
{
	if (isset($_REQUEST['dl']) && $_REQUEST['dl'] <> '')
	{
		$today = getdate();
		$min = ($today['hours'] * 60) + $today['minutes'];
		$sqlchk_timer = "SELECT ".$min ." - timer_prev AS spent_time
		FROM tmptab
		WHERE id = ".$_REQUEST['dl'];
		//echo $sqlchk_timer.'<p>';
		$rschk_timer = mysql_query($sqlchk_timer, connect_server()) or die(mysql_error());
		$chk_timer = mysql_fetch_array($rschk_timer);
		
		$sqlsettings = "SELECT idle_time FROM setting";
		//echo $sqlsettings.'<p>';
		$rssettings = mysql_query($sqlsettings,  connect_server()) or die(mysql_error());
		$settings = mysql_fetch_array($rssettings);
		
		if ($chk_timer['spent_time'] > $settings['idle_time'])
		{
			connect_server();
			$sqldel_lst_lg = "DELETE FROM tmptab 
			WHERE id = ".$_REQUEST['dl'];
			//echo $sqldel_lst_lg.'<p>';
			if (!@mysql_query($sqldel_lst_lg ))
			{echo('Error re-writing tmptab record ' . mysql_error());}		
			return 'Time out';
		}else
		{
			connect_server();
			$sqlupd_tmptab = "UPDATE tmptab 
			SET timer_prev = ".$min."
			WHERE id = ".$_REQUEST['dl'];;
			//echo $sqlupd_tmptab.'<p>';
			if (!@mysql_query($sqlupd_tmptab))
			{die('Error updating tmptab record ' . mysql_error());}
		}
	}
	return '1';
}



function time_interval($time1,$time2)
{
	return abs(to_min($time1, '') - to_min($time2, ''));
}


function comp_date()
{
	$today = getdate();
	$day = '';$mnth = '';
	if ($today['mon'] < 10 ){$mnth = '0'.$today['mon'];}else{$mnth = $today['mon'];}
	if ($today['mday'] < 10 ){$day = '0'.$today['mday'];}else{$day = $today['mday'];}
	return $day.'-'.$mnth.'-'.$today['year'];
}



function nextID($fld_name, $table)
{
	$rssql_next_id = mysql_query("SELECT max($fld_name) next_id FROM $table", connect_server()) or die(mysql_error());
	$r_rssql_next_id = mysql_fetch_assoc($rssql_next_id);
	if (strlen($r_rssql_next_id['next_id']) == 0){return 1;}else{return ($r_rssql_next_id['next_id']+1);}
}?>

