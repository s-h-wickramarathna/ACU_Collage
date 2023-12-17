<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["officer"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACU || Release Student Marks</title>
        <link rel="icon" href="resources/app/university_logo.png" />
        <link rel="stylesheet" href="frameworks/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <?php include "header.php"; ?>

                <div class="col-12">
                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <p class="fs-4 fw-bold text-primary">Search Students To Assign Marks ....</p>
                        </div>
                        <div class="col-3 offset-3">
                            <select class="form-select" id="MarksAssignGrade" onchange="loadSubjectToGradeMarks();">
                                <option value="0">Select Grade</option>
                                <?php
                                $grade_rs = Database::Search("SELECT * FROM `grade` ");
                                $grade_num = $grade_rs->num_rows;

                                if ($grade_num != 0) {
                                    for ($i = 0; $i < $grade_num; $i++) {
                                        $grade_data = $grade_rs->fetch_assoc();
                                ?>
                                        <option value="<?php echo ($grade_data["id"]) ?>"><?php echo ($grade_data["Grade_name"]) ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>

                        <div class="col-3">
                            <select class="form-select" id="marksAssignSubject">
                                <option value="0">Select Subject</option>
                            </select>
                        </div>
                        <div class="col-3 d-grid">
                            <button class="btn btn-primary" onclick="loadStudentMarksDetails();">Search</button>
                        </div>

                    </div>
                </div>

                <div class="col-8 offset-4">
                    <hr class="border border-3 border-primary">
                </div>

                <div class="col-12 mt-3 mb-4">
                    <div class="row">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>

                                        <th scope="col">#</th>
                                        <th scope="col">Assignment Title</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">student Name</th>
                                        <th scope="col">student Email</th>
                                        <th scope="col">marks</th>
                                        <th scope="col">option</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    if (isset($_GET["g"]) && isset($_GET["s"])) {
                                        $grade = $_GET["g"];
                                        $subject = $_GET["s"];
                                        $student_rs = Database::Search("SELECT * FROM `assignment_result`
                                        INNER JOIN `assignments` ON `assignments`.`assignment_id`=`assignment_result`.`assignments_assignment_id`
                                        INNER JOIN `student_has_subject` ON `student_has_subject`.`student_subject`=`assignment_result`.`student_has_subject_student_subject`
                                        INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`student_subject`
                                        INNER JOIN `student` ON `student`.`student_email`=`student_has_subject`.`student_student_email`
                                        INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
                                        WHERE `grade`.`id`='" . $grade . "' AND `subject`.`subject_id`='" . $subject . "' ");

                                        $student_num = $student_rs->num_rows;

                                        if ($student_num != 0) {
                                            for ($x = 0; $x < $student_num; $x++) {
                                                $student_data = $student_rs->fetch_assoc();
                                    ?>
                                                <tr>

                                                    <th scope="row"><?php echo ($x + 1) ?></th>
                                                    <td><?php echo ($student_data["assignment_title"]) ?></td>
                                                    <td><?php echo ($student_data["subject_name"]) ?></td>
                                                    <td><?php echo ($student_data["Grade_name"]) ?></td>
                                                    <td><?php echo ($student_data["student_firstname"] . " " . $student_data["student_lastname"]) ?></td>
                                                    <td><?php echo ($student_data["student_email"]) ?></td>
                                                    <td><?php echo ($student_data["marks"]) ?></td>
                                                    <?php
                                                    if ($student_data["atendents_atendent_id"] == 1) {
                                                    ?>
                                                        <td><button class="btn btn-danger">Absent</button></td>
                                                    <?php
                                                    } else if ($student_data["atendents_atendent_id"] == 2) {
                                                    ?>
                                                        <td><button class="btn btn-success" onclick="showAddMarksmodel(<?php echo ($student_data['assignment_result_id']) ?>);">Add Marks</button></td>
                                                    <?php
                                                    }
                                                    ?>

                                                </tr>
                                                <!-- Model -->
                                                <div class="modal" tabindex="-1" id="showAddmarksStudentModel<?php echo ($student_data['assignment_result_id']) ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add Marks</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="number" class="form-control" id="studentmarks_Assign<?php echo ($student_data['assignment_result_id']) ?>">
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" onclick="addmarkstoStudent(<?php echo ($student_data['assignment_result_id']) ?>);">+Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Model -->
                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <tr>

                                            <th scope="row"></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-12 mt-2">
                        <?php include "footer.php" ?>
                    </div>
            </div>
        </div>
        <script src="frameworks/jquery_v3.6.2.js"></script>
        <script src="frameworks/bootstrap.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
}
?>