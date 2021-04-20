<?php
   // Initialize the session
   session_start();
    
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: html/index.php");
       exit;
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
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script>
         $(function(){
           $("#header").load("html/header2.html"); 
         
         });
         		
      </script>
      <style>
         * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }
         html { width: 100%; height:100%; overflow:hidden; }
         body { 
         color: #fff;
         text-align: center; 
         width: 100%;
         height:100%;
         font-family: 'Open Sans', sans-serif;
         background-image: url('images/bg1.png');
         }
         img
         {
         width: 50%;
         margin: auto;
         }
         .carousel-inner > .item > img, .carousel-inner > .item > a > img {
         width: 100%;
         height: 80%;
         }
      </style>
   </head>
   <body>
      <div id="header"></div>
      <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
      <div id="demo" class="carousel slide" data-ride="carousel">
         <!-- Indicators -->
         <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
         </ul>
         <!-- The slideshow -->
         <div class="carousel-inner">
            <div class="carousel-item active img-fluid">
               <img src="images/slide1.png" alt="Los Angeles">
            </div>
            <div class="carousel-item img-fluid">
               <img src="images/slide2.png" alt="Chicago">
            </div>
            <div class="carousel-item img-fluid">
               <img src="images/slide4.png" alt="New York">
            </div>
         </div>
         <!-- Left and right controls -->
         <a class="carousel-control-prev" href="#demo" data-slide="prev">
         <span class="carousel-control-prev-icon"></span>
         </a>
         <a class="carousel-control-next" href="#demo" data-slide="next">
         <span class="carousel-control-next-icon"></span>
         </a>
      </div>
   </body>
</html>