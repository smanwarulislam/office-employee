<?php
/* $link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error);
	
// todo: DELETE
	if (isset($_GET['id'])) 
	{
		$delete_sql = "DELETE FROM employeesinfo WHERE employees_id = " . $_GET['id'];
		$result_delete = mysql_query($delete_sql)
			or die("Invalid query: " . mysql_error());
	} */
?>
<!-- <a href="index.php">Index</a> -->



<?php
	// print_r($_POST);
	// exit;
	
	$link = mysql_connect("localhost", "root", "")
		or die(mysql_error());
	mysql_select_db("employeesinformation")
		or die(mysql_error);
	
// todo: office_employees -> index.php eai file a [DELETE] link baad diye form er table a add multiple checkbox use korte hobe ebong form er table er sheshe/niche DELETE option ta jog korte hobe

	if (isset($_POST['id'])) 
	{
		foreach($_POST['id'] as $id)
		{
			$delete_sql = "DELETE FROM employeesinfo WHERE employees_id = " . $id;
			$result_delete = mysql_query($delete_sql)
				or die("Invalid query: " . mysql_error());
		}
	}
			
	header('Location: ' . 'index.php');	
?>