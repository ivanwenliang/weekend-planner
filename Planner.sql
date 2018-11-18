DROP DATABASE IF EXISTS planner;
CREATE DATABASE IF NOT EXISTS planner;
USE planner;

SELECT 'CREATING DATABASE STRUCTURE' as 'INFO';

DROP TABLE IF EXISTS Events, User, Goingto, Friends, Review;
              
CREATE TABLE Events (eventid INT, ename varchar(20), location varchar(20), eventdate date, starttime time, endtime time  PRIMARY KEY(eventid));
CREATE TABLE User (uemail INT, fname varchar(20), lname varchar(20), PRIMARY KEY(uemail));
CREATE TABLE Goingto (eventid INT, userid INT, goingdate date, PRIMARY KEY(eventid,userid),
FOREIGN KEY (eventid) REFERENCES Events (eventid),
FOREIGN KEY (userid) REFERENCES User (userid) );
CREATE TABLE Friends (userid INT,friendid INT(10),
PRIMARY KEY (userid,friendid),
FOREIGN KEY (userid) REFERENCES User (userid),
FOREIGN KEY (friendid) REFERENCES User (userid));
CREATE TABLE Review (review varchar(500),ename varchar(20), attenddate date, rating INT,PRIMARY KEY(ename,attenddate),
FOREIGN KEY (ename) REFERENCES Events (ename));
