<?php
$link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error);

include "include_function.php"; 
?>

<form action="search_result.php" method="get"> <!-- ei php file-ta (search_result.php) eai jonno kora hoichilo je prothom dike index.php file-ta te action="search_result.php" chilo. pore index.php file-ta te action="index.php deya hoichilo eai jonno je search korle index.php file-ta tei jate show kore -->
Employees Category:
	<select name="employees_category">
		<option value="" selected>Select a category...</option>
	<?php
		for ($category = 1; $category <= 10; $category++) 
		{
	?>
		<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
	<?php
		}
	?>
	</select>
	
	<input type="submit">
</form>

<table border="1" cellpadding="2" cellspacing="2" align="center">
	<tr>
		<th>Employees Name</th>
		<th>Employees Category</th>
		<th>Employees Position</th>
		<th>Action</th>
	</tr>

<?php
	$employees_sql = "SELECT * FROM employeesinfo WHERE employees_category = " . $_GET['employees_category'];
	$result_employees = mysql_query($employees_sql)
		or die("Invalid query: " . mysql_error());
	while ($row = mysql_fetch_array($result_employees)) {
?>
	<tr>
		<td><?php echo $row['employees_name']; ?></td>
		<td><?php echo $row['employees_category']; ?></td>
		<td><?php echo $row['employees_position']; ?></td>
		<td>
			<a href="edit_employees.php?id=<?php echo $row['employees_id']; ?>">[EDIT]</a>
			<a href="delete.php?id=<?php echo $row['employees_id']; ?>">[DELETE]</a>
		</td>
	</tr>
<?php
}
?>
</table>