<?php
session_start();
if (isset($_SESSION["teacher"])) {
    $teacher = $_SESSION["teacher"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACU || View Submited Answer Sheet </title>
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
                ?>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-12">
                            <p class="fs-4 fw-bold text-primary">Filter Details To See Answer Sheets ....</p>
                        </div>
                        <div class="col-4 offset-4 mt-2 mb-2">
                            <p>Subject :</p>
                            <select class="form-select" id="teacherSubjectAssignment">
                                <option value="0">Select Subject</option>
                                <?php

                                $ths_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
                                INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
                                WHERE `officer_teacher_email`='" . $teacher["email"] . "' ");

                                $ths_num = $ths_rs->num_rows;
                                if ($ths_num == 0) {
                                ?>
                                    <option value="0">Grade Is Not Assign To You</option>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $ths_num; $x++) {
                                        $ths_data = $ths_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $ths_data["subject_id"] ?>"><?php echo $ths_data["subject_name"] ?></option>
                                <?php
                                    }
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-4 mt-2 mb-2">
                            <p>Grade :</p>
                            <select class="form-select" id="teacherGradeAssignment">
                            <option value="0">Select Grade</option>
                                <?php

                                $thg_rs = Database::Search("SELECT * FROM `officer_teacher_has_grade`
                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_grade`.`Grade_id`
                                WHERE `officer_teacher_email`='" . $teacher["email"] . "' ");

                                $thg_num = $thg_rs->num_rows;
                                if ($ths_num == 0) {
                                ?>
                                    <option value="0">Grade Is Not Assign To You</option>
                                    <?php
                                } else {
                                    for ($x = 0; $x < $thg_num; $x++) {
                                        $thg_data = $thg_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $thg_data["id"] ?>"><?php echo $thg_data["Grade_name"] ?></option>
                                <?php
                                    }
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-dark" onclick="selectsubmitedAnswersheet();">View Result</button>
                        </div>
                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-primary">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row" id="loadAnswerSheets">

                        <div class="col-12">
                            <p class="fs-4 fw-bold text-primary">All Students....</p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>

                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Submit Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Student Email</th>
                                            <th scope="col"></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                       <?php
                                       $student_rs = Database::Search("SELECT * FROM `student` 
                                       INNER JOIN `student_has_subject` ON `student_has_subject`.`student_student_email`=`student`.`student_email` 
                                       INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id` ");
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
                                                    <td></td>
                                                    <td></td>
                        
                                                </tr>
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-primary">
                        </div>
                        <div class="col-12">
                            <p class="fs-4 fw-bold text-primary">Absent Students ....</p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>

                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Submit Date</th>
                                            <th scope="col">Expire Date</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Student Email</th>
                                            <th scope="col">Option</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

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