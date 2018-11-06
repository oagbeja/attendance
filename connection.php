<?php
function connect_server()
{
	$cnx = mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db('servicom', $cnx);
	return $cnx;
}?>