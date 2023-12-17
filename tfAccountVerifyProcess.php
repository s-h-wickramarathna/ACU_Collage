<?php
session_start();
require "database/connection.php";

if (isset($_POST["e"]) && isset($_POST["v"])) {
    $email = $_POST["e"];
    $vcode = $_POST["v"];

    if (empty($vcode)) {
        echo ("Enter Verification Code");
    } else {
        $v_rs =  Database::Search("SELECT * FROM `officer_teacher` WHERE `email`='" . $email . "' AND `verifaction_code`='" . $vcode . "' ");
        $v_num = $v_rs->num_rows;

        if ($v_num == 1) {
            Database::iud("UPDATE `officer_teacher` SET `status_id`='2' WHERE `email`='" . $email . "' ");
            $v_data = $v_rs->fetch_assoc();

            if ($v_data["user_type_id"] == 1) {
                $_SESSION["teacher"] = $v_data;
                echo ("teacher");

            } else if ($v_data["user_type_id"] == 2) {
                $_SESSION["officer"] = $v_data;
                echo ("Academic_Officer");
                
            }
        } else {
            echo ("Invalid Verification Code");
        }
    }
}

?>