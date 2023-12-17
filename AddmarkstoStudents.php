<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["officer"])){
    if(isset($_GET["a"]) && isset($_GET["m"])){
        $assignment_id = $_GET["a"];
        $marks = $_GET["m"];

        Database::iud("UPDATE `assignment_result` SET `marks`='".$marks."' WHERE `assignment_result_id`='".$assignment_id."' ");
        echo("Success");

    }
}

?>