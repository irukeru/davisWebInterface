<?php

	function getSpecDataFromSQL($num) {
		$database =  new SQLite3("/home/pi/database/davisMeteoDatabase.db");

		$sql = "SELECT * FROM davisWeeklyData WHERE date > 20141215101010";

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

	function getSpecDataWithDate($num) {

		date_default_timezone_set('Europe/Istanbul');

		$prev_date = date('Ymd', strtotime(date('Ymd') . '-'.getDataDate($num).' day'));
		$todays_date = date('Ymd');

		$year = date("Y");
		$month = date("m") - 1;

		if (!file_exists("/home/pi/database/thermometer.txt"))
			return "false";

		$file = file_get_contents("/home/pi/database/thermometer.txt");

		$file = explode("\n", $file);
		$length = count($file);

		$nowDateVar = date("YmdHis");
		$k = 0;

		$file = array_reverse($file);
		$result = getDataByNum($k, $num, $length, $file, $nowDateVar);
		$k = $result[0];
		$swapArray = $result[1];

		if (!isset($swapArray))
			return "false";
	
		for ($i = 0; $i < count($swapArray); $i++)	{

			$swap = $swapArray[$i];

			if (isset($swap[1])) {
				$data[$i][0] = $swap[1]; // magnitude
				$data[$i][1] = $swap[2]; // frequency
				$data[$i][2] = $swap[3]; // temperature
				$data[$i][3] = $swap[0]; // date
			}
		}
		if (isset($data))
			return $data;
		else
			return "false";

	}

	function getArchiveData($dataDate) {
		$fileName = ((int)($dataDate/100))."_".($dataDate%100).".txt";
		$file = file_get_contents($fileName);
		$file = explode("\n", $file);
        $length = count($file);

		for ($i = 0; $i < $length; $i++) {
			$swap = preg_split('/\s+/', $file[$i]);

			if (isset($swap[1]) && isset($swap[2])) {
				$data[$i][0] = $swap[1]; // temperature
				$data[$i][3] = $swap[0]; // date
			}
		}
		return $data;
	}
	
	function getDataByNum($k, $num, $length, $file, $nowDateVar) {
		$swapArray = array();

		$date = str_split($nowDateVar, 2);

		for ($i = 0; $i < $length; $i++) {
			$swap = preg_split('/\s+/', $file[$i]);
			$dateSw = str_split($swap[0], 2);

			if ($date[0] == $dateSw[0] && $date[1] == $dateSw[1]) {
				if ($date[2] == $dateSw[2]) {
					if ($date[3] == $dateSw[3]) {
						$dateNow = $date[4] * 60 * 60 + $date[5] * 60 + $date[6];
						$dateSwap = ($dateSw[4] + 2) * 60 * 60 + $dateSw[5] * 60 + $dateSw[6];
						if ($dateNow - $dateSwap < $num) {
							$swap[0] += 20000;
							$swapArray[$k++] = $swap;
						} else {
							break;
						}
					} else {
						if ($date[3] == ($dateSw[3] + 1) ) {
							if (((22 - $dateSw[4]) * 3600 + $dateSw[5] * 60 + $dateSw[6]) + ($date[4] * 3600 + $date[5] * 60 + $date[6]) < $num) {
	                                                        $swap[0] += 20000;
               		                                        $swapArray[$k++] = $swap;
							} else
								break;
						}
					}
				}
			}
		}

		return array($k, $swapArray);
	}
	
	function getDataByNumPrev($length_before, $k, $file_before, $newBoundary, $file, $length, $nowDateVar, $nowDateVarHour, $swapDayTime) {
		
		for ($i = 0; $i < $length_before; $i++) {
			$swap = preg_split('/\s+/', $file_before[$i]);
			
			if (($swapDayTime - $swap[0]) < $newBoundary) {
				$swapArray[$k++] = $swap;
			}					
		}	
		for ($i = 0; $i < $length; $i++) {
			$swap = preg_split('/\s+/', $file[$i]);
			if (($nowDateVar - $swap[0]) < $nowDateVarHour+1000000) {
				$swapArray[$k++] = $swap;
			}
		}
		
		if (isset($swapArray))
			return array($k, $swapArray);
		else
			return array($k, null);	
	}
	
	function getDataDate($num) {
		if ($num >= 1000000) 
			return $num/1000000;
		else
			return 0;
	}

?>
