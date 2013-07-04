<?php

session_start();
echo $_GET['imp'];
$_SESSION['uid'] = $_GET['imp'];


error_reporting(E_ALL);
ini_set('display_errors', '1');

	define('INCLUDE_CHECK',TRUE);
	
//	if(isset($_SESSION['userID'])){
	//	echo $_SESSION['userID'];
//	}else{
	//	echo "no session";
//	}
	
	require_once('../../../connect.php');
	$query = 'SELECT name, path FROM images WHERE uid = "'. $_SESSION['userID'] .'" ' ;
	
	
	//echo $query;
	$result = mysql_query($query);

	
	if($result === FALSE) {
		die(mysql_error()); 
	}

$xml = new DOMDocument();

$xml_gallery = $xml->createElement("juiceboxgallery");
$xml_gallery->setAttribute("galleryTitle", "myCloud_Gallery");




	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	
//		echo $row["path"];
		$xml_image = $xml->createElement("image");
		$xml_image->setAttribute("imageURL", "../." . $row["path"]);
		$xml_image->setAttribute("linkURL", "../." . $row["path"]);
		$xml_image->setAttribute("linkTarget", "_blank");
		// add image titles or captions and thumbnails...........

		//$xml_track->nodeValue = "tere or";
		$xml_gallery->appendChild( $xml_image );
  			
  	}
	



$xml->appendChild( $xml_gallery );

$xml->save("config.xml");


mysql_close($link);
?>