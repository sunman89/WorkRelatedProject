<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!-- Used code from this site to fix the http 0 blocked mixed content problem that was occuring, it gave me the code below in the meta tag:
	https://stackoverflow.com/questions/33507566/mixed-content-blocked-when-running-an-http-ajax-operation-in-an-https-page -->
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Contact Us</title>
	<link href="css/lummy.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="header">
	<a href="index.php"><img class="logo" src="includes/pics/lummy logo new.jpg" alt="butterfly image from myFBcovers.com"/></a>
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
		<h1>Contact Us</h1>
		<p>Email: lummys.boutique@gmail.com</p>
		<h3>How to enquire about purchasing a product</h3>
		<p>Write down the product or products you wish to pruchase and the quantity. Then just email this information to us and we should get back to you shortly regarding payment and shipping.</p>
		
		<h3>Enquiring about a custom product</h3>
		<p>If you have any enquiries about having a product custom made for you please feel free to email us with any idea you can think of, and we should get back to you ASAP regarding if it can be done.</p>
	
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