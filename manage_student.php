<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Manage Adminstration</title>
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
            ?>

            <div class="col-12 mt-3">
                <p class="fs-4 fw-bold text-primary">Manage Students ....</p>
            </div>

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">verification</th>
                                <th scope="col">status</th>
                                <th scope="col">Join Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $student_rs = Database::Search("SELECT * FROM `student`
                            INNER JOIN `status` ON `student`.`status_id`=`status`.`id`
                            INNER JOIN `hold_status` ON `student`.`hold_status_h_id`=`hold_status`.`h_id`
                            INNER JOIN `gender` ON `gender`.`gender_id`=`student`.`gender_gender_id` 
                            WHERE `delete_status_d_id`='2' ");
                            $student_num = $student_rs->num_rows;

                            if ($student_num != 0) {
                                for ($x = 0; $x < $student_num; $x++) {
                                    $student_data = $student_rs->fetch_assoc();
                            ?>
                                    <tr class="cursor" onclick="viewSingleStudentDetails('<?php echo ($student_data['student_email']); ?>');">
                                        <th scope="row"><?php echo ($x + 1); ?></th>
                                        <td><?php echo ($student_data["student_email"]); ?></td>
                                        <td><?php echo ($student_data["student_firstname"]); ?></td>
                                        <td><?php echo ($student_data["student_lastname"]); ?></td>
                                        <td><?php echo ($student_data["gender_type"]); ?></td>
                                        <td><?php echo ($student_data["status"]); ?></td>
                                        <td><?php echo ($student_data["hold_type"]); ?></td>
                                        <td><?php echo ($student_data["student_joindate"]); ?></td>
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
<script src="script.js"></script>
</body>

</html>