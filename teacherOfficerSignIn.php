<?php
session_start();
require "database/connection.php";

if(isset($_POST["e"]) && isset($_POST["p"])){
    $email = $_POST["e"];
    $password = $_POST["p"];

    if(empty($email)){
        echo("Enter Email Address");

    }else if(empty($password)){
        echo("Enter Password Address");

    }else{

        $tf_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `email`='".$email."' AND `password`='".$password."' ");
        $tf_num = $tf_rs->num_rows;

        if($tf_num == 1){
            $tf_data = $tf_rs->fetch_assoc();

            $userType = $tf_data["user_type_id"];
            $status = $tf_data["status_id"];

            if($status == 1){
                echo("show Model");
            }else{
                if($userType == 2){
                    $_SESSION["officer"] = $tf_data;
                    echo("Academic_Officer");
                }else if($userType == 1){
                    $_SESSION["teacher"] = $tf_data;
                    echo("teacher");
                }
            }

        }else{
            echo("Invalid Email Address Or Password");
        }

    }

}

?>