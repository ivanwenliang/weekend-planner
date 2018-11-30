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
		<link href="style.css" rel="stylesheet">
		<link href="css/clean-blog.min.css" rel="stylesheet">
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
							<a class="nav-link" href="user.php">User</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					</ul>
				</div>	
			</div>	
		</nav>

		<!-- Page Header -->
		<header class="masthead" style="background-image: url('img/user-bg.jpg')">
		  <div class="overlay"></div>
		  <div class="container">
		    <div class="row">
		      <div class="col-lg-8 col-md-10 mx-auto">
		        <div class="page-heading">
		          <h1>User Profile</h1>
		          <span class="subheading">User Information and Settings</span>
		        </div>
		      </div>
		    </div>
		  </div>
		</header>

		<!-- Below Navbar -->
		<div class="container" style="margin-top:30px">
			<div class="row">
				<div class="col-sm-12 mx-auto" style="max-width: 700px;">
					<h2 class="text-center mb-4">User Information</h2>
					<?php 

					$servername = "127.0.0.1";

					$username = "root";

					$password = "IbgrwAttn,mwa.11SQL";

					$dbname = "planner";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// $sql = "SELECT * FROM user WHERE id='1'";
					// $result = mysqli_query($conn,$sql);
					//while($row = mysqli_fetch_assoc($result)) {
					//
					
					$sql = "SELECT * FROM user WHERE id='1'";
					$result = mysqli_query($conn,$sql);

					if ($result->num_rows > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							echo "<h5 class='font-weight-bold d-inline-block'>Username:</h5>" ."\t" .$row['username']. "<br>";
							echo "<h5 class='font-weight-bold d-inline-block'>First Name:</h5>" ."\t" .$row['firstname']. "<br>";
							echo "<h5 class='font-weight-bold d-inline-block'>Last Name:</h5>" ."\t" .$row['lastname']. "<br>";
						}
					}
					$conn->close();
					?>
					
					<h2 class="text-center mt-4 mb-4">Recently Reviewed Events</h2>

					<?php 

					$servername = "127.0.0.1";

					$username = "root";

					$password = "IbgrwAttn,mwa.11SQL";

					$dbname = "planner";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					$sql2 = "SELECT * FROM review LIMIT 1";
					$result = mysqli_query($conn,$sql2);

					if ($result->num_rows > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							echo "<h5 class='font-weight-bold d-inline-block'>Event Name:</h5>" ."\t" .$row['ename']. "<br>";
							echo "<h5 class='font-weight-bold d-inline-block'>Rating:</h5>" ."\t" .$row['rating']. "<br>";
							echo "<h5 class='font-weight-bold d-inline-block'>Review:</h5>" ."\t" .$row['review']. "<br>";
						}
					}
					$conn->close();
					?>

					
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

	</body>
</html>

