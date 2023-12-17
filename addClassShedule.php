<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Student Details</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "adminHeader.php";
            require "database/connection.php";

            if (isset($_GET["g"])) {
                $grade_id = $_GET["g"];

                $grade_rs = Database::Search("SELECT * FROM `grade` WHERE `id`='" . $grade_id . "' ");
                $grade_data = $grade_rs->fetch_assoc();

            ?>
                <div class="col-12 mt-3">
                    <p class="fs-4 fw-bold text-primary">Manage Students ....</p>
                </div>

                <div class="col-12">
                    <div class="row justify-content-end">
                        <div class="col-12 col-lg-4 mb-4">
                            <div class="alert alert-success d-none" role="alert" id="lectureSheduleMSG"></div>
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Held Date :</p>
                            <input type="date" class="form-control shadow" id="HeldDate" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Grade :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($grade_data["Grade_name"]) ?>" disabled />
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Select Subject :</p>
                            <select class="form-select shadow" id="sheduleSubject" onchange="loadteachers(<?php echo ($grade_data['id']) ?>)">
                                <option value="0">Select Subject</option>
                                <?php
                                $subject_rs = Database::Search("SELECT * FROM `subject` ");
                                $subject_num = $subject_rs->num_rows;

                                if ($subject_num != 0) {
                                    for ($s = 0; $s < $subject_num; $s++) {
                                        $subject_data = $subject_rs->fetch_assoc();

                                ?>
                                        <option value="<?php echo ($subject_data["subject_id"]) ?>"><?php echo ($subject_data["subject_name"]) ?></option>
                                <?php

                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Select Teacher :</p>
                            <select class="form-select shadow" id="loadteacherSH">
                                <option value="0">First Select Subject</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Satrt Time :</p>
                            <input type="time" class="form-control shadow" id="st_time" />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">End Time :</p>
                            <input type="time" class="form-control shadow" id="En_time" />
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4 text-end">
                    <button class="btn btn-success" onclick="AddClassShedule(<?php echo ($grade_data['id']) ?>);">Save & Add New</button>
                </div>

                <div class="col-12">
                    <hr class="border border-4 border-primary">
                </div>
                <div class="col-12">
                    <p class="fs-4 fw-bold text-primary">Search Lectures :</p>
                </div>
                <div class="col-4 offset-4 my-3">
                    <input type="date" class="form-control" onchange="searchLectures(<?php echo ($grade_data['id']) ?>);" id="searchDate">
                </div>
                <div class="col-4 my-3">
                    <select class="form-select" id="searchSubject" onchange="searchLectures(<?php echo ($grade_data['id']) ?>);">
                        <option value="0">Select Subject</option>
                        <?php
                        $subjectS_rs = Database::Search("SELECT * FROM `subject` ");
                        $subjectS_num = $subjectS_rs->num_rows;

                        if ($subjectS_num != 0) {
                            for ($s = 0; $s < $subjectS_num; $s++) {
                                $subjectS_data = $subjectS_rs->fetch_assoc();

                        ?>
                                <option value="<?php echo ($subjectS_data["subject_id"]) ?>"><?php echo ($subjectS_data["subject_name"]) ?></option>
                        <?php

                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12">
                    <div class="table-responsive table_heigth">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Satrt At</th>
                                    <th scope="col">End At</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tbody id="SearchLeactureLoadDiv">
                                <?php

                                $startAt;
                                $endAt;

                                $lecture_rs = Database::Search("SELECT * FROM `class_shedule` 
                                INNER JOIN `subject` ON `subject`.`subject_id`=`class_shedule`.`subject_subject_id`
                                WHERE `Grade_id`='" . $grade_data['id'] . "' ORDER BY `Shedule_date` DESC ");

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
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php

            }

            ?>


        </div>
    </div>
    <script src="frameworks/jquery_v3.6.2.js"></script>
    <script src="frameworks/bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php



?>