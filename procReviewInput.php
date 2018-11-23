
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {




    	 $eventid = $_POST['eventid'];

	 $attenddate = $_POST['attenddate'];

	 $length = $_POST['length'];
	
	 $review = %_POST['review'];




	insertReviewInputIntoDB($eventid,$attenddate,$length,$review);


}

function insertReviewInputIntoDB($eventid,$attenddate,$length,$review){
	//connect to your database. Type in your username, password and the DB path
	$conn= mysql_connect('servername','username', 'password');
	if(!$conn) {
	     print "<br> connection failed:";
        exit;
	}
	$query =  "Insert Into Review(eventid,attenddate,length,review) values($eventid,$attenddate,$length,$review)");



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
