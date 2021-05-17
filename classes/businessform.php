<?php
//code adapted from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $privs = $first_name = $last_name = $email = $address = "";
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
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	//Check if user is a staff
	if(isset($_POST['staff'])) {
		$privs = "#S";
	} else {
		$privs = "#P";
	}

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
   
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";     
    } elseif(strlen(trim($_POST["email"])) < 5){
        $email_err = "email must have atleast 5 characters.";
    } else{
        $email = trim($_POST["email"]);
    }
	
    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a address.";     
    } elseif(strlen(trim($_POST["address"])) < 5){
        $address_err = "address must have atleast 5 characters.";
    } else{
        $address = trim($_POST["address"]);
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
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>