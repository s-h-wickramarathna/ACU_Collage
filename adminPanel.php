<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Admin Panel</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "adminHeader.php";
            require "database/connection.php";

            if (isset($_SESSION["admin"])) {
                $admin_email = $_SESSION["admin"]["email"];
            ?>
                <div class="col-12 col-lg-3 mt-2">
                    <div class="row shadow border-end border-3 border-primary">

                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="row">
                                <div class="col-12">
                                    <p class="fs-4 fw-bold text-primary m-0 mt-2 mb-2">My Section ....</p>
                                </div>
                                <div class="col-8">
                                    <hr class="border border-3 border-success">
                                </div>
                                <div class="col-12 mt-2 mb-2 text-center">
                                    <?php
                                    $image_path = "resources/app/no_image.jpg";
                                    $image_rs = Database::Search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='" . $admin_email . "' ");
                                    $image_data = $image_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo($image_data["image_path"]) ?>" class="rounded-circle" height="200px">
                                </div>
                                <div class="col-12 mt-2 mb-2 text-center">
                                    <a href="adminUpdateProfile.php" class="btn btn-outline-dark">Update Profile</a>
                                    <a href="#" onclick="Logout();" class="btn btn-dark">Log Out</a>
                                </div>
                            </div>
                        </div> 

                        <div class="col-12 col-sm-6 col-lg-12 d-flex align-items-end">
                            <div class="row border border-2 mt-3">

                                <div class="col-6 col-lg-12 mt-2 mb-2 text-center">
                                    <a href="manageAdmistration.php" class="btn btn-outline-primary">Manage Adminstration</a>
                                </div>
                                <div class="col-6 col-lg-12 mt-2 mb-2 text-center">
                                    <a href="Manage_teachers.php" class="btn btn-outline-primary">Manage Teachers</a>
                                </div>
                                <div class="col-6 col-lg-12 mt-2 mb-2 text-center">
                                    <a href="Officers_manage.php" class="btn btn-outline-primary">Manage Officers</a>
                                </div>
                                <div class="col-6 col-lg-12 mt-2 mb-2 text-center">
                                    <a href="manage_class&Section.php" class="btn btn-outline-primary">Manage Grade</a>
                                </div>
                                <div class="col-6 col-lg-12 mt-2 mb-2 text-center">
                                    <a href="manage_student.php" class="btn btn-outline-primary">Manage Students</a>
                                </div>
                                <div class="col-6 col-lg-12 mt-2 mb-2 text-center">
                                    <a href="manageClassShedule.php" class="btn btn-outline-primary">Manage Lectures</a>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-3 p-3">
                                    <div class="row shadow text-center">
                                        <p class="m-0 fs-5 fw-bold">All Officers</p>
                                        <?php
                                        $officer_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `user_type_id`='2' ");
                                        $officer_num = $officer_rs->num_rows;
                                        ?>
                                        <p class="m-0 fs-3 fw-bold text-black-50"><?php echo ($officer_num); ?></p>
                                    </div>
                                </div>
                                <div class="col-3 p-3">
                                    <div class="row shadow text-center">
                                        <p class="m-0 fs-5 fw-bold">All Teachers</p>
                                        <?php
                                        $teacher_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `user_type_id`='1' ");
                                        $teacher_num = $teacher_rs->num_rows;
                                        ?>
                                        <p class="m-0 fs-3 fw-bold text-black-50"><?php echo ($teacher_num); ?></p>
                                    </div>
                                </div>
                                <div class="col-3 p-3">
                                    <div class="row shadow text-center">
                                        <p class="m-0 fs-5 fw-bold">All Students</p>
                                        <?php
                                        $student_rs = Database::Search("SELECT * FROM `student`");
                                        $student_num = $student_rs->num_rows;
                                        ?>
                                        <p class="m-0 fs-3 fw-bold text-black-50"><?php echo ($student_num) ?></p>
                                    </div>
                                </div>
                                <div class="col-3 p-3">
                                    <div class="row shadow text-center">
                                        <p class="m-0 fs-5 fw-bold">All Subjects</p>
                                        <?php
                                        $subject_rs = Database::Search("SELECT * FROM `subject`");
                                        $subject_num = $subject_rs->num_rows;
                                        ?>
                                        <p class="m-0 fs-3 fw-bold text-black-50"><?php echo ($subject_num) ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <p class="fs-4 fw-bold text-primary m-0 mt-2 mb-2">Suspend Accounts ....</p>
                                </div>
                                <div class="col-12 mt-2 mb-2 shadow">
                                    <div class="table-responsive" style="height: 160px;">
                                        <table class="table table-dark table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Student Email</th>
                                                    <th scope="col">student Name</th>
                                                    <th scope="col">Parent Mobile No</th>
                                                    <th scope="col">Grade</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $suspend_rs = Database::Search("SELECT `is_paid`,`tail_period`,`student_email`,`student_firstname`,`student_lastname`,`Grade_name`,`enrollment_fee`.`id` AS `eid` FROM `enrollment_fee`
                                            INNER JOIN `student` ON `student`.`student_email`=`enrollment_fee`.`student_student_email`
                                            INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
                                            INNER JOIN `student_parent_details` ON `student_parent_details`.`student_student_email`=`student`.`student_email` ");

                                                $suspend_num = $suspend_rs->num_rows;

                                                if ($suspend_num != 0) {
                                                    for ($s = 0; $s < $suspend_num; $s++) {
                                                        $suspend_data = $suspend_rs->fetch_assoc();

                                                        $today = date("Y-m-d");
                                                        if ($suspend_data["is_paid"] == 1 && $suspend_data["tail_period"] > $today) {
                                                ?>
                                                            <tr>
                                                                <th scope="row"><?php echo ($s + 1) ?></th>
                                                                <td><?php echo ($suspend_data["student_email"]) ?></td>
                                                                <td><?php echo ($suspend_data["student_firstname"] . " " . $suspend_data["student_lastname"]) ?></td>
                                                                <td><?php echo ($suspend_data["parent_mobile"]) ?></td>
                                                                <td><?php echo ($suspend_data["Grade_name"]) ?></td>
                                                                <td><button class="btn btn-info" onclick="markPaid(<?php echo($suspend_data['eid']) ?>);">Mark Paid</button></td>
                                                            </tr>
                                                <?php
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

                        <div class="col-12 mt-2 mb-2">
                            <div class="row gap-2 justify-content-center">

                                <div class="col-12">
                                    <p class="fs-4 fw-bold text-primary m-0 mt-2 mb-2"> Lectures ....</p>
                                </div>

                                <?php
                                $today = date("Y-m-d");
                                $lecture_rs = Database::Search("SELECT * FROM `class_shedule`
                                INNER JOIN `subject` ON `subject`.`subject_id`=`class_shedule`.`subject_subject_id`
                                WHERE `Shedule_date` >= '" . $today . "' ");
                                
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
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>



    <script src="frameworks/jquery_v3.6.2.js"></script>
    <script src="script.js"></script>
</body>

</html>