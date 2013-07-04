<?php
session_start();
// echo $_SESSION['uid'];
define('INCLUDE_CHECK',true);
require '../connect.php';
// echo $_POST['name']." ".$_POST['url'];
$name = addslashes($_GET['name']);
$tag = addslashes($_GET['url']); 
$uid = $_SESSION['uid'];

$query = " INSERT INTO url (tag_name, tag_url, uid) VALUES (\"" . $name . "\" , \"". $tag ."\" , \"". $uid ."\")";
// echo $query;
if (!mysql_query($query,$link)){
  die('Error: ' . mysql_error());
  }

$query = "SELECT * FROM url WHERE uid=\"".$uid."\"";
		
$string = "";		
			
$result = mysql_query($query);	
while($row = mysql_fetch_array($result)){
  		// $string .= $row['tag_name'] . " >>> " . $row['tag_url'];
  		$string .= "<a href=\". $row['tag_url'] . "\" target=\"_blank\">" . $row['tag_name'] . "</a>";
  		$string .= "<br />";
  		}
echo $string;
?>