<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["student"])) {
    if (isset($_POST["a"]) && isset($_POST["s"])) {
        $assignment_id = $_POST["a"];
        $student_has_subject_id = $_POST["s"];

        // echo($assignment_id." , ".$student_has_subject_id);

        $length = sizeof($_FILES);

        if ($length == 1) {
            $file = $_FILES["f"];

            $allowed_ext = array(
                'application/pdf',
                'application/msword',
                'application/x-zip-compressed',
                'application/docx',
            );

            if (in_array($file["type"], $allowed_ext)) {

                $new_ext;

                if ($file["type"] == 'application/pdf') {
                    $new_ext = ".pdf";
                } else if ($file["type"] == 'application/msword') {
                    $new_ext = ".docx";
                } else if ($file["type"] == 'application/x-zip-compressed') {
                    $new_ext = ".zip";
                } else if ($file["type"] == 'application/docx') {
                    $new_ext = ".docx";
                }

                $filename = "resources//assignments//assign" . "_" . uniqid() . $new_ext;
                move_uploaded_file($file["tmp_name"], $filename);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $add_date = $d->format("Y-m-d H:i:s");

                $assignment_rs = Database::Search("SELECT * FROM `assignment_result` WHERE `student_has_subject_student_subject`='" . $student_has_subject_id . "' AND `assignments_assignment_id`='" . $assignment_id . "' ");
                $assignment_num = $assignment_rs->num_rows;

                if ($assignment_num == 0) {
                    Database::iud("INSERT INTO `assignment_result`(`student_has_subject_student_subject`,`assignments_assignment_id`,`marks`,`atendents_atendent_id`,`answer_path`,`UploadDateTime`)
                    VALUES ('" . $student_has_subject_id . "','" . $assignment_id . "','0','2','" . $filename . "','" . $add_date . "') ");
                
                } else {
                    Database::iud("UPDATE `assignment_result` SET `answer_path`='" . $filename . "',`UploadDateTime`='" . $add_date . "' ");
                }
                echo("Success ....");

            }else{
                echo("invalid File Type ....");

            }
        } else {
            echo ("Please Select File ....");

        }
    }
}
