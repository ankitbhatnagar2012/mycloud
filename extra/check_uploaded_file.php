<?php
	define('INCLUDE_CHECK',TRUE);
	session_start();
	if(isset($_SESSION['userID'])){
		echo $_SESSION['userID'];
	}
	

	function checkFileType($allowedExts_images, $allowedExts_docs, $allowedExts_media){
	
		$fileName = $_FILES["file"]["name"];
		$dot = ".";
		$value = explode($dot, $fileName);
		$extension = end($value);

		if(in_array($extension, $allowedExts_images)){
			
			// $dir = "./uploads/images/";
			$dir = "./resources/".$_SESSION['userID']."/images/";
			$cat = "images";
			save_File($extension, $dir, $fileName, $cat);
		}
		else if(in_array($extension, $allowedExts_docs)){

			// $dir = "./uploads/docs/";
			$dir = "./resources/".$_SESSION['userID']."/docs/";
			
			$cat = "docs";
			save_File($extension, $dir, $fileName, $cat);
		}
		else if(in_array($extension, $allowedExts_media)){

			// $dir = "./uploads/media/";
			$dir = "./resources/".$_SESSION['userID']."/media/";
			
			$cat = "media";
			save_File($extension, $dir, $fileName, $cat);
		}
		else{
			echo "Invalid file";
		}
	}

	function save_File($extension, $dir, $fileName, $cat){

		if(!is_dir($dir)){

			mkdir($dir);
		}

		if(file_exists($dir . $fileName)){

			echo $fileName . " already exists. ";
		}
		else {
 
			move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $fileName);
			echo "Upload: " . $fileName . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . "Kb <br>";
			echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";
			echo "Stored in : " . $dir . $fileName;
			$path = $dir . $fileName;
			store_Db($fileName, $path, $extension, $cat);
		}
	
	}

	function store_Db($fileName, $path, $extension, $cat){
		
		require_once('../connect.php');
		$query = "INSERT INTO $cat(name, path, type, uid) VALUES(".
							"\"". $fileName ."\",". 
							"\"". $path ."\",". 
							"\"". $extension. "\",". 
							"\"". $_SESSION['userID'] ."\")";
		echo $query; // debug code

		if(!mysql_query($query, $link)){

			dir('Error: ' . mysql_error() . '<br>');
		}
		else{

			echo "<br>Data entered successfully<br>";
		}
		mysql_close($link);
	}

?>
