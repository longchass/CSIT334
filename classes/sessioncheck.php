<?php
   // Initialize the session
   session_start();
    $parent_dir = dirname(dirname(dirname($_SERVER['SCRIPT_NAME'])));
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: {$parent_dir}index.php");
       exit;
   }
   //Display navigation bar according to the group of user
	if($_SESSION["privs"] == "#P") {
		include("html/PersonHeader.html");
	} elseif($_SESSION["privs"] == "#S") {
		include("html/StaffHeader.html");
	} elseif($_SESSION["privs"] == "#A") {
		include("html/AdminHeader.html");
	} elseif($_SESSION["privs"] == "#B") {
		include("html/BusinessHeader.html");
	}
   ?>