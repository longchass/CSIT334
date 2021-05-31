<?php
require 'config.php';
require 'classes/sessioncheck.php';
require 'classes/person.php';
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
			#t01 {
				background-color:#fff;
				color:black;
			}
			#t02 tr:nth-child(even) {
				background-color:#eef;
				color:black;
			}
			#t02 tr:nth-child(odd) {
				background-color:#fff;
				color:black;
			}
			#t00 {
				background-color:#fff;
				color:black;
				padding: 5px;
				width: 80%;
				margin
			}
        </style>
	</head>
<body>
	<?php
		$sql = "SELECT PERSON.USERNAME, FNAME, LNAME, INFECTED, VACCINE_TYPE, VAC_DATE, HEALTH_STAFF
				FROM person LEFT OUTER JOIN vaccine_cert
				ON person.username = vaccine_cert.username
				WHERE person.username like ?";
		if($stmt = $link->prepare($sql) ) {
			$stmt->bind_param("s",$_SESSION[username]);
			if($stmt->execute() ) {
				$result = $stmt->get_result();
				if($result->num_rows <> 0) {
					while($row = $result->fetch_row() ) {
						if ($row[3] <> 1) $row[3] = 0;
					
						$Person = new Person($row[0],$row[1],$row[2]);
						$Person->set_infected($row[3]);
						$vaccine = $row[4];
						$vac_date = $row[5];
						$staff = $row[6];
					} 
				}else {
					echo "No record found";
				}
				$stmt->close();
			}
		}
	?>
    <div id="display" >
		<h1>Your certificate</h1>
		<table id="t00" align='center'>
		<tr rowspan='4'>
		<td>
		<table id ='t01' border='0' align='center' width='100%'>
			<tr><th align='left' >COVID-19 Vaccination Record Card</th></tr>
			<tr><td colspan='2'>Please keep this record card, which includes medical information about the vaccines you have received.</td></tr>
			<tr>
				<td width='50%'>First name: <?php echo htmlspecialchars($Person->get_fname());?></td>
				<td width='50%'>Last name: <?php echo htmlspecialchars($Person->get_lname());?></td>
			</tr>
		</table>
		</td>
		</tr>
		<tr rowspan='5'>
		<td>
		<table id='t02' width='100%' border='1' align='center'>
			<tr>
				<th width='10%'>Vaccine</th>
				<th width='35%'>Product Name/Manufacturer</th>
				<th width='20%'>Date</th>
				<th width='35%'>Healthcare Professional or Clinic Site</th>
			</tr>
			<tr>
				<td>1st Dose Covid-19</td>
				<td><?php echo htmlspecialchars($vaccine);?></td>
				<td><?php echo htmlspecialchars($vac_date);?></td>
				<td><?php echo htmlspecialchars($staff);?></td>
			</tr>
			<tr>
				<td>2nd Dose Covid-19</td>
				<td><?php echo htmlspecialchars($vaccine);?></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Other</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Other</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		</td>
		</tr>
		</table>
    </div>
</body>
</html>
