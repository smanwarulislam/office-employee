<?php
	// todo: UPDATE
	// database connection
	$link = mysql_connect("localhost", "root", "")
		or die(mysql_error());
	mysql_select_db("employeesinformation")
		or die(mysql_error);
		
	// check if form submitted
	if(isset($_POST['submit'])) // -> submit
	{
		// validation start
		$validation = TRUE;
		
		// validate name
		if($_POST['office_name'] == "") 
		{
			$office_name_error =  "Update Office Name";
			$validation = FALSE;
		}
		
		// validate number
		if($_POST['office_phone_no'] == "") 
		{
			$validation = FALSE;
			$office_phone_no_error = "Update Phone Number";
		}
		
		if($validation == TRUE) 
		{
			// update row
			$update_sql = "UPDATE officeinfo SET
							 office_name = '" . $_POST['office_name'] . "',
							 office_phone_no = '" . $_POST['office_phone_no'] . "'
						  WHERE office_id = " . $_GET['id'];
						
			$result_update = mysql_query($update_sql)
				or die("Invalid query: " . mysql_error());
				
			// redirect to home page
			// redirect in PHP / HTTP Headers and the header() function in PHP
			header('Location: ' . 'index.php');
		}
	}
		
	$office_sql = "SELECT * FROM officeinfo WHERE office_id = " . $_GET['id'];
	$result_office = mysql_query($office_sql)
		or die("Invalid query: " . mysql_error());
		
	$row = mysql_fetch_assoc($result_office); // for single(selected) input showing to edit form
?>

	<form action="update_office.php?id=<?php echo $_GET['id']; ?>" method="post">
	<table width="750" border="1" cellspacing="1" cellpadding="3" align="center">
		<tr>
			<td width="30%">Office Name</td>
			<td width="70%">
				<input type="text" name="office_name" value="<?php if(isset($_POST['office_name'])) echo $_POST['office_name']; else echo $row['office_name']; ?>">
				<br>
<?php
					if(isset($office_name_error)) 
						echo $office_name_error;
?>
				</br>
			</td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>
				<input type="text" name="office_phone_no" value="<?php if(isset($_POST['office_phone_no'])) echo $_POST['office_phone_no']; else echo $row['office_phone_no']; ?>">
				<br>
<?php
					if(isset($office_phone_no_error)) 
						echo $office_phone_no_error;
?>
				</br>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Update">
			</td>
		</tr>
	</table>
	</form>