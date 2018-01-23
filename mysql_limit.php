<?php
// todo: Limit Data Selections From a MySQL Database
$link = mysql_connect("localhost", "root", "")
	or die(mysql_error());
mysql_select_db("employeesinformation")
	or die(mysql_error());
	
	// $sql = "SELECT * FROM employeesinfo LIMIT 10";
	// $sql = "SELECT * FROM employeesinfo ORDER BY employees_name DESC LIMIT 10";
	// $sql = "SELECT * FROM employeesinfo LIMIT 10 OFFSET 15";
				
	$result = mysql_query($sql)
		or die("Invalid query: " . mysql_error());



// todo: Limit Data Selections From a MySQL Database
// Database: employeesinformation »Table: employeesinfo
// (["phpMyAdmin"]Run SQL query/queries on database employeesinformation:)

// Show query box
/* SELECT * FROM employeesinfo
LIMIT 10  */

// Showing rows 0 - 9 (10 total, Query took 0.0010 seconds.) [employees_name: TEST NAME - ]
// SELECT * FROM employeesinfo ORDER BY employees_name DESC LIMIT 10 

// Mysql also provides a way to handle this: by using OFFSET
/* SELECT * FROM employeesinfo
LIMIT 10 OFFSET 15; */
?>