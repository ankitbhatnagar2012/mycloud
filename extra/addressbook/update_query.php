<?php
if(!isset($_POST['submit']))
header('location:index.php');
else
{
// $con=mysql_connect("localhost","root","jacob")or die("not connect to database".mysql_error());
// mysql_select_db("phonebook",$con) or die("database not exist".mysql_error());
define('INCLUDE_CHECK',true);

include_once '../../connect.php';
echo print_r($_POST);
$sql="update contact set firstname='{$_POST['fname']}',lastname='{$_POST['lname']}',email='{$_POST['email']}',tel='{$_POST['tel']}',mobile='{$_POST['mob']}',streetone='{$_POST['s1']}',streettwo='{$_POST['s2']}',city='{$_POST['city']}',country='{$_POST['ctry']}' where id='{$_POST['id']}'";
// POint to noted....:):)
//You would need to put {} around each {$_POST[...]} variable and you should be developing and debugging
// your code on a system with error_reporting set to E_ALL and display_errors set to ON in your master 
//php.ini (or a local php.ini or a .htaccess file) so that all the errors that php detects will be reported
// and displayed. You will save a ton of time.
//Also, since the values are apparently text, you would need to enclose them in single-quotes inside of the
// query to prevent sql syntax errors.

$result=mysql_query($sql,$link);
header('location:update.php');

}
?>