<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){
    if(isset($_POST["sh"])){

        $shwdule_id = $_POST["sh"];
        $startTime = $_POST["s"];
        $endTime = $_POST["e"];
        $Teacher = $_POST["t"];

    if(empty($startTime)){
        echo("error");
    }else if(empty($endTime)){
        echo("error");
    }else if(empty($Teacher)){
        echo("error");
    }else{

        Database::iud("UPDATE `class_shedule` 
        SET `start_time`='".$startTime."',
        `end_time`='".$endTime."',
        `teacher`='".$Teacher."'
        WHERE `shedule_id`='".$shwdule_id."' ");

        echo("success");

    }

    }
}

?>