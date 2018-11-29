<?php
	if(isset($_POST["event_id"]))
	{
		$output= '';
		$connect = mysqli_connect("127.0.0.1", "root", "IbgrwAttn,mwa.11SQL", "planner");
		$query = "SELECT * FROM events WHERE eventid = '".$_POST["event_id"]."'";
		$result = mysqli_query($connect, $query);
		$output .= '
		<div class="table-responsive">
			<table class="table table-bordered">';
		while($row = mysqli_fetch_assoc($result))
		{
			$output .= "
				<tr>  
                     <td width="30%"><label>Event Name</label></td>  
                     <td width="70%">'.$row["ename"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Location</label></td>  
                     <td width="70%">'.$row["location"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Event Date</label></td>  
                     <td width="70%">'.$row["eventdate"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Start Time</label></td>  
                     <td width="70%">'.$row["starttime"].'</td>  
                </tr>  
                ";
		}
		$output .= "</table></div>";
		echo $output;
	}
?>