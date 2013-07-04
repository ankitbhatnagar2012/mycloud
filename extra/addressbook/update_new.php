<?php 
// $con=mysql_connect("localhost","root","jacob")or die("not connect to database".mysql_error());
// mysql_select_db("phonebook",$con) or die("database not exist".mysql_error());
define('INCLUDE_CHECK',true);

include_once '../../connect.php';
$temp=intval($_GET['id']); //convert to integer value
$qry="select * from contact where id='$temp'";
$result=mysql_query($qry,$link);
if(mysql_num_rows($result)==0)
  header('location:update.php');
 else
 {
  $result=mysql_fetch_array($result);
//  print_r($result);  
?>
<!DOCTYPE html>
<html>
<title>Phone Book Project</title>
<body class="my_body">
<h1 align="center">ADDRESS BOOK</h1><br />	
<form name="update" action="update_query.php" method="post">
<fieldset><legend>Update</legend>
<table>
<!-- pass as hidden variable id-->
<input type='hidden' name='id' value='<?php echo $result["id"];?>' />
<tr><td>First name :</td><td><input type='text' name='fname' size=20 value="<?php echo $result['firstname'];?>"required /></td></tr>
<tr><td>Last name :</td><td><input type='text' name='lname' value='<?php echo $result['lastname'];?>'size=20 /></td></tr>
<tr><td>Email :</td><td><input type='email' name='email' size=30 value='<?php echo $result['email'];?>' placeholder="xyz@gmail.com" /></td></tr>
<tr><td>Tel:</td><td><input type='text' name='tel' value='<?php echo $result['tel']?>' size=20 /></td><td>
<tr><td>Mobile:</td><td><input type='text' name='mob' value='<?php echo $result['mobile']?>' size=20 /></td></tr>
<tr><td>Street1:</td><td><input type='text' name='s1' value='<?php echo $result['streetone']?>' size=30 /></td></tr>
<tr><td>Street2:</td><td><input type='text' name='s2' value='<?php echo $result['streettwo']?>' size=30 /></td></tr>
<tr><td>City:</td><td><input type='text' name='city' value='<?php echo $result['city']?>' size=20 /></td></tr>
<tr><td>Country:</td><td><input type='text' name='ctry' value="<?php echo $result['country']?>" size=20 /></td></tr>
<tr></tr><?php } ?>
<tr><td></td><td><input type='submit' value='update' name='submit'/></td></tr>
</fieldset>
</form>
</body>
</html>