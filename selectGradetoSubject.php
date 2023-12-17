<?php
require "database/connection.php";

if(isset($_GET["g"])){
    $student_grade = $_GET["g"];

    if ($student_grade <= 5) {
        $primary_subject = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='1' ");
        $primary_subject_num = $primary_subject->num_rows;

        for ($i=0; $i < $primary_subject_num; $i++) { 
            $primary_subject_data = $primary_subject->fetch_assoc();
           ?>
           <option value="<?php echo($primary_subject_data["subject_id"]) ?>"><?php echo($primary_subject_data["subject_name"]) ?></option>
           <?php
        }
        
    } else if ($student_grade >= 6 && $student_grade <= 11) {
        $ol_subject = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='2' AND `subject_type_stype_id`='3' AND `subject_type_stype_id`='4' AND `subject_type_stype_id`='5' ");
        $ol_subject_num = $ol_subject->num_rows;

        for ($i=0; $i < $ol_subject_num; $i++) { 
            $ol_subject_data = $ol_subject->fetch_assoc();
            ?>
            <option value="<?php echo($ol_subject_data["subject_id"]) ?>"><?php echo($ol_subject_data["subject_name"]) ?></option>
            <?php
        }
       

    } else if ($student_grade >= 12 && $student_grade <= 13) {
        $Al_subject = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='6' AND `subject_type_stype_id`='7' AND `subject_type_stype_id`='8' AND `subject_type_stype_id`='9' ");
        $Al_subject_num = $Al_subject->num_rows;

        for ($i=0; $i < $Al_subject_num; $i++) { 
            $Al_subject_data = $Al_subject->fetch_assoc();
            ?>
            <option value="<?php echo($Al_subject_data["subject_id"]) ?>"><?php echo($Al_subject_data["subject_name"]) ?></option>
            <?php
        }
    }

}

?>