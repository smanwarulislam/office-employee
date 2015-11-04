<?php

/* create the main database if it doesn't already exit
Database:  login_form  */
// (["phpMyAdmin"]Run SQL query/queries on database  login_form:)

CREATE TABLE IF NOT EXISTS login(
id int(11) NOT NULL AUTO_INCREMENT,
username varchar(255) NOT NULL,
password varchar(255) NOT NULL,
PRIMARY KEY (id)
)

?>