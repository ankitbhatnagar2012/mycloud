<?php

session_start();
$_SESSION['userID'] = $_GET['userID'];

?>


 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../favicon.ico" />
        <title>New Web Project</title>
    </head>
    <body>
        <h1>Upload mechanism</h1>
        <form action="upload_modified.php" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><h1>Upload your file</h1></legend>
				<dl>
		    		<dt><label for="file">Browse File : </label></dt>
		    		<dd><input type="file" name="file" id="file" /></dd>
		    	</dl>				
				<input type="submit" name="submit" value="Upload" style="width: 100px;" />
		</fieldset>
	</form>
    </body>
</html>  
