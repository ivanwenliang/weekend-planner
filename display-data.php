<?php
$conn= mysql_connect('servername','username', 'password');
$sqlget = "Select * FROM Events";
$sqldata = mysql_query($conn,$sqlget) or die('error getting data');

echo "<table>";
echo "<tr><th>Eventid</th><th>Category</th><th>Timestamp</th><th>Event Name</th></tr>"

while($row = mysql_fetch_array($sqldata, MYSQL_ASSOC)){
    echo "<tr><td>"
    echo $row['eventid'];
    echo "</td><td>";
    echo $row['category'];
    echo "</td><td>";
    echo $row['tstamp'];
    echo "</td><td>";
    echo $row['ename'];
    echo "</td></tr>";
}

echo "</table>";
?>
