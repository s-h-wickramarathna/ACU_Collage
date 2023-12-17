<?php
session_start();
require "database/connection.php";

if (isset($_POST["se"]) && isset($_POST["sp"])) {
    $student_email = $_POST["se"];
    $student_password = $_POST["sp"];

    if(empty($student_email)){
        echo("Please Enter Email Address ....");

    }else if(!filter_var($student_email, FILTER_VALIDATE_EMAIL)){
        echo("Invalid Email Address ....");

    }else if(empty($student_password)){
        echo("Please Enter Password ....");

    }else{

        $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='".$student_email."' AND `student_password`='".$student_password."' ");
        $student_num = $student_rs->num_rows;
    
        if($student_num == 1){
            $student_data = $student_rs->fetch_assoc();

            if($student_data["status_id"] == 1){
                echo("1");

            }else{
                $fee = Database::Search("SELECT * FROM  `enrollment_fee` WHERE `student_student_email`='".$student_email."' AND `Grade_id`='".$student_data["Grade_id"]."' ");
                $fee_num = $fee->num_rows;

                if($fee_num == 1){
                    $fee_data = $fee->fetch_assoc();
                    $today = date("Y-m-d");

                     if($fee_data["is_paid"] == 1 && $fee_data["tail_period"] > $today){
                        echo("your Account Is Suspend");

                    }else if($fee_data["is_paid"] == 1 && $fee_data["tail_period"] < $today){
                        $_SESSION["student"] = $student_data;
                        echo("3");

                    }else if($fee_data["is_paid"] == 2){
                        $_SESSION["student"] = $student_data;
                        echo("2");
                    }
                    
                }

                
            }
 
    
        }else{
            echo("Invalid Email Or Password ....");
        }
    }
}

?>