<?php
require 'classes/sessioncheck.php'

   ?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8" />
        <title>Welcome</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
      <script>
         $(function(){
           $("#header").load("html/StaffHeader.html"); 
         
         });
         		
      </script>
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
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
            }
            img {
                width: 50%;
                margin: auto;
            }
            .carousel-inner > .item > img,
            .carousel-inner > .item > a > img {
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
    </head>
    <body>
	      <div id="header" ></div>

        <h1 class="my-5">
            Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome.
        </h1>
        <h1 align="left" style="padding-left: 30px;">DASHBOARD</h1>
        <table width="90%" border="1" align="center">
            <tbody>
                <tr>
                    <td width="25%" align="center">
                        <img src="https://cdn.davemorrowphotography.com/wp-content/uploads/2021/01/star-photography-39.jpg" /><br />
                        Check-in
                    </td>
                    <td width="25%" align="center">
                        <img src="https://cdn.davemorrowphotography.com/wp-content/uploads/2021/01/star-photography-39.jpg" /><br />
                        Enroll
                    </td>
                    <td width="25%" align="center">
                        <img src="https://cdn.davemorrowphotography.com/wp-content/uploads/2021/01/star-photography-39.jpg" /><br />
                        Roll outs
                    </td>
                    <td width="25%" align="center">
                        <img src="https://cdn.davemorrowphotography.com/wp-content/uploads/2021/01/star-photography-39.jpg" /><br />
                        Annoucements
                    </td>
                </tr>
            </tbody>
        </table>
        <br />
        <br />
        <div class="other-activities" style="padding-top: 20px;">
            <h1 align="left" style="padding-left: 20px;">Otherrr information</h1>
            <div class="row">
                <div class="col-md-4">
                    <h2>
                        COVID-19 News
                    </h2>
                    <img alt="Bootstrap Image Preview" src="https://images-na.ssl-images-amazon.com/images/S/sgp-catalog-images/region_US/g9a9m-MHM425BWQ9F-Full-Image_GalleryBackground-en-US-1521579412582._SX1080_.jpg" />
                    <p>
                        <a class="btn" href="#">Read more »</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>
                        Contact government
                    </h2>
                    <img alt="Bootstrap Image Preview" src="https://images-na.ssl-images-amazon.com/images/S/sgp-catalog-images/region_US/g9a9m-MHM425BWQ9F-Full-Image_GalleryBackground-en-US-1521579412582._SX1080_.jpg" />
                    <p>
                        <a class="btn" href="#">View details »</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>
                        Support our website
                    </h2>
                    <img alt="Bootstrap Image Preview" src="https://images-na.ssl-images-amazon.com/images/S/sgp-catalog-images/region_US/g9a9m-MHM425BWQ9F-Full-Image_GalleryBackground-en-US-1521579412582._SX1080_.jpg" />
                    <p>
                        <a class="btn" href="#">Donate »</a>
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>
