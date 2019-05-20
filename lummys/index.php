<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!-- Used code from this site to fix the http 0 blocked mixed content problem that was occuring, it gave me the code below in the meta tag:
	https://stackoverflow.com/questions/33507566/mixed-content-blocked-when-running-an-http-ajax-operation-in-an-https-page -->
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lummy's Boutique</title>
<link href="css/lummy.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="header">
	<a href="index.php"><img class="logo" src="includes/pics/lummy logo new.jpg" alt="butterfly image from myFBcovers.com" /></a>
		<div id="common">
		<?php
			
			if (isset($_SESSION['username'])) 
			{
				require ('includes/commonIn.php');
			}
			else 
			{
				require ('includes/commonOut.php');
			}
		?>
		</div>
	</div>
	<!--This is the navigation -->
	<div id="navigation">
		<?php
			
			if (isset($_SESSION['username'])) 
			{
				require ('includes/navigationIn.php');
			}
			else 
			{
				require ('includes/navigationOut.php');
			}
		?>
	</div>
	<div id="contentArea" class="normal">
		<h1>Welcome</h1>
		<h3>Welcome to Lummy's Boutique</h3>
		<p>We sell custom jewellery for girls and ladies with a creative streak.</p>
		<p>Unique fashion jewellery pieces with a twist! Contact me if you are looking for something different, themed or just plain crazy!</p>
		<br />
		<br />
		<h3>Enquiries</h3>
		<p>If you have any enquiries please visit our <a href="contact.php">contact page</a> to find out how to contact us</p>
	
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