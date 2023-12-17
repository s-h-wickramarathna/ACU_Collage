<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["officer"])) {
    $officer = $_SESSION["officer"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACU || View Assignment Marks </title>
        <link rel="icon" href="resources/app/university_logo.png" />
        <link rel="stylesheet" href="frameworks/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <?php include "header.php"; ?>

                <div class="col-12 mt-3 mb-3">
                    <p class="fs-4 fw-bold text-primary">View Student Marks Sheets ....</p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Teacher Email</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Exam Term</th>
                                    <th scope="col">Option</th>
                                    <th scope="col">Task</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $marks_rs = Database::Search("SELECT * FROM `student_marks`
                                INNER JOIN `assignments` ON `assignments`.`assignment_id`=`student_marks`.`assignments_assignment_id`
                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`student_marks`.`officer_teacher_has_subject_ths_id`
                                INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                INNER JOIN `exam_term` ON `exam_term`.`id`=`assignments`.`exam_term_id`");
                                $marks_num = $marks_rs->num_rows;

                                if ($marks_num != 0) {
                                    for ($x = 0; $x < $marks_num; $x++) {
                                        $marks_data = $marks_rs->fetch_assoc();
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo ($x + 1); ?></th>
                                            <td><?php echo ($marks_data["assignment_title"]); ?></td>
                                            <td><?php echo ($marks_data["subject_name"]); ?></td>
                                            <td><?php echo ($marks_data["officer_teacher_email"]); ?></td>
                                            <td><?php echo ($marks_data["Grade_name"]); ?></td>
                                            <td><?php echo ($marks_data["term_type"]); ?></td>
                                            <td><a href="<?php echo ($marks_data["student_marks_sheet_path"]); ?>" class="btn btn-info">View & Download</a></td>
                                            <td>
                                                <?php
                                                if ($marks_data["task"] == 1) {
                                                ?>
                                                    <button class="btn btn-danger" onclick="submitedStudentMarksConfirm(<?php echo ($marks_data['student_marks_id']) ?>)">Not Submited</button>
                                                <?php
                                                } else if ($marks_data["task"] == 2) {
                                                ?>
                                                    <button class="btn btn-success">Submited</button>
                                                <?php
                                                }
                                                ?>

                                            </td>

                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 mt-2">
                        <?php include "footer.php" ?>
                    </div>
            </div>
        </div>
        <script src="frameworks/jquery_v3.6.2.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
}

?>