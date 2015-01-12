<?php
        include("functions.php");

        $num = $_GET['value'];

//        echo json_encode(getSpecDataWithDate($num));
        echo json_encode(getSpecDataFromSQL($num));

?>

