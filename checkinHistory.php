<?php
	require 'config.php';
	require 'classes/sessioncheck.php';
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
		<h3>Your checkin history</h3>

		<div id="display">
			<?php
				{
					$sql = "SELECT PERSON.USERNAME, NAME, B_USERNAME, ADDRESS, CHECK_IN, CHECK_OUT, PERSON.INFECTED
							FROM PERSON JOIN CHECKIN 
							ON PERSON.USERNAME = CHECKIN.P_USERNAME 
							WHERE PERSON.USERNAME=?;";
					if($stmt = $link->prepare($sql) ) {
						$stmt->bind_param("s",$_SESSION['username']);
						
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
				} 
			?>
		</div>
    </body>
</html>
