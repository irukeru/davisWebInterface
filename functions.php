<?php

	function getSpecDataFromSQL($num) {
		$database =  new SQLite3("/home/pi/database/davisMeteoDatabase.db");

		$day = round($num / 80);

		$yesterday = date('YmdHis', strtotime('-'.$day.' day'));

		$sql = "SELECT * FROM davisMonthlyData WHERE date > ".$yesterday;

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

        function getSpecDataFromSQLColm($num, $colm) {
                $database =  new SQLite3("/home/pi/database/davisMeteoDatabase.db");

                $day = round($num / 80);

                $yesterday = date('YmdHis', strtotime('-'.$day.' day'));

                $sql = "SELECT " . $colm .  ", date FROM davisMonthlyData WHERE date > ".$yesterday;

                $results = $database->query($sql);

                $result = array();
                $k = 0;

                while ($row = $results->fetchArray()) {
                        $result[$k][0] = $row[$colm];
                        $result[$k++][1] = $row['date'];
                }

                if (count($results) == 0)
                        return "false";
                else
                        return $result;
        }

?>
