<?php
if ($_POST) {
    date_default_timezone_set("America/Mexico_City");
    $fechaLog_Post = $_POST["logs"];
    $fechaLog_Format = date("d-M-Y", strtotime($fechaLog_Post)); //date_format($fechaLog_Post,"d/M/Y");
    header("Content-disposition: attachment; filename=log-". $fechaLog_Format .".txt");
    header("Content-type: application/txt");
    readfile("logs/log-". $fechaLog_Format .".txt");
}

?>