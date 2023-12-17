<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_POST["g"]) && isset($_POST["s"]) && isset($_POST["t"])) {
        $grade = $_POST["g"];
        $subject = $_POST["s"];
        $teacher = $_POST["t"];

        if ($grade == 0) {
            echo ("error");
        } else if ($subject == 0) {
            echo ("error");
        } else if ($teacher == 0) {
            echo ("error");
        } else {

            $teacher_has_subject_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject` WHERE `officer_teacher_email`='" . $teacher . "' AND `subject_subject_id`='" . $subject . "' AND `Grade_id`='" . $grade . "' ");
            $teacher_has_subject_num = $teacher_has_subject_rs->num_rows;

            if ($teacher_has_subject_num == 0) {
                Database::iud("INSERT INTO `officer_teacher_has_subject`(`officer_teacher_email`,`subject_subject_id`,`Grade_id`) VALUE('" . $teacher . "','" . $subject . "','" . $grade . "')");
                echo ("Success");
            }
        }
    }
}

?>
