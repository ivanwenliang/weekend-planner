
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {




     $eventid = $_POST['eventid'];

	 $attenddate = $_POST['attenddate'];

	 $length = $_POST['length'];




	insertReviewInputIntoDB($eventid,$attenddate,$length);


}

function insertReviewInputIntoDB($eventid,$attenddate,$length){
	//connect to your database. Type in your username, password and the DB path
	$conn= mysql_connect('servername','username', 'password');
	if(!$conn) {
	     print "<br> connection failed:";
        exit;
	}
	$query =  "Insert Into Review(eventid,attenddate,length) values($eventid,$attenddate,$length)");



	// Execute the query
  mysql_select_db('Review');
	$res = mysql_query($query, $conn);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		die('Could not enter data: ' . mysql_error());
	}
	mysql_close($conn);
}

?>
