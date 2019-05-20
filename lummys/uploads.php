<?php
	
	//This gets the correct data to connect to the database from the config file.
	require_once('includes/config.inc.php');
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
	
	// The function to resize the images.
	function imageResize($inFile, $outFile, $reqWidth, $reqHeight) 
	{
	
		// Get image file details
		$details = getimagesize($inFile);
		if ($details !== false)
		{
			switch ($details[2]) 
			{
				case IMAGETYPE_JPEG: // JPG File
				$src = imagecreatefromjpeg($inFile);
				break;
			}
			$width = $details[0];
			$height = $details[1];
			$new_width = $reqWidth;
			$new_height = $reqHeight;
			$new = imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($new, $src, 0, 0, 0, 0, $new_width,
			$new_height, $width, $height);
			imagejpeg($new, $outFile, 90); // Save in images dir
			imagedestroy($src);
			imagedestroy($new);
		} 
		else 
		{
			
			$errorMessage = 1;
		}
  
	}

	// Creates the variable $file with the template file.
	$file = 'templates/page.html';
	
	// Get the type of product and the destination for it to be saved.
	$productDirect = '';
	$optionalDirect = '';
	$thumbDirect = '';
	$error = '';
	$proceed = 0;
	
	
	
	// This gets the contents of $file. And stores them in the variable $tpl. To be used later.
	$tpl = file_get_contents($file);

	// This edits the output for the title and heading.
	$title = 'Process Page';
	$heading = 'Form couldn\'t be processed';
	

	$content = '';
	$common = '<a href=' . '"index.php">' . 'Home' . '</a>' . '</li>' .  PHP_EOL . '<li class="common">' .  '<a href=' . '"contact.php">' . 'Contact Page' . '</a>' . '</li>' .  PHP_EOL . '<li class="commonLast">' . '<a href=' . '"logOut.php">' . 'Log Out' .
	 '</a>' . PHP_EOL;
			
			
	$navigation = '<a href=' . '"index.php">' . 'Home' . '</a>' . '</li>' .  PHP_EOL . '<li class="nav">' . '<a href=' . '"products.php">' . 'View Products' . '</a>' . '</li>' .  PHP_EOL . '<li class="nav">' .  '<a href=' . '"contact.php">' . 'Contact Page' . '</a>' . '</li>' .  PHP_EOL . '<li class="navLast">' . '<a href=' . '"logIn.php">' . 'Upload / Log Out' . '</a>' . PHP_EOL;
			
	$footer = 'Footer';
	
	
	$type = '';
	$imageTitle = '';
	$imageDescription = '';
	$price = 0;
	$errorMessage = 0;
	$opt1Error = false;
	$opt2Error = false;
	
if($_FILES != null)
{
		
	
		// Checks to see if the file uploaded is an uploaded file.
	if(is_uploaded_file($_FILES['imageFile']['tmp_name']))
	{
			// Checks to see if there was an error with uploading the file and stores it into the variable $error.
			$error = $_FILES['imageFile']['error'];
			
		if($_FILES['imageFile2'] !== false) 
		{
			if(is_uploaded_file($_FILES['imageFile2']['tmp_name']))	
			{
					$opt1Error = $_FILES['imageFile2']['error'];
			}
		}
			
		if($_FILES['imageFile3'] !== false)
		{
			if(is_uploaded_file($_FILES['imageFile3']['tmp_name']))	
			{
					$opt2Error = $_FILES['imageFile3']['error'];
			}
		}
			
			// Checks if the $error is okay. If so it then proceeds.
		if($error == UPLOAD_ERR_OK)
		{
				
			$productType = htmlspecialchars($_POST['type']);
			if($productType == 'Necklace')
			{
					$productDirect = 'necklaces/';
					$optionalDirect = 'optional_neck/';
					$thumbDirect = 'thumb_neck/';
			}
			elseif($productType == 'Bracelet')
			{
					$productDirect = 'bracelets/';
					$optionalDirect = 'optional_brace/';
					$thumbDirect = 'thumb_brace/';
			}
			elseif($productType == 'Charms')
			{
					$productDirect = 'charms/';
					$optionalDirect = 'optional_charms/';
					$thumbDirect = 'thumb_charms/';
			}
			elseif($productType == 'Misc')
			{
					$productDirect = 'misc/';
					$optionalDirect = 'optional_misc/';
					$thumbDirect = 'thumb_misc/';
			}
			else 
			{
					$errorMessage = 9;
			}
				
				$updir = dirname(__FILE__).'/products/' . $productDirect;
				$fileName = basename($_FILES['imageFile']['name']);
				$extension = ".jpg";
				$tmpname = $_FILES['imageFile']['tmp_name'];
				$timeStamp = time();
				$details = getimagesize($tmpname);	
				
				
			if ($details !== false) 
			{
					$width = $details[0];
					$height = $details[1];
					$type = $details[2];
			} 
			else 
			{
					$errorMessage = 1;
			}
				
				
			if($opt1Error == UPLOAD_ERR_OK && $opt1Error !== false)
			{
					$opt1Name = basename($_FILES['imageFile2']['name']);
					$opt1Tmpname = $_FILES['imageFile2']['tmp_name'];
					$opt1Details = getimagesize($opt1Tmpname);	
					
					
				if ($opt1Details !== false) 
				{
						$opt1Width = $opt1Details[0];
						$opt1Height = $opt1Details[1];
						$opt1Type = $opt1Details[2];
				} 
				else 
				{
						$errorMessage = 7;
				}
			}
				
			if($opt2Error == UPLOAD_ERR_OK && $opt2Error !== false)
			{
					$opt2Name = basename($_FILES['imageFile3']['name']);
					$opt2Tmpname = $_FILES['imageFile3']['tmp_name'];
					$opt2Details = getimagesize($opt2Tmpname);	
					
				
				if ($opt2Details !== false) 
				{
						$opt2Width = $opt2Details[0];
						$opt2Height = $opt2Details[1];
						$opt2Type = $opt2Details[2];
				} 
				else 
				{
						$errorMessage = 7;
				}
			}		
			if(isset($_POST))
			{
					
					$titleOfImage = htmlspecialchars($_POST['title']);
					
					$description = htmlspecialchars($_POST['description']);
					
					$price = htmlspecialchars($_POST['price']);
					
					
				if(($titleOfImage != null) AND ($description != null) AND ($errorMessage == 0))
				{
						
						$content =  'Title and Description of image is verified and ready to process.' . '<br/>' . '</br/>' . PHP_EOL;
						$imageTitle = mysqli_real_escape_string($link, $titleOfImage);
						$imageDescription = mysqli_real_escape_string($link, $description);
						$cleanPrice = mysqli_real_escape_string($link, $price);
				}
				else
				{
						
					$errorMessage = 2;
				}
			}
			else
			{
					
					$errorMessage = 5;
			}
		}
			
			
		if(($errorMessage != 2) AND ($errorMessage != 1) AND ($errorMessage != 5))
		{		
				
			if($type == 2)
			{
						
				
					$content .= 'Verifed image is a jpeg file. Will now transfer it to the database.' . '<br/>' . '<br/>' . PHP_EOL;
				
					$newName = "products/" . $productDirect . ($imageTitle . $extension);
				
					$thumb = "products/" . $productDirect . $thumbDirect . ($imageTitle . '_thumb' . $extension);
					$getThumnbnail = imageResize($tmpname, $thumb, 200, 200);
					$getImageNewSize = imageResize($tmpname, $newName, 600, 600);
					
				
					$imagePath = mysqli_real_escape_string($link, $newName);
				
					$nameOfFile = mysqli_real_escape_string($link, $fileName);
					$thumbName = $imageTitle . '_thumbnail';
					$thumbPath =  mysqli_real_escape_string($link, $thumb);
					
					
					
					
					
		
				if($opt1Error !== false)
				{
						$nameOfFile2 = $imageTitle . '_optional 1';
						$imagePath2 = "products/" . $productDirect . $optionalDirect . ($nameOfFile2 . $extension);
						$getImageoptional1 = imageResize($opt1Tmpname, $imagePath2, 400, 400);
				}
				else
				{
						$nameOfFile2 = null;
						$imagePath2 = null;
				}
					
				if($opt2Error !== false)
				{
						$nameOfFile3 = $imageTitle . '_optional 2';
						$imagePath3 = "products/" . $productDirect . $optionalDirect . ($nameOfFile3 . $extension);
						$getImageoptional2 = imageResize($opt2Tmpname, $imagePath3, 400, 400);
				}
				else
				{
						$nameOfFile3 = null;
						$imagePath3 = null;
				}
					
					
				if(file_exists($imagePath))
				{
					if(is_numeric($cleanPrice))
					{
						$proceed = 1;
					}
					else
					{
						$proceed = 0;
					
						$errorMessage = 8;
					}
					
					if((file_exists($imagePath2)) || (file_exists($imagePath3)))
					{
							$proceed = 2;
					}
				}
					
				if($proceed == 1 || $proceed == 2)
				{
						$sql = "INSERT INTO products VALUES ('', '$imageTitle' , '$productType' , '$imageDescription', '$nameOfFile', '$imagePath', '$cleanPrice' , '$thumbName' , '$thumbPath' , '$nameOfFile2' , '$imagePath2' , '$nameOfFile3' , '$imagePath3')";
					$ok = mysqli_query($link, $sql);
					
					if ($ok === false) 
					{
							echo mysqli_error($link);
							$content .= 'Can\'t upload the image data to the database.' . '<br/>' . '<br/>' . PHP_EOL;
					} 
					else 
					{
							$errorMessage = 6;
					}
				}
					
					
			}
			else
			{
					
					$errorMessage = 3;
			}
			
		}

		else
		{
			
		if($error == UPLOAD_ERR_INI_SIZE)
		{
				$content = 'The file exceeds the upload_max_filesize directive in php.ini.' . '<br/>' . '<br/>' . PHP_EOL;
		}
		elseif($error == UPLOAD_ERR_FORM_SIZE)
		{
				$content = 'The file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.' . '<br/>' . '<br/>' . PHP_EOL;
		}
		elseif($error == UPLOAD_ERR_PARTIAL)
		{
				$content = 'The uploaded file was only partially uploaded.' . '<br/>' . '<br/>' . PHP_EOL;
		}
		elseif($error == UPLOAD_ERR_NO_FILE)
		{
			
				$content = 'No file was uploaded (not always an error).' . '<br/>' . '<br/>' . PHP_EOL;		
		}
			
	}
	
}
	else
{
		$errorMessage = 4;
}
}
else
{
	$content = 'No file selected or information inputted into the form.' . '</p>' . '<p>' . '<a href="logIn.php">' . 'Click here to try again' 
	. '</a>' . PHP_EOL;
}

	
	
if($errorMessage == 1)
{
		$content .=  'Can\'t get the details from the image.' . '<br/>' . '<br/>' . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
elseif($errorMessage == 2)
{
		$content .=  'Title and Description of image is not entered or can\'t be verified.' . '<br/>'  . '<br/>' . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
		
}
elseif($errorMessage == 3)
{
		$content .= 'Not a jpeg file!' . '<br/>' . '<br/>'  . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
elseif($errorMessage == 4)
{
		$content .= 'No file selected.' . '<br/>' . '<br/>' . PHP_EOL;
		
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
elseif($errorMessage == 5)
{
		$content .=  'Title and Description of image is not entered or can\'t be verified.' . '<br/>'  . '<br/>' . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
elseif($errorMessage == 8)
{
		$content .=  'Price was not a number in the correct format.' . '<br/>'  . '<br/>' . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
	
elseif($errorMessage == 7)
{
		$content .=  'Cannot get the details from the optional images' . '<br/>'  . '<br/>' . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
elseif($errorMessage == 9)
{
		$content .=  'Type of product is unknown.' . '<br/>'  . '<br/>' . PHP_EOL;
		$content .= 'Click ' .  '<a href="logIn.php">' . 'here ' . '</a>' .  'to try again.' . PHP_EOL;
}
	
elseif($errorMessage == 6)
{
		$content = 'Data has been inserted into the database.' . '<br/>' . '<br/>'  . PHP_EOL;
		$content .= 'View the image in the products page by clicking ' . '<a href="products.php">' . 'here ' . '</a>' . '<br/>' .
		 '<br/>'  . PHP_EOL;
		$content .= 'Or upload another image by clicking ' .  '<a href="logIn.php">' . 'here ' . '</a>' . PHP_EOL;
		$heading = "Form has been processed";
		$title = 'Pics uploaded';
		$footer ='Footer';
		
}

		
		// This gathers all the outputs depending on the errorMessage and will display it.
		$pass1 = str_replace('[+title+]', $title, $tpl);
		$pass2 = str_replace('[+common+]', $common, $pass1);
		$pass3 = str_replace('[+navigation+]', $navigation, $pass2);
		$pass4 = str_replace('[+heading+]', $heading, $pass3);
		$final = str_replace('[+content+]', $content, $pass4);
		//$final = str_replace('[+footer+]', $footer, $pass5);
		echo $final;
		
		// This will close the connection to the database.
		mysqli_close($link);
		
		
		
		
?>


