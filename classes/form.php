<?php
//code adapted from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $password_hash = $privs = $first_name = $last_name = $email = $address = "";
$username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = $email_err = $address_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "$username_err";
            }

        }
    }
	
	//Check if user is a staff


    // Validate first name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter a first name.";     
    } elseif(strlen(trim($_POST["first_name"])) < 1){
        $first_name_err = "Please enter a real first name";
    } else{
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter a last name.";     
    } elseif(strlen(trim($_POST["last_name"])) < 1){
        $last_name_err = "Please enter a real last name.";
    } else{
        $last_name = trim($_POST["last_name"]);
    }
	
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
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
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err)  && empty($last_name_err) && empty($email_err) && empty($address_err)  ){
        //Initialize 2 insert statements
		if(isset($_POST['staff'])) {
		$privs = "#S";
		} else {
		$privs = "#P";
		}
		$insertUsers = $insertTable = "";
		$username = trim($_POST["username"]);

		if($privs == "#S") {
			// Prepare an insert statement
			$insertTable = "INSERT INTO staff (username, password, fname, lname) VALUES (?, ?, ?, ?)";
							echo "<script type='text/javascript'>alert('a');</script>";

			$insertUsers = "INSERT INTO users (username, privs) VALUES (?, ?)";
		} else {
			// Prepare an insert statement
			$insertTable = "INSERT INTO person (username, password, fname, lname) VALUES (?, ?, ?, ?)";
				echo "<script type='text/javascript'>alert('b');</script>";

			$insertUsers = "INSERT INTO users (username, privs) VALUES (?, ?)";
		}
			if($stmt = mysqli_prepare($link, $insertUsers)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ss", $username, $privs);

				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
			
			if($stmt2 = mysqli_prepare($link, $insertTable)){
				// Set parameters
				//$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt2, "ssss", $username, $password, $first_name, $last_name);
				

				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt2)){
					// Redirect to login page
					header("location: index.php");
				} else{
					echo "Oops! Something went wrong. Please try again later.sdfsafsadfsadf";
				}

				// Close statement
				mysqli_stmt_close($stmt2);
				mysqli_stmt_close($stmt);
			}
			
		}
}
    // Close connection
    mysqli_close($link);

?>