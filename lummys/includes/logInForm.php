<?php

// State variables
$form_is_submitted = false;
$errors_detected = false;
$loggedIn = 0;

// Arrays to gather data
$clean = array();
$errors = array();

// Validate form if it was submitted
if (isset($_POST['logInDetails'])) 
{
    
    $form_is_submitted = true;
	$username = htmlspecialchars(($_POST['username']));
	$password = htmlspecialchars(($_POST['password']));
	if ((strlen($username)>=1) && (strlen($password)>=1))
	{
		$logCheck = fopen('information/users.php', 'r');
		
		while (!feof($logCheck))
		{
			$user1 = fgets($logCheck);
			$userTrim = trim($user1);
			$user_info = explode('~', $userTrim);
			if(!empty($user_info[0])) 
			{   
				$clean['username'] = trim($username);
				$clean['password'] = trim($password);
				$username_check = substr_count($user_info[2], $clean['username']);
				$password_check = substr_count($user_info[3], $clean['password']);
				
				
				
				$user_len = strlen($user_info[2]);
				$username_len = strlen($clean['username']);
				$password_len = strlen($clean['password']);
				$pass_len = strlen($user_info[3]);
				if(($username_check == 1)&&($password_check == 1)&&($user_len == $username_len)&&($pass_len == $password_len))
				{
					$loggedIn = 1;
					$_SESSION['username'] = $clean['username'];
					break;	
				}
				
				
				
				
			}
		}
		if(($username_check == 0)&&($user_len == $username_len))
				{
					echo '<h3>' . 'Please enter a correct username' . '</h3>';
				}
		elseif(($password_check == 0)&&($pass_len == $password_len))
				{
					echo '<h3>' . 'Please enter a correct password' . '</h3>';
				}
		else
				{
					echo'<h3>' . 'Please enter a correct username and password' . '</h3>'; 	
				}
				
		fclose($logCheck);
    }
}

// Collect output in a variable, tidier than multiple "echo" calls
$logInForm = '';

// Decide whether to process data or (re)display form

if ($loggedIn === 1 && $form_is_submitted === true) 
{
    
    // Logged in okay and now need to add session and cookie data.
	
    $logInForm .= '<h3>You are logged in</h3>';
	
	header('Location: '.$_SERVER['REQUEST_URI']);
	
	echo '<p>' . 'You must upload a main image (must be JPEG) for the product. It will make a thumbnail of this image.'
		 . '<br/>' . 'You must input a correct title for the product.' . '<br/>' .
		'You must select the type of the product from the options.' . '<br/>' . 
		'You must input a valid price, to two decimal places.' . '<br/>' . 
		'You must input a vdalid description for the product.' . '<br/>' . 
		'You can select two optional images (must be JPEG) if you like.' . '<br/>' . '</p>' . PHP_EOL;
	$logInForm .= '<form enctype="multipart/form-data" action="uploads.php" method="post">
		<fieldset>
		<legend>Form to upload a JPEG image:</legend>
		<br/>
			<label for="imageFile" >Main Image for Product:</label>
			<input name="imageFile" type="file" id="imageFile"/>
			<br/><br/>
			<label for="title" >Title</label>
			<input name="title" type="text" id="title"/>
			<br/><br/>
			<label for="type">Type</label>
			<select name="type" id="type">
							<option value="Bracelet">Bracelet</option>
							<option value="Necklace">Necklace</option>
							<option value="Charms">Charms</option>
							<option value="Misc">Miscellaneous</option>
			</select>
			<br/><br/>
			<label for="price" >Price</label>
			<input name="price" type="text" id="price"/>
			<br/><br/>
			<label for="description" >Description:</label>
			<textarea name="description" cols="30" rows="4" id="description"></textarea>
			<br/><br/>
			<label for="imageFile2" >Optional Image 1:</label>
			<input name="imageFile2" type="file" id="imageFile2"/>
			<br/><br/>
			<label for="imageFile3" >Optional Image 2:</label>
			<input name="imageFile3" type="file" id="imageFile3"/>
			<br/><br/>
			<input type="submit" value="Upload File"/>	
			</fieldset>
		</form>';
		
		
	session_regenerate_id(true);
	
}

 else {
  

    $self = htmlentities($_SERVER['PHP_SELF']);

   
	
	if (!isset($_SESSION['username'])) 
	{
		echo '<h3>' .'Welcome guest, would you like to login' . '</h3>' . PHP_EOL . '<br />';
		
		$logInForm .= '<form action="' . $self . '" method="post">
			<fieldset>
			<legend>Log In</legend>
		
			<div>
			<label for="user">Enter your username = </label>
			<input type="text" name="username" id="user" value="" />
			</div>
			<br/>
			
			<div>
			<label for="pass">Enter your password = </label>
			<input type="password" name="password" id="pass" value="" />
			</div>
			<br/>
			
			<input type="submit" name="logInDetails" value="Log In" />
			
			</fieldset>
			</form>';
	}
	else 
	{
		echo '<h1>' . 'You are logged in' . '</h1>' . PHP_EOL;
		echo '<h3>' .'To log out click ' . '<a href=' . 'logOut.php>' . 'HERE' . '</a>' . '</h3>' . PHP_EOL;   
		echo '<p>' . 'You must upload a main image (must be JPEG) for the product. It will make a thumbnail of this image.'
		 . '<br/>' . 'You must input a correct title for the product.' . '<br/>' .
		'You must select the type of the product from the options.' . '<br/>' . 
		'You must input a valid price, to two decimal places.' . '<br/>' . 
		'You must input a vdalid description for the product.' . '<br/>' . 
		'You can select two optional images (must be JPEG) if you like.' . '<br/>' . '</p>' . PHP_EOL;
		
		$logInForm .= '<form enctype="multipart/form-data" action="uploads.php" method="post">
		<fieldset>
		<legend>Form to upload a JPEG image:</legend>
		<br/>
			<label for="imageFile" >Main Image for Product:</label>
			<input name="imageFile" type="file" id="imageFile"/>
			<br/><br/>
			<label for="title" >Title</label>
			<input name="title" type="text" id="title"/>
			<br/><br/>
			<label for="type">Type</label>
			<select name="type" id="type">
							<option value="Bracelet">Bracelet</option>
							<option value="Necklace">Necklace</option>
							<option value="Charms">Charms</option>
							<option value="Misc">Miscellaneous</option>
			</select>
			<br/><br/>
			<label for="price" >Price</label>
			<input name="price" type="text" id="price"/>
			<br/><br/>
			<label for="description" >Description:</label>
			<textarea name="description" cols="30" rows="4" id="description"></textarea>
			<br/><br/>
			<label for="imageFile2" >Optional Image 1:</label>
			<input name="imageFile2" type="file" id="imageFile2"/>
			<br/><br/>
			<label for="imageFile3" >Optional Image 2:</label>
			<input name="imageFile3" type="file" id="imageFile3"/>
			<br/><br/>
			<input type="submit" value="Upload File"/>	
			</fieldset>
		</form>';
		
	}

}

// Echo gathered output from script
echo $logInForm;


?>
