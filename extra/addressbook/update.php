<!DOCTYPE html>
<html>
<head><title>Address Book</title>
<script>
function func()
{
  chk=document.update.radio;
  index=0,flag=0;
  for(i=0;i<chk.length;i++)
  {
    if(chk[i].checked)
	{
	flag=1;
	index=chk[i].value
	window.open('update_new.php?id='+index);
	}
  }
}
</script>
</head>
<body>

<h1 align="center"><a href="index.php">ADDRESS BOOK</a></h1>

<form name="update" action="" method="post" onsubmit='return func();'>
	<fieldset><legend>UPDATE</legend>
	<input type="submit" name="submit" value="submit"/>
	<table border='0'width='70%'>
	<tr align='left'>
	<th>Select</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Telephone</th>
	<th>Mobile</th><th>streetone</th><th>city</th><th>ctry</th>
	</tr>

<?php
	// $con=mysql_connect("localhost","root","jacob")or die("not connect to database".mysql_error());
	// mysql_select_db("phonebook",$con) or die("database not exist".mysql_error());
	define('INCLUDE_CHECK',true);

	include_once '../../connect.php';
	$qry="select * from contact";
	$result=mysql_query($qry,$link);
	while($rows=mysql_fetch_array($result))
	{
		extract($rows);
?>

<tr>
<td><input type='radio' name='radio' value='<?php echo $id?>'/></td>
<td><?php echo $firstname ?></td>
<td><?php echo $lastname ?></td>
<td><?php echo $email ?></td>
<td><?php echo $tel ?></td>
<td><?php echo $mobile ?></td>
<td><?php echo $streetone ?></td>
<td><?php echo $city ?></td>
<td><?php echo $country ?></td>
</tr><?php } ?>
</table>
</fieldset></form>
</body>
</html>
