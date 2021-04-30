<?php
   // Initialize the session
   session_start();
    
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   ?>
<!DOCTYPE html>
<html lang="en">
    <head>
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
    </head>
    <body>
        <h3>Profile information</h3>
        <! --Need to put sql query into here-->
        <table width="80%" border="1" align="center">
            <tbody>
                <tr width="33.3%">
                    <td>Username</td>
                    <td><?php echo htmlspecialchars($_SESSION["username"]); ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>&nbsp;</td>
                    <td>Edit</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>&nbsp;</td>
                    <td>Change</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
