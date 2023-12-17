<?php
session_start();
require "database/connection.php";

if (isset($_GET["e"])) {
    $email = $_GET["e"];
    $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $email . "' ");
    $student_data = $student_rs->fetch_assoc();

    if ($student_data["hold_status_h_id"] == 1) {
        Database::iud("UPDATE `student` SET `hold_status_h_id`='2' ");
    } else if ($student_data["hold_status_h_id"] == 2) {
        Database::iud("UPDATE `student` SET `hold_status_h_id`='1' ");
    }

    echo ("Success");
}

?>