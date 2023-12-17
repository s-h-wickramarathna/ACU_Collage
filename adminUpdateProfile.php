<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Admin Profile</title>
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

            if (isset($_SESSION["admin"])) {
                $admin_email = $_SESSION["admin"]["email"];

                $admin_rs = Database::Search("SELECT * FROM `admin`
                INNER JOIN `gender` ON `gender`.`gender_id`=`admin`.`gender_gender_id`
                 WHERE `email`='" . $admin_email . "' ");
                $admin_data = $admin_rs->fetch_assoc();
            ?>

                <div class="col-12 mt-3">
                    <p class="fs-4 fw-bold text-primary">My Profile ....</p>
                </div>

                <div class="col-12 mt-2 text-end">
                    <?php
                    $image = "resources/app/no_image.jpg";

                    $a_image_rs = Database::Search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='".$admin_email."' ");
                    $a_image_num = $a_image_rs->num_rows;

                    if($a_image_num == 1){
                        $a_image_data = $a_image_rs->fetch_assoc();

                        $image = $a_image_data["image_path"];
                    }
                    ?>
                    <img src="<?php echo($image) ?>" height="250px" class="rounded-circle" id="img_url"><br>
                    <input type="file" class="visually-hidden" id="img_file"  onChange="img_pathUrl(this);">
                    <label for="img_file" class="fw-bold fs-5 cursor"><i class="bi bi-pencil-square"></i></label>
                </div>

                <div class="col-8 offset-4 mb-2">
                    <hr class="border border-4 border-dark">
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Email Address :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($admin_data["email"]) ?>" id="a_email" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">First Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($admin_data["fname"]) ?>" id="a_fname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Last Name :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($admin_data["lname"]) ?>" id="a_lname" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">NIC No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($admin_data["nic_no"]) ?>" disabled />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Mobile No :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($admin_data["mobile_no"]) ?>" id="a_mobile" />
                        </div>
                        <div class="col-6 col-lg-4 mb-4">
                            <p class="fw-bold text-black-50">Gender :</p>
                            <input type="text" class="form-control shadow" value="<?php echo ($admin_data["gender_type"]) ?>" disabled />
                        </div>
                        
                        <div class="col-12 text-end mt-2 mb-4">
                            <button class="btn btn-dark" onclick="adminUpdate('<?php echo ($admin_data['email']) ?>');">Update</button>
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