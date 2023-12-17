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
                <p class="fs-4 fw-bold text-primary">Add Teacher's & Academic Officer's</p>
            </div>

            <div class="col-12 mb-2">
                <div class="row justify-content-center">
                    <!-- form -->
                    <div class="col-11 shadow-lg rounded-3 my-3">
                        <div class="row g-3 my-2">
                            <div class="col-6">
                                <p>Select User Type :</p>
                                <select class="form-select shadow-none" id="R_userType">
                                    <option value="0">User Type</option>
                                    <?php
                                    $userType_rs = Database::Search("SELECT * FROM `user_type` ");
                                    $userType_num = $userType_rs->num_rows;

                                    if ($userType_num != 0) {
                                        for ($x = 0; $x < $userType_num; $x++) {
                                            $userType_data = $userType_rs->fetch_assoc();
                                    ?>
                                            <option value="<?php echo ($userType_data["id"]) ?>"><?php echo ($userType_data["type"]) ?></option>
                                    <?php
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-8">
                                <hr class="m-0 border border-3 border-dark">
                            </div>
                            <div class="col-6">
                                <p>Enter First Name :</p>
                                <input type="text" class="form-control shadow-none" id="R_firstName" />
                            </div>
                            <div class="col-6">
                                <p>Enter Last Name :</p>
                                <input type="text" class="form-control shadow-none" id="R_lastName" />
                            </div>
                            <div class="col-12">
                                <p>Enter Email Address :</p>
                                <input type="email" class="form-control shadow-none" id="R_email" />
                            </div>
                            <div class="col-6 col-md-4">
                                <p>Enter NIC No :</p>
                                <input type="number" class="form-control shadow-none" id="R_NIC" />
                            </div>
                            <div class="col-6 col-md-4">
                                <p>Enter Mobile No :</p>
                                <input type="number" class="form-control shadow-none" id="R_mobile" />
                            </div>
                            <div class="col-6 col-md-4">
                                <p>Select Gender :</p>
                                <select class="form-select shadow-none" id="R_gender">
                                    <option value="0">User Gender</option>
                                    <?php
                                    $gender_rs = Database::Search("SELECT * FROM `gender` ");
                                    $gender_num = $gender_rs->num_rows;

                                    if ($gender_num != 0) {
                                        for ($x = 0; $x < $gender_num; $x++) {
                                            $gender_data = $gender_rs->fetch_assoc();
                                    ?>
                                            <option value="<?php echo ($gender_data["gender_id"]) ?>"><?php echo ($gender_data["gender_type"]) ?></option>
                                    <?php
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-6 col-md-6">
                                <p>Select City :</p>
                                <select class="form-select shadow-none" id="R_city">
                                    <option value="0">User City</option>
                                    <?php
                                    $city_rs = Database::Search("SELECT * FROM `city` ");
                                    $city_num = $city_rs->num_rows;

                                    if ($city_num != 0) {
                                        for ($x = 0; $x < $city_num; $x++) {
                                            $city_data = $city_rs->fetch_assoc();
                                    ?>
                                            <option value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                    <?php
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <p>Enter Address :</p>
                                <input type="text" class="form-control shadow-none" id="R_address" />
                            </div>
                            <div class="col-12">
                                <div class="alert alert-danger m-0 d-none" id="officeTeachererrorMSG" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill">
                                        <span id="officeTeachererrorMSGContent"></span>
                                    </i>
                                </div>
                                <div class="alert alert-success m-0 d-none" id="officeTeacherSuccessMSG" role="alert">
                                <i class="bi bi-exclamation-triangle-fill">
                                        <span id="officeTeacherSuccessMSGContent"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button class="btn btn-primary" onclick="Officer_teacher_registration();">Register</button>
                            </div>
                        </div>
                    </div>
                    <!-- form -->
                </div>
            </div>
            <?php include "footer.php" ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="frameworks/jquery_v3.6.2.js"></script>
</body>

</html>