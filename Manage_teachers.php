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
                <p class="fs-4 fw-bold text-primary">Manage Teachers ....</p>
            </div>

            <div class="col-12 mb-2">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">NIC No</th>
                                <th scope="col">Mobile NO</th>
                                <th scope="col">verification</th>
                                <th scope="col">status</th>
                                <th scope="col">Join Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $teacher_rs = Database::Search("SELECT * FROM `officer_teacher`
                            INNER JOIN `status` ON `officer_teacher`.`status_id`=`status`.`id`
                            INNER JOIN `hold_status` ON `officer_teacher`.`hold_status_id`=`hold_status`.`h_id` 
                            WHERE `delete_status_d_id`='2' AND `user_type_id`='1' ");
                            $teacher_num = $teacher_rs->num_rows;

                            if ($teacher_num != 0) {
                                for ($x = 0; $x < $teacher_num; $x++) {
                                    $teacher_data = $teacher_rs->fetch_assoc();
                            ?>
                                    <tr class="cursor" onclick="window.location='singleTeacherView.php?tid='+<?php echo ($teacher_data['nic_no']); ?>">
                                        <th scope="row"><?php echo ($x + 1); ?></th>
                                        <td><?php echo ($teacher_data["email"]); ?></td>
                                        <td><?php echo ($teacher_data["fname"]); ?></td>
                                        <td><?php echo ($teacher_data["lname"]); ?></td>
                                        <td><?php echo ($teacher_data["nic_no"]); ?></td>
                                        <td><?php echo ($teacher_data["mobile_no"]); ?></td>
                                        <td><?php echo ($teacher_data["status"]); ?></td>
                                        <td><?php echo ($teacher_data["hold_type"]); ?></td>
                                        <td><?php echo ($teacher_data["join_datetime"]); ?></td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php include "footer.php" ?>
        </div>
    </div>
    
</body>

</html>