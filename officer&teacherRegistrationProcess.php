<?php

session_start();
require "database/connection.php";

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["admin"])) {

    $user_type = $_POST["ut"];
    $first_name = $_POST["fn"];
    $last_name = $_POST["ln"];
    $email = $_POST["e"];
    $nic = $_POST["nic"];
    $mobile = $_POST["m"];
    $gender = $_POST["g"];
    $city = $_POST["c"];
    $address = $_POST["a"];

    if ($user_type == 0) {
        echo ("Please Select User Type.");
    } else if (empty($first_name)) {
        echo ("Please Enter First Name.");
    } else if (empty($last_name)) {
        echo ("Please Enter Last Name.");
    } else if (empty($email)) {
        echo ("Please Enter Email Address.");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid Email Address.");
    } else if (empty($nic)) {
        echo ("Please Enter NIC No.");
    } else if (strlen($nic) < 5 || strlen($nic) > 13) {
        echo ("Invalid NIC No.");
    } else if (empty($mobile)) {
        echo ("Please Enter Mobile No.");
    } else if (!preg_match("/07[1,2,6,8,4][0-9]/", $mobile)) {
        echo ("Invalid Mobile Number.");
    } else if ($gender == 0) {
        echo ("Please Select Gender.");
    } else if ($city == 0) {
        echo ("Please Select City.");
    } else if (empty($address)) {
        echo ("Please Enter Address.");
    } else if (strlen($address) > 100) {
        echo ("invalid Address.");
    } else {

        $officer_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `email`='" . $email . "' AND `nic_no`='" . $nic . "' ");
        $officer_num = $officer_rs->num_rows;

        if ($officer_num == 0) {
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $password = "0";

            if ($user_type == 1) {
                $password = "TECH" . uniqid();
            } else {
                $password = "OFFI" . uniqid();
            }
            $code = uniqid();

            Database::iud("INSERT INTO `officer_teacher` (`email`,`password`,`fname`,`lname`,`mobile_no`,`gender_gender_id`,`user_type_id`,`verifaction_code`,`status_id`,`nic_no`,`join_datetime`,`hold_status_id`,`delete_status_d_id`)
            VALUES ('" . $email . "','" . $password . "','" . $first_name . "','" . $last_name . "','" . $mobile . "','" . $gender . "','" . $user_type . "','" . $code . "','1','" . $nic . "','" . $date . "','1','2') ");

            Database::iud("INSERT INTO `officer_address` (`address`,`officer_teacher_email`,`city_city_id`)
            VALUES ('" . $address . "','" . $email . "','" . $city. "') ");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sanchithaheashan655@gmail.com';
            $mail->Password = 'wglsgnqozpyneglg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('sanchithaheashan655@gmail.com', 'ACU');
            $mail->addReplyTo('sanchithaheashan655@gmail.com', 'ACU');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'University Of ACU';
            $bodyContent = '<div>
            <h1>UserName : <span>' . $email . '</span></h1>
            <h1>Password : <span>' . $password . '</span></h1>
            <h1>Verification Code : <span>' . $code . '</span></h1>
            </div>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo ("Verification code sending failed ???");
            } else {
                echo ("Verification Code Successfully Send Your Email");
            }
        } else {
            echo ("Invalid Email Address");
        }
    }
} else {
    echo ("This User Already Exist.");
}

// App Key = wglsgnqozpyneglg