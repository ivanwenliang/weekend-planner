DROP DATABASE IF EXISTS planner;
CREATE DATABASE IF NOT EXISTS planner;
USE planner;

SELECT 'CREATING DATABASE STRUCTURE' as 'INFO';

DROP TABLE IF EXISTS Events, User, Goingto, Friends, Review;
              
CREATE TABLE Events (eventid INT, ename varchar(100), location varchar(100), eventdate varchar(50), starttime varchar(20), edesc varchar(300), PRIMARY KEY(eventid));
CREATE TABLE User (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, username varchar(50) NOT NULL UNIQUE, password varchar(255) NOT NULL);
-- CREATE TABLE Goingto (eventid INT, uemail varchar(100), goingdate date, PRIMARY KEY(eventid,uemail),
-- FOREIGN KEY (eventid) REFERENCES Events (eventid),
-- FOREIGN KEY (uemail) REFERENCES User (uemail) );
-- CREATE TABLE Friends (userid INT,friendid INT(10),
-- PRIMARY KEY (userid,friendid),
-- FOREIGN KEY (userid) REFERENCES User (userid),
-- FOREIGN KEY (friendid) REFERENCES User (userid));
CREATE TABLE Review (eventid INT, review varchar(500),ename varchar(100), attenddate varchar(20), rating INT,PRIMARY KEY(review,attenddate),
FOREIGN KEY fk_events (eventid) REFERENCES Events (eventid));
