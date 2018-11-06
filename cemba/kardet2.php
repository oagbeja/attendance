<?php
if (isset($_REQUEST['sbmt2']))
{//
//	      extract($_POST);
//
//	$uploaddir = 'photos/';
//      $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
//     // echo '<pre>';
//       if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
//	   {

	 //mysql_connect("localhost", "root", "");
	 //mysql_select_db("cemba");
	
	// mysql_query("INSERT INTO cemba_rec SET  userfile = '$uploadfile'");
	$sqlcemba_rec = "DELETE FROM personal_info
	WHERE matric_no = '".$_REQUEST['matric_no']."'";
	
	//echo $sqlcemba_rec.'<p>';
	if (!@mysql_query($sqlcemba_rec))
	{die('Error deleting personal_info record ' . mysql_error());}
	
	$v_state = '';
	if(isset($_REQUEST['v_state'])){$v_state = " v_state = '". $_REQUEST['v_state']."', ";}
	
	$sqlcemba_rec = "INSERT INTO personal_info SET
	matric_no = '".$_REQUEST['matric_no']."',
	v_title = '".$_REQUEST['v_title']."',
	v_surname = '".strtoupper(addslashes(trim($_REQUEST['v_surname'])))."',
	v_mname = '".ucwords(strtolower(trim($_REQUEST['v_mname'])))."',
	v_oname = '".ucwords(strtolower(trim($_REQUEST['v_oname'])))."',
	v_address = '".ucwords(strtolower(trim($_REQUEST['v_address'])))."',
	v_htown = '".ucwords(strtolower(trim($_REQUEST['v_htown'])))."', 
	v_lga= '".$_REQUEST['v_lga']."',
    $v_state
    v_country = '".$_REQUEST['v_country']."',
    dob = '".formatdate($_REQUEST['dob'],'todb')."',
    dos = '".formatdate($_REQUEST['dos'],'todb')."',
	v_gender = '".$_REQUEST['v_gender']."',
	v_status = '".$_REQUEST['v_status']."',
     v_disablity = '".$_REQUEST['v_disablity']."',
	 v_nationality = '".$_REQUEST['v_nationality']."',
     v_others = '".$_REQUEST['v_others']."',
	 v_tcity = '".strtolower(trim($_REQUEST['v_tcity']))."',
	 v_cstate= '".strtolower(trim($_REQUEST['v_cstate']))."',
	 v_clga = '".strtolower(trim($_REQUEST['v_clga']))."',
	v_fax= '".trim($_REQUEST['v_fax'])."',
	 v_phone = '".trim($_REQUEST['v_phone'])."',
	 joined= now(),
	 v_email = '".$_REQUEST['v_email']."'";
	//echo $sqlcemba_rec.'<p>';
	 if (!@mysql_query($sqlcemba_rec))
	 {die('Error updating personal_info record ' . mysql_error());}
	 
	 
	 $kin_experience = "DELETE FROM kin_experience
	WHERE matric_no = '".$_REQUEST['matric_no']."'";
	
	//echo $sqlcemba_rec.'<p>';
	if (!@mysql_query($kin_experience))
	{die('Error deleting kin_experience record ' . mysql_error());}
	
	$kin_experience = "INSERT INTO kin_experience SET
	matric_no = '".$_REQUEST['matric_no']."',
	v_ktitle = '".$_REQUEST['v_ktitle']."',
	vs_kname = '".strtoupper(addslashes(trim($_REQUEST['vs_kname'])))."',
	vo_kname = '".strtoupper(addslashes(trim($_REQUEST['vo_kname'])))."',
	emp_type = '".$_REQUEST['emp_type']."',
	emp_name = '".ucwords(strtolower(trim($_REQUEST['emp_name'])))."',
	emp_add = '".ucwords(strtolower(trim($_REQUEST['emp_add'])))."', 
	v_krelation= '".$_REQUEST['v_krelation']."',
    emp_rank = '".$_REQUEST['emp_rank']."',
    emp_position = '".$_REQUEST['emp_position']."',
	emp_id = '".$_REQUEST['emp_id']."',
	votherexp = '".$_REQUEST['votherexp']."',
	v_kfax= '".trim($_REQUEST['v_kfax'])."',
	 v_kphone = '".trim($_REQUEST['v_kphone'])."',
	 doe= '".formatdate($_REQUEST['doe'],'todb')."',
	 kvemail = '".$_REQUEST['kvemail']."'";
	//echo $kin_experience'<p>';
	 if (!@mysql_query($kin_experience))
	 {die('Error updating kin_experience record ' . mysql_error());}
	 
	  $acada_details = "DELETE FROM acada_details
	WHERE matric_no = '".$_REQUEST['matric_no']."'";
	
	//echo $sqlcemba_rec.'<p>';
	if (!@mysql_query($acada_details))
	{die('Error deleting kin_experience record ' . mysql_error());}
	
	$acada_details = "INSERT INTO acada_details SET
	matric_no = '".$_REQUEST['matric_no']."',
	vcentre = '".$_REQUEST['vcentre']."',
	programme = '".strtoupper(addslashes(trim($_REQUEST['programme'])))."',
	qual_1 = '".$_REQUEST['qual_1']."',
	subject_1 = '".$_REQUEST['subject_1']."',
	date_1 = '".formatdate($_REQUEST['date_1'],'todb')."',
	school_1 = '".ucwords(strtolower(trim($_REQUEST['school_1'])))."', 
	mat_1 = '".ucwords(strtolower(trim($_REQUEST['mat_1'])))."',
	qual_2= '".$_REQUEST['qual_2']."',
    subject_2 = '".$_REQUEST['subject_2']."',
    date_2 =  '".formatdate($_REQUEST['date_2'],'todb')."',
	school_2 = '".ucwords(strtolower(trim($_REQUEST['school_2'])))."', 
	mat_2 = '".ucwords(strtolower(trim($_REQUEST['mat_2'])))."', 
	qual_3= '".$_REQUEST['qual_3']."',
	subject_3 = '".$_REQUEST['subject_3']."',
	date_3= '".formatdate($_REQUEST['date_3'],'todb')."',
	school_3='".ucwords(strtolower(trim($_REQUEST['school_3'])))."',
	mat_3='".ucwords(strtolower(trim($_REQUEST['mat_3'])))."',
	o_qual='".ucwords(strtolower(trim($_REQUEST['o_qual'])))."',
	o_subject='".ucwords(strtolower(trim($_REQUEST['o_subject'])))."',
	o_date='".formatdate($_REQUEST['o_date'],'todb')."'";  
	  //echo $acada_details'<p>';
	 
	 if (!@mysql_query($acada_details))
	 {die('Error updating acada_details record ' . mysql_error());}
	
	$sqlcemba_rec="update matriculation set status = 'N' where matric_no = '".$_REQUEST['matric_no']."'";
	if (!@mysql_query($sqlcemba_rec))
	{die('Error updating  matriculation  record ' . mysql_error());}
	
	   $sqlfmud ="select * from matriculation 
		where status='A'
		order by matric_no
		limit 1"; 
	//echo "File is valid, and was successfully uploaded.\n";
	//echo $uploadfile;
        }  
      else 
	     {
   // echo "Possible file upload attack!\n";
       
   }?>
    <script language="JavaScript" type="text/javascript">
      location.href='http:congra.php?matric_no=<?Php  echo $_REQUEST['matric_no']?> '
       </script><?php
	
	/*$sqlcemba_rec = "DELETE FROM cemba_rec
	WHERE cfmno = '".$_REQUEST['cfmno']."'"
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
	//}
	
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