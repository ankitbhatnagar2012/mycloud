<?php
define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined


session_name('tzLogin');
// Starting the session

session_set_cookie_params(24*60*60);
// Making the cookie live for 2 weeks

session_start();

if($_SESSION['id'] && !isset($_COOKIE['tzRemember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();
	
	// Destroy the session
}


if(isset($_GET['logoff']))
{
	$_SESSION = array();
	// unset($_SESSION['tzLogin']);
	session_destroy();
	setcookie ("page_access", "", time() - 3600);
	define('INCLUDE_CHECK',FALSE);	
	header("Location: index.php");
	exit();
}

if($_POST['submit']=='Login')
{
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'All the fields must be filled in!';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string(md5($_POST['password']));
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// Escaping all input data

		$row = mysql_fetch_assoc(mysql_query("SELECT id,usr,uid FROM members WHERE usr='{$_POST['username']}' AND pass='{$_POST['password']}'"));

		if($row['usr'])
		{
			// If everything is OK login			
			$_SESSION['usr']=$row['usr'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			$_SESSION['userID'] = $row['uid'];			
			// Store some data in the session			
			setcookie('tzRemember',$_POST['rememberMe']);
			setcookie('userID',$row['uid']);
                        

		}
		else {
			$err[]='Wrong username and/or password!';	
		}
	}
	
	if($err){
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
		header("Location: index.php");
		exit();				
	}
	// Save the error messages in the session
	setcookie('page_access','TRUE');			
	//define('INCLUDE_CHECK',TRUE);


        /* if(isset($_SESSION)){
           echo $_SESSION['userID'];
         }*/
        //Dummy redirect for testing
       // header("Location: extra/lol.php");

	header("Location: extra/index.php");
	exit();
}

else if($_POST['submit']=='Register')
{
	// If the Register form has been submitted
	
	$err = array();
	
	if(strlen($_POST['username'])<4 || strlen($_POST['username'])>32)
	{
		$err[]='Your username must be between 3 and 32 characters!';
	}
	
	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username']))
	{
		$err[]='Your username contains invalid characters!';
	}
	
	if(!checkEmail($_POST['email']))
	{
		$err[]='Your email is not valid!';
	}
	
	if(!count($err))
	{
		// If there are no errors
		
		// Generate a random password
		$pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
		
		// Escape the input data		
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		
		// need to create a random user identifier and insert it into the database here
		$my_uid = uniqid (rand(), true);		
		
		// also the directory structure needs to be constructed here.
		// Desired folder structure
		$INITIAL_PATH = './extra/resources/';

		// replace the constant with the name of the user registering
		$user_name = $my_uid;

		$structure = $INITIAL_PATH.$user_name;

		// To create the nested structure, the $recursive parameter 
		// to mkdir() must be specified.
		// chmod($INITIAL_PATH, 0777);

		if (!mkdir($structure, 0777, true)) {
    		die('Failed to create folders...');
		}
		chmod($structure, 0777);

		$parent_structure = $structure;

		$structure = $parent_structure . "/images";
		if (!mkdir($structure, 0777, true)) {
    		die('Failed to create folders...');
		}
		chmod($structure, 0777);

		$structure = $parent_structure . "/audio";
		if (!mkdir($structure, 0777, true)) {
    		die('Failed to create folders...');
		}
		chmod($structure, 0777);

		$structure = $parent_structure . "/video";
		if (!mkdir($structure, 0777, true)) {
    		die('Failed to create folders...');
		}
		chmod($structure, 0777);

		$structure = $parent_structure . "/bookmarks";
		if (!mkdir($structure, 0777, true)) {
    		die('Failed to create folders...');
		}
		chmod($structure, 0777);

		$structure = $parent_structure . "/docs";
		if (!mkdir($structure, 0777, true)) {
    		die('Failed to create folders...');
		}
		chmod($structure, 0777);
		
		// now inserting the credentials into the login database
		mysql_query("	INSERT INTO members(usr,pass,email,uid,regIP,dt)
						VALUES(
						
							'".$_POST['username']."',
							'".md5($pass)."',
							'".$_POST['email']."',
							'".$my_uid."',							
							'".$_SERVER['REMOTE_ADDR']."',
							NOW()
							
						)");
		
		// E-Mail sending logic here....
		// echo $pass;
		if(mysql_affected_rows($link)==1)
		{
			send_mail(	'admin@mycloud.com',
						$_POST['email'],
						'MyCloud - Your New Password',
						'Your password is: '.$pass);

			$_SESSION['msg']['reg-success']='We sent you an email with your new password!';
		}
		else $err[]='This username is already taken!';
	}

	if(count($err))
	{
		$_SESSION['msg']['reg-err'] = implode('<br />',$err);
	}	
	
	header("Location: extra/index.php");
	exit();
}

$script = '';

if($_SESSION['msg'])
{
	// The script below shows the sliding panel on page load
	
	$script = '
	<script type="text/javascript">
	
		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});
	
	</script>';
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" />
<title>MyCloud</title>
    
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" >
	function myfunc()
	{
		alert("DEVELOPERS: Ankit, Harpreet and Jacob");
	}    
	</script>
	
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    
    <?php echo $script; ?>
</head>

<body>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>MyCloud</h1>
				<h2>Login Portal</h2>		
				<p class="grey">Welcome !!!</p>
			</div>
            
            
            <?php
			
			if(!$_SESSION['id']):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
					<h1>Member login</h1>
                    
                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="" method="post">
					<h1>New User? Register here</h1>		
                    
                    <?php
						
						if($_SESSION['msg']['reg-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
							unset($_SESSION['msg']['reg-err']);
						}
						
						if($_SESSION['msg']['reg-success'])
						{
							echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
							unset($_SESSION['msg']['reg-success']);
						}
					?>
                    		
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label>A password will be e-mailed to you.</label>
					<input type="submit" name="submit" value="Register" class="bt_register" />
				</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
            <h1>Dear Member,</h1>
            <p>You've successfully logged in.</p>
            <a href="extra/index.php">Visit your profile</a>
            <p>--- or ---</p>
            <a href="?logoff">Logout</a>
            
            </div>
            
            <div class="left right">
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Guest';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Open Panel':'Log In | Register';?></a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<div class="pageContent"></div>
	<!-- Main content -->
    <div id="container">
    	<div id="left_content">
    		<center>
    			<br /><br /><br />    			
    			<img src="./images/project_logo.png" alt="Project Logo" height="400px" /><br />
    			<div style="font-family: Palatino Linotype; font-size: 70px; font-weight: bold;">&lt;&nbsp;MyCloud&nbsp;/&gt;</div><br />
    			<div style="font-family: Palatino Linotype; font-size: 30px; font-weight: bold;">Your Desktop, Wherever You Go.</div><br />
    			<br /><br /><br />
    		</center>
    	</div>
    	
    	<div id="right_content">
    		<!--
    		<div style="font-family: Palatino Linotype; font-size: 20px; font-weight: bold; padding-left: 20px;">Login into MyCloud -</div><br />
    		<center>    			
    			<a href="#"><img src="./images/google.png" /></a>
    			<a href="#"><img src="./images/facebook.png" /></a>
    			<a href="#"><img src="./images/twitter.png" /></a>
    		</center>
    		-->    			
    	</div>
    	
    	<div id="bottom_content">
    		<div style="font-family: Palatino Linotype; font-size: 10px; font-weight: bold; padding-left: 80%;">
    			 <a href="#">ABOUT US</a>&nbsp;|&nbsp;
    			 <a href="#">CONTACT US</a>&nbsp;|&nbsp;
    			 <a href="#" onclick="myfunc()">DEVELOPERS</a>
    		</div>    		
    	</div>
    </div>
	<!-- End of Main Content-->
</body>
</html>