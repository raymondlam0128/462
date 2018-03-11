DROP DATABASE IF EXISTS 462_schedule_project;
CREATE DATABASE IF NOT EXISTS 462_schedule_project;
/*
DROP USER IF EXISTS 'binh'@'localhost';
GRANT SELECT, INSERT, DELETE, UPDATE
ON 462_schedule_project.*
TO 'binh'@'localhost' IDENTIFIED BY 'binhlam';
*/
USE 462_schedule_project;

CREATE TABLE prerequest
(
  ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MFName VARCHAR(100) NOT NULL,
  MLName VARCHAR(100) NOT NULL,
  EFName VARCHAR(150) NOT NULL,
  ELName VARCHAR(250) NOT NULL,
  StartDate VARCHAR(100) NOT NULL,
  EndDate VARCHAR(100) NOT NULL,
  Status VARCHAR(10) NOT NULL



);


INSERT INTO prerequest VALUES
(100, 'Donald', 'Duck', 'DANH', 'PHAM', '10/22/1991', '10/23/1991', 'undefine'),
(101, 'binh', 'lam', 'DANH', 'PHAM', '11/23/1991', '11/24/1991', 'undefine');
