<?php
require 'classes/sessioncheck.php';
require 'config.php';

$updatestatus = "SELECT * FROM STATISTIC LIMIT 1";
if ($stmt = mysqli_prepare($link, $updatestatus)) {
    // Attempt to execute the prepared statement
    mysqli_stmt_execute($stmt);
}
$result = $stmt->get_result();
$row = $result->fetch_row();
$total_population = $row[0];
$total_user = $row[1];
$vaccinated_user  = $row[2];
$positive_cases   = $row[3];
$positive_contact = $row[4];

//gets the count of all vaccinations of pifizer
$updatestatus = "SELECT COUNT(*) FROM Pfizer";
if ($stmt = mysqli_prepare($link, $updatestatus)) {
    // Set parameters
    mysqli_stmt_execute($stmt);
}
$result = $stmt->get_result();
$row = $result->fetch_row();
$Pfizer_count = $row[0];

//gets the count of all vacinations of astrozenica
$updatestatus = "SELECT COUNT(*) FROM AstraZeneca";
if ($stmt = mysqli_prepare($link, $updatestatus)) {
    mysqli_stmt_execute($stmt);
}
$result = $stmt->get_result();
$row = $result->fetch_row();
$AstraZeneca_count = $row[0];


$vaccinated_user_count  = $AstraZeneca_count + $Pfizer_count;





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
    <!--Chart Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/dark.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
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

        #chartdiv {
            width: 100%;
            height: 500px;
            padding-right: 50px;
        }
    </style>

    
    <!-- Graph code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_dark);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);


            //Gets data from variables holding statistic data
            var vaccinated_user_count = <?php echo json_encode($vaccinated_user_count); ?>;
			var positive_cases = <?php echo json_encode($positive_cases); ?>;
			var positive_contact = <?php echo json_encode($positive_contact); ?>;

            // Add data
            chart.data = [{
                "field_name": "Vaccinated User Total",
                "data_value": vaccinated_user_count
            }, {
				"field_name": "Positive cases",
				"data_value": positive_cases
			}, {
				"field_name": "Encounter with positive cases",
				"data_value": positive_contact
			}];

            // Create axes

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "field_name";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;          

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "data_value";
            series.dataFields.categoryX = "field_name";
            series.name = "Visits";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;

            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;

        }); // end am4core.ready()
    </script>

</head>



<body>
    <div id="header"></div>

    <h1 class="my-5">
        Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to VaXafe.
    </h1>

    <table width="100%">
        <tr>
            <td>
                <div class="news">
                    <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" preloader-text="Loading" data-fw-param="146675/"></script>
                </div>
            </td>
            <td>
                <div id="chartdiv"></div>
            </td>
        </tr>
    </table>



    <h1 style="padding-top: 4%; padding-bottom: 10px;">Latest Government News</h1>


    <h2>NSW Health Twitter</h2>
    <div class="twitter">
        <rssapp-wall id="XXVEy733sePV8HH8"></rssapp-wall>
        <script src="https://widget.rss.app/v1/wall.js" type="text/javascript" async></script>
    </div>

    </div>
    <div id="header"></div>









</body>

</html>