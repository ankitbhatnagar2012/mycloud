<?php
echo $_GET['imp'];
// $_SESSION['uid'] = $_GET['imp'];
require_once('../gallery.php');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>myCloud Gallery</title>
		<meta charset="utf-8" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<style type="text/css">
			body {
				margin: 0px;
			}
		</style>
	</head>
	<body>
		
		<script src="jbcore/juicebox.js"></script>
		<script>
			new juicebox({
				containerId : 'juicebox-container'
			});

		</script>
		<div id="juicebox-container"></div>
		
	</body>
</html>