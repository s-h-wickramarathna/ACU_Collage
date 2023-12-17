<?php
session_start();
require "database/connection.php";

if (isset($_POST["sv"]) && isset($_POST["se"])) {
    $student_verificationCode = $_POST["sv"];
    $student_email = $_POST["se"];

    if (empty($student_verificationCode)) {
        echo ("Please Enter Verification Code");
    } else {

        $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' AND `student_verification_code`='" . $student_verificationCode . "' ");
        $student_num = $student_rs->num_rows;

        if($student_num == 1){
            $student_data = $student_rs->fetch_assoc();
            Database::iud("UPDATE `student` SET `status_id`='2' WHERE `student_email`='" . $student_email . "'  ");
            $_SESSION["student"] = $student_data;
            echo("1");

        }else{
            echo("Invalid Verification Code");
        }

    }
}
