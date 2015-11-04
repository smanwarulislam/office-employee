<!-- todo: include statement -->
Employees <a href="add_employees.php">[ADD]</a><br>

<a href="paasword_change.php">Change the Password</a><br> <!-- password change korer jonno ekta link korlam -->

<a href="logout.php">Logout</a>


<?php
	$link = mysql_connect("localhost", "root", "")
		or die(mysql_error());
	mysql_select_db("employeesinformation")
		or die(mysql_error());
	
	$office_sql = "SELECT * FROM officeinfo";
	$result_office = mysql_query($office_sql)
		or die("Invalid query: " . mysql_error());
	while ($row = mysql_fetch_array($result_office)) {
?>
		<div align="center">
			Office Name: <?php echo $row['office_name']; ?><br>
			Phone Number: <?php echo $row['office_phone_no']; ?><br>

<!-- todo: eki Database-a i mean employeesinformation Database-a arekti Table (suppose -> officeinfo) create korte hobe ebong shei table-a office name, office phone no. store korte hobe. erpor eki page-a (suppose -> index page-a Office Name, Phone Number er Update Information [UPDATE] dekhabe i mean eki page-a) -->
Update Information <a href="update_office.php?id=<?php echo $row['office_id']; ?>">[UPDATE]</a>			
<?php
	}
?>
		</div>