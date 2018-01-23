<?php
// todo: edit_submit
$link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error());
	
	$edit_sql = "UPDATE employeesinfo SET
				   employees_name = '" . $_POST['employees_name'] . "',
				   employees_category = '" . $_POST['employees_category'] . "',
				   employees_position = '" . $_POST['employees_position'] . "'
				WHERE employees_id = " . $_GET['id'];
				
	$result_edit = mysql_query($edit_sql)
		or die("Invalid query: " . mysql_error());
?>
<a href="index.php">Index</a>