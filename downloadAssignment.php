<?php
session_start();
if (isset($_SESSION["student"])) {
    $student = $_SESSION["student"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACU || Download Assignments</title>
        <link rel="icon" href="resources/app/university_logo.png" />
        <link rel="stylesheet" href="frameworks/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php
                include "header.php";
                require "database/connection.php";

                $student_rs = Database::Search("SELECT * FROM `student`
            INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
            WHERE `student_email`='" . $student["student_email"] . "' ");
                $student_num = $student_rs->num_rows;

                if ($student_num != 0) {
                    $student_data = $student_rs->fetch_assoc();

                ?>
                    <div class="col-12">
                        <p class="m-0 fs-3 fw-bold text-success border-bottom border-2">Subjects & Assignments :</p>
                        <p class="m-0 fs-4 fw-bold text-primary">Student Name : <span class="text-black-50"><?php echo ($student_data["student_firstname"] . " " . $student_data["student_lastname"]) ?></span> </p>
                        <p class="m-0 fs-4 fw-bold text-primary">Student Grade : <span class="text-black-50"><?php echo ($student_data["Grade_name"]) ?></span> </p>
                    </div>


                    <div class="col-12 mt-4">
                        <div class="accordion">

                            <?php

                            $subject_rs = Database::Search("SELECT * FROM `student_has_subject`
                            INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id`
                            WHERE `student_student_email`='" . $student["student_email"] . "' ");

                            $subject_num = $subject_rs->num_rows;

                            if ($subject_num != 0) {
                                for ($i = 0; $i < $subject_num; $i++) {
                                    $subject_data = $subject_rs->fetch_assoc();
                            ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo ($i) ?>">
                                                <p class="fs-4 fw-bold text-danger"><?php echo ($subject_data["subject_name"]) ?></p>
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse<?php echo ($i) ?>" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Title</th>
                                                                <th scope="col">Submit Date</th>
                                                                <th scope="col">Expire Date</th>
                                                                <th scope="col">Marks</th>
                                                                <th scope="col">Option</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ths_rs = Database::Search("SELECT * FROM `assignments`
                                                            INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id` 
                                                            INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
                                                            WHERE `subject_subject_id`='" . $subject_data["subject_id"] . "' ");
                                                            $ths_num = $ths_rs->num_rows;

                                                            if ($ths_num != 0) {
                                                                for ($x = 0; $x < $ths_num; $x++) {
                                                                    $ths_data = $ths_rs->fetch_assoc();
                                                            ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo ($x + 1); ?></th>
                                                                        <td><?php echo ($ths_data["assignment_title"]); ?></td>
                                                                        <td><?php echo ($ths_data["assignment_submit_date"]) ?></td>
                                                                        <td><?php echo ($ths_data["assignment_expire_date"]) ?></td>
                                                                        <td>0</td>
                                                                        <?php
                                                                        $today =  date("Y-m-d");
                                                                        $expire_d = explode(" ", $ths_data["assignment_expire_date"]);
                                                                        $expire_date = $expire_d[0];

                                                                        if ($today <= $expire_date) {

                                                                        ?>
                                                                            <td><a class="btn btn-primary" download="<?php echo ($ths_data["assignment_path"]) ?>">Download</a></td>
                                                                            <td>
                                                                                <?php

                                                                                $assignment_rs = Database::Search("SELECT * FROM `assignment_result` WHERE `student_has_subject_student_subject`='" . $subject_data['student_subject'] . "' AND `assignments_assignment_id`='" . $ths_data['assignment_id'] . "' ");
                                                                                $assignment_num = $assignment_rs->num_rows;

                                                                                if ($assignment_num == 0) {
                                                                                ?>
                                                                                    <input type="file" id="assignmentAnswerUpload<?php echo ($x) ?>" class="visually-hidden" hidden onchange="uploadAssignments(<?php echo ($ths_data['assignment_id']); ?>,<?php echo ($subject_data['student_subject']) ?>,<?php echo ($x) ?>);">
                                                                                    <label for="assignmentAnswerUpload<?php echo ($x) ?>" class="btn btn-dark">Upload</label>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <input type="file" id="assignmentAnswerUpload1<?php echo ($x) ?>" class="visually-hidden" hidden onchange="uploadAssignments(<?php echo ($ths_data['assignment_id']); ?>,<?php echo ($subject_data['student_subject']) ?>,<?php echo ($x) ?>);">
                                                                                    <label for="assignmentAnswerUpload1<?php echo ($x) ?>" class="btn btn-success">Re Upload</label>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <?php

                                                                        } else {
                                                                            $assignment_result = Database::Search("SELECT * FROM `assignment_result`
                                                                            INNER JOIN `student_has_subject` ON `student_has_subject`.`student_subject`=`assignment_result`.`student_has_subject_student_subject` 
                                                                            WHERE `student_student_email`='" . $student["student_email"] . "' AND `subject_subject_id`='" . $subject_data["subject_id"] . "' ");

                                                                            $assignment_result_num = $assignment_result->num_rows;

                                                                            if ($assignment_result_num == 0) {

                                                                                $d = new DateTime();
                                                                                $tz = new DateTimeZone("Asia/Colombo");
                                                                                $d->setTimezone($tz);
                                                                                $date = $d->format("Y-m-d H:i:s");

                                                                                Database::iud("INSERT INTO `assignment_result` (`student_has_subject_student_subject`,`assignments_assignment_id`,`marks`,`atendents_atendent_id`,`answer_path`,`UploadDateTime`)
                                                                                VALUES ('" . $subject_data["student_subject"] . "','" . $ths_data["assignment_id"] . "','0','2','null','" . $date . "') ");
                                                                            ?>
                                                                                <td><a class="btn btn-danger">Absent</a></td>
                                                                                <?php
                                                                            } else {
                                                                                $assignment_result_data = $assignment_result->fetch_assoc();
                                                                                if ($assignment_result_data["atendents_atendent_id"] == 1) {
                                                                                ?>
                                                                                    <td><a class="btn btn-danger">Absent</a></td>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <td><a class="btn btn-info">Submited</a></td>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }

                        ?>

                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <?php include "footer.php" ?>
                    </div>
            </div>
        </div>
        <script src="frameworks/bootstrap.js"></script>
        <script src="frameworks/jquery_v3.6.2.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
}
?>