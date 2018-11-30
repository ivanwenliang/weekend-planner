<?php
// Include config file
$servername = "127.0.0.1";
$username = "root";
$password = "IbgrwAttn,mwa.11SQL";
$dbname = "planner";
// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $username = trim($_POST["username"])
        // // Prepare a select statement
        // $sql = "SELECT id FROM users WHERE username = ?";
        // if($stmt = mysqli_prepare($link, $sql)){
        //     // Bind variables to the prepared statement as parameters
        //     mysqli_stmt_bind_param($stmt, "s", $param_username);
        //     // Set parameters
        //     $param_username = trim($_POST["username"]);
        //     // Attempt to execute the prepared statement
        //     if(mysqli_stmt_execute($stmt)){
        //         /* store result */
        //         mysqli_stmt_store_result($stmt);
        //         if(mysqli_stmt_num_rows($stmt) == 1){
        //             $username_err = "This username is already taken.";
        //         } else{
        //             $username = trim($_POST["username"]);
        //         }
        //     } else{
        //         echo "Oops! Something went wrong. Please try again later.";
        //     }
        // }
        // // Close statement
        // mysqli_stmt_close($stmt);
    }
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO User (username, password) VALUES ('$username', '$password')";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
		<header class="masthead" style="background-image: url('img/register-bg.jpg')">
		  <div class="overlay"></div>
		  <div class="container">
		    <div class="row">
		      <div class="col-lg-8 col-md-10 mx-auto">
		        <div class="page-heading">
		          <h1>Register</h1>
		          <span class="subheading">Create a New Account</span>
		        </div>
		      </div>
		    </div>
		  </div>
		</header>

		<!-- Below Navbar -->
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
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
