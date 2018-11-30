<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file

$servername = "127.0.0.1";

$username = "root";

$password = "IbgrwAttn,mwa.11SQL";

$dbname = "planner";

// Create connection

$link = new mysqli($servername, $username, $password, $dbname);

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = $username";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>
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
							<a class="nav-link" href="schedule.html">Schedule</a>
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
		<header class="masthead" style="background-image: url('img/login-bg.jpg')">
		  <div class="overlay"></div>
		  <div class="container">
		    <div class="row">
		      <div class="col-lg-8 col-md-10 mx-auto">
		        <div class="page-heading">
		          <h1>Login</h1>
		          <span class="subheading">Sign Into Your Account</span>
		        </div>
		      </div>
		    </div>
		  </div>
		</header>

		<!-- Below Navbar -->
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
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
