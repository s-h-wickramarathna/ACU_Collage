<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_POST["g"])) {
        $gid = $_POST["g"];
        $date = $_POST["d"];
        $subject = $_POST["s"];

        $grade_rs = Database::Search("SELECT * FROM `grade` WHERE `id`='".$gid."' ");
        $grade_data = $grade_rs->fetch_assoc();

        $query = "SELECT * FROM `class_shedule` 
        INNER JOIN `subject` ON `subject`.`subject_id`=`class_shedule`.`subject_subject_id`
        WHERE `Grade_id`='" . $gid . "' ";

        if (!empty($date) && $subject == 0) {
            $query .= " AND `Shedule_date`='" . $date . "'";

        }else if(empty($date) && $subject != 0){
            $query .= " AND `subject_subject_id`='" . $subject . "'";

        }else if(!empty($date) && $subject != 0){
            $query .= " AND `Shedule_date`='" . $date . "' AND `subject_subject_id`='" . $subject . "' ";
        }

        $startAt;
        $endAt;
        
        $lecture_rs = Database::Search($query);

        $lecture_num = $lecture_rs->num_rows;

        if ($lecture_num != 0) {
            for ($l = 0; $l < $lecture_num; $l++) {
                $lecture_data = $lecture_rs->fetch_assoc();

                $teacher_rs = Database::Search("SELECT * FROM `officer_teacher` 
                WHERE `email`='" . $lecture_data["teacher"] . "' ");

                $teacher_data = $teacher_rs->fetch_assoc();

                if ($lecture_data["lecture_verify_v_id"] == 2) {
        ?>
                    <tr class="cursor">
                        <th scope="row" class="bg-danger"><?php echo ($l + 1) ?></th>
                        <td class="bg-danger"><?php echo ($grade_data['Grade_name']) ?></td>
                        <td class="bg-danger"><?php echo ($lecture_data['subject_name']) ?></td>
                        <td class="bg-danger"><?php echo ($teacher_data['fname'] . " " . $teacher_data['lname']) ?></td>
                        <td class="bg-danger"><?php echo ($lecture_data['Shedule_date']) ?></td>
                        <?php
                        $splid_st = explode(":", $lecture_data['start_time']);
                        $st_hour = $splid_st[0];
                        $st_min = $splid_st[1];

                        if ($st_hour >= 12) {
                            $startAt = $st_hour . ":" . $st_min . " PM";
                        } else {
                            $startAt = $st_hour . ":" . $st_min . " AM";
                        }

                        $splid_et = explode(":", $lecture_data['end_time']);
                        $et_hour = $splid_et[0];
                        $et_min = $splid_et[1];

                        if ($et_hour >= 12) {
                            $endAt = $et_hour . ":" . $et_min . " PM";
                        } else {
                            $endAt = $et_hour . ":" . $et_min . " AM";
                        }
                        ?>
                        <td class="bg-danger"><?php echo ($startAt) ?></td>
                        <td class="bg-danger"><?php echo ($endAt) ?></td>
                        <td class="bg-danger"><?php echo ($lecture_data['link']) ?></td>
                    </tr>
                <?php
                } else if ($lecture_data["lecture_verify_v_id"] == 1) {
                ?>
                    <tr class="cursor" onclick="showlectureUpdateModel(<?php echo ($lecture_data['shedule_id']) ?>)">
                        <th scope="row"><?php echo ($l + 1) ?></th>
                        <td><?php echo ($grade_data['Grade_name']) ?></td>
                        <td><?php echo ($lecture_data['subject_name']) ?></td>
                        <td><?php echo ($teacher_data['fname'] . " " . $teacher_data['lname']) ?></td>
                        <td><?php echo ($lecture_data['Shedule_date']) ?></td>
                        <?php
                        $splid_st = explode(":", $lecture_data['start_time']);
                        $st_hour = $splid_st[0];
                        $st_min = $splid_st[1];

                        if ($st_hour >= 12) {
                            $startAt = $st_hour . ":" . $st_min . " PM";
                        } else {
                            $startAt = $st_hour . ":" . $st_min . " AM";
                        }

                        $splid_et = explode(":", $lecture_data['end_time']);
                        $et_hour = $splid_et[0];
                        $et_min = $splid_et[1];

                        if ($et_hour >= 12) {
                            $endAt = $et_hour . ":" . $et_min . " PM";
                        } else {
                            $endAt = $et_hour . ":" . $et_min . " AM";
                        }
                        ?>
                        <td><?php echo ($startAt) ?></td>
                        <td><?php echo ($endAt) ?></td>
                        <td><?php echo ($lecture_data['link']) ?></td>
                    </tr>
                <?php
                }
                ?>

                <!-- update Model -->
                <div class="modal" tabindex="-1" id="lectureUpdate<?php echo ($lecture_data['shedule_id']) ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Lecture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6 mt-2">
                                            <p class="fw-bold m-0 mb-2">Grade :</p>
                                            <input type="text" class="form-control" value="<?php echo ($grade_data["Grade_name"]) ?>" disabled />
                                        </div>
                                        <div class="col-6 mt-2">
                                            <p class="fw-bold m-0 mb-2">Date :</p>
                                            <input type="text" class="form-control" value="<?php echo ($lecture_data['Shedule_date']) ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row mt-2">
                                        <div class="col-6 mt-2">
                                            <p class="fw-bold m-0 mb-2">Start Time :</p>
                                            <input type="time" class="form-control" value="<?php echo ($lecture_data['start_time']) ?>" id="l_start<?php echo ($lecture_data['shedule_id']) ?>" />
                                        </div>
                                        <div class="col-6 mt-2">
                                            <p class="fw-bold m-0 mb-2">End Time :</p>
                                            <input type="time" class="form-control" value="<?php echo ($lecture_data['end_time']) ?>" id="l_end<?php echo ($lecture_data['shedule_id']) ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row mt-2">
                                        <div class="col-6 mt-2">
                                            <p class="fw-bold m-0 mb-2">Select Subject :</p>
                                            <input type="text" class="form-control" value="<?php echo ($lecture_data['subject_name']) ?>" disabled />
                                        </div>
                                        <div class="col-6 mt-2">
                                            <p class="fw-bold m-0 mb-2">Select Teacher :</p>
                                            <select class="form-select" id="l_teacher<?php echo ($lecture_data['shedule_id']) ?>">
                                                <?php
                                                $teacher_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
                                                 INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_subject`.`officer_teacher_email` 
                                                 WHERE `subject_subject_id`='" . $lecture_data['subject_subject_id'] . "' AND `Grade_id`='" . $lecture_data['Grade_id'] . "' ");

                                                $teacher_num = $teacher_rs->num_rows;

                                                if ($teacher_num != 0) {
                                                    for ($t = 0; $t < $teacher_num; $t++) {
                                                        $teacher_data = $teacher_rs->fetch_assoc();

                                                ?>
                                                        <option value="<?php echo ($teacher_data["officer_teacher_email"]) ?>"><?php echo ($teacher_data["fname"] . " " . $teacher_data["lname"]) ?></option>
                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="updateLecture(<?php echo ($lecture_data['shedule_id']) ?>)">Save changes</button>
                                <button type="button" class="btn btn-danger" onclick="cancelLecture(<?php echo ($lecture_data['shedule_id']) ?>)">Cancel Lecture</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- update Model -->

        <?php
            }
        }

    }
}
