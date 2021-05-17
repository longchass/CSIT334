<?php
   // Initialize the session
   session_start();
    $parent_dir = dirname(dirname(dirname($_SERVER['SCRIPT_NAME'])));
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: {$parent_dir}index.php");
       exit;
   }
   ?>