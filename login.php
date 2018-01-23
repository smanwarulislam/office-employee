<?php
	// start the session 
	session_start();
	require_once __DIR__ . '../src/autoload.php';

	// reCAPTCHA
	$siteKey = '6Lcv2AsTAAAAAK0HoW4q7vTPFnIw0mkfYGeu6byu';
	$secret = '6Lcv2AsTAAAAACvEyyQQJxMa9XijXbeV7kCU9dhE';
	$lang = 'en';
	
	// print_r($_POST);
	if(isset($_POST['submit']))
	{
		// check if captcha posted
		if (isset($_POST['g-recaptcha-response']) AND $_POST['g-recaptcha-response'] != '')
		{
			// echo '<tt><pre>'. var_export($_POST) .'</pre></tt>'; exit;
			// load captcha library
			$recaptcha = new \ReCaptcha\ReCaptcha($secret);

			// Make the call to verify the response and also pass the user's IP address
			$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

			// If the response is a success, that's it!
			if ($resp->isSuccess())
			{
				// database connection
				$link = mysql_connect("localhost", "root", "")
					or die(mysql_error());
				mysql_select_db("employeesinformation")
					or die(mysql_error());
			
				// check if username and password match
				// $sql = "SELECT * FROM users WHERE username = '". $_POST['username'] ."' and password = '". $_POST['password'] ."'";
				// echo $sql;
				
				// encrypting password using md5() function
				$sql = "SELECT * FROM users WHERE username = '". $_POST['username'] ."' and password = '". md5($_POST['password']) ."'";  
				// echo $sql; exit;

				$result = mysql_query($sql)
					or die("Invalid query: " . mysql_error());

				$num_rows = mysql_num_rows($result); // mysql_num_rows — Get number of rows in result
				// echo $num_rows;
				
				if($num_rows > 0)
				{
					$_SESSION['username'] = $_POST['username']; // create session and storing session
					header('Location: ' . 'index.php'); // redirect to home page
				}
				else
				{
					$error = "Password not matched!";
				}
			}
			else
			{
				$captcha_error = "Captcha not matched!";
			} // end else captcha not matched
		}
		else
		{
			$captcha_error = "Please input captcha!";
		} // end else captcha posted
	}
?>

<form action="login.php" method="post">
<table width="750" border="1" cellspacing="1" cellpadding="3" align="center">
	<tr>
		<td width="30%">Username</td>
		<td width="70%">
			<input type="text" name="username">
		</td>
	</tr>
	
	<tr>
		<td width="30%">Password</td>
		<td width="70%">
			<input type="password" name="password">
			<br>
<?php
				if(isset($error)) echo $error;
?>
			</br>
		</td>
	</tr>

	<tr>
		<td width="100%" colspan="2">
            <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
            <script type="text/javascript"
                    src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>">
            </script>
<?php
			if(isset($captcha_error)) echo $captcha_error;
?>
		</td>
	</tr>

	<tr>
		<td colspan="2" align="center">
			<input type="submit" name="submit" value="Login">
		</td>
	</tr>
</table>
</form>