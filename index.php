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

		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>

		<!-- Add fancyBox main JS and CSS files -->
		<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

		<!-- Add Button helper (this is optional) -->
		<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
		<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

		<!-- Add Thumbnail helper (this is optional) -->
		<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
		<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

		<!-- Add Media helper (this is optional) -->
		<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>		
		
		

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
			</div>
		</div>
	</div>
	<script type="text/javascript">
		timedRefresh();
	</script>

</body>
</html>
