
-- Database : reglog
CREATE DATABASE reglog;


-- Table: user
CREATE TABLE user (
    id int(11) auto_increment primary key, 
	username varchar(255),
	password varchar(255),
	email varchar(255)
);