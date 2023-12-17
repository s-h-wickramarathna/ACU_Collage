<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {
    if (isset($_GET["e"]) && isset($_GET["ths"])) {

        $teacher_email = $_GET["e"];
        $ths_id = $_GET["ths"];

        if (empty($teacher_email)) {
            echo ("error");
        } else {

            $teacher_has_subject_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject` 
            WHERE `ths_id`='".$ths_id."'");

            $teacher_has_subject_num = $teacher_has_subject_rs->num_rows;

            if ($teacher_has_subject_num == 1) {
                Database::iud("UPDATE `officer_teacher_has_subject` SET `officer_teacher_email`='" . $teacher_email . "' WHERE `ths_id`='".$ths_id."' ");
                echo ("Success");
            }
        }
    }
}

?>
