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
        <title>ACU || Teacher Panel</title>
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
                    <div class="row justify-content-center gap-4">

                        <div class="col-3 shadow mt-3 text-center">
                            <a href="addlesson.php" class="fw-bold fs-5 text-success">add Leason</a>
                        </div>

                        <div class="col-3 shadow mt-3 text-center">
                            <a href="addNewAssignment.php" class="fw-bold fs-5 text-success">add Assignments</a>
                        </div>

                        <div class="col-3 shadow mt-3 text-center">
                            <a href="teacherUpdateProfile.php" class="fw-bold fs-5 text-success">Update Profile</a>
                        </div>

                        <div class="col-3 shadow text-center">
                            <a href="viewSubmittedAnswerSheet.php" class="fw-bold fs-5 text-success">view Submitted Answer</a>
                        </div>

                        <div class="col-3 shadow text-center">
                            <a href="addAssignmentMark.php" class="fw-bold fs-5 text-success">Add Assignment Mark</a>
                        </div>

                        <div class="col-3 shadow text-center">
                            <a href="logOutProcess.php" class="fw-bold fs-5 text-success">Log Out</a>
                        </div>

                    </div>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <p class="fw-bold fs-4 text-primary">Today Lecture's</p>
                        </div>
                        <div class="col-12">
                            <hr class="border border-3 border-primary">
                        </div>

                        <div class="col-12 mt-2 mb-2">
                            <div class="row gap-2 justify-content-center">

                                <div class="col-12">
                                    <p class="fs-4 fw-bold text-primary m-0 mt-2 mb-2">Today Lectures ....</p>
                                </div>

                                <?php
                                $today = date("Y-m-d");
                                $lecture_rs = Database::Search("SELECT * FROM `class_shedule`
                                INNER JOIN `subject` ON `subject`.`subject_id`=`class_shedule`.`subject_subject_id`
                                WHERE `Shedule_date` LIKE '%" . $today . "%' AND `teacher`='".$teacher["email"]."' ");

                                $lecture_num = $lecture_rs->num_rows;

                                if ($lecture_num != 0) {
                                    for ($l = 0; $l < $lecture_num; $l++) {
                                        $lecture_data = $lecture_rs->fetch_assoc();

                                        $teacherL_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `email`='" . $lecture_data["teacher"] . "' ");
                                        $teacherL_data = $teacherL_rs->fetch_assoc();


                                ?>
                                        <!-- card -->
                                        <div class="card shadow" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo ($lecture_data["subject_name"]) ?></h5>
                                                <div class="col-12">
                                                    <hr class="border border-3 border-warning">
                                                </div>

                                                <div class="col-12">
                                                    <p class="fw-bold text-bg-success">Shedule Date : <?php echo ($lecture_data["Shedule_date"]) ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="fw-bold text-bg-info">Start Time : <?php echo ($lecture_data["start_time"]) ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="fw-bold text-bg-secondary">End Time : <?php echo ($lecture_data["end_time"]) ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="fw-bold text-bg-warning">Teacher : <?php echo ($teacherL_data["fname"] . " " . $teacherL_data["lname"]) ?></p>
                                                </div>
                                                <div class="col-12 text-center bg-primary">
                                                    <a href="<?php echo ($lecture_data["link"]) ?>" class="text-bg-primary">Click To Link Join</a>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- card -->
                                <?php
                                    }
                                }else{
                                    ?>
                                    <div class="col-12 text-center">
                                        <p class="fs-4 fw-bold text-primary">No Lecture Sheduled Yet ....</p>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </body>

    </html>

<?php
}

?>