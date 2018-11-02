CREATE TABLE Events (eventid num(10), category varchar(20), tstamp date, ename varchar(20), PRIMARY KEY(eventid));
CREATE TABLE User (userid num(10), fname varchar(20), lname varchar(20), PRIMARY KEY(userid));
CREATE TABLE Goingto (eventid num(10), userid num(10), goingdate date, PRIMARY KEY(eventid,userid),
FOREIGN KEY (eventid) REFERENCES Events (eventid),
FOREIGN KEY (userid) REFERENCES User (userid) );
CREATE TABLE Friends (userid num(10),friendid num(10),
PRIMARY KEY (userid,friendid),
FOREIGN KEY (userid) REFERENCES User (userid),
FOREIGN KEY (friendid) REFERENCES User (userid));
