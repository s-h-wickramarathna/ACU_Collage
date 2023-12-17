<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){

    if(isset($_GET["s"]) && isset($_GET["g"])){
        $subject = $_GET["s"];
        $grade = $_GET["g"];

        $teacher_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
        INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_subject`.`officer_teacher_email` 
        WHERE `subject_subject_id`='".$subject."' AND `Grade_id`='".$grade."' ");

        $teacher_num = $teacher_rs->num_rows;

        if($teacher_num != 0){
            for ($t=0; $t < $teacher_num ; $t++) { 
                $teacher_data = $teacher_rs->fetch_assoc();

                ?>
                <option value="<?php echo($teacher_data["officer_teacher_email"]) ?>"><?php echo($teacher_data["fname"]." ".$teacher_data["lname"]) ?></option>
                <?php

            }
        }

    }

}

?>