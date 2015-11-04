<?php
$link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error);

include "include_function.php"; /* todo: create a file (include_function.php) that includes some information and this information will show to index.php page and also all other pages */
?>

<form action="index.php" method="get"> <!-- todo: ekhon index page er moddhei Employees Category er ekta drop-down list korte hobe. Pashapashi ekta search box/item korte hobe ejonno je drop-down list er je Employees Category-ta select kore search korbo ta shei Employees Category related onnanno information-gulo show korbe. -->
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
	// check if search value not found
	if (!isset($_GET['employees_category'])) /* condition-ta amon je Employees Category "search" deyar por drop-down list er Employees Category class er related information-e show korbe */ 
	{
		$employees_sql = "SELECT * FROM employeesinfo";
	}
	else
	{
		$employees_sql = "SELECT * FROM employeesinfo WHERE employees_category = " . $_GET['employees_category'];
	}
?>

<?php
	
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