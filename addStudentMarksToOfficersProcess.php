<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["teacher"])) {
    if (isset($_POST["t"])) {
        $teacher_email = $_POST["t"];
        $assignment_id = $_POST["a"];
        $teacher_has_subject_id = $_POST["s"];

        $length = sizeof($_FILES);

        if ($teacher_email != $_SESSION["teacher"]["email"]) {
            echo ("You are not a teacher");

        } else if ($length != 1) {
            echo ("Please Select Mark Sheet");

        } else {
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

                $filename = "resources//answerSheets//Sheet" . "_" . uniqid() . $new_ext;
                move_uploaded_file($file["tmp_name"], $filename);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                Database::iud("INSERT INTO `student_marks` (`assignments_assignment_id`,`officer_teacher_has_subject_ths_id`,`upload_date_time`,`student_marks_sheet_path`,`task`)
                VALUES ('".$assignment_id."','".$teacher_has_subject_id."','".$date."','".$filename."','1') ");

                echo("Success");

            }
        }
    }
}
