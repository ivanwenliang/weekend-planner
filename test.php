<div class="table-responsive">

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<thead>

<tr>

<th>ID</th>

<th>Event ID</th>

<th>Event Name</th>

<th>Event Location</th>

<th>Event Date</th>

<th>Event Start Time</th>

</tr>

</thead>

<tfoot>

<tr>

<th>ID</th>

<th>Event ID</th>

<th>Event Name</th>

<th>Event Location</th>

<th>Event Date</th>

<th>Event Start Time</th>

</tr>

</tfoot>

<?php

$servername = "127.0.0.1";

$username = "root";

$password = "IbgrwAttn,mwa.11SQL";

$dbname = "planner";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = 'SELECT * from events';

if (mysqli_query($conn, $sql)) {

echo "";

} else {

echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}

$count=1;

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

// output data of each row

while($row = mysqli_fetch_assoc($result)) { ?>

<tbody>

<tr>

<th>

<?php echo $row['eventid']; ?>

</th>

<td>

<?php echo $row['ename']; ?>

</td>

<td>

<?php echo $row['location']; ?>

</td>

<td>

<?php echo $row['eventdate']; ?>

</td>

<td>

<?php echo $row['starttime']; ?>

</td>

</tr>

</tbody>

<?php

$count++;

}

} else {

echo '0 results';

}

?>

</table>