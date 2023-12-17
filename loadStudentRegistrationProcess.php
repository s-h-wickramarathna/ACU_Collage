<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["officer"])) {
    if (isset($_GET["g"])) {

        $grade_id = $_GET["g"];

        if ($grade_id >= 9 && $grade_id <= 10) {

?>
            <!-- O/L -->
            <div class="row">
                <div class="col-12">
                    <p class="fw-bold text-danger">Already Have To Learn Main Subjects</p>
                </div>
                <div class="col-4 mt-2 mb-2" id="Show_OLSubject1">
                    <p class="fw-bold text-black-50">Select First Subject :</p>
                    <select class="form-select" id="showSubSubjectsOL1">
                        <option value="0">First Select Grade</option>
                        <?php
                        $ol_rs_01 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='3' ");
                        $ol_num_01 = $ol_rs_01->num_rows;

                        if ($ol_num_01 != 0) {
                            for ($i = 0; $i < $ol_num_01; $i++) {
                                $ol_data_01 = $ol_rs_01->fetch_assoc();
                        ?>
                                <option value="<?php echo ($ol_data_01["subject_id"]) ?>"><?php echo ($ol_data_01["subject_name"]) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 mt-2 mb-2" id="Show_OLSubject2">
                    <p class="fw-bold text-black-50">Select Second Subject :</p>
                    <select class="form-select" id="showSubSubjectsOL2">
                        <option value="0">First Select Grade</option>
                        <?php
                        $ol_rs_02 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='4' ");
                        $ol_num_02 = $ol_rs_02->num_rows;

                        if ($ol_num_02 != 0) {
                            for ($x = 0; $x < $ol_num_02; $x++) {
                                $ol_data_02 = $ol_rs_02->fetch_assoc();
                        ?>
                                <option value="<?php echo ($ol_data_02["subject_id"]) ?>"><?php echo ($ol_data_02["subject_name"]) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 mt-2 mb-2" id="Show_OLSubject3">
                    <p class="fw-bold text-black-50">Select Third Subject :</p>
                    <select class="form-select" id="showSubSubjectsOL3">
                        <option value="0">First Select Grade</option>
                        <?php
                        $ol_rs_03 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='5' ");
                        $ol_num_03 = $ol_rs_03->num_rows;

                        if ($ol_num_03 != 0) {
                            for ($i = 0; $i < $ol_num_03; $i++) {
                                $ol_data_03 = $ol_rs_03->fetch_assoc();
                        ?>
                                <option value="<?php echo ($ol_data_03["subject_id"]) ?>"><?php echo ($ol_data_03["subject_name"]) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- O/L -->
        <?php

        } else if ($grade_id > 10) {
        ?>
            <!-- A/L -->
            <div class="row">
                <div class="col-12">
                    <p class="fw-bold text-danger">Already Have To Learn Main Subjects</p>
                </div>
                <div class="col-4 mt-2 mb-2" id="Show_ALSubject1">
                    <p class="fw-bold text-black-50">Select First Subject :</p>
                    <select class="form-select" id="showSubSubjectsAL1">
                        <option value="0">First Select Grade</option>
                        <?php
                        $al_rs_01 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='7' ");
                        $al_num_01 = $al_rs_01->num_rows;

                        if ($al_num_01 != 0) {
                            for ($i = 0; $i < $al_num_01; $i++) {
                                $al_data_01 = $al_rs_01->fetch_assoc();
                        ?>
                                <option value="<?php echo ($al_data_01["subject_id"]) ?>"><?php echo ($al_data_01["subject_name"]) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 mt-2 mb-2" id="Show_ALSubject2">
                    <p class="fw-bold text-black-50">Select Second Subject :</p>
                    <select class="form-select" id="showSubSubjectsAL2">
                        <option value="0">First Select Grade</option>
                        <?php
                        $al_rs_02 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='8' ");
                        $al_num_02 = $al_rs_02->num_rows;

                        if ($al_num_02 != 0) {
                            for ($i = 0; $i < $al_num_02; $i++) {
                                $al_data_02 = $al_rs_02->fetch_assoc();
                        ?>
                                <option value="<?php echo ($al_data_02["subject_id"]) ?>"><?php echo ($al_data_02["subject_name"]) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 mt-2 mb-2" id="Show_ALSubject3">
                    <p class="fw-bold text-black-50">Select Third Subject :</p>
                    <select class="form-select" id="showSubSubjectsAL3">
                        <option value="0">First Select Grade</option>
                        <?php
                        $al_rs_03 = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='9' ");
                        $al_num_03 = $al_rs_03->num_rows;

                        if ($al_num_03 != 0) {
                            for ($i = 0; $i < $al_num_03; $i++) {
                                $al_data_03 = $al_rs_03->fetch_assoc();
                        ?>
                                <option value="<?php echo ($al_data_03["subject_id"]) ?>"><?php echo ($al_data_03["subject_name"]) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- A/L -->
<?php
        }
    }
}


?>