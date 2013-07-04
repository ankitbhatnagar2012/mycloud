<?php
session_start();
define('INCLUDE_CHECK',true);

include_once '../../connect.php';
?>
<!DOCTYPE html>
<html>
<head><title> Address Book</title></head>
<style>
	div{
		color:black;
		display:inline;
		}
</style>
<!--
<script>
	function check()
	{
	a=document.search.fname;
	if(a.value.length==0)
	{
	alert("hii");
	window.open("abc.php");
	}
	}
</script>
-->
<body>

<h3><div class="inline">
<a href="addc.php"> ADD</a>&nbsp;&nbsp;
<a href="delete.php">DELETE</a>&nbsp;&nbsp;
<a href="update.php">UPDATE</a>&nbsp;&nbsp;
</div></h3>
<form name="search" action="search.php" method="post">
<fieldset><legend>Search Creteria</legend>
<table name='tab'>
<tr><td>By First name :</td><td><input type='text' name='fname' size=20 /></td><td><input type="submit" name="subf" value="search"></td></tr>
<tr><td>By Last name :</td><td><input type='text' name='lname' size=20 /></td><td><input type="submit" name="subl" value="search"></td></tr>
<tr><td>By Email :</td><td><input type='email' name='email' size=30 placeholder="xyz@gmail.com"/></td><td>
<input type="submit" name="sube" value="search"></td></tr>
</table></fieldset>
</form><br /><br />
<form name="detail" action="">
<fieldset><legend>Phone Book</legend>
<?php
	// $con=mysql_connect("localhost","root","jacob")or die("not connect to database".mysql_error());	
	// mysql_select_db("phonebook",$con) or die("database not exist".mysql_error());
	$sql="select * from contact";
	$result=mysql_query($sql,$link);
	if(mysql_num_rows($result)==0)
		echo "<H3>CONTACTS NOT EXIST YET</H3>";
	else
	{
		echo "<table border='0' width=85%>
		<tr align='left'>
		<th>S.No.</th>
		<th>First Name</th>
		<th>Last Name</th>
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
?>
</fieldset>
</body>
</html>