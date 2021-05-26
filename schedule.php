<?php
	require 'config.php';
   session_start();
 

   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["privs"] != "#S" ){
       header("location: index.php");
       exit;
   }


 	$username_err = $first_name_err = $last_name_err = $email_err = $address_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate first name
	$vaccine_type = " ";
	$new_date = date('Y-m-d', strtotime($_POST['dateFrom']));
	 

    // Check input errors before inserting in database
    if(empty($username_err) && empty($first_name_err)  && empty($last_name_err)){

		$vaccine_type =$_POST['vaccine_type'];

		$username = trim($_POST["username"]);
				
		// Prepare an update statement
			$info = "INSERT into VACCINE_CERT values( ?,?,?,?)";

			$updateVaccine = "INSERT into ? values( ?)";
		
			if($stmt = mysqli_prepare($link, $info)){
				// Set parameters
				//$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ssss", $username, $vaccine_type, $_SESSION[username],$new_date);
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
				} else{

					echo $stmt->error;
				}

				// Close statement

			}
			
			
			mysqli_stmt_close($stmt);
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
                <td><input type="text" name="username" placeholder="Username" required="required <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span></td>
				<td> <select name="vaccine_type">
        <option value="AstraZeneca">AstraZeneca</option>
        <option value="Pfizer">Pfizer</option>
    </select></td>
				<td>
				<input type="date" name="dateFrom" value="<?php echo date('Y-m-d'); ?>" />
				</td>
				
                    <td><input type="submit" value="Change"></td>
                </tr>
            </tbody>
			</form>
        </table>
    </body>
</html>
