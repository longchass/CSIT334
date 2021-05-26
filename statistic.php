<?php
	require 'config.php';
	require 'classes/sessioncheck.php';
	$total_population = $total_user	=  $vaccinated_user  = $positive_cases   = $positive_contact = " ";
function divideFloat($a, $b, $precision=3) {
    $a*=pow(10, $precision);
    $result=(int)($a / $b);
    if (strlen($result)==$precision) return '0.' . $result;
    else return preg_replace('/(\d{' . $precision . '})$/', '.\1', $result);
}
	$updatestatus = "SELECT * FROM STATISTIC LIMIT 1";
			if($stmt = mysqli_prepare($link, $updatestatus)){
				// Set parameters
				//$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Bind variables to the prepared statement as parameters
				// Attempt to execute the prepared statement
				mysqli_stmt_execute($stmt);
	

				// Close statement

			}
			$result = $stmt->get_result();
			$row = $result->fetch_row();
			$total_population = $row[0];
			$total_user	      = $row[1];
			$vaccinated_user  = $row[2];
			$positive_cases   = $row[3];
			$positive_contact = $row[4];
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
		<table width="80%" border="1" align="center">
			<tr> 
				<td>Total population</td>
				<td><?php echo $total_population; ?></td>
			</tr>
			<tr>
				<td>Total user count</td>
				<td><?php echo $total_user; ?></td>
			</tr>
			<tr>
				<td>Vaccinated user count</td>
				<td><?php echo $vaccinated_user; ?></td>
			</tr>
			<tr>
				<td>Positive case count</td>
				<td><?php echo $positive_cases; ?></td>
			</tr>
			<tr>
				<td>Encounter with positive case count</td>
				<td><?php echo $positive_contact; ?></td>
			</tr>

			<tr>
				<td>positive case count over user count</td>
				<td><?php echo divideFloat((int) $positive_cases, (int)$total_user) *100; echo "%" ?></td>
			</tr>
			
			<tr>
				<td>user registered over total pop </td>
				<td><?php echo divideFloat((int) $total_use, (int)$total_population); 100; echo "%"?></td>
			</tr>
			
			<tr>
				<td>positive case count over total population</td>
				<td><?php echo divideFloat((int) $positive_cases, (int)$total_population); 100; echo "%"?></td>
			</tr>
			<tr>
				<td>positive case count over total vaccinated </td>
				<td><?php echo divideFloat((int) $positive_cases, (int)$total_population); 100; echo "%"?></td>
			</tr>			
		</table>
    </body>
</html>
