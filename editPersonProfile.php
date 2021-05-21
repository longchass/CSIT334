<?php
	require 'config.php';
   // Initialize the session
   session_start();
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   // Prepare a select statement
	$info = "SELECT username, password, fname, lname FROM person WHERE username = ?";
	$username = $password = $fname = $lname = "";
	if($stmt = mysqli_prepare($link, $info)) {
			// Bind variables to the prepared statement as parameters
			//$param_username = $username;

			mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
			
			// Set parameters
			
			// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			// Store result
			mysqli_stmt_store_result($stmt);
				
			// Check if username exists, if yes then find their privilege
			if(mysqli_stmt_num_rows($stmt) == 1){  
				
				mysqli_stmt_bind_result($stmt, $username, $password, $fname, $lname);
				if(mysqli_stmt_fetch($stmt)){
				}
				else
				{
					echo "<script type='text/javascript'>alert('No result found');</script>";
				}

			} else{
				echo "<script type='text/javascript'>alert('Execution error');</script>";
			}
			mysqli_stmt_close($stmt);
		}
	// Close connection
	mysqli_close($link);
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
            <tbody>
                <tr width="33.3%">
                    <td>Username</td>
                    <td><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td><?php echo htmlspecialchars($fname); ?></td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo htmlspecialchars($lname); ?></td>
                    <td>Edit</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
