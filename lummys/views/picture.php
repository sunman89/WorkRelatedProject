<?php
	
	
	$picID = htmlentities($pictureID);
	
	// Save the query.
	$sql = "Select id, title, productType, description, price,  filePath, filePath2, filePath3 FROM products WHERE id = $picID";
	$result = mysqli_query($link, $sql);
	
	// This will check to see if the query has returned data or not.
	if($result === false)
	{
		echo mysqli_error($link);
	}
	else
	{
		// This will fetch the row of data from $result and gather the correct data from the database.
		// It will loop through the row and store the necessary data.
		while($row = mysqli_fetch_assoc($result))
		{
			
			
			
			$cleanPath = htmlentities($row['filePath']);
			$cleanDescrip = htmlentities($row['description']);
			$cleanType = htmlentities($row['productType']);
			$cleanPrice = htmlentities($row['price']);
			$cleanPath2 = htmlentities($row['filePath2']);
			$cleanPath3 = htmlentities($row['filePath3']);
	
			
			// This creates a div tag in the content variable.
			$content = '<div id="display">' . PHP_EOL;
			$content .= '<div id="imageInfo">' . PHP_EOL;
			
			$content .= '<h3>' . 'Title: ' . htmlentities($row['title']). '</h3>' . PHP_EOL;
			
			$content .= '<p>' . 'Type of product: ' . $cleanType . '</p>' . PHP_EOL;
		
			$content .= '<p>' . 'Description: ' . $cleanDescrip . '</p>' . PHP_EOL;
			
			$content .= '<p>' . 'Price: £' . $cleanPrice . '</p>' . PHP_EOL;
			$content .= '<p>' . 'If you would like to enquire about this product, just ' . '<a href="contact.php">' . 'click here to go to the contact page'. '</a>' .' for details on how to get in contact. Make sure to write down the title of the product/s and the quantity, as this information is needed.' . '</p>' . PHP_EOL;
			$content .= '</div>' . '<br/>' . '<br/>' . PHP_EOL;
			$content .= '<div id="image">' . PHP_EOL;
			$content .= "<a href='products.php'>";
			
			$content .= "<img src='$cleanPath' alt='$cleanDescrip'/>";
			
			$content .= "</a>";
			$content .= '<br/>' . PHP_EOL;
			$content .= '</div>' . '<br/>' . '<br/>' . PHP_EOL;
			$content .= '</div>' . '<br/>' . '<br/>' . PHP_EOL;
			if(($cleanPath2 != null) || ($cleanPath3 != null))
			{
				$content .= '<div id="optionalImages">' . PHP_EOL;
				$content .= '<h3>' . 'Extra Image/s' . '</h3>' . PHP_EOL;
				if($cleanPath2 != null)
				{
					$content .= '<div id="optionalImage1">' . PHP_EOL;
					$content .= "<img src='$cleanPath2' alt='$cleanDescrip'/>";
			
					$content .= '</div>' . PHP_EOL;
				}
				if($cleanPath3 != null)
				{
					$content .= '<div id="optionalImage2">' . PHP_EOL;
					$content .= "<img src='$cleanPath3' alt='$cleanDescrip'/>";
					
					$content .= '</div>' . PHP_EOL;
				}
			
				$content .= '</div>' . '<br/>' . '<br/>' . PHP_EOL;
			}
		}
		
	// This will free up the variable $result.
	mysqli_free_result($result);
	
	}
	
	// This will close the connection to the database.
	mysqli_close($link);
	
?>