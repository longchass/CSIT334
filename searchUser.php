<?php
require 'config.php';
require 'classes/sessioncheck.php';
require 'classes/person.php';

$sql="SELECT * FROM PERSON where username like ?";
if($stmt = $link->prepare($sql) ) {
	$stmt->bind_param("s",$_GET['name']);
	
	if($stmt->execute() ) {
		echo "<div id='header' ></div>";
		echo "<h3>Profile information</h3>";
		echo "<table width='80%' border='1' align='center'>\n";
		echo "<tr><th>Username</th><th>First name</th><th>Last name</th><th>Infected</th></tr>";
		$result = $stmt->get_result();
		while($row = $result->fetch_row() ) {
			if ($row[4] <> 1) $row[4] = 0;
		
			$Person = new Person($row[0],$row[1],$row[2],$row[3]);
			$Person->set_infected($row[4]);
			echo "<tr><td>".$Person->get_username()."</td>\n";
			echo "<td>".$Person->get_fname()."</td>\n";
			echo "<td>".$Person->get_lname()."</td>\n";
			echo "<td>".$Person->get_infected()."</td></tr>\n";	
		}
		echo "</table>\n";
		$stmt->close();
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
			th, td {
				padding: 10px;
			}
			tr:nth-child(even) {
				background-color:#eee;
				color:black;
			}
			th {
				background-color: #0044cc;
				color:white;
			}
        </style>
		      
    </head>
    <body>
		
    </body>
</html>