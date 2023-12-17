<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Student Details</title>
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


            if (isset($_SESSION["student"])) {
                $student_email = $_SESSION["student"]["student_email"];

                $student_rs = Database::Search("SELECT * FROM `student`
                INNER JOIN `gender` ON `gender`.`gender_id`=`student`.`gender_gender_id`
                INNER JOIN `status` ON `student`.`status_id`=`status`.`id`
                INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
                INNER JOIN `hold_status` ON `hold_status`.`h_id`=`student`.`hold_status_h_id`
                INNER JOIN `student_address` ON `student_address`.`student_student_email`=`student`.`student_email`
                INNER JOIN `city` ON `city`.`city_id`=`student_address`.`city_city_id`
                INNER JOIN `district` ON `city`.`district_district_id`=`district`.`district_id`
                INNER JOIN `province` ON `province`.`province_id`=`district`.`province_province_id`
                INNER JOIN `student_parent_details` ON `student_parent_details`.`student_student_email`=`student`.`student_email`
                WHERE `student_email`='" . $student_email . "' ");

                $student_data = $student_rs->fetch_assoc();

            ?>
                <div class="col-12 mt-3">
                    <p class="fs-4 fw-bold text-primary">Manage Students ....</p>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Email Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_email"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">first Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_firstname"]) ?>" id="us_fname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Last Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_lastname"]) ?>" id="us_lname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Date Of Birth :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["dob"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">NIC No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_nic"]) ?>" id="us_nic" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <div class="row">
                                <p class="fw-bold text-black-50">Status $ Verification</p>
                                <div class="col-6">
                                    <input type="text" class="form-control shadow" value="<?php echo ($student_data["hold_type"]) ?>" disabled />
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control shadow" value="<?php echo ($student_data["status"]) ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Gender :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["gender_type"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Join Date :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_joindate"]) ?>" disabled />
                        </div>

                        <div class="col-6 col-lg-6 mb-4">
                            <p class="fw-bold text-black-50">Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["address_no"]) ?>" id="us_address" />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">City :</p>
                            <select class="form-select shadow" id="us_city">
                                <option value="0">User City</option>
                                <?php

                                $city_rs = Database::Search("SELECT * FROM `city` ");
                                $city_num = $city_rs->num_rows;

                                for ($c = 0; $c < $city_num; $c++) {
                                    $city_data = $city_rs->fetch_assoc();
                                    if ($student_data["city_city_id"] == $city_data["city_id"]) {
                                ?>
                                        <option selected value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                <?php
                                    }
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">District :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["district_name"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Province :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["province_name"]) ?>" disabled />
                        </div>

                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-dark">
                        </div>

                        <div class="col-12">
                            <p class="fs-4 fw-bold text-primary">Parent Details </p>
                        </div>

                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">First Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_fname"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Last Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_lname"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">NIC No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_nic"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Mobile No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_mobile"]) ?>" disabled />
                        </div>

                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-dark">
                        </div>
                        <div class="col-12 mt-2 mb-4 text-end">
                            <button class="btn btn-primary" onclick="studentProfileDetailsUpdate('<?php echo ($student_data['student_email']) ?>');">Update</button>
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
<?php



?>