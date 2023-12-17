<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Officer && Teacher Profile</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            session_start();
            include "header.php";
            require "database/connection.php";

            if (isset($_SESSION["teacher"])) {
                $teacher_email = $_SESSION["teacher"]["email"];

                $teacher_rs = Database::Search("SELECT * FROM `officer_teacher`
                INNER JOIN `gender` ON `gender`.`gender_id`=`officer_teacher`.`gender_gender_id` 
                WHERE `email`='".$teacher_email."' ");

                $teacher_data = $teacher_rs->fetch_assoc();

 
            ?>

                <div class="col-12 mt-3">
                    <p class="fs-4 fw-bold text-primary">My Profile ....</p>
                </div>

                <div class="col-12 mt-2 text-end">
                    <p class="fw-bold m-0 mt-2"><?php echo($teacher_data["fname"]." ".$teacher_data["lname"]) ?></p>
                    <p class="fw-bold text-black-50"><?php echo($teacher_data["email"]) ?></p>
                </div>

                <div class="col-8 offset-4 mb-2">
                    <hr class="border border-4 border-dark">
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Email Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["email"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">First Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["fname"]) ?>" id="t_fname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Last Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["lname"]) ?>" id="t_lname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">NIC No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["nic_no"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Mobile No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["mobile_no"]) ?>" id="t_mobile" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Gender :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["gender_type"]) ?>" disabled />
                        </div>
                        
                        <div class="col-12 text-end mt-2 mb-4">
                            <button class="btn btn-dark" onclick="teacherUpdate('<?php echo ($teacher_data['email']) ?>');">Update</button>
                        </div>

                    </div>
                </div>
            <?php
            }

            ?>
<div class="col-12 mt-2">
                        <?php include "footer.php" ?>
                    </div>
        </div>
    </div>
    <script src="frameworks/jquery_v3.6.2.js"></script>
    <script src="script.js"></script>
</body>

</html>