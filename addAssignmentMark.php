<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["teacher"])) {
    $teacher = $_SESSION["teacher"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACU || Add Student Assignment Marks </title>
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
                ?>
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 mt-3">
                            <p class="fs-4 fw-bold text-primary">Submit Student Marks ...</p>
                        </div>
                        <div class="col-12 mt-3 text-end">
                            <button class="btn btn-primary">Download Mark Sheet</button>
                        </div>

                        <div class="col-8">
                            <hr class="border border-3 border-primary">
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <p class="fw-bold fs-4 text-primary">All Assignments ....</p>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>

                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Submit Date</th>
                                                    <th scope="col">Expire Date</th>
                                                    <th scope="col">Grade</th>
                                                    <th scope="col">Exam Term</th>
                                                    <th scope="col">Option</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                $assignment_rs = Database::Search("SELECT * FROM `assignments`
                                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id`
                                                INNER JOIN `exam_term` ON `exam_term`.`id`=`assignments`.`exam_term_id`
                                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                                WHERE `officer_teacher_email`='" . $teacher["email"] . "' ");

                                                $assignment_num = $assignment_rs->num_rows;

                                                if ($assignment_num != 0) {
                                                    for ($x = 0; $x < $assignment_num; $x++) {
                                                        $assignment_data = $assignment_rs->fetch_assoc();

                                                ?>
                                                        <tr>

                                                            <th scope="row"><?php echo ($x + 1) ?></th>
                                                            <td><?php echo ($assignment_data["assignment_title"]) ?></td>
                                                            <td><?php echo ($assignment_data["assignment_submit_date"]) ?></td>
                                                            <td><?php echo ($assignment_data["assignment_expire_date"]) ?></td>
                                                            <td><?php echo ($assignment_data["Grade_name"]) ?></td>
                                                            <td><?php echo ($assignment_data["term_type"]) ?></td>
                                                            <td><a href="<?php echo ($assignment_data["assignment_path"]) ?>" class="btn btn-dark">view</a></td>

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

                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-primary">
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-6">
                                    <p class="fw-bold fs-4 text-primary">Submit Assignment Marks ....</p>
                                </div>
                                <div class="col-6">
                                    <div class="alert alert-danger m-0 d-none" id="AssignmentStudentMarksheet" role="alert">

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>

                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Submit Date</th>
                                                    <th scope="col">Expire Date</th>
                                                    <th scope="col">Exam Term</th>
                                                    <th scope="col">Grade</th>
                                                    <th scope="col">Option</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $assignments_rs = Database::Search("SELECT * FROM `assignments`
                                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id`
                                                INNER JOIN `exam_term` ON `exam_term`.`id`=`assignments`.`exam_term_id`
                                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                                WHERE `officer_teacher_email`='" . $teacher["email"] . "' ");

                                                $assignments_num = $assignments_rs->num_rows;

                                                if ($assignments_num != 0) {
                                                    for ($x = 0; $x < $assignments_num; $x++) {
                                                        $assignment_data = $assignments_rs->fetch_assoc();

                                                        $today =  date("Y-m-d");
                                                        $expire_d = explode(" ", $assignment_data["assignment_expire_date"]);
                                                        $expire_date = $expire_d[0];

                                                        if ($today >= $expire_date) {

                                                            $studentMarks_rs = Database::Search("SELECT * FROM `student_marks` WHERE `assignments_assignment_id`='" . $assignment_data["assignment_id"] . "' ");
                                                            $studentMarks_num = $studentMarks_rs->num_rows;

                                                            if ($studentMarks_num == 0) {
                                                ?>
                                                                <tr>

                                                                    <th scope="row"><?php echo ($x + 1) ?></th>
                                                                    <td><?php echo ($assignment_data["assignment_title"]) ?></td>
                                                                    <td><?php echo ($assignment_data["assignment_submit_date"]) ?></td>
                                                                    <td><?php echo ($assignment_data["assignment_expire_date"]) ?></td>
                                                                    <td><?php echo ($assignment_data["term_type"]) ?></td>
                                                                    <td><?php echo ($assignment_data["Grade_name"]) ?></td>
                                                                    <td>
                                                                        <input type="file" class="visually-hidden" id="studentAssignmentmSheet<?php echo ($assignment_data["assignment_id"]) ?>" onchange="uploadAssignmentMarks(<?php echo ($assignment_data['assignment_id']) ?>,'<?php echo ($assignment_data['officer_teacher_email']) ?>',<?php echo ($assignment_data['officer_teacher_has_subject_ths_id']) ?>);">
                                                                        <label for="studentAssignmentmSheet<?php echo ($assignment_data["assignment_id"]) ?>" class="btn btn-dark">Upload</label>
                                                                    </td>

                                                                </tr>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                }

                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-primary">
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <p class="fw-bold fs-4 text-primary">Marks Submited Assignments ....</p>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>

                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Submit Date</th>
                                                    <th scope="col">Expire Date</th>
                                                    <th scope="col">Exam Term</th>
                                                    <th scope="col">Grade</th>
                                                    <th scope="col">Option</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result_rs = Database::Search("SELECT * FROM `student_marks`
                                                INNER JOIN `assignments` ON `assignments`.`assignment_id`=`student_marks`.`assignments_assignment_id`
                                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id`
                                                INNER JOIN `exam_term` ON `exam_term`.`id`=`assignments`.`exam_term_id`
                                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                                WHERE `officer_teacher_email`='" . $teacher["email"] . "' ");

                                                $result_num = $result_rs->num_rows;

                                                if ($result_num != 0) {
                                                    for ($i = 0; $i < $result_num; $i++) {
                                                        $result_data = $result_rs->fetch_assoc();

                                                ?>
                                                        <tr>

                                                            <th scope="row"><?php echo($i + 1) ?></th>
                                                            <td><?php echo($result_data["assignment_title"]) ?></td>
                                                            <td><?php echo($result_data["assignment_submit_date"]) ?></td>
                                                            <td><?php echo($result_data["assignment_expire_date"]) ?></td>
                                                            <td><?php echo($result_data["term_type"]) ?></td>
                                                            <td><?php echo($result_data["Grade_name"]) ?></td>
                                                            <td><button class="btn btn-success">Submited</button></td>
                                                            
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