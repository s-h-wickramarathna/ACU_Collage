<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){

    if(isset($_GET["e"]) && isset($_GET["gid"])){
        $teacher_email = $_GET["e"];
        $grade_id = $_GET["gid"];

        if($teacher_email == 0){
            echo("error");
        }else{

            $grade_rs = Database::Search("SELECT * FROM `officer_teacher_has_grade` WHERE `Grade_id`='".$grade_id."' ");
            $grade_num = $grade_rs->num_rows;

            if($grade_num == 0){
                Database::iud("INSERT INTO `officer_teacher_has_grade`(`officer_teacher_email`,`Grade_id`) VALUES('".$teacher_email."','".$grade_id."') ");
            }else{
                Database::iud("UPDATE `officer_teacher_has_grade` SET `officer_teacher_email`='".$teacher_email."' WHERE `Grade_id`='".$grade_id."' ");
            }
            echo("Success");

        }

    }

}

?>