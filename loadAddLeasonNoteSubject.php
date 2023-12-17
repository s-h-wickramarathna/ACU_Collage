<?php
require "database/connection.php";

if (isset($_POST["g"]) && isset($_POST["e"])) {
    $grade = $_POST["g"];
    $email = $_POST["e"];

    $subject_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
    INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
    INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
    WHERE `officer_teacher_email`='" . $email . "' AND `Grade_id`='" . $grade . "' ");
    $subject_num = $subject_rs->num_rows;

    if ($subject_num != 0) {
        for ($x = 0; $x < $subject_num; $x++) {
            $subject_data = $subject_rs->fetch_assoc();
?>
            <option value="<?php echo ($subject_data["subject_subject_id"]) ?>"><?php echo ($subject_data["subject_name"]) ?></option>
<?php
        }
    }
}

?>