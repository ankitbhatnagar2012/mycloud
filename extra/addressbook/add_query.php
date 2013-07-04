<?php
// $con=mysql_connect("localhost","root","jacob")or die("not connect to database".mysql_error());
// mysql_select_db("phonebook",$con) or die("database not exist".mysql_error());
define('INCLUDE_CHECK',true);

include_once '../../connect.php';
$sql="insert into contact values('','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[tel]','$_POST[mob]','$_POST[s1]','$_POST[s2]','$_POST[city]','$_POST[ctry]')";
if (!mysql_query($sql,$link))
  {
  die('Error: ' . mysql_error());
  }  
else
  {
	// mysql_close($link);
    header('Location:index.php');  
  } 
?>