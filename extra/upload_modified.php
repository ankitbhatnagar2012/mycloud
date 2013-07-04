<?php

        session_start();
	require_once('./check_uploaded_file.php');
	

    $allowedExts_images = array("png","jpeg","pjpeg","gif","jpg");
    $allowedExts_docs = array("pdf","txt","doc","docx");
    $allowedExts_media = array("mp3","mp4","ogg","m4a","m4v","oga","ogv","webma","webmv","wav","fla","flv","rtmpa","rtmpv");

	//echo "file is here";
	
	if($_FILES["file"]["error"] > 0){

		echo "Error: " . $_FILES["file"]["error"] . "<br> Try Again. <br>";
	}
	else{

		checkFileType($allowedExts_images, $allowedExts_docs, $allowedExts_media);
	}