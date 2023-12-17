<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {
    if (isset($_GET["e"])) {
        $student_email = $_GET["e"];
        $fee = $_GET["f"];

        if(!empty($fee)){
            $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' ");
            $student_data = $student_rs->fetch_assoc();
    
           $studenths_rs = Database::Search("SELECT * FROM `student_has_subject` WHERE `student_student_email`='" . $student_email . "' ");
           $studenths_num = $studenths_rs->num_rows;
    
    for ($x=0; $x < $studenths_num; $x++) { 
        $studenths_data = $studenths_rs->fetch_assoc();
    
        $result_rs = Database::Search("SELECT * FROM `assignment_result` WHERE `student_has_subject_student_subject`='".$studenths_data["student_subject"]."' ");
        $result_num = $result_rs->num_rows;
    
        for ($i=0; $i < $result_num; $i++) { 
            $result_data = $result_rs->fetch_assoc();
    
            if($result_data["student_has_subject_student_subject"] == $studenths_data["student_subject"]){
                Database::iud("DELETE FROM `assignment_result` WHERE `student_has_subject_student_subject`='".$studenths_data["student_subject"]."' ");
    
            }
        }
    }
    
            Database::iud("DELETE FROM `student_has_subject` WHERE `student_student_email`='" . $student_email . "' ");
    
            $student_grade = $student_data["Grade_id"] + 1;
    
            if ($student_grade <= 5) {
                $primary_subject = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='1' ");
                $primary_subject_num = $primary_subject->num_rows;
    
                for ($i=0; $i < $primary_subject_num; $i++) { 
                    $primary_subject_data = $primary_subject->fetch_assoc();
                    Database::iud("INSERT INTO `student_has_subject`(`student_student_email`,`subject_subject_id`) VALUES('".$student_email."','".$primary_subject_data["subject_id"]."') ");
                
                }
                Database::iud("UPDATE `student` SET `Grade_id`='".$student_grade."' WHERE `student_email`='".$student_email."' ");
                
                $today = date("Y-m-d");
                $treil_period = date('d-m-Y', strtotime('+1 month'));
                $expire_date = date('d-m-Y', strtotime('+1 year'));
                
    
                Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`,`tail_period`,`expire_date`) VALUES('".$fee."','".$student_email."','".$student_grade."','1','".$today."','".$treil_period."','".$expire_date."') ");
                echo("Success");
    
    
            } else if ($student_grade >= 6 && $student_grade <= 9) {
                $ol_subject = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='2' AND `subject_type_stype_id`='3' AND `subject_type_stype_id`='4' AND `subject_type_stype_id`='5' ");
                $ol_subject_num = $ol_subject->num_rows;
    
                for ($i=0; $i < $ol_subject_num; $i++) { 
                    $ol_subject_data = $ol_subject->fetch_assoc();
                    Database::iud("INSERT INTO `student_has_subject`(`student_student_email`,`subject_subject_id`) VALUES('".$student_email."','".$primary_subject_data["subject_id"]."') ");
                
                }
                Database::iud("UPDATE `student` SET `Grade_id`='".$student_grade."' WHERE `student_email`='".$student_email."' ");
    
                $today = date("Y-m-d");
    
                Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`) VALUES('".$fee."','".$student_email."','".$student_grade."','1','".$today."') ");
                echo("Success");
    
            } else if ($student_grade >= 9 && $student_grade <= 11) {
                echo("9");
            } else if ($student_grade >= 12 && $student_grade <= 13) {
                echo("12");
            } else if ($student_grade == 14) {
                echo("Success");
            }
        }else{
            echo("p");
        }

    }
}
