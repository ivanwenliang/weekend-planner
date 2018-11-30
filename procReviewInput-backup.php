
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


		

     $eventid = $_POST['eventid'];
	
	 $ename = $_POST['ename'];

	 $attenddate = $_POST['attenddate'];

	 $length = $_POST['length'];

	 $review = $_POST['review'];




	insertReviewInputIntoDB($eventid,$ename,$attenddate,$length,$review);


}

function insertReviewInputIntoDB($eventid,$ename,$attenddate,$length,$review){
	//connect to your database. Type in your username, password and the DB path
	$conn= mysqli_connect('127.0.0.1','root', 'IbgrwAttn,mwa.11SQL', 'planner');
  if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
  }

  // $db_selected = mysqli_select_db('planner',$conn);

  // if (!$db_selected) {
  //       die('Can \'t use ' . 'planner' . ':' . mysqli_error());
  // }

	$sql =  "INSERT INTO Review(eventid,review,ename,attenddate,rating) values('$eventid','$review','$ename','$attenddate','$length')";



	// Execute the query
if (!mysqli_query($sql)){
    die('Error: ' . mysqli_error());
}
	mysqli_close($conn);
}

?>
