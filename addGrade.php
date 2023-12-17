<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){
    if(isset($_GET["g"])){
        $grade = $_GET["g"];

        if(empty($grade)){
            echo("error");
        }else{
            $grade_rs = Database::Search("SELECT * FROM `grade` WHERE `Grade_name` LIKE '%".$grade."%' ");
        $grade_num = $grade_rs->num_rows;

        if($grade_num == 0){
            Database::iud("INSERT INTO `grade` (`Grade_name`) VALUES ('".$grade."') ");
            echo("Success");
        }else{
            echo("error");
        }
        }

    }
}

?>