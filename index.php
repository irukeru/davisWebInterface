<?php
	require_once("functions.php");
	date_default_timezone_set('Europe/Istanbul');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php ini_set('default_charset', 'UTF-8');?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="http://davis.irukeru.rocks/" />

		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery-ui/jquery-ui.min.css" type="text/css" />

		<script src="js/jquery.js"></script>
		<script src="js/shared/jquery-ui/jquery-ui.min.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.resize.js"></script>
		<script src="js/meteoLib.js"></script>
		<script src="js/jquery.flot.time.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery.flot.navigate.js"></script>

		<title>Physics Dept. Meteo Monitor</title>

		<script type="text/JavaScript">
			function timedRefresh() {
				//getDataGraph();
				getDataGraphWithTime(sampleDateVar);
				setTimeout(timedRefresh, delayValue);
			}
		</script>


	</head>
	<body>

	<div class="content" id="content">
		<center>
		<font color="White">
		<h3>Meteo Monitor</h3>
		<h3>( Located at Physics Department, METU, Ankara, Turkey )</h3>
		</font>
		</center>
		<div class = "center_data_big midTopMargin">
			<div class = "left-data_table">
				<table id="meteoDataTable" class="meteoDataTable">
					<thead>
						<tr>
							<th></th>
						 	<th>Current</th>
					 		<th>Average</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Temperature:</td>
							<td id = "outsideTemp">*</td>
							<td id = "outsideTempAv">*</td>
						</tr>
						<tr>
							<td>Hummidity : </td>
							<td id = "hummidity">*%</td>
							<td id = "hummidityAv">*%</td>
						</tr>
                                                <tr>
                                                        <td>Atm. Press. :</td>
                                                        <td id = "pressure">* mBar</td>
                                                        <td id = "pressureAv">* mBar</td>
                                                </tr>
                                                <tr>
                                                        <td>Wind Speed : </td>
                                                        <td id = "windSpeed">*km/h</td>
                                                        <td id = "windSpeedAv">*km/h</td>
                                                </tr>
					</tbody>
				</table>

			</div>

			<div class="left-container" id="graph_container">
				<div id="placeholder_1" class="demo-placeholder"></div>
				<div id="placeholder_3" class="demo-placeholder"></div>
				<br>
				<div id="placeholder_2" class="demo-placeholder" style="margin-top: 20px;"></div>
				<div id="placeholder_4" class="demo-placeholder" style="margin-top: 20px"></div>
				<br>
				<div id="placeholder_5" class="demo-placeholder" style="margin-top: 20px;"></div>
				<div id="placeholder_6" class="demo-placeholder" style="margin-top: 20px"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		timedRefresh();
		var updateTempGraphVar = false;

		$(function() {

			$("#placeholder_1").bind("plotpan", function (event, plot) {
				var axes = plot.getAxes();

				var currentDate = (new Date()).getTime();

				var dif = Math.round(Math.round(currentDate / 1000000) - Math.round(axes.xaxis.min.toFixed(2)) / 1000000);

				tempGraphXMin = axes.xaxis.min.toFixed(2);
				tempGraphXMax = axes.xaxis.max.toFixed(2);
//				console.log(sampleDateVar + " - " +dif);

				if (updateTempGraphVar == false) {
					if ((sampleDateVar / 2) < dif) {
						sampleDateVar += 800;
						updateTempGraphVar = true;
						getNewData(sampleDateVar);
						console.log("is it finished ?");
						updateTempGraphVar = false;
					}
				}
			});

                        $("#placeholder_1").bind("plotzoom", function (event, plot) {
                                var axes = plot.getAxes();

                                var currentDate = (new Date()).getTime();

                                var dif = Math.round(Math.round(currentDate / 1000000) - Math.round(axes.xaxis.min.toFixed(2)) / 1000000);

                                tempGraphXMin = axes.xaxis.min.toFixed(2);
                                tempGraphXMax = axes.xaxis.max.toFixed(2);
//                              console.log(sampleDateVar + " - " +dif);

                                if (updateTempGraphVar == false) {
                                        if ((sampleDateVar / 2) < dif) {
                                                sampleDateVar += 800;
                                                updateTempGraphVar = true;
                                                getNewData(sampleDateVar);
                                                console.log("is it finished ?");
                                                updateTempGraphVar = false;
                                        }
                                }
                        });

			$("#placeholder_2").bind("plotpan", function (event, plot) {
				var axes = plot.getAxes();
//				var message = "Panning to x: "  + axes.xaxis.min.toFixed(2) + " &ndash; " + axes.xaxis.max.toFixed(2) + " and y: " + axes.yaxis.min.toFixed(2)+ " &ndash; " + axes.yaxis.max.toFixed(2);

//				console.log(message);
				console.log("place_2");
			});


			$("#placeholder_3").bind("plotpan", function (event, plot) {
				var axes = plot.getAxes();
//				var message = "Panning to x: "  + axes.xaxis.min.toFixed(2) + " &ndash; " + axes.xaxis.max.toFixed(2) + " and y: " + axes.yaxis.min.toFixed(2)+ " &ndash; " + axes.yaxis.max.toFixed(2);

//				console.log(message);
				console.log("place_3");

			});


			$("#placeholder_4").bind("plotpan", function (event, plot) {
				var axes = plot.getAxes();
//				var message = "Panning to x: "  + axes.xaxis.min.toFixed(2) + " &ndash; " + axes.xaxis.max.toFixed(2) + " and y: " + axes.yaxis.min.toFixed(2)+ " &ndash; " + axes.yaxis.max.toFixed(2);

//				console.log(message);
				console.log("plage_4");
			});


			$("#placeholder_5").bind("plotpan", function (event, plot) {
				var axes = plot.getAxes();
//				var message = "Panning to x: "  + axes.xaxis.min.toFixed(2) + " &ndash; " + axes.xaxis.max.toFixed(2) + " and y: " + axes.yaxis.min.toFixed(2)+ " &ndash; " + axes.yaxis.max.toFixed(2);

//				console.log(message);
				console.log("placee_5");
			});


			$("#placeholder_6").bind("plotpan", function (event, plot) {
				var axes = plot.getAxes();
//				var message = "Panning to x: "  + axes.xaxis.min.toFixed(2) + " &ndash; " + axes.xaxis.max.toFixed(2) + " and y: " + axes.yaxis.min.toFixed(2)+ " &ndash; " + axes.yaxis.max.toFixed(2);

//				console.log(message);
				console.log("place_6");
			});

		});

	</script>

</body>
</html>
