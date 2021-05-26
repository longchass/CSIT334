<?php
	require 'config.php';
 	require 'classes/staff.php';
	require 'classes/sessioncheck.php';
    //Initialize the session
	
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
		<h3>Lookup People</h3>
		<div align='right'>
			<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<input type="text" name ="name" placeholder="Search username">
				<input type="submit" value="Search">
				<input type="submit" value="Reset">
			</form>
		</div>
		<div id="display">
			<?php
				if(!empty($_GET['name']) ) 
				{
					$sql = "SELECT PERSON.USERNAME, FNAME, LNAME, INFECTED, VACCINE_TYPE
							FROM person LEFT OUTER JOIN vaccine_cert
							ON person.username = vaccine_cert.username
							WHERE person.username like ?";
					if($stmt = $link->prepare($sql) ) {
						$stmt->bind_param("s",$_GET['name']);
						
						if($stmt->execute() ) {
							echo "<table width='80%' border='1' align='center'>\n";
							echo "<tr><th>Username</th><th>First name</th><th>Last name</th><th>Infected</th><th>Vaccine</th></tr>";
							$result = $stmt->get_result();
							while($row = $result->fetch_row() ) {
								if ($row[3] <> 1) $row[3] = 0;
							
								$Person = new Person($row[0],$row[1],$row[2]);
								$Person->set_infected($row[3]);
								echo "<tr><td>".$Person->get_username()."</td>\n";
								echo "<td>".$Person->get_fname()."</td>\n";
								echo "<td>".$Person->get_lname()."</td>\n";
								echo "<td>".$Person->get_infected()."</td>\n";
								echo "<td>$row[4]</td></tr>\n";	
							}
							echo "</table>\n";
							$stmt->close();
						}
					}
				} else 
				{
					$sql = 'SELECT PERSON.USERNAME, FNAME, LNAME, INFECTED, VACCINE_TYPE
							FROM PERSON LEFT OUTER JOIN vaccine_cert
							ON person.username = vaccine_cert.username';
					if($stmt = $link->query($sql) )
					{
						echo "<table width='80%' border='1' align='center'>\n";
						echo "<tr><th>Username</th><th>First name</th><th>Last name</th><th>Infected</th><th>Vaccine</th></tr>";
						while($row = $stmt->fetch_row() )
						{
							if($row[3] <> 1) $row[3] = 0;
							$Person = new Person($row[0],$row[1],$row[2]);
							$Person->set_infected($row[3]);
							
							echo "<tr><td>".$Person->get_username()."</td>\n";
							echo "<td>".$Person->get_fname()."</td>\n";
							echo "<td>".$Person->get_lname()."</td>\n";
							echo "<td>".$Person->get_infected()."</td>\n";
							echo "<td>$row[4]</td></tr>\n";	
						}
						echo "</table>\n";
						$stmt->close();
					}
				}
			?>
		</div>
    </body>
</html>
