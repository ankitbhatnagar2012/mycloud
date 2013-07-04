<!DOCTYPE html>
<html>
<title>Phone Book Project</title>
<body class="my_body">
<h1 align="center">ADDRESS BOOK</h1><br />	
<form name="add" action="add_query.php" method="post">
<fieldset><legend>Add New</legend>
<table>
<tr><td>First name :</td><td><input type='text' name='fname' size=20 required /></td></tr>
<tr><td>Last name :</td><td><input type='text' name='lname' size=20 /></td></tr>
<tr><td>Email :</td><td><input type='email' name='email' size=30 placeholder="xyz@gmail.com" /></td></tr>
<tr><td>Tel:</td><td><input type='text' name='tel' size=20 /></td><td>
<tr><td>Mobile:</td><td><input type='text' name='mob' size=20 /></td></tr>
<tr><td>Street1:</td><td><input type='text' name='s1' size=30 /></td></tr>
<tr><td>Street2:</td><td><input type='text' name='s2' size=30 /></td></tr>
<tr><td>City:</td><td><input type='text' name='city' size=20 /></td></tr>
<tr><td>Country:</td><td><input type='text' name='ctry' size=20 /></td></tr>
<tr></tr>
<tr><td></td><td><input type='submit' value='Submit'/></td></tr>
</fieldset>
</form>
</body>
</html>