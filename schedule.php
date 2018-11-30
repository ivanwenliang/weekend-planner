<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Weekend Planner</title>

		<!-- Bootstrap -->
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Fonts -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

		<!-- Link to stylesheet -->
		<link href="css/clean-blog.css" rel="stylesheet">
	</head>

	<body>

		<!-- Navbar code -->
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand" href="home.html">Weekend Planner</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					Menu
					<i class="fas fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="events.php">Events</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="schedule.php">Schedule</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Reviewinputform.html">Reviews</a>
						</li>
					</ul>	
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="user.html">User</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					</ul>
				</div>	
			</div>	
		</nav>

		<!-- Page Header -->
		<header class="masthead" style="background-image: url('img/schedule-bg.jpg')">
		  <div class="overlay"></div>
		  <div class="container">
		    <div class="row">
		      <div class="col-lg-8 col-md-10 mx-auto">
		        <div class="page-heading">
		          <h1>Events</h1>
		          <span class="subheading">A List of Events Near You</span>
		        </div>
		      </div>
		    </div>
		  </div>
		</header>

		<!-- Below Navbar -->
		<div class="container" style="margin-top:30px">

				<div class="col-sm-12 border mx-auto" style="max-width: 50rem; height: 400px; overflow-y: scroll;">
					<!-- <h2 class="text-center">Event List</h2>
					<p class="text-center text-muted mb-4">A list of events near you</p> -->

					<?php

					$servername = "127.0.0.1";

					$username = "root";

					$password = "IbgrwAttn,mwa.11SQL";

					$dbname = "planner";

					// Create connection

					$conn = new mysqli($servername, $username, $password, $dbname);
					
					$sql = "SELECT * FROM events";

					if (mysqli_query($conn, $sql)) {

					echo "";

					} else {

					echo "Error: " . $sql . "<br>" . mysqli_error($conn);

					}	

					$resultset = mysqli_query($conn, $sql) or die("Database error:" . mysqli_error($conn));

					while($record = mysqli_fetch_assoc($resultset)) {
					?>

					<div class="card text-center mx-auto mb-4" id="<?php echo $record['eventid']; ?>" style="max-width: 25rem; height: 350px;">
						<div class="card-body events">
							<h5 class="card-title"><?php echo $record['ename']; ?></h5>
							<div class="card-text"><?php echo $record['location']; ?></div>
							<div class="card-text"><?php echo $record['eventdate']; ?></div>
							<div class="card-text"><?php echo $record['starttime']; ?></div>
							<a href="<?php echo $record['edesc']; ?>" class="btn btn-primary" role="button">More Details</a>

							<?php 
							if(isset($_POST['submit'])) {
								$eventid = $record['eventid'];
								$sql = "INSERT INTO goingto (eventid, id) VALUES ('1','1')";
								$sql2 = "INSERT INTO goingto (eventid, id) VALUES ('2','1')";
								$result = mysqli_query($conn, $sql);
								$result = mysqli_query($conn, $sql2);
							}
							?>

							<form method='post'>
								<input class="btn btn-primary mt-1" type="submit" name="submit" value="Add to List" style="min-width: 165px;"/>
							</form>

							<!-- <button type="button" class='btn btn-primary' data-toggle='modal' data-id='<?php echo $record['eventid']; ?>' data-target='#myModal'>More details</button> -->
						</div>
						<!-- <div class="card-footer text-muted">
							Found 2 hours ago
						</div> -->
					</div>

					

					<!-- <div class="card text-center mx-auto mb-4" style="max-width: 23rem;">
						<div class="card-body">
							<h5 class="card-title">Event</h5>
							<p class="card-text">Description of event</p>
							<a href="#" class="btn btn-primary">More details</a>
						</div>
						<div class="card-footer text-muted">
							Found 1 day ago
						</div>
					</div>

					<div class="card text-center mx-auto mb-4" style="max-width: 23rem;">
						<div class="card-body">
							<h5 class="card-title">Event</h5>
							<p class="card-text">Description of event</p>
							<a href="#" class="btn btn-primary">More details</a>
						</div>
						<div class="card-footer text-muted">
							Found 2 days ago
						</div>
					</div> -->
					<?php } ?>

					
					
				</div>
			
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
				      </div>
				      <div class="modal-body">
				      	<div class="table-responsive">
				      		<table class="table table-bordered">
      							<tr>  
      			                     <td width="30%"><label>Event Name</label></td>  
      			                     <td width="70%"><?php echo $row["ename"]; ?></td>  
      			                </tr>  
      			                <tr>  
      			                     <td width="30%"><label>Location</label></td>  
      			                     <td width="70%"><?php echo $row["location"]; ?></td>  
      			                </tr>  
      			                <tr>  
      			                     <td width="30%"><label>Event Date</label></td>  
      			                     <td width="70%"><?php echo $row["eventdate"]; ?></td>  
      			                </tr>  
      			                <tr>  
      			                     <td width="30%"><label>Start Time</label></td>  
      			                     <td width="70%"><?php echo $row["starttime"]; ?></td>  
      			                </tr> 
				      		</table>
				      	</div>
					  </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div>
				    </div>
				  </div>
				</div>

		</div>

		<!-- Footer -->
		
		<footer>
		  <!-- <hr> -->
		  <div class="container mt-5">
		    <div class="row">
		      <div class="col-lg-8 col-md-10 mx-auto">
		        <ul class="list-inline text-center">
		          <li class="list-inline-item">
		            <a href="#">
		              <span class="fa-stack fa-sm">
		                <i class="fas fa-circle fa-stack-2x"></i>
		                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
		              </span>
		            </a>
		          </li>
		          <li class="list-inline-item">
		            <a href="#">
		              <span class="fa-stack fa-sm">
		                <i class="fas fa-circle fa-stack-2x"></i>
		                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
		              </span>
		            </a>
		          </li>
		          <li class="list-inline-item">
		            <a href="#">
		              <span class="fa-stack fa-sm">
		                <i class="fas fa-circle fa-stack-2x"></i>
		                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
		              </span>
		            </a>
		          </li>
		        </ul>
		        <p class="copyright text-muted">Copyright &copy; Weekend Planner 2018</p>
		      </div>
		    </div>
		  </div>
		</footer>

		<!-- Bootstrap core Javascript -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Extra scripts -->
		<script src="js/clean-blog.min.js"></script>

		<script>
			$(document).ready(function(){
			    $('#myModal').on('show.bs.modal', function (e) {
			        var rowid = $(this).attr("data-id");
			        $.ajax({
			            url: 'select.php', //Here you will fetch records 
			            method: 'post',
			            data:  'id='+ rowid, //Pass $id
			            success: function(data){
			            	$('.modal-body').html(data);//Show fetched data from database
			            	$('#myModal').modal("show");
			            }
			        });
			     });
			});
		</script>

	</body>
</html>

