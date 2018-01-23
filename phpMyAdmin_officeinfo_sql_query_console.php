<?php

/* create the main database if it doesn't already exit
Database: employeesinformation  */
// (["phpMyAdmin"]Run SQL query/queries on database employeesinformation:)

CREATE TABLE IF NOT EXISTS officeinfo (
    office_id int(11) NOT NULL auto_increment,
    office_name varchar(255) NOT NULL,
    office_phone_no int(11) NOT NULL default 0,
    PRIMARY KEY (office_id)
)



/* insert data into "officeinfo" table
Database: employeesinformation »Table: officeinfo */
// (["phpMyAdmin"]Run SQL query/queries on database employeesinformation:)

 INSERT INTO
 `officeinfo`
 (`office_id`,`office_name`,`office_phone_no`)
VALUES
 ('1','Entrance Logic Systems','0289321')   

?>