<?php
   // Initialize the session
   session_start();
    
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
	
	// Include config file
	require_once "config.php";
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
        </style>
		      <script>
         $(function(){
           $("#header").load("html/header.html"); 
         
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
                    <td>Password</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>&nbsp;</td>
                    <td>Edit</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
            </tbody>
        </table>
		Test
		<br />
		<?php
			// Attempt select query execution
			$sql = "SELECT * FROM users2";
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					echo "<table>";
						echo "<tr>";
							echo "<th>id</th>";
							echo "<th>username</th>";
							echo "<th>user_type</th>";
							echo "<th>fname</th>";
							echo "<th>lname</th>";
							echo "<th>org</th>";
							echo "<th>email</th>";
							echo "<th>address</th>";
							echo "<th>created</th>";
						echo "</tr>";
					while($row = mysqli_fetch_array($result)){
						echo "<tr>";
							echo "<td>" . $row['user_id'] . "</td>";
							echo "<td>" . $row['username'] . "</td>";
							echo "<td>" . $row['user_type'] . "</td>";
							echo "<td>" . $row['fname'] . "</td>";
							echo "<td>" . $row['lname'] . "</td>";
							echo "<td>" . $row['organisation_name'] . "</td>";
							echo "<td>" . $row['email'] . "</td>";
							echo "<td>" . $row['address'] . "</td>";
							echo "<td>" . $row['created_at'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					// Free result set
					mysqli_free_result($result);
				} else{
					echo "No records matching the query were found.";
				}
			} else{
				echo "ERROR: Could not execute $sql. " . mysqli_error($link);
			}

			// Close connection
			mysqli_close($link);
		?>
		
    </body>
</html>
