<?php
session_start();
// echo $_GET['userID'];
$_SESSION['uid']=$_GET['userID'];
$uid = $_GET['userID'];
define('INCLUDE_CHECK',true);
require '../connect.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>New Web Project</title>
        <script type="text/css" >
         a {
         	font-family: Helvetica; text-decoration: none; font-size: 15px
        }
        </script>
        <script type="text/javascript">
        	function getXMLHttp()
			{
 			var xmlHttp;

  			try
  			{
    			//Firefox, Opera 8.0+, Safari
    			xmlHttp = new XMLHttpRequest();
  			}
 		 	catch(e)
  			{
    			//Internet Explorer
    			try
    			{
      				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    			}
    			catch(e)
    			{
      				try
      				{
        				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      				}
      				catch(e)
      				{
        				alert("Your browser does not support AJAX!")
        				return false;
      				}
    			}
  			}
  			return xmlHttp;
			}
		
		function HandleResponse(response)
		{
  			document.getElementById('urls').innerHTML = response;
  			// alert(response);
		}
		
		function my_func(id)
		{
  			var xmlHttp = getXMLHttp();
  			// alert(document.url_submit.url.value);
  			var tag_name = document.url_submit.name.value;
  			var tag_link = document.url_submit.url.value;   			
  
  			xmlHttp.onreadystatechange = function()
  			{
    			if(xmlHttp.readyState == 4)
    			{
      				HandleResponse(xmlHttp.responseText);
      				// document.getElementById(id+"_up").value = xmlHttp.responseText;
    			}
  			}
  			xmlHttp.open("GET", "bookmarker.php?name="+tag_name+"&url="+tag_link , true); 
  			xmlHttp.send(null);
		}        	
        </script>
    </head>
    <body>
        <form name="url_submit">
		<fieldset>
			<legend><h1>Bookmark your URL</h1></legend>
				<dl>
		    		<dt><label for="title">Name</label></dt>
		    		<dd><input type="text" id="tag" name="name" /></dd>
		    		
		    		<dt><label for="title">URL</label></dt>
		    		<dd><input type="text" id="url" name="url" /></dd>		    		
		    	</dl>				
				<input type="button" name="bookmark" value="BOOKMARK" style="width: 100px;" onclick="my_func();" />
		</fieldset>
		</form>
		
		<!-- Need to render the contents of the url table here -->
		<div id="urls" >
			<?php
			$query = "SELECT * FROM url WHERE uid=\"".$uid."\"";		
			$result = mysql_query($query);	
			while($row = mysql_fetch_array($result)){
  				// echo $row['tag_name'] . " >>> " . $row['tag_url'];
  				echo "<a href=\"http://". $row['tag_url'] . "\" target=\"_blank\">" . $row['tag_name'] . "</a>";
  				echo "<br />";
  			}			
			?>			
		</div>
				
    </body>
</html>
