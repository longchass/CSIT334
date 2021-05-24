<?php
	require 'config.php';
	require 'classes/Person.php';
   // Initialize the session
   session_start();
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   // Prepare a select statement
	$info = "SELECT username, password, fname, lname FROM person WHERE username = ?";
	$username = $password = $fname = $lname = "";
	$Person = new Person($_SESSION[username], $_SESSION[fname], $_SESSION[lname]);
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
           $("#header").load("html/PersonHeader.html"); 
         
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
                    <td><?php echo htmlspecialchars($Person -> get_username()); ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td><?php echo htmlspecialchars($Person -> get_fname()); ?></td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo htmlspecialchars($Person -> get_lname()); ?></td>
                    <td>Edit</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
