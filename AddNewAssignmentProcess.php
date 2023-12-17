<?php
session_start();
require "database/connection.php";

$email = $_POST["e"];
$grade = $_POST["g"];
$subject = $_POST["s"];
$title = $_POST["ttl"];
$term = $_POST["t"];
$expire_date = $_POST["d"];
$length = sizeof($_FILES);

if ($length == 0) {
    echo ("Please Select Assignment");
} else if ($grade == 0) {
    echo ("Please Select Grade");
} else if ($subject == 0) {
    echo ("Please Select Subject");
} else if (empty($title)) {
    echo ("Please Enter Title");
} else if ($term == 0) {
    echo ("please Select Term");
} else if (empty($expire_date)) {
    echo ("Please Select Expire Date");
} else {

    $file = $_FILES["f"];

    $subject_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
    INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
    INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
    WHERE `officer_teacher_email`='" . $email . "' AND `Grade_id`='" . $grade . "' AND `subject_subject_id`='" . $subject . "' ");

    $subject_num = $subject_rs->num_rows;

    if ($subject_num == 1) {
        $subject_data = $subject_rs->fetch_assoc();
        $teacher_has_subject_id = $subject_data["ths_id"];

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

            $filename = "resources//assignments//" . $title . "_" . uniqid() . $new_ext;
            move_uploaded_file($file["tmp_name"], $filename);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $add_date = $d->format("Y-m-d H:i:s");

            $assignment_rs = Database::Search("SELECT * FROM `assignments`
             WHERE `officer_teacher_has_subject_ths_id`='" . $teacher_has_subject_id . "'
             AND `assignment_title`='" . $title . "'
             AND `exam_term_id`='" . $term . "' ");

            $assignment_num = $assignment_rs->num_rows;

            if ($assignment_num == 0) {
                Database::iud("INSERT INTO
                `assignments` (`officer_teacher_has_subject_ths_id`,
               `assignment_title`,
               `assignment_submit_date`,
               `assignment_expire_date`,
               `assignment_path`,
               `exam_term_id`,
               `delete_status_d_id`)
               VALUES('" . $teacher_has_subject_id . "',
               '" . $title . "',
               '" . $add_date . "',
               '" . $expire_date . "',
               '" . $filename . "',
               '" . $term . "',
               '2') ");
                echo ("Succcess");
            } else {
                echo ("This Assignment Already Exist");
            }
        }
    }
}

?>
