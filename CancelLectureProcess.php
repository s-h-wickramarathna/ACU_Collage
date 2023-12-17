<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){
    if(isset($_GET["sh"])){

        $shwdule_id = $_GET["sh"];

        Database::iud("UPDATE `class_shedule` SET `lecture_verify_v_id`='2'
        WHERE `shedule_id`='".$shwdule_id."' ");

        echo("Success");

    }

    }

?>