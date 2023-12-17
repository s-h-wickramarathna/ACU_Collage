<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {
    $admin_email = $_SESSION["admin"]["email"];

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $email = $_POST["e"];

    if (empty($fname)) {
        echo ("error");
    } else if (empty($lname)) {
        echo ("error");
    } else if (empty($mobile)) {
        echo ("error");
    } else {
        Database::iud("UPDATE `admin` 
        SET 
        `fname`='".$fname."',
        `lname`='".$lname."',
        `mobile_no`='".$mobile."',
        `email`='".$email."'
        WHERE `email`='".$admin_email."'
        ");

        $length = sizeof($_FILES);

        if ($length == 1) {
            $image = $_FILES["file"];
            $image_tmp_name = $image["tmp_name"];
            $image_extention = $image["type"];

            $allowed_image_ext = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

            if (in_array($image_extention, $allowed_image_ext)) {

                $new_img_extention;

                if ($image_extention == "image/jpg") {
                    $new_img_extention = ".jpg";
                } else if ($image_extention == "image/jpeg") {
                    $new_img_extention = ".jepg";
                } else if ($image_extention == "image/png") {
                    $new_img_extention = ".png";
                } else if ($image_extention == "image/svg+xml") {
                    $new_img_extention = ".svg";
                }

                $file_name = "resources//profile_images//".$fname."_".uniqid().$new_img_extention;
                move_uploaded_file($image_tmp_name,$file_name);


                $image_rs = Database::Search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='".$email."' ");
                $image_num = $image_rs->num_rows;

                if($image_num == 1){
                    Database::iud("UPDATE `admin_profile_image` SET `image_path`='".$file_name."' WHERE `admin_email`='".$email."' ");

                }else{
                    Database::iud("INSERT INTO `admin_profile_image` (`admin_email`,`image_path`) VALUES ('".$email."','".$file_name."') ");
                }

            }else{
                echo("Invalid Image Type");
            }
            
        }

        echo("Success");
    }
}
