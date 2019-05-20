<?php 
	session_start();// Found this session destroy code from presentation 11 of the php module.
	if (isset($_SESSION['username'])) 
			{
				$content = "You have successfully logged out";
			}
			else 
			{
				$content = 'You were not logged in, go to Login page to login, by clicking ' . '<a href="logIn.php">' . 'HERE' . '</a>';
			}
			
	if (ini_get("session.use_cookies")) 
	{
		$yesterday = time() - (24 * 60 * 60);
		$params = session_get_cookie_params();
		setcookie(session_name(), '', $yesterday,
		$params["path"], $params["domain"],
		$params["secure"], $params["httponly"]); 
	}
	session_destroy();
	//header('Location: '.$_SERVER['PHP_SELF']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Used code from this site to fix the http 0 blocked mixed content problem that was occuring, it gave me the code below in the meta tag:
	https://stackoverflow.com/questions/33507566/mixed-content-blocked-when-running-an-http-ajax-operation-in-an-https-page -->
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log Out Page</title>
<link href="css/lummy.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id='header'>
	<a href="index.php"><img class="logo" src="includes/pics/lummy logo new.jpg" alt="butterfly image from myFBcovers.com"/></a>
		<div id='common'>
		<?php
			// Firstly include the user navigation, it can be either one with a log in 
			//and register link or one with just the log out link.
			require ('includes/commonOut.php');
		?>
		</div>
	</div>
	<div id="navigation">
		<?php
			// Include navigation.
			require ('includes/navigationOut.php');
		?>
	</div>
	
	<div id="contentArea">
		<h1>Logged Out</h1>
		<h3>Successfully Logged Out</h3>
		<p>
		<?php
			echo $content;
		?>
		
		</p>
		
	</div>
	<div id="footer">
	
		<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
	  
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
<a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="Valid CSS!" />
    </a>
</p>
	</div>

</body>
</html>