<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Officer Profile</title>
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

            if (isset($_SESSION["officer"])) {
                $academic_email = $_SESSION["officer"]["email"];

                $academic_rs = Database::Search("SELECT * FROM `officer_teacher`
                INNER JOIN `gender` ON `gender`.`gender_id`=`officer_teacher`.`gender_gender_id` 
                WHERE `email`='".$academic_email."' ");

$academic_data = $academic_rs->fetch_assoc();

 
            ?>

                <div class="col-12 mt-3">
                    <p class="fs-4 fw-bold text-primary">My Profile ....</p>
                </div>

                <div class="col-12 mt-2 text-end">
                    <p class="fw-bold m-0 mt-2"><?php echo($academic_data["fname"]." ".$academic_data["lname"]) ?></p>
                    <p class="fw-bold text-black-50"><?php echo($academic_data["email"]) ?></p>
                </div>

                <div class="col-8 offset-4 mb-2">
                    <hr class="border border-4 border-dark">
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Email Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($academic_data["email"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">First Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($academic_data["fname"]) ?>" id="ac_fname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Last Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($academic_data["lname"]) ?>" id="ac_lname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">NIC No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($academic_data["nic_no"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Mobile No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($academic_data["mobile_no"]) ?>" id="ac_mobile" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Gender :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($academic_data["gender_type"]) ?>" disabled />
                        </div>
                        
                        <div class="col-12 text-end mt-2 mb-4">
                            <button class="btn btn-dark" onclick="AcadimicUpdate('<?php echo ($academic_data['email']) ?>');">Update</button>
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