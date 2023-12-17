<?php

if (isset($_GET["tid"])) {
    $tid = $_GET["tid"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACU || Teacher Details</title>
        <link rel="icon" href="resources/app/university_logo.png" />
        <link rel="stylesheet" href="frameworks/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <?php include "adminHeader.php";
                require "database/connection.php";

                if(isset($_GET["tid"])){
                    $teacher_nic = $_GET["tid"];
                }

                $teacher_rs = Database::Search("SELECT * FROM `officer_teacher`
                INNER JOIN `status` ON `officer_teacher`.`status_id`=`status`.`id`
                INNER JOIN `hold_status` ON `officer_teacher`.`hold_status_id`=`hold_status`.`h_id`
                INNER JOIN `gender` ON `officer_teacher`.`gender_gender_id`=`gender`.`gender_id`
                INNER JOIN `officer_address` ON `officer_address`.`officer_teacher_email`=`officer_teacher`.`email`
                INNER JOIN `city`ON `officer_address`.`city_city_id`=`city`.`city_id`
                INNER JOIN `district` ON `city`.`district_district_id`= `district`.`district_id`
                INNER JOIN `province` ON `district`.`province_province_id`=`province`.`province_id`
                WHERE `officer_teacher`.`nic_no`='".$teacher_nic."' ");
                $teacher_data = $teacher_rs->fetch_assoc();
                ?>

                <div class="col-12 mt-3">
                    <p class="fs-4 fw-bold text-primary">Manage Teachers ....</p>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Email Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["email"]) ?>" disabled id="T_email" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">first Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["fname"]) ?>" id="T_fname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Last Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["lname"]) ?>" id="T_lname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">NIC No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["nic_no"]) ?>" id="T_nic" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Mobile No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["mobile_no"]) ?>" id="T_mobile" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <div class="row">
                                <p class="fw-bold text-black-50">Status $ Verification</p>
                                <div class="col-6">
                                    <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["hold_type"]) ?>" disabled />
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["status"]) ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Gender :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["gender_type"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Join Date :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["join_datetime"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">City :</p>
                            <select class="form-select shadow" id="T_city">
                                <option value="0">User City</option>
                                <?php
                                $city_rs = Database::Search("SELECT * FROM `city` ");
                                $city_num = $city_rs->num_rows;

                                if ($city_num != 0) {
                                    for ($x = 0; $x < $city_num; $x++) {
                                        $city_data = $city_rs->fetch_assoc();
                                        if ($city_data["city_name"] == $teacher_data["city_name"]) {
                                ?>
                                            <option selected value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                <?php
                                        }
                                    }
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-6 mb-4">
                            <p class="fw-bold text-black-50">Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["address"]) ?>" id="T_address" />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">District :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["district_name"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-3 mb-4">
                            <p class="fw-bold text-black-50">Province :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($teacher_data["province_name"]) ?>" disabled />
                        </div>
                        <div class="col-8 offset-4">
                            <hr class="border border-3 border-dark">
                        </div>
                        <div class="col-12 mt-2 mb-4 text-end">
                            <button class="btn btn-primary" onclick="teacherUpdate();">Update</button>
                            <?php
                            if ($teacher_data["h_id"] == 1) {
                            ?>
                                <button class="btn btn-warning" onclick="teacherDeactive(<?php echo($teacher_data['h_id']) ?>);">Deactive</button>
                            <?php
                            }else{
                                ?>
                                <button class="btn btn-dark" onclick="teacherDeactive(<?php echo($teacher_data['h_id']) ?>);">Active</button>
                            <?php 
                            }
                            ?>
                            <button class="btn btn-danger" onclick="teacherDelete('<?php echo($teacher_data['email']) ?>');">Delete</button>
                        </div>
                    </div>
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