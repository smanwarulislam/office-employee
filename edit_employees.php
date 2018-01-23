<?php
	include "session.php";

	include "include_function.php";
	
	// print_r($_POST); exit;
	
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
		if($_POST['employees_name'] == "") 
		{
			$employees_name_error = "Edit Employees Name";
			$validation = FALSE;
		}
		
		// validate gender
		if(!isset($_POST['gender'])) 
		{
			$gender_error = "Gender Name is not selected";
			$validation = FALSE;
		}
		
		// validate position
		if($_POST['employees_position'] == "") 
		{
			$validation = FALSE;
			$employees_position_error = "Edit Employees Position";
		}
		
		// validate category
		if($_POST['employees_category'] == "") 
		{
			$validation = FALSE;
			$employees_category_error = "Edit Employees Category";
		}
		
		if($validation == TRUE) 
		{		
			// edit / update row		
			$edit_sql = "UPDATE employeesinfo SET
						   employees_name = '" . $_POST['employees_name'] . "',
						   gender = '" . $_POST['gender'] . "',
						   employees_category = '" . $_POST['employees_category'] . "',
						   employees_position = '" . $_POST['employees_position'] . "'
						WHERE employees_id = " . $_GET['id'];
						
			$result_edit = mysql_query($edit_sql)
				or die("Invalid query: " . mysql_error());
					
			// redirect to home page
			// redirect in PHP / HTTP Headers and the header() function in PHP
			header('Location: ' . 'index.php'); 	
		}
	}
		
	$employees_sql = "SELECT * FROM employeesinfo WHERE employees_id = " . $_GET['id'];
	$result_employees = mysql_query($employees_sql)
		or die("Invalid query: " . mysql_error());
			
	$row = mysql_fetch_assoc($result_employees); /* index.php-a (home/mul page-a) jei table row er [EDIT] link-a click korbo shudhu oi row er single(selected) information oi database er oi table er oi row theke ane edit form-a (edit_employees.php) show korbe */
?>

	<!-- action="edit_submit.php"  (todo: prothome action chilo "edit_submit.php") --> 
	<form action="edit_employees.php?id=<?php echo $_GET['id']; ?>" method="post">
	<table width="750" border="1" cellspacing="1" cellpadding="3" align="center">
		<tr>
			<td width="30%">Employees Name</td>
			<td width="70%">
				<input type="text" name="employees_name" value="<?php if(isset($_POST['employees_name'])) echo $_POST['employees_name']; else echo $row['employees_name']; ?>">
				<br>
<?php
					if(isset($employees_name_error)) 
						echo $employees_name_error;
?>
				</br>
			</td>
		</tr>
		<tr>
			<td>Gender</td>
			<td>
	<?php
		$checked_gender = '';
		
		if(isset($_POST['gender']))
			$checked_gender = $_POST['gender'];
		elseif(isset($row['gender']))
			$checked_gender = $row['gender'];
			
		// echo $checked_gender;	
	?>
				<!-- <input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) AND ($_POST['gender'] == 'Male')) echo 'checked'; ?> > -->
				<!-- <input type="radio" name="gender" value="Male" <?php if($row['gender'] == 'Male') echo 'checked'; ?> >Male -->
				<input type="radio" name="gender" value="Male" <?php if($checked_gender == 'Male') echo 'checked'; ?> >Male
				<br>
				<!-- <input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) AND ($_POST['gender'] == 'Female')) echo 'checked'; ?> >Female -->
				<!-- <input type="radio" name="gender" value="Female" <?php if($row['gender'] == 'Female') echo 'checked'; ?> >Female -->
				<input type="radio" name="gender" value="Female" <?php if($checked_gender == 'Female') echo 'checked'; ?> >Female
				<br>
<?php
					if(isset($gender_error)) 
						echo $gender_error;
?>
				</br>				
			</td>
		</tr>
		<tr>
			<td>Employees Category</td>
			<td>
				<select name="employees_category">
					<option value="">Select</option>				
	<?php
		$selected_cat = '';
		
		if(isset($_POST['employees_category']))
			$selected_cat = $_POST['employees_category'];
		elseif(isset($row['employees_category']))
			$selected_cat = $row['employees_category'];
	
		for ($category = 1; $category <= 10; $category++) 
		{
				// $row_category
				if($category == $selected_cat) 
				{
	?>
					<option value="<?php echo $category; ?>" selected><?php echo $category; ?></option>
	<?php				
				}
				else
				{
	?>
					<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
	<?php
				}
		}
	?>
				</select>
				<br>
<?php
					if(isset($employees_category_error))
						echo $employees_category_error;
?>						
				</br>				
			</td>
		</tr>
		<tr>
			<td>Employees Position</td>
			<td>
				<input type="text" name="employees_position" value="<?php if(isset($_POST['employees_position'])) echo $_POST['employees_position']; else echo $row['employees_position']; ?>">				
				<br>
<?php
					if(isset($employees_position_error))
						echo $employees_position_error;
?>						
				</br>				
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Edit">
			</td>
		</tr>
	</table>
	</form>