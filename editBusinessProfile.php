<?php
	require 'config.php';
	require 'classes/Business.php';
   // Initialize the session
   session_start();
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   // Prepare a select statement
	$info = "SELECT username, password, fname, lname FROM Business WHERE username = ?";
	$username  = $bname = $address = "";
	$username_err  = $bname_err = $email_err = $address_err = "";
	$Business = new Business($_SESSION[username], $_SESSION[bname], $_SESSION[address]);
 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter an address.";     
    } elseif(strlen(trim($_POST["address"])) < 10){
        $address_err = "Please enter a real address";
    } else{
        $address = trim($_POST["address"]);
    }

    // Validate business name
    if(empty(trim($_POST["bname"]))){
        $bname_err = "Please enter a business name.";     
    } elseif(strlen(trim($_POST["bname"])) < 1){
        $bname_err = "Please enter a real business name.";
    } else{
        $bname = trim($_POST["bname"]);
    }

	echo $Business -> set_address($address);
	echo $Business -> set_fname($bname);
	$_SESSION["address"]    = $address;
	$_SESSION["bname"]    = $bname;
    // Check input errors before inserting in database
    if(empty($username_err) && empty($address_err)  && empty($bname_err)){

		$updateTable = "";
		
		$username = trim($_POST["username"]);
				
		// Prepare an update statement
			$updateTable = "UPDATE Business set  address = ?, bname= ? WHERE username = ?";
		
			if($stmt2 = mysqli_prepare($link, $updateTable)){
				// Set parameters
				//$password_hash = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt2, "sss", $address, $bname, $_SESSION[username]);
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt2)){
					// Redirect to login page
					header("location: index.php");
				} else{
					echo "Oops! Something went wrong. Please try again later.sdfsafsadfsadf";
				}

				// Close statement
				mysqli_stmt_close($stmt2);
				mysqli_stmt_close($stmt);
			}
			
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
            td {
                width: 33.3%;
            }
        </style>
		      <script>
         $(function(){
           $("#header").load("html/StaffHeader.html"); 
         
         });
         		
      </script>
    </head>
    <body>
		<div id="header" ></div>
        <h3>Profile information</h3>
        <! --Need to put sql query into here-->
        <table width="80%" border="1" align="center">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <tbody>
                <tr width="33.3%">
                    <td>Username</td>
                    <td><?php echo htmlspecialchars($Business -> get_username()); ?></td>
                    <td><input type="submit" value="Change"></td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td><input type="text" name="address"    placeholder="address" required="required <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo htmlspecialchars($Business -> get_address()); ?>"></td>
                    <td><input type="submit" value="Change"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="Name"    placeholder="Name" required="required <?php echo (!empty($bname_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo htmlspecialchars($Business -> get_name()); ?>"></td>
                    <td><input type="submit" value="Change"></td>
                </tr>
            </tbody>
			</form>
        </table>
    </body>
</html>
