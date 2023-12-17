<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["officer"])) {
    if (isset($_GET["g"])) {

        $grade_id = $_GET["g"];

        if ($grade_id >= 6 && $grade_id <= 11) {

?>

            <?php
            $ol_rs_01 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='2' AND `subject_type_stype_id`='3' AND  `subject_type_stype_id`='4' AND  `subject_type_stype_id`='5' ");
            $ol_num_01 = $ol_rs_01->num_rows;

            if ($ol_num_01 != 0) {
                for ($i = 0; $i < $ol_num_01; $i++) {
                    $ol_data_01 = $ol_rs_01->fetch_assoc();
            ?>
                    <option value="<?php echo ($ol_data_01["subject_id"]) ?>"><?php echo ($ol_data_01["subject_name"]) ?></option>
                <?php
                }
            }
        } else if ($grade_id > 10) {

            $al_rs_01 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='6' AND `subject_type_stype_id`='7' AND `subject_type_stype_id`='8' AND `subject_type_stype_id`='9' ");
            $al_num_01 = $al_rs_01->num_rows;

            if ($al_num_01 != 0) {
                for ($i = 0; $i < $al_num_01; $i++) {
                    $al_data_01 = $al_rs_01->fetch_assoc();
                ?>
                    <option value="<?php echo ($al_data_01["subject_id"]) ?>"><?php echo ($al_data_01["subject_name"]) ?></option>
<?php
                }
            }
        }else if($grade_id >= 1 && $grade_id <= 5){
            $p_rs_01 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='1' ");
            $p_num_01 = $p_rs_01->num_rows;

            if ($p_num_01 != 0) {
                for ($i = 0; $i < $p_num_01; $i++) {
                    $p_data_01 = $p_rs_01->fetch_assoc();
                ?>
                    <option value="<?php echo ($p_data_01["subject_id"]) ?>"><?php echo ($p_data_01["subject_name"]) ?></option>
<?php
                }
            }
        }
    }
}


?>