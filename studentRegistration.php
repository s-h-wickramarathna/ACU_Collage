<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Add Students</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";
            require "database/connection.php";

            ?>

            <div class="col-12 mt-3">
                <p class="fs-4 fw-bold text-primary">Add New Students ....</p>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">first Name :</p>
                        <input type="text" class="form-control shadow" id="addS_fname" />
                    </div>
                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">Last Name :</p>
                        <input type="text" class="form-control shadow" id="addS_lname" />
                    </div>
                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">Email Address :</p>
                        <input type="email" class="form-control shadow" id="addS_email" />
                    </div>
                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">Date Of Birth :</p>
                        <input type="date" class="form-control shadow" id="addS_bithday" />
                    </div>
                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">NIC No :</p>
                        <input type="number" class="form-control shadow" id="addS_nic" />
                    </div>

                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">Gender :</p>
                        <select id="addS_gender" class="form-select shadow">
                            <option value="0">Select Gender</option>
                            <?php

                            $gender_rs = Database::Search("SELECT * FROM `gender` ");
                            $gender_num = $gender_rs->num_rows;

                            for ($c = 0; $c < $gender_num; $c++) {
                                $gender_data = $gender_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo ($gender_data["gender_id"]) ?>"><?php echo ($gender_data["gender_type"]) ?></option>
                            <?php
                            }


                            ?>
                        </select>
                    </div>
                    <div class="col-6 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">City :</p>
                        <select class="form-select shadow" id="addS_city">
                            <option value="0">User City</option>
                            <?php

                            $city_rs = Database::Search("SELECT * FROM `city` ");
                            $city_num = $city_rs->num_rows;

                            for ($c = 0; $c < $city_num; $c++) {
                                $city_data = $city_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                            <?php
                            }


                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">Grade :</p>
                        <select class="form-select shadow" id="addS_grade" onchange="LoadSubjectStudent();">
                            <option value="0">Select Grade ....</option>
                            <?php

                            $grade_rs = Database::Search("SELECT * FROM `grade` ");
                            $grade_num = $grade_rs->num_rows;

                            for ($c = 0; $c < $grade_num; $c++) {
                                $grade_data = $grade_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo ($grade_data["id"]) ?>"><?php echo ($grade_data["Grade_name"]) ?></option>
                            <?php
                            }


                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-lg-4 mb-4">
                        <p class="fw-bold text-black-50">Address :</p>
                        <input type="text" class="form-control shadow" id="addS_address" />
                    </div>

                    <div class="col-12">
                        <p class="fs-4 fw-bold text-primary">Subjects ....</p>
                    </div>

                    <div class="col-12" id="Show_loaddedSubjects">

                    </div>

                    <div class="col-8 offset-4">
                        <hr class="border border-3 border-dark">
                    </div>

                    <div class="col-12">
                        <p class="fs-4 fw-bold text-primary">Parent Details </p>
                    </div>

                    <div class="col-6 col-lg-3 mb-4">
                        <p class="fw-bold text-black-50">First Name :</p>
                        <input type="text" class="form-control shadow" id="addS_pfname" />
                    </div>
                    <div class="col-6 col-lg-3 mb-4">
                        <p class="fw-bold text-black-50">Last Name :</p>
                        <input type="text" class="form-control shadow" id="addS_plname" />
                    </div>
                    <div class="col-6 col-lg-3 mb-4">
                        <p class="fw-bold text-black-50">NIC No :</p>
                        <input type="number" class="form-control shadow" id="addS_pnic" />
                    </div>
                    <div class="col-6 col-lg-3 mb-4">
                        <p class="fw-bold text-black-50">Mobile No :</p>
                        <input type="number" class="form-control shadow" id="addS_pmobile" />
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <div class="alert alert-danger d-none" id="showStudentRejistrationError" role="alert"></div>
                    </div>

                    <div class="col-8 offset-4">
                        <hr class="border border-3 border-dark">
                    </div>
                    <div class="col-12 mt-2 mb-4 text-end">
                        <button class="btn btn-primary" onclick="studentRegistration();">+ Add</button>
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



?>