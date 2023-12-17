<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["officer"])) {
    if (isset($_POST["e"])) {

        $email = $_POST["e"];
        $fname = $_POST["f"];
        $lname = $_POST["l"];
        $mobile = $_POST["m"];
        $status = 0;

        if (empty($fname)) {
            echo ("Please Enter First Name");

        } else if (empty($lname)) {
            echo ("Please Enter Last Name");

        }else if(empty($mobile)){
            echo("Please Enter Mobile Number");

        }else{

            Database::iud("UPDATE `officer_teacher` 
            SET 
            `fname`='".$fname."',
            `lname`='".$lname."',
            `mobile_no`='".$mobile."'
            WHERE `email`='".$email."'
            ");

        echo("Success");
    

        }
    }
}

?>