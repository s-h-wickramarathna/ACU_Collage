<?php
require "database/connection.php";

$email = $_POST["e"];
$subject = $_POST["s"];
$grade = $_POST["g"];
$title = $_POST["t"];
$length = sizeof($_FILES);

if($length == 0){
    echo("Please Select Leasson_Note");

}else if($grade == 0){
    echo("Please Select grade");

}else if(empty($title)){
    echo("Please Enter Title");

}else if($subject == 0){
    echo("Please Select Subject");

}else{

$subject_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
    INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
    INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
    WHERE `officer_teacher_email`='" . $email . "' AND `Grade_id`='" . $grade . "' AND `subject_subject_id`='" . $subject . "' ");

$subject_num = $subject_rs->num_rows;

if ($subject_num == 1) {
    $subject_data = $subject_rs->fetch_assoc();

    $teacher_has_subject_id = $subject_data["ths_id"];

    $note_rs = Database::Search("SELECT * FROM `lecture_notes` 
        WHERE `officer_teacher_has_subject_ths_id`='" . $teacher_has_subject_id . "'
        AND `lecture_title`='" . $title . "' ");

    $note_num = $note_rs->num_rows;

    if ($note_num == 0) {
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

            if($file["type"] == 'application/pdf'){
                $new_ext = ".pdf";

            }else if($file["type"] == 'application/vnd.ms-powerpoint'){
                $new_ext = ".pptx";

            }else if($file["type"] == 'application/msword'){
                $new_ext = ".docx";

            }else if($file["type"] == 'application/x-zip-compressed'){
                $new_ext = ".zip";

            }else if($file["type"] == 'application/docx'){
                $new_ext = ".docx";
            }

            $filename = "resources//leasson_notes//".$title."_".uniqid().$new_ext;

            move_uploaded_file($file["tmp_name"],$filename);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");
    
            Database::iud("INSERT INTO `lecture_notes`(`officer_teacher_has_subject_ths_id`,`lectuer_dateime`,`lecture_title`,`lecture_path`,`delete_status_d_id`)
            VALUES ('".$teacher_has_subject_id."','".$date."','".$title."','".$filename."','2')");

            echo("Success");

        } else {
            echo ("Invalid File Type ....");
        }

    } else {
        echo("Lecture Note Already Exist ....");
    }
}
}
