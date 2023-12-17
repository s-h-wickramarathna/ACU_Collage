<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["teacher"])) {
    if (isset($_POST["a"])) {

        $aid = $_POST["a"];
        $date = $_POST["d"];
        $title = $_POST["t"];

        $length = sizeof($_FILES);

        if ($length == 0) {
            echo ("Please Select Assignment File ....");
        } else if (empty($date)) {
            echo ("Please Select Expire Date Time");
        } else if (empty($title)) {
            echo ("Please Enter Title");
        } else {
            $file = $_FILES["f"];

            $allowed_ext = array(
                'application/pdf',
                'application/msword',
                'application/vnd.ms-powerpoint',
                'application/x-zip-compressed',
                'application/docx',
            );

            if (in_array($file["type"], $allowed_ext)) {

                $new_ext;

                if ($file["type"] == 'application/pdf') {
                    $new_ext = ".pdf";
                } else if ($file["type"] == 'application/vnd.ms-powerpoint') {
                    $new_ext = ".pptx";
                } else if ($file["type"] == 'application/msword') {
                    $new_ext = ".docx";
                } else if ($file["type"] == 'application/x-zip-compressed') {
                    $new_ext = ".zip";
                } else if ($file["type"] == 'application/docx') {
                    $new_ext = ".docx";
                }

                $filename = "resources//leasson_notes//" . $title . "_" . uniqid() . $new_ext;
                move_uploaded_file($file["tmp_name"], $filename);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $add_date = $d->format("Y-m-d H:i:s");

                Database::iud("UPDATE `assignments` 
                SET `assignment_title`='".$title."',
                `assignment_expire_date`='".$date."',
                `assignment_path`='".$filename."'
                WHERE `assignment_id`='".$aid."'");

                echo("Success");

            }
        }
    }
}
