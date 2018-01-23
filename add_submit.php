<?php
// todo: add_submit
$link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error());
	
	$add_sql = "INSERT INTO employeesinfo
		(employees_name,
		employees_category,
		employees_position)
	VALUES
	    ('" . $_POST['employees_name'] . "',
		'" . $_POST['employees_category'] . "',
		'" . $_POST['employees_position'] . "')";
		
	$result_add = mysql_query($add_sql)
		or die("Invalid query: " . mysql_error());
?>
<a href="index.php">Index</a>