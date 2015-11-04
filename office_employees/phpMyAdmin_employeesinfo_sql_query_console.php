<?php

/* create the main database if it doesn't already exit
Database: employeesinformation  */
// (["phpMyAdmin"]Run SQL query/queries on database employeesinformation:)

CREATE TABLE IF NOT EXISTS employeesinfo (
    employees_id int(11) NOT NULL auto_increment,
    employees_name varchar(255) NOT NULL,
    employees_category tinyint(2) NOT NULL default 0,
    employees_position int(11) NOT NULL default 0,
    PRIMARY KEY (employees_id)
    );


	
/* insert data into "studentinfo" table
Database: employeesinformation »Table: employeesinfo */
// (["phpMyAdmin"]Run SQL query/queries on database employeesinformation:)

INSERT INTO
 `employeesinfo`
 (`employees_id`,`employees_name`,`employees_category`,`employees_position`)
VALUES
 ('1','Alif Alauddin','1','3'),
 ('2','Brayan Adam','2','2'),
 ('3','Chris Harrish','3','1');

?>