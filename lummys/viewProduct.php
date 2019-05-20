<?php
	
	session_start();
	//This gets the correct data to connect to the database from the config file.
	require('includes/config.inc.php');
	//Use them to connect to DB
	$link = mysqli_connect
	(
	$config['db_host'],
	$config['db_user'],
	$config['db_pass'],
	$config['db_name']
	);
	
	// This tests the connection to the database. If it returns an error, then it will exit trying to connect to the database.
	if (mysqli_connect_errno()) 
	{
		exit(mysqli_connect_error());
		
	}

	
	if (!isset($_GET['id'])) 
	{
		// displays a page that won't display any real data, just a message saying they have not entered an appropriate id in the
		// url.
		$id = 'original'; 
	} 
	// Checks to see if anything other than a number has been entered into the id.
	elseif(! is_numeric($_GET['id']))
	{
		// Will display a 404 error to tell the user they have entered the wrong data into the url. Therefore that page doesn't
		// exist.
		 $id = '404Error';
	}
	else
	{
		// If the correct data is entered than it will proceed.
		// It will first store the id entered in the url into the variable $id.
		$id = htmlspecialchars($_GET['id']);
		
		// It will check to see if $id is more than zero.
		if($id > 0)
		{
			
			$sql = "SELECT id FROM products WHERE id = $id";
			// This will run the query stored in $sql, in the database.
			$result = mysqli_query($link, $sql);
			// This will fetch the data from $result and return an array if $id matches an id from the database.
			$data = mysqli_fetch_assoc($result);
			
			
			if($data == true)
			{
			$id = 'done';
			$pictureID = $_GET['id'];
			}
			
			else
			{
			// This is a view which tells the user that the id entered into the url, doesn't exist in the database.
			$id = 'error';
			}
		}
	}
	
	// Initialising the header and the content.
	$header = '';
	$content = '';
	
	// Switch statement to decide content of page.
	// Regardless of which "view" is displayed, the variable $content will
	// be populated with the HTML content for that view
	switch ($id)
	{
		case 'original':
		include 'views/original.php';
		break;
		
		case 'done':
		include 'views/picture.php';
		break;
		
		case 'error':
		include 'views/error.php';
		break;
		
		default:
		include 'views/404Error.php';
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!-- Used code from this site to fix the http 0 blocked mixed content problem that was occuring, it gave me the code below in the meta tag:
	https://stackoverflow.com/questions/33507566/mixed-content-blocked-when-running-an-http-ajax-operation-in-an-https-page -->
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Product</title>
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
		
		<?php
			// Display content for requested view.
			echo $content;
			echo PHP_EOL;
		?>
		<h3><a href="products.php"> Back to products</a></h3>
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