<?php
	require 'config.php';
	require 'classes/Person.php';
   // Initialize the session
   session_start();
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   // Prepare a select statement
	$info = "SELECT username, password, fname, lname FROM person WHERE username = ?";
	$username = $first_name = $last_name = $email = $address = "";
	$username_err = $first_name_err = $last_name_err = $email_err = $address_err = "";
	$Person = new Person($_SESSION[username], $_SESSION[fname], $_SESSION[lname]);
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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

	echo $Person -> set_lname($first_name);
	echo $Person -> set_fname($last_name);
	$_SESSION["fname"]    = $first_name;
	$_SESSION["lname"]    = $last_name;
    // Check input errors before inserting in database
    if(empty($username_err) && empty($first_name_err)  && empty($last_name_err)){

		$updateTable = "";
		
		$username = trim($_POST["username"]);
				
		// Prepare an update statement
			$updateTable = "UPDATE person set  fname = ?, lname= ? WHERE username = ?";
		
			if($stmt2 = mysqli_prepare($link, $updateTable)){
				// Set parameters
				//$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt2, "sss", $first_name, $last_name, $_SESSION[username]);
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


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <meta charset="UTF-8" />
        <style>
            html {
                width: 100%;
                height: 100%;
                overflow-y: scroll;
                overflow-x: hidden;
            }
            body {
                position: absolute;
                color: #fff;
                text-align: center;
                width: 100%;
                height: 100%;
                font-family: "Open Sans", sans-serif;
                background: #092756;
            }
            td {
                width: 33.3%;
            }
        </style>
		      <script>
         $(function(){
           $("#header").load("html/PersonHeader.html"); 
         
         });
         		
      </script>
    </head>
    <body>
		<div id="header" ></div>
        <h3>Profile information</h3>
        <! --Need to put sql query into here-->
        <table width="80%" border="1" align="center">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <tbody>
                <tr width="33.3%">
                    <td>Username</td>
                    <td><?php echo htmlspecialchars($Person -> get_username()); ?></td>
                    <td><input type="submit" value="Change"></td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td><input type="text" name="first_name"    placeholder="first name" required="required <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo htmlspecialchars($Person -> get_fname()); ?>"></td>
                    <td><input type="submit" value="Change"></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="last_name"    placeholder="last name" required="required <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo htmlspecialchars($Person -> get_lname()); ?>"></td>
                    <td><input type="submit" value="Change"></td>
                </tr>
            </tbody>
			</form>
        </table>
    </body>
</html>
