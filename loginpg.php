<?php
	include ('connection.php');
	$error=0;
	if (isset($_REQUEST['sub']))
	{ 
		if(trim($_REQUEST['staffid'])=='')
		{
			echo 'ENTER YOUR STAFF ID <br/>' ;  
			$error=1;
		}
		if(preg_match ("/[^0-9]/",$_REQUEST['staffid']))
		{
			echo 'NOT A VALID STAFF ID<br/>';
			$error=1;
		}
		if(trim($_REQUEST['vpassword'])=='')
		{
			echo 'ENTER YOUR PASSWORD <br/>' ;
			$error=1;
		}
		
					
		if ($error<>1)
		{
			$sql='select * from profile where staffid = "'.$_REQUEST['staffid'].'" and  vpassword="'.$_REQUEST['vpassword'].'"';//echo $sql;
			$rsql=mysql_query($sql,connect_server())or die("Unable to query ".mysql_error());
			if(mysql_num_rows($rsql)==0)
			{
				echo 'Wrong username or password';
			}else
			{
				$tab=mysql_fetch_array($rsql);
				$update='update profile set ucount="'.++$tab['ucount'].'" where staffid = "'.$_REQUEST['staffid'].'"';
				$rupdate=mysql_query($update, connect_server())or die("Unable to query ".mysql_error());
				if($tab['ucount']==1)
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
    <form  name="loginform" method="post" >	
        <table border="1" align="center">
            <tr>
                <td>	
                    <table border="0" align="center">
                      <tr>
                        <td colspan="2">Enter your Staff id</td>
                        <td>:</td>
                        <td><input name="staffid" type="text" size="10%"   /></td>
                      </tr>
                      <tr>
                        <td colspan="2">Enter Password</td>
                        <td>:</td>
                        <td><input name="vpassword" type="password" size="10%"  /></td>
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
        </table>
     </form>
</body>
</body>
</html>
