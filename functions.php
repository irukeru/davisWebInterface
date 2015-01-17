<?php

	function getSpecDataFromSQL($num) {
		$database =  new SQLite3("/home/pi/database/davisMeteoDatabase.db");

		$day = round($num / 80);

		$yesterday = date('YmdHis', strtotime('-'.$day.' day'));

		$sql = "SELECT * FROM davisWeeklyData WHERE date > ".$yesterday;

		$results = $database->query($sql);

		$result = array();
		$k = 0;

		while ($row = $results->fetchArray()) {
			$result[$k][0] = $row['outsideTemperature'];
			$result[$k][1] = $row['outdoorHumidity'];
			$result[$k][2] = $row['pressure'];
			$result[$k][3] = $row['date'];
			$result[$k++][4] = $row['windSpeed'];
		}

		if (count($results) == 0)
			return "false";
		else
			return $result;
	}

?>
