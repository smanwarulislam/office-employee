<?php
	include "session.php";
	
	// connect db 
	$link = mysql_connect("localhost", "root", "")
		or die(mysql_error());
	mysql_select_db("employeesinformation")
		or die(mysql_error());

	include "include_function.php"; /* todo: create a file (include_function.php) that includes some information and this information will show to index.php page and also all other pages */
?>

<form action="index.php" method="get"> <!-- todo: ekhon index page er moddhei Employees Category er ekta drop-down list korte hobe. Pashapashi ekta search box/item korte hobe ejonno je drop-down list er je Employees Category-ta select kore search korbo ta shei Employees Category related onnanno information-gulo show korbe. -->
Employees Category:
	<select name="employees_category">
		<option value="" >Select a category...</option>
	<?php
		for ($category = 1; $category <= 10; $category++) 
		{
			if ($_GET['employees_category'] == $category)
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
	<input type="submit">
</form>

<?php
	$limit = 10; // selected amount of rows

	// check if isset offset 
	if (isset($_GET['offset']))
		$sql_offset = $_GET['offset'];
	else
		$sql_offset = 0;

	// check if employees_category not found
	if (!isset($_GET['employees_category']) || ($_GET['employees_category'] == "")) 
	{
		$employees_sql = "SELECT * FROM employeesinfo LIMIT " . $limit . " OFFSET " . $sql_offset;
	}
	else 
	{
		$employees_sql = "SELECT * FROM employeesinfo WHERE employees_category = " . $_GET['employees_category'] ." LIMIT " . $limit . " OFFSET " . $sql_offset;
	}

	$result_employees = mysql_query($employees_sql) // run the query
		or die("Invalid query: " . mysql_error());
?>

<!-- show list -->
<form action="delete.php" method="post">
<table border="1" cellpadding="2" cellspacing="2" align="center">
	<tr>
		<th>Select</th>
		<th>ID</th>
		<th>Employees Name</th>
		<th>Gender</th>
		<th>Employees Category</th>
		<th>Employees Position</th>
		<th>Action</th>
	</tr>
		
<?php	
	$result_employees = mysql_query($employees_sql)
		or die("Invalid query: " . mysql_error());
	while ($row = mysql_fetch_array($result_employees)) 
	{
?>
	<tr>
		<td>
			<input type="checkbox" name="id[]" value="<?php echo $row['employees_id']; ?>">
		</td>
		<td><?php echo $row['employees_id']; ?></td>
		<td><?php echo $row['employees_name']; ?></td>
		<td><?php echo $row['gender']; ?></td>
		<td><?php echo $row['employees_category']; ?></td>
		<td><?php echo $row['employees_position']; ?></td>
		<td>
			<a href="edit_employees.php?id=<?php echo $row['employees_id']; ?>">[EDIT]</a>
			<!-- <a href="delete.php?id=<?php echo $row['employees_id']; ?>">[DELETE]</a> -->
		</td>		
	</tr>
	
<?php
	}
?>

	<tr>
		<td>
			<input type="submit" name="delete" value="Delete">
		</td>
	</tr>
		
</table>	
</form>		

<?php
	// count total rows
	// check if employees_category found
	if (isset($_GET['employees_category']) && ($_GET['employees_category'] != ""))
	{
		$employees_sql = "SELECT * FROM employeesinfo WHERE employees_category = " .  $_GET['employees_category'];
	}
	else
	{
		$employees_sql = "SELECT * FROM employeesinfo";
	}

	$result_employees = mysql_query($employees_sql) // run the query
		or die("Invalid query: " . mysql_error());
		
	$total_rows = mysql_num_rows($result_employees); // Return the number of rows in result set

	$total_pages = $total_rows / $limit;

	$total_pages = ceil($total_pages);  /* ceil — Round fractions up (php.net) / The ceil() function rounds a number UP to the nearest integer, if necessary (w3schools.com) */
?>

<?php
	// check if pagination link needed
	if($total_pages > 1)
	{
		// pagination link start
		for ($page = 1; $page <= $total_pages; $page++) 
		{
			$offset = $page * $limit - $limit;
			// echo $offset; 
			
			// Page link
			// check if employees_category found
			if (isset($_GET['employees_category']))
			{
	?>
				<a href="index.php?offset=<?php echo $offset; ?>&employees_category=<?php echo $_GET['employees_category']; ?>"> 
					<?php echo $page; ?>
				</a>
	<?php
			}
			else
			{
	?>
				<a href="index.php?offset=<?php echo $offset; ?>"> 
					<?php echo $page; ?>
				</a>
	<?php
			}	
		} // pagination link end
	}
?>