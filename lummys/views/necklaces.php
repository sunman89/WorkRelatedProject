<?php
					
					
					$getType = $_GET['type'];
					$cleanProductType = htmlentities($getType);
					
					
					
					$sql = "Select id, title, description, price, thumbFilePath, productType FROM products WHERE productType = '$cleanProductType'";
					
					$result = mysqli_query($link, $sql);
					
					
					if($result === false)
					{
						echo mysqli_error($link);
					}
					else
					{
						
						while($row = mysqli_fetch_assoc($result))
						{
							
						
							$cleanDataID = htmlentities($row['id']);
							$cleanDataPath = htmlentities($row['thumbFilePath']);
							$cleanDataDesc = htmlentities($row['description']);
							$cleanDataPrice = htmlentities($row['price']);
							$cleanDataTitle = htmlentities($row['title']);
							
						
							$header = '<h1>' . 'Necklaces' . '</h1>';
							$header .= '<h4>' . 'Click on product image to view more information about that product' . '</h4>';
							$content .= "<div id= \"image$cleanDataID\" class=\"productContent\">" . PHP_EOL;
							$content .= "<div id= \"product$cleanDataID\" class=\"productDisplay\">" . PHP_EOL;
							$content .= '<h3 class="productText">' . $cleanDataTitle . '</h3>' . '<br/><br/>' . '<h3
							 class="productText">' .  'Price = £' . $cleanDataPrice . '</h3>' .
							 PHP_EOL;
							 $content .= "</div>" . PHP_EOL;
							$content .= "<a href='viewProduct.php?id=$cleanDataID'>";
							$content .= "<img src='$cleanDataPath' alt='$cleanDataDesc'";
							$content .= ' class="productImage"' . '/>';
							$content .= "</a>" . PHP_EOL;
							$content .= "</div>" . PHP_EOL;
						}
						
					// Frees up the result.
					mysqli_free_result($result);
					// Closes the connection to the database.
					mysqli_close($link);
					}
				?>