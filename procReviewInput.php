<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1", "root", "IbgrwAttn,mwa.11SQL", "planner");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$eventid = mysqli_real_escape_string($link, $_REQUEST['eventid']);
$review = mysqli_real_escape_string($link, $_REQUEST['review']);
$ename = mysqli_real_escape_string($link, $_REQUEST['ename']);
$attenddate = mysqli_real_escape_string($link, $_REQUEST['attenddate']);
$rating = mysqli_real_escape_string($link, $_REQUEST['length']);

// Attempt insert query execution
$sql = "INSERT INTO Review (eventid, review, ename, attenddate, rating) VALUES ('$eventid', '$review', '$ename', '$attenddate', '$rating')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
