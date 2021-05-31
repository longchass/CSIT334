<?php
	require 'config.php';
 	//require 'classes/staff.php';
	require 'classes/sessioncheck.php';
    //Initialize the session
	    //Initialize the session
	// if($_SERVER["REQUEST_METHOD"] == "POST"){
    // // Validate first name
	
		// $status =$_POST['infected_status'];
		// $username = trim($_POST["username"]);
				
		// // Prepare an update statement
			// $updatestatus = "UPDATE PERSON SET infected = ? where username = ?";

		
			// if($stmt = mysqli_prepare($link, $updatestatus)){
				// // Set parameters
				// //$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// // Bind variables to the prepared statement as parameters
				// mysqli_stmt_bind_param($stmt, "ss", $status,$username);
				// // Attempt to execute the prepared statement
				// if(mysqli_stmt_execute($stmt)){
				// } else{

					// echo $stmt->error;
				// }
				// // Close statement

			// }
			
			
			// mysqli_stmt_close($stmt);
	// }
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
			th, td {
				padding: 10px;
			}
			tr:nth-child(even) {
				background-color:#eed;
				color:black;
			}
			tr:nth-child(odd) {
				background-color:#eef;
				color:black;
			}
			th {
				background-color: #0044cc;
				color:white;
			}
        </style>
    </head>
    <body>
		<div id="header" ></div>
		<h3>Checkin History</h3>
		<span align='middle' display ='inline'>
			<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<input type="text" name ="name" placeholder="Search username">
				<input type="submit" value="Search">
				<input type="reset" value="Reset">
			</form>
		</span>

		<div id="display">
			<?php
				if(!empty($_GET['name']) ) 
				{
					$sql = "SELECT PERSON.USERNAME, NAME, B_USERNAME, ADDRESS, CHECK_IN, CHECK_OUT, PERSON.INFECTED
							FROM PERSON JOIN CHECKIN ON PERSON.USERNAME = CHECKIN.P_USERNAME
							WHERE person.username like ?";
					if($stmt = $link->prepare($sql) ) {
						$stmt->bind_param("s",$_GET['name']);
						
						if($stmt->execute() ) {
							echo "<table width='80%' border='1' align='center'>\n";
							echo "<tr><th>Username</th><th>Full name</th><th>Business ID</th><th>Business address</th><th>Check in</th><th>Check out</th><th>Infected</th></tr>";
							$result = $stmt->get_result();
							while($row = $result->fetch_row() ) {
								if ($row[6] <> 1) $row[6] = 0;
							
								echo "<tr><td>$row[0]</td>\n";
								echo "<td>$row[1]</td>\n";
								echo "<td>$row[2]</td>\n";
								echo "<td>$row[3]</td>\n";
								echo "<td>$row[4]</td>\n";
								echo "<td>$row[5]</td>\n";
								echo "<td>$row[6]</td></tr>\n";	
							}
							echo "</table>\n";
							$stmt->close();
						}
					}
					
				} else 
				{
					$sql = 'SELECT PERSON.USERNAME, NAME, B_USERNAME, ADDRESS, CHECK_IN, CHECK_OUT, PERSON.INFECTED
							FROM PERSON JOIN CHECKIN 
							ON PERSON.USERNAME = CHECKIN.P_USERNAME';
					if($stmt = $link->query($sql) )
					{
						echo "<table width='80%' border='1' align='center'>\n";
						echo "<tr><th>Username</th><th>Full name</th><th>Business ID</th><th>Business address</th><th>Check in</th><th>Check out</th><th>Infected</th></tr>";
						
						while($row = $stmt->fetch_row() ) {
							if ($row[6] <> 1) $row[6] = 0;
						
							echo "<tr><td>$row[0]</td>\n";
							echo "<td>$row[1]</td>\n";
							echo "<td>$row[2]</td>\n";
							echo "<td>$row[3]</td>\n";
							echo "<td>$row[4]</td>\n";
							echo "<td>$row[5]</td>\n";
							echo "<td>$row[6]</td></tr>\n";	
						}
						echo "</table>\n";
						$stmt->close();
					}
				}
			?>
		</div>
    </body>
</html>
