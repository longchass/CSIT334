<?php

require 'config.php';
session_start();
	$checkouttime = date('Y-m-d h:i:s');
	$sql = "UPDATE CHECKIN SET CHECK_OUT = ? WHERE check_in=?";
	if($stmt = $link->prepare($sql) ) {
				echo "<script>alert('You have checked out')</script>";

		$name = $S_SESSION[fname]." ".$_SESSION[lname];
		
		$stmt->bind_param("ss",$checkouttime,$_SESSION[checkin]);
		
		if($stmt->execute() ) {
			
		}
		$stmt->close();
		
		
		header("location: checkinform.php");
	}
?>