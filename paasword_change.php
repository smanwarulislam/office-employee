<?php
	include "session.php";
	
	// print_r($_POST); exit;
	if(isset($_POST['submit']))
	{
		// check validation
		$validation = TRUE;
		
		if($_POST['newPassword'] == '')
		{
			$validation = FALSE;
			$confirm_error = "New Password is required!";
		}
		elseif($_POST['newPassword'] != $_POST['confirmnewPassword'])
		{
			$validation = FALSE;
			$confirm_error = "New Password and Confirm New Password don't match!";
		}
		
		if($validation == TRUE)
		{
			// database connection
			$link = mysql_connect("localhost", "root", "")
				or die(mysql_error());
			mysql_select_db("employeesinformation")
				or die(mysql_error());
			
			//
			$sql = "SELECT * FROM users WHERE username = '". $_SESSION['username'] ."' and password = '". md5($_POST['currentPassword']) ."'";
			// print_r($sql); exit;
			// echo $sql; exit;
			
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());

			$num_rows = mysql_num_rows($result); 
			
			// user found, update new password into db
			if($num_rows > 0)
			{
				$change_sql = "UPDATE users SET password='" . md5($_POST["newPassword"]) ."' WHERE username = '". $_SESSION['username'] ."'";
				// echo $change_sql; exit;
				mysql_query($change_sql);
				// echo "Password Changed";
				header('Location: ' . 'index.php'); // redirect to home page
			}
			else
			{
				$error = "Current Password is wrong!";
			}
		}
	}
?>


	<form action="paasword_change.php" method="post">
	<table width="750" border="1" cellspacing="1" cellpadding="3" align="center">
		<tr>
			<td width="30%">Current / Old Password</td>
			<td width="70%">
				<input type="password" name="currentPassword">
				<br>
<?php
					if(isset($error))
					echo $error;
?>
				</br>
			</td>
		</tr>
		
		<tr>
			<td width="30%">New Password</td>
			<td width="70%">
				<input type="password" name="newPassword">
			</td>
		</tr>
		
		<tr>
			<td width="30%">Confirm New Password</td>
			<td width="70%">
				<input type="password" name="confirmnewPassword">
				<br>
<?php
					if(isset($confirm_error))
					echo $confirm_error;
?>
				</br>
			</td>
		</tr>
		
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Login">
			</td>
		</tr>
	</table>
	</form>