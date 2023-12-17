<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["teacher"])) {

    $nid = $_POST["n"];
    $title = $_POST["t"];
    $length = sizeof($_FILES);

    $status = 0;

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if (!empty($title)) {
        Database::iud("UPDATE `lecture_notes` 
                    SET
                     `lectuer_dateime`='" . $date . "',
                    `lecture_title`='" . $title . "'
                    WHERE `note_id`='" . $nid . "'
                    ");

        $status = 1;

        if ($length != 0) {
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

                Database::iud("UPDATE `lecture_notes` 
                    SET
                    `lecture_path`='" . $filename . "'
                    WHERE `note_id`='" . $nid . "'
                    ");

                $status = 1;
            } else {
                echo ("Invalid File Type ....");
            }
        }
        if ($status == 1) {
            echo ("Success");
        }
    } else {
        echo ("Please Enter Title ....");
    }
}
