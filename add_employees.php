<?php
	include "session.php";

	include "include_function.php";
	
	// print_r($_POST); exit;
	// check if form submitted
	if(isset($_POST['submit'])) // -> submit
	{
		// -> validation
		// validation start
		$validation = TRUE;

		// validate name
		if($_POST['employees_name'] == "") 
		{
			$employees_name_error = "Employees Name is required";
			$validation = FALSE;
		}
		
		// validate gender
		if(!isset($_POST['gender'])) 
		{
			$gender_error = "Gender Name is not selected";
			$validation = FALSE;
		}
		
		// validate category
		if(!isset($_POST['employees_category']) OR $_POST['employees_category'] == "")
		{
			$employees_category_error = "Employees Category is not selected";
			$validation = FALSE;
		}
		
		// validate position
		if($_POST['employees_position'] == "") 
		{
			$validation = FALSE;
			$employees_position_error = "Employees Position is required";
		}
		
		if($validation == TRUE) // -> insert
		{
			$link = mysql_connect("localhost", "root", "")
				or die(mysql_error());
			mysql_select_db("employeesinformation")
				or die(mysql_error());
				
			$add_sql = "INSERT INTO employeesinfo
				(employees_name,
				gender,
				employees_category,
				employees_position)
				VALUES
				('" . $_POST['employees_name'] . "',
				'" . $_POST['gender'] . "',
				'" . $_POST['employees_category'] . "',
				'" . $_POST['employees_position'] . "')";

				$result_add = mysql_query($add_sql)
					or die("Invalid query: " . mysql_error());
					
			// redirect to home page
			// redirect in PHP / HTTP Headers and the header() function in PHP			
			header('Location: ' . 'index.php'); 
		}
	}	
?>

		<!-- action="add_submit.php"  (todo: prothome action chilo "add_submit.php") --> 
		<form action="http://localhost/project/office_employees/add_employees.php" method="post">
		<table width="750" border="1" cellspacing="1" cellpadding="3" align="center">
			<tr>
				<td width="30%">Employees Name</td>
				<td width="70%">

					<input type="text" name="employees_name" value="<?php if(isset($_POST['employees_name'])) echo $_POST['employees_name']; ?>">
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
				
					<input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) AND ($_POST['gender'] == 'Male')) echo 'checked'; ?> >Male
					<br>
					<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) AND ($_POST['gender'] == 'Female')) echo 'checked'; ?> >Female
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
						<option value="" selected>Select a category...</option>
						
		<?php
			for ($category = 1; $category <= 10; $category++) 
			{
				// check if category found in POST and match
				if((isset($_POST['employees_category'])) && ($category == $_POST['employees_category'])) 
				{
		?>
						<option value="<?php echo $category; ?>" selected><?php echo $category; ?></option>
				
		<?php
				}
		?>
						<option value="<?php echo $category ;?>"><?php echo $category; ?></option>
		<?php
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
				
					<input type="text" name="employees_position" value="<?php if(isset($_POST['employees_position'])) echo $_POST['employees_position']; ?>">
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
					<input type="submit" name="submit" value="Add">
					<br></br>
				</td>
			</tr>
		</table>
		</form>