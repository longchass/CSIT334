<?php
require 'classes/sessioncheck.php'

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
   <style>
      * {
         -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
         -ms-box-sizing: border-box;
         -o-box-sizing: border-box;
         box-sizing: border-box;
      }

      html {
         width: 100%;
         height: 100%;
         overflow-y: scroll;
         overflow-x: hidden;
      }

      body {
         color: #fff;
         text-align: center;
         width: 100%;
         height: 100%;
         font-family: 'Open Sans', sans-serif;
         background: #092756;
         background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -moz-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -moz-linear-gradient(-45deg, #670d10 0%, #092756 100%);
         background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -webkit-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -webkit-linear-gradient(-45deg, #670d10 0%, #092756 100%);
         background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -o-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -o-linear-gradient(-45deg, #670d10 0%, #092756 100%);
         background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -ms-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -ms-linear-gradient(-45deg, #670d10 0%, #092756 100%);
         background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), linear-gradient(to bottom, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), linear-gradient(135deg, #670d10 0%, #092756 100%);
         filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3E1D6D', endColorstr='#092756', GradientType=1);
      }

      h2 {
         padding-top: 75px;
         padding-bottom: 10px;
      }

      div.news {
         padding-left: 10%;
         padding-right: 10%;
         padding-bottom: 50px;
      }
      
   </style>


    <meta charset="UTF-8" />
    <title>Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script type="text/javascript" src="scripts/javascript/displayNotification.js"></script>

    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -o-box-sizing: border-box;
            box-sizing: border-box;
        }

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
            background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, 0.4) 10%, rgba(138, 114, 76, 0) 40%), -moz-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%),
                -moz-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, 0.4) 10%, rgba(138, 114, 76, 0) 40%), -webkit-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%),
                -webkit-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, 0.4) 10%, rgba(138, 114, 76, 0) 40%), -o-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%),
                -o-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, 0.4) 10%, rgba(138, 114, 76, 0) 40%), -ms-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%),
                -ms-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, 0.4) 10%, rgba(138, 114, 76, 0) 40%), linear-gradient(to bottom, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%),
                linear-gradient(135deg, #670d10 0%, #092756 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3E1D6D', endColorstr='#092756', GradientType=1);
        }

        img {
            width: 50%;
            margin: auto;
        }

        .carousel-inner>.item>img,
        .carousel-inner>.item>a>img {
            width: 100%;
            height: 80%;
        }

        .btn {
            color: white;
        }

        .other-activities {
            background-color: cornflowerblue;
        }
    </style>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "4354d47c-391a-40fd-967f-fbe4df633c0c",
    });
  });
</script>

</head>



<body>
   <div id="header"></div>
   
   <h1 class="my-5">
        Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.
    </h1>

   <h1 style="padding-top: 4%; padding-bottom: 10px;">Latest Government News</h1>
   <div class="news">
      <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" preloader-text="Loading" data-fw-param="146675/"></script>
   </div>

   <h2>NSW Health Twitter</h2>
   <div class="twitter">
      <rssapp-wall id="XXVEy733sePV8HH8"></rssapp-wall>
      <script src="https://widget.rss.app/v1/wall.js" type="text/javascript" async></script>
   </div>

   </div>
    <div id="header"></div>

    
	


    
    


</body>

</html>