<?php
require "database/connection.php";

if (isset($_POST["s"])) {

    $status = $_POST["s"];

    if ($status == 1) {
        $email = $_POST["e"];
        $fname = $_POST["f"];
        $lname = $_POST["l"];
        $nic = $_POST["n"];
        $mobile = $_POST["m"];
        $city = $_POST["c"];
        $address = $_POST["a"];

        if (!empty($email) && !empty($fname) && !empty($lname) && !empty($nic)) {
            if (!empty($mobile) && !empty($city) && !empty($address)) {

                Database::iud("UPDATE `officer_teacher` SET  
                `fname`='" . $fname . "', 
                `lname`='" . $lname . "', 
                `nic_no`='" . $nic . "', 
                `mobile_no`='" . $mobile . "'
                WHERE `email`='" . $email . "' ");

                Database::iud("UPDATE `officer_address` SET 
                `address`='" . $address . "', 
                `city_city_id`='" . $city . "'
                WHERE `officer_teacher_email`='" . $email . "' 
                ");

                echo ("Success");
            }
        }
    } else if ($status == 2) {
        $email = $_POST["e"];
        $active_status = $_POST["ac"];

        if ($active_status == 1) {
            Database::iud("UPDATE `officer_teacher` SET 
            `hold_status_id`='2'
            WHERE `email`='" . $email . "' ");
        } else if ($active_status == 2) {
            Database::iud("UPDATE `officer_teacher` SET 
            `hold_status_id`='1'
            WHERE `email`='" . $email . "' ");
        }

        echo ("Success");
    } else if ($status == 3) {
        $email = $_POST["e"];

        Database::iud("UPDATE `officer_teacher` SET `delete_status_d_id`='1' WHERE `email`='" . $email . "' ");

        $grade_rs = Database::Search("SELECT * FROM `officer_teacher_has_grade` WHERE `officer_teacher_email`='" . $email . "' ");
        $grade_num = $grade_rs->num_rows;

        if ($grade_num != 0) {
            Database::iud("DELETE FROM `officer_teacher_has_grade` WHERE `officer_teacher_email`='" . $email . "' ");
        }

        $class_rs = Database::Search("SELECT * FROM `officer_teacher_has_class` WHERE `officer_teacher_email`='" . $email . "' ");
        $class_num = $class_rs->num_rows;

        if ($class_num != 0) {
            Database::iud("DELETE FROM `officer_teacher_has_class` WHERE `officer_teacher_email`='" . $email . "' ");
        }

        echo ("Success");
    }
}
