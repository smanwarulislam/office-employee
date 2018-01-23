<?php
// todo: SQL ORDER BY Keyword
/* $link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error());
	
	$sql = "SELECT * FROM employeesinfo ORDER BY employees_name DESC";
				
	$result = mysql_query($sql)
		or die("Invalid query: " . mysql_error()); */
		
		
// todo: SQL ORDER BY Keyword
// Database: employeesinformation »Table: employeesinfo 
// (["phpMyAdmin"]Run SQL query/queries on database employeesinformation:)

SELECT * FROM employeesinfo
ORDER BY employees_name DESC;
?>