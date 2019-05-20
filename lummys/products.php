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
	
	
	if (!isset($_GET['type'])) 
	{
		
		$displayProducts = 'Products'; 
	} 
	// Checks to see if anything other than a number has been entered into the id.
	elseif(is_numeric($_GET['type']))
	{
		
		 $displayProducts = '404Error';
	}
	else
	{
		
		$displayProducts = $_GET['type'];
		
		
		if($displayProducts > 0)
		{
			
			$sql = "SELECT productType FROM products WHERE productType = '$displayProducts'";
			
			$result = mysqli_query($link, $sql);
			
			$data = mysqli_fetch_assoc($result);
			
			
			if($data == true)
			{
			$displayProducts = 'Products';
			$getType = $_GET['type'];
			
			}
		
			else
			{
			$displayProducts = '404error';
			}
		}
	}
	
	// Initialising the header and the content.
	$header = '';
	$content = '';
	

	switch ($displayProducts)
	{
		case 'Products':
		include 'views/allProducts.php';
		break;
		
		case 'Necklace':
		include 'views/necklaces.php';
		break;
		
		case 'Bracelet':
		include 'views/bracelets.php';
		break;
		
		case 'Charms':
		include 'views/charms.php';
		break;
		
		case 'Misc':
		include 'views/misc.php';
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
	<title>Products</title>
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
	<div id="contentArea" class="products">
	
		<div id="sideNav">
		<h3 class="sideNavInfo">Product Types:</h3>
		<p class="sideNavInfo">Click on a product type from below to view products of that type.</p>
		<ul>
			<li><a href="products.php">All Products</a></li>
			<li><a href="products.php?type=Necklace">Necklaces</a></li>
			<li><a href="products.php?type=Bracelet">Bracelets</a></li>
			<li><a href="products.php?type=Charms">Charms</a></li>
			<li><a href="products.php?type=Misc">Miscellaneous</a></li>
		</ul>
		</div>
		<div id="content">	
			<?php
				echo $header;
				echo PHP_EOL;
				echo $content;
				echo PHP_EOL;
			?>
				
				
				
			</div>
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