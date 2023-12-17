<?php
 session_start();
 require "database/connection.php"; 

 if(isset($_SESSION["admin"])){

    $heldDate = $_POST["h"];
    $subject_id = $_POST["s"];
    $teacher_email = $_POST["t"];
    $startDate = $_POST["st"];
    $endDate = $_POST["e"];
    $grade_id = $_POST["g"];


    if(empty($heldDate)){
        echo("1");
    }else if($subject_id == 0){
        echo("1");
    }else if($teacher_email == 0){
        echo("1");
    }else if(empty($startDate)){
        echo("1");
    }else if(empty($endDate)){
        echo("1");
    }else{

        $lecture_rs = Database::Search("SELECT * FROM `class_shedule` 
        WHERE `subject_subject_id`='".$subject_id."'
        AND `Grade_id`='".$grade_id."'
        AND `Shedule_date` LIKE '%".$heldDate."%'
        AND `lecture_verify_v_id`='2' ");

        $lecture_num = $lecture_rs->num_rows;

        if($lecture_num == 0){

            Database::iud("INSERT INTO `class_shedule` (`Grade_id`,`Shedule_date`,`start_time`,`end_time`,`subject_subject_id`,`lecture_verify_v_id`,`teacher`)
            VALUES ('".$grade_id."','".$heldDate."','".$startDate."','".$endDate."','".$subject_id."','1','".$teacher_email."') ");

            echo("Successfully Added");

        }else{
            echo("Lecture Already Listed ....");
        }

    }

 }

?>