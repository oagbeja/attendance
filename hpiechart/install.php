<?php
include 'config.php';
?>
<style>
.ta{background-color: lightblue;}
.rad{color:red; font-weight:bold; background-color: ffff44;}
</style>
<?php
  $username = $_POST['username'];
	$password = $_POST['pass'];
	$hostname = $_POST['hostname'];
	$dbname = $_POST['dbname'];
	$tablename=$_POST['table'];
  //open config.php and write the data in to it.
	$file = "config.php"; 
	$open = fopen($file, "w");
	fwrite($open,"<?php\n\n \$username = \"".$username."\";\n \$password = \"".$password."\";\n \$hostname = \"".$hostname."\";
		\$dbname = \"".$dbname."\";\n  \$tablename = \"".$tablename."\";\n\n ?>");
	fclose($open);

?>
<table  align=center style=" margin-top:150px;font-family: Monaco, Verdana, Sans-serif; font-size: 12px;background-color: #f9f9f9;border: 1px solid #D0D0D0;color: #002166;  width:50%;" >
<tr><td align=center> 
</td></tr>
<tr><td align=center><i><b>Database Details</b></i></td></tr>
<tr><td><br><br>
 <form name=setf method=POST action="<?php echo $PHP_SELF;?>">
	<table align=center  style="font-family: Monaco, Verdana, Sans-serif; font-size: 12px;">
	<tr><td>HOST NAME: </td><td><input class="ta" name="hostname"  type=text value=<?php echo "$hostname";?>></td></tr>
	<tr><td>DB NAME: </td><td><input class="ta" name="dbname"  type=text value=<?php echo "$dbname";?>></td></tr>
	<tr><td>User NAME: </td><td><input class="ta" name="username"  type=text value=<?php echo " $username";?>></td></tr>
	<tr><td>Password: </td><td><input class="ta" name="pass"  type=text value=<?php echo "$password";?> ></td></tr>
	<tr><td>TableName: </td><td><input class="ta" name="table"  type=text value=<?php echo "$tablename";?> ></td></tr>	
  <tr><td><br><br><br><br></td><td><input type=submit value="Install" onClick="chkfrm()"></td></tr>
	</table>
 </form>
</td></tr></table>
<script language="javascript">
function chkfrm()
{
var hname=document.setf.hostname.value;
var dname=document.setf.dbname.value;
var uname=document.setf.username.value;
var tname=document.setf.table.value;
if((hname.length)!=0 && (dname.length)!=0 && (uname.length)!=0 && (tname.length)!=0)
{
alert("Your Installation Sucessfull")
 return true;
}
else
{
alert("Your Installation not Sucessfull")
 return false;
}
}
</script> 

