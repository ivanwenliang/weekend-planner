<?php
//Create connection to database
$servername = "127.0.0.1",
$username = "root",
$password = "",
$dbname = "planner";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection validity
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
?>