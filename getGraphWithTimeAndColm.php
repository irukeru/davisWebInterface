<?php
        include("functions.php");

        $num = $_GET['value'];
	$colm = $_GET['data'];

        echo json_encode(getSpecDataFromSQLColm($num, $colm));


?>
