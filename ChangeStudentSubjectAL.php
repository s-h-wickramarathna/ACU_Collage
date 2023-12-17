<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {
    if (isset($_POST["e"])) {
        $student_email = $_POST["e"];

        $subject_01 = $_POST["s1"];
        $subject_02 = $_POST["s2"];
        $subject_03 = $_POST["s3"];
        $fee = $_POST["f"];

        if (!empty($fee)) {
            if ($subject_01 == 0 || $subject_02 == 0 || $subject_03 == 0) {
                echo ("1");
            } else {

                $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' ");
                $student_data = $student_rs->fetch_assoc();

                $studenths_rs = Database::Search("SELECT * FROM `student_has_subject` WHERE `student_student_email`='" . $student_email . "' ");
                $studenths_num = $studenths_rs->num_rows;

                for ($x = 0; $x < $studenths_num; $x++) {
                    $studenths_data = $studenths_rs->fetch_assoc();

                    $result_rs = Database::Search("SELECT * FROM `assignment_result` WHERE `student_has_subject_student_subject`='" . $studenths_data["student_subject"] . "' ");
                    $result_num = $result_rs->num_rows;

                    for ($i = 0; $i < $result_num; $i++) {
                        $result_data = $result_rs->fetch_assoc();

                        if ($result_data["student_has_subject_student_subject"] == $studenths_data["student_subject"]) {
                            Database::iud("DELETE FROM `assignment_result` WHERE `student_has_subject_student_subject`='" . $studenths_data["student_subject"] . "' ");
                        }
                    }
                }
                Database::iud("DELETE FROM `student_has_subject` WHERE `student_student_email`='" . $student_email . "' ");
                $student_grade = $student_data["Grade_id"] + 1;

                $Al_subject = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='6' ");
                $Al_subject_num = $Al_subject->num_rows;

                for ($i = 0; $i < $Al_subject_num; $i++) {
                    $Al_subject_data = $Al_subject->fetch_assoc();
                    Database::iud("INSERT INTO `student_has_subject`(`student_student_email`,`subject_subject_id`) VALUES('" . $student_email . "','" . $primary_subject_data["subject_id"] . "') ");
                }

                Database::iud("INSERT INTO `student_has_subject`(`student_student_email`,`subject_subject_id`) VALUES('" . $student_email . "','" . $subject_01 . "') ");
                Database::iud("INSERT INTO `student_has_subject`(`student_student_email`,`subject_subject_id`) VALUES('" . $student_email . "','" . $subject_02 . "') ");
                Database::iud("INSERT INTO `student_has_subject`(`student_student_email`,`subject_subject_id`) VALUES('" . $student_email . "','" . $subject_03 . "') ");

                Database::iud("UPDATE `student` SET `Grade_id`='" . $student_grade . "' WHERE `student_email`='" . $student_email . "' ");
                
                $today = date("Y-m-d");
                $treil_period = date('d-m-Y', strtotime('+1 month'));
                $expire_date = date('d-m-Y', strtotime('+1 year'));
                
                Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`,`tail_period`,`expire_date`) VALUES('".$fee."','".$student_email."','".$student_grade."','1','".$today."','".$treil_period."','".$expire_date."') ");
                echo ("Success");
            }
        } else {
            echo ("p");
        }
    }
}
