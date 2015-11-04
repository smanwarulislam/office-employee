<?php
// todo: update_submit
$link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error);
	
	$update_sql = "UPDATE officeinfo SET
					 office_name = '" . $_POST['office_name'] . "',
				     office_phone_no = '" . $_POST['office_phone_no'] . "'
				  WHERE office_id = " . $_GET['id'];
				
	$result_update = mysql_query($update_sql)
		or die("Invalid query: " . mysql_error());
?>
<a href="index.php">Index</a>