
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {




    	 $eventid = $_POST['eventid'];

	 $attenddate = $_POST['attenddate'];

	 $length = $_POST['length'];

	 $review = $_POST['review'];




	insertReviewInputIntoDB($eventid,$attenddate,$length,$review);


}

function insertReviewInputIntoDB($eventid,$attenddate,$length,$review){
	//connect to your database. Type in your username, password and the DB path
	$conn= mysql_connect('localhost','root', 'Eng!dc*18');
  if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
  }

  $db_selected = mysql_select_db('planner',$conn);

  if (!$db_selected) {
        die('Can \'t use ' . 'planner' . ':' . mysql_error());
  }

	$sql =  "INSERT INTO Review(eventid,attenddate,length,review) values($eventid,$attenddate,$length,$review)");



	// Execute the query
if (!mysql_query($sql)){
    die('Error: ' . mysql_error());
}
	mysql_close($conn);
}

?>
