<?php
if(!isset($_POST['subf']) and !isset($_POST['subl']) and !isset($_POST['sube']))
{header('Location:index.php');
}
else
{
// $con=mysql_connect("localhost","root","jacob")or die("not connect to database".mysql_error());
// mysql_select_db("phonebook",$con) or die("database not exist".mysql_error());
define('INCLUDE_CHECK',true);

include_once '../../connect.php';
if(isset($_POST['subf']))
{
	$sql="select * from contact where firstname='$_POST[fname]'";
}else if(isset($_POST['subl']))
{
	$sql="select * from contact where lastname='$_POST[lname]'";
}else if(isset($_POST['sube']))
{
	$sql="select * from contact where email='$_POST[email]'";
}
	$result=mysql_query($sql,$link);
	if(mysql_num_rows($result)==0)
		echo "<H3>CONTACTS NOT EXIST YET</H3>";
	else
	{
		echo "<h1 align='center'> ADDRESS BOOK </h1><hr />";
		echo "<table border='0' width='85%'>
		<tr align='left'>
		<th>S.No.</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
		<th>Telephone</th>
		<th>Mobile</th>
		<th>streetone</th>
		<th>city</th>
		<th>ctry</th>
		</tr>";
		$count=0;
		while($row=mysql_fetch_array($result))
		{
		$count++;
		extract($row);
		echo "<tr>";
		  echo "<td>" . $count . "</td>";
		  echo "<td>" . $firstname. "</td>";
		  echo "<td>" . $lastname . "</td>";
		  echo "<td>" . $email. "</td>";
		  echo "<td>" . $tel. "</td>";
		  echo "<td>" . $mobile. "</td>";
		  echo "<td>" . $streetone. "</td>";
		  echo "<td>" . $city. "</td>";
		  echo "<td>" . $country. "</td>";
		  echo "</tr>";
		}
		echo "</table>";
	}

}
?>