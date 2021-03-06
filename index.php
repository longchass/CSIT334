<?php

session_start();
 
	function person_session_info($link) 
	{
		$username = $fname = $lname = " ";
		
		$sql = "SELECT username, fname, lname FROM person WHERE username = ?";
		if($stmt3 = mysqli_prepare($link, $sql)){
					mysqli_stmt_bind_param($stmt3, "s", $_SESSION["username"]);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_store_result($stmt3);
					mysqli_stmt_bind_result($stmt3, $username, $fname, $lname);
					mysqli_stmt_fetch($stmt3);
					$_SESSION["username"] = $username;
					$_SESSION["fname"]    = $fname;
					$_SESSION["lname"]    = $lname;
					
		}
	}
	
	function staff_session_info($link)
	{
		$username = $fname = $lname = " ";
		
		$sql = "SELECT username, fname, lname FROM staff WHERE username = ?";
		if($stmt3 = mysqli_prepare($link, $sql)){
					mysqli_stmt_bind_param($stmt3, "s", $_SESSION["username"]);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_store_result($stmt3);
					mysqli_stmt_bind_result($stmt3, $username, $fname, $lname);
					mysqli_stmt_fetch($stmt3);
					$_SESSION["username"] = $username;
					$_SESSION["fname"]    = $fname;
					$_SESSION["lname"]    = $lname;
		}
	}
	function business_session_info($link)
	{
		$username = $bname = $address = $guest_lim = " ";
		
		$sql = "SELECT username, bname, address, guest_lim FROM business WHERE username = ?";
		if($stmt3 = mysqli_prepare($link, $sql)){
					mysqli_stmt_bind_param($stmt3, "s", $_SESSION["username"]);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_store_result($stmt3);
					mysqli_stmt_bind_result($stmt3, $username, $bname, $address, $guest_lim);
					mysqli_stmt_fetch($stmt3);
					$_SESSION["username"]   = $username;
					$_SESSION["bname"]      = $bname;
					$_SESSION["address"]    = $address;
					$_SESSION["guest_lim"]  = $guest_lim;
		}


	}
		
 
 
	function verify_password($sql, $param_username,$password,$link) {
	$hashed_password=" ";
		if($stmt2 = mysqli_prepare($link, $sql)){

			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt2, "s", $param_username);
			
			// Set parameters
			$param_username;
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt2)){
				// Store result
				mysqli_stmt_store_result($stmt2);
					
				// Check if username exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt2) == 1){                    
				
					// Bind result variables
					mysqli_stmt_bind_result($stmt2, $param_username, $hashed_password);

					if(mysqli_stmt_fetch($stmt2)){

						if($password == $hashed_password){

							// Password is correct, so start a new session
							session_start();
								
							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["username"] = $param_username;
						} else{
							// Password is not valid, display a generic error message
							$login_err = "Invalid username or password.";

						}
					}
				} else{
					// Username doesn't exist, display a generic error message
					echo "<script type='text/javascript'>alert('invalid username or password');</script>";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

		}
	}
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$sql = $privs = "";
$username_err = $password_err = $login_err = "";
 
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
		$privilege = "SELECT username, privs FROM USERS WHERE username = ?";
		if($stmt = mysqli_prepare($link, $privilege)) {
			// Bind variables to the prepared statement as parameters
			$param_username = $username;

			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			// Set parameters
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Store result
				mysqli_stmt_store_result($stmt);
				
				// Check if username exists, if yes then find their privilege
				if(mysqli_stmt_num_rows($stmt) == 1){  
				
					mysqli_stmt_bind_result($stmt, $username, $privs);
					if(mysqli_stmt_fetch($stmt)){
						//Check user privilege to retrieve data from database
						if($privs == '#P') {
							$sql = "SELECT username, password FROM person WHERE username = ?";
						} elseif ($privs == '#S') {
							$sql = "SELECT username, password FROM staff WHERE username = ?";
						} elseif($privs == '#A')
						{
							$sql = "SELECT username, password FROM admin WHERE username = ?";
						} elseif($privs == '#B')
						{
							$sql = "SELECT username, password FROM business WHERE username = ?";
						}

					}

					verify_password($sql,$param_username,$password,$link);
					$_SESSION["privs"] = $privs;
					if($privs == '#P') {
							person_session_info($link);
						} elseif ($privs == '#S') {
							staff_session_info($link);
						} elseif($privs == '#B')
						{
							business_session_info($link);
						}
					//Redirect user to welcome page
					header("location: welcome.php");
				}
				else
				{
					echo "<script type='text/javascript'>alert('wrong username or password');</script>";
				}

			} else{
				echo "<script type='text/javascript'>alert('wrong username or password');</script>";
			}
			mysqli_stmt_close($stmt);
		}
    }

    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body { 
  width: 100%;
  height:100%;
  font-family: 'Open Sans', sans-serif;
  background: #092756;
  background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
  background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
  background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
  background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
  background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
.login { 
  position: absolute;
  top: 40%;
  left: 50%;
  margin: -150px 0 0 -150px;
  width:300px;
  height:300px;

}
img{ 
  margin: auto;
  display: block;
  width: 50%;
  border-radius: 8px;

}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

.login p { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); }

input { 
  width: 100%; 
  margin-bottom: 10px; 
  background: rgba(0,0,0,0.3);
  border: none;
  outline: none;
  padding: 10px;
  font-size: 13px;
  color: #fff;
  text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
  -webkit-transition: box-shadow .5s ease;
  -moz-transition: box-shadow .5s ease;
  -o-transition: box-shadow .5s ease;
  -ms-transition: box-shadow .5s ease;
  transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
    </style>
</head>
<body>
	<div class="login" >
	<img src="images/vaxafe.png" alt="VaXafe">
        <h1 style="padding-top: 25px;">Login</h1>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
                
                <input type="text" name="username" placeholder="Username" required="required <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
              
            
               
                <input type="password" name="password" placeholder="Password" required="required" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            
            
                <input type="submit" class="btn btn-primary btn-block btn-large" value="Login">
            
            <p>Register <a href="registerPersonal.php">For myself</a> or <a href="registerBusiness.php">For my business</a></p>
        </form>
		
		
    </div>
    </div>
</body>
</html>
