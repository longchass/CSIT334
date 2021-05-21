<?php
//code adapted from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $password_hash = $privs = $bnamee = $address = "";
$username_err = $password_err = $confirm_password_err = $bname_err = $address_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT username FROM users WHERE username = ?";
        
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


    // Validate business name
    if(empty(trim($_POST["bname"]))){
        $bname_err = "Please enter a business name.";     
    } elseif(strlen(trim($_POST["bname"])) < 1){
        $bname_err = "Please enter a real business name";
    } else{
        $bname = trim($_POST["bname"]);
    }
	
	// Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter an address.";     
    } elseif(strlen(trim($_POST["bname"])) < 1){
        $address_err = "Please enter a real address";
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
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($bname_err) && empty($address_err)  ){
        //Initialize 2 insert statements and set privilege to #B for business
		$privs = "#B";
		$insertUsers = $insertTable = "";
		$username = trim($_POST["username"]);

		
		// Prepare an insert statement
		$insertUsers = "INSERT INTO users (username, privs) VALUES (?, ?)";
		$insertTable = "INSERT INTO business (username, password, bname, address) VALUES (?, ?, ?, ?)";
			echo "<script type='text/javascript'>alert('insert script is invalid');</script>";

		
			if($stmt = mysqli_prepare($link, $insertUsers)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ss", $username, $privs);

				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
				} else{
					echo "Failed to execute insert user statement";
				}
			}
			
			if($stmt2 = mysqli_prepare($link, $insertTable)){
				// Set parameters
				//$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt2, "ssss", $username, $password, $bname, $address);
				

				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt2)){
					// Redirect to login page
					header("location: index.php");
				} else{
					echo "Failed to execute insert table statement";
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