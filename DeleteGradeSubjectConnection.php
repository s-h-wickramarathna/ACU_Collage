<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){
    if(isset($_GET["ths"])){
        $ths_id = $_GET["ths"];
        Database::iud("DELETE FROM `officer_teacher_has_subject` WHERE `ths_id`='".$ths_id."' ");
        echo("success");
    }
}

?>