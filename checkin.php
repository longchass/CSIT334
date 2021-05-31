<?php
require 'config.php';
session_start();
	$checkintime = date('Y-m-d h:i:s');
	$_SESSION[checkin] = $checkintime;
	$sql = "INSERT INTO CHECKIN(P_USERNAME, NAME, B_USERNAME, ADDRESS, CHECK_IN, INFECTED, POS_CONTACT)
			VALUES(?,?,?,?,?,FALSE,FALSE);";
	if($stmt = $link->prepare($sql) ) {
		$name = $S_SESSION[fname]." ".$_SESSION[lname];
		
		$stmt->bind_param("sssss",$_SESSION[username],$name,$_GET['b_username'],$_GET['address'],$checkintime);
		
		if($stmt->execute() ) {
		}
		$stmt->close();
	}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Welcome</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <script>
function checkout() {
  alert("you have check out!");
}
</script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  
      <style>
         * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }
         html { width: 100%; height:100%; overflow:hidden; }
         body { 
         color: #fff;
         text-align: center; 
         width: 100%;
         height:100%;
         font-family: 'Open Sans', sans-serif;
         background: #092756;
         }
         img
         {
			 width:40%;
			 height:50%;
         margin: auto;
         }
      </style>
   </head>
   <body>
      <div id="header"></div>
      <h1>Welcome, <b><?php echo htmlspecialchars($_SESSION["fname"]); ?></b>.</h1>
      <div id="demo">
		<img src="images/success.png" alt="Success">
      </div>
	  <h2>You have successfully checked in</h2>
		<br/><br/>
		<form action="checkout.php">
			<input type="submit" value="Checkout" onclick="checkout()">
		</form>
   </body>
</html>