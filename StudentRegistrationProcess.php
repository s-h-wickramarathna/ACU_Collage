<?php
session_start();
require "database/connection.php";

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["officer"])) {
    $officer = $_SESSION["officer"];

    $student_fname = $_POST["sf"];
    $student_lname = $_POST["sl"];
    $student_email = $_POST["se"];
    $student_birthday = $_POST["sb"];
    $student_nic = $_POST["sn"];
    $student_gender = $_POST["sg"];
    $student_city = $_POST["sc"];
    $student_address = $_POST["sad"];
    $student_grade = $_POST["sgrd"];
    $parent_fname = $_POST["pf"];
    $parent_lname = $_POST["pl"];
    $parent_nic = $_POST["pn"];
    $parent_mobile = $_POST["pm"];
    $ol_subject_01 = $_POST["ol1"];
    $ol_subject_02 = $_POST["ol2"];
    $ol_subject_03 = $_POST["ol3"];
    $al_subject_01 = $_POST["al1"];
    $al_subject_02 = $_POST["al2"];
    $al_subject_03 = $_POST["al3"];
    $status = 0;

    if (empty($student_fname)) {
        echo ("Please Enter Student First name");
    } else if (empty($student_lname)) {
        echo ("Please Enter Student Last name");
    } else if (empty($student_email)) {
        echo ("Please Enter Student Email Address");
    } else if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid Email Address !!!");
    } else if (empty($student_birthday)) {
        echo ("Please Select Student Birthday");
    } else if (empty($student_grade)) {
        echo ("Please Select Student Grade");
    } else if (empty($student_gender)) {
        echo ("Please Select Student Gender");
    } else if (empty($student_city)) {
        echo ("Please Select Student City");
    } else if (empty($student_address)) {
        echo ("Please Enter Student Address");
    } else if (empty($parent_fname)) {
        echo ("Please Enter Parent First Name");
    } else if (empty($parent_lname)) {
        echo ("Please Enter Parent Last Name");
    } else if (empty($parent_nic)) {
        echo ("Please Enter Parent NIC No");
    } else if (empty($parent_mobile)) {
        echo ("Please Enter Parent Mobile No");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $parent_mobile)) {
        echo ("Invalid Mobile Number !!!");
    } else {

        if ($student_grade >= 9 && $student_grade <= 10) {
            if ($ol_subject_01 == 0) {
                echo ("Please Select O/L First Subject");
            } else if ($ol_subject_02 == 0) {
                echo ("Please Select O/L Second Subject");
            } else if ($ol_subject_03 == 0) {
                echo ("Please Select O/L Third Subject");
            } else {

                // O/L Student
                $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' ");
                $student_num = $student_rs->num_rows;

                if ($student_num == 1) {
                    echo ("Email Address Already Exist ....");
                } else {
                    $d = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $d->setTimezone($tz);
                    $student_joinDate = $d->format("Y-m-d H:i:s");

                    $student_password = "STU" . uniqid();
                    $verification_code = uniqid();

                    Database::iud("INSERT INTO `student`(`student_email`,
                    `student_firstname`,
                    `student_lastname`,
                    `student_password`,
                    `student_joindate`,
                    `student_nic`,
                    `gender_gender_id`,
                    `delete_status_d_id`,
                    `hold_status_h_id`,
                    `status_id`,
                    `dob`,
                    `Grade_id`,
                    `student_verification_code`)
                    VALUES(
                        '" . $student_email . "',
                        '" . $student_fname . "',
                        '" . $student_lname . "',
                        '" . $student_password . "',
                        '" . $student_joinDate . "',
                        '" . $student_nic . "',
                        '" . $student_gender . "',
                        '2',
                        '1',
                        '1',
                        '" . $student_birthday . "',
                        '" . $student_grade . "',
                        '" . $verification_code . "',
                    ) ");

                    Database::iud("INSERT INTO `student_parent_details`(`parent_fname`,`parent_lname`,`parent_nic`,`student_student_email`,`parent_mobile`)VALUES('" . $parent_fname . "','" . $parent_lname . "','" . $parent_nic . "','" . $student_email . "','" . $parent_mobile . "') ");
                    Database::iud("INSERT INTO `student_address` (`address_no`,`student_student_email`,`city_city_id`) VALUES ('" . $student_address . "','" . $student_email . "','" . $student_city . "') ");
                   
                    $today = date("Y-m-d");
                    $treil_period = date('Y-m-d', strtotime('+1 month'));
                    $expire_date = date('Y-m-d', strtotime('+1 year'));

                    Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`,`tail_period`,`expire_date`) VALUES('1200','" . $student_email . "','" . $student_grade . "','1','" . $today . "','" . $treil_period . "','" . $expire_date . "') ");

                    $subject_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='2' ");
                    $subject_num = $subject_rs->num_rows;

                    if ($subject_num != 0) {
                        for ($i = 0; $i < $subject_num; $i++) {
                            $subject_data = $subject_rs->fetch_assoc();

                            Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $subject_data["subject_id"] . "') ");
                        }
                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $ol_subject_01 . "') ");
                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $ol_subject_02 . "') ");
                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $ol_subject_03 . "') ");
                    }
                    $status = 1;
                }
                // O/L Student
            }
        } else if ($student_grade > 10) {
            if ($al_subject_01 == 0) {
                echo ("Please Select A/L First Subject");
            } else if ($al_subject_02 == 0) {
                echo ("Please Select A/L Second Subject");
            } else if ($al_subject_03 == 0) {
                echo ("Please Select A/L Third Subject");
            } else {
                // A/L Student
                $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' ");
                $student_num = $student_rs->num_rows;

                if ($student_num == 1) {
                    echo ("Email Address Already Exist ....");
                } else {
                    $d = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $d->setTimezone($tz);
                    $student_joinDate = $d->format("Y-m-d H:i:s");

                    $student_password = "STU" . uniqid();
                    $verification_code = uniqid();

                    Database::iud("INSERT INTO `student`(`student_email`,
                    `student_firstname`,
                    `student_lastname`,
                    `student_password`,
                    `student_joindate`,
                    `student_nic`,
                    `gender_gender_id`,
                    `delete_status_d_id`,
                    `hold_status_h_id`,
                    `status_id`,
                    `dob`,
                    `Grade_id`,
                    `student_verification_code`)
                    VALUES(
                        '" . $student_email . "',
                        '" . $student_fname . "',
                        '" . $student_lname . "',
                        '" . $student_password . "',
                        '" . $student_joinDate . "',
                        '" . $student_nic . "',
                        '" . $student_gender . "',
                        '2',
                        '1',
                        '1',
                        '" . $student_birthday . "',
                        '" . $student_grade . "',
                        '" . $verification_code . "',
                    ) ");

                    Database::iud("INSERT INTO `student_parent_details`(`parent_fname`,`parent_lname`,`parent_nic`,`student_student_email`,`parent_mobile`)VALUES('" . $parent_fname . "','" . $parent_lname . "','" . $parent_nic . "','" . $student_email . "','" . $parent_mobile . "') ");
                    Database::iud("INSERT INTO `student_address` (`address_no`,`student_student_email`,`city_city_id`) VALUES ('" . $student_address . "','" . $student_email . "','" . $student_city . "') ");

                    $today = date("Y-m-d");
                    $treil_period = date('Y-m-d', strtotime('+1 month'));
                    $expire_date = date('Y-m-d', strtotime('+1 year'));

                    Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`,`tail_period`,`expire_date`) VALUES('1200','" . $student_email . "','" . $student_grade . "','1','" . $today . "','" . $treil_period . "','" . $expire_date . "') ");

                    $subject_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='6' ");
                    $subject_num = $subject_rs->num_rows;

                    if ($subject_num != 0) {
                        for ($i = 0; $i < $subject_num; $i++) {
                            $subject_data = $subject_rs->fetch_assoc();

                            Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $subject_data["subject_id"] . "') ");
                        }
                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $ol_subject_01 . "') ");
                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $ol_subject_02 . "') ");
                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $ol_subject_03 . "') ");
                    }
                    $status = 1;
                }
                // A/L Student

            }
        } else if ($student_grade > 0 && $student_grade <= 5) {
            // Primary Student
            $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' ");
            $student_num = $student_rs->num_rows;

            if ($student_num == 1) {
                echo ("Email Address Already Exist ....");
            } else {
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $student_joinDate = $d->format("Y-m-d H:i:s");

                $student_password = "STU" . uniqid();
                $verification_code = uniqid();



                Database::iud("INSERT INTO `student`(`student_email`,
                `student_firstname`,
                `student_lastname`,
                `student_password`,
                `student_joindate`,
                `student_nic`,
                `gender_gender_id`,
                `delete_status_d_id`,
                `hold_status_h_id`,
                `status_id`,
                `dob`,
                `Grade_id`,
                `student_verification_code`)
                VALUES(
                    '" . $student_email . "',
                    '" . $student_fname . "',
                    '" . $student_lname . "',
                    '" . $student_password . "',
                    '" . $student_joinDate . "',
                    '" . $student_nic . "',
                    '" . $student_gender . "',
                    '2',
                    '1',
                    '1',
                    '" . $student_birthday . "',
                    '" . $student_grade . "',
                    '" . $verification_code . "'
                ) ");

                Database::iud("INSERT INTO `student_parent_details`(`parent_fname`,`parent_lname`,`parent_nic`,`student_student_email`,`parent_mobile`)VALUES('" . $parent_fname . "','" . $parent_lname . "','" . $parent_nic . "','" . $student_email . "','" . $parent_mobile . "') ");
                Database::iud("INSERT INTO `student_address` (`address_no`,`student_student_email`,`city_city_id`) VALUES ('" . $student_address . "','" . $student_email . "','" . $student_city . "') ");

                $today = date("Y-m-d");
                $treil_period = date('Y-m-d', strtotime('+1 month'));
                $expire_date = date('Y-m-d', strtotime('+1 year'));

                Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`,`tail_period`,`expire_date`) VALUES('1200','" . $student_email . "','" . $student_grade . "','1','" . $today . "','" . $treil_period . "','" . $expire_date . "') ");


                $subject_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='1' ");
                $subject_num = $subject_rs->num_rows;

                if ($subject_num != 0) {
                    for ($i = 0; $i < $subject_num; $i++) {
                        $subject_data = $subject_rs->fetch_assoc();

                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $subject_data["subject_id"] . "') ");
                    }
                    $status = 1;
                }
            }
            // Primary Student

        } else if ($student_grade >= 6 && $student_grade <= 9) {
            // Ordinary Student
            $student_rs = Database::Search("SELECT * FROM `student` WHERE `student_email`='" . $student_email . "' ");
            $student_num = $student_rs->num_rows;

            if ($student_num == 1) {
                echo ("Email Address Already Exist ....");
            } else {
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $student_joinDate = $d->format("Y-m-d H:i:s");

                $student_password = "STU" . uniqid();
                $verification_code = uniqid();



                Database::iud("INSERT INTO `student`(`student_email`,
        `student_firstname`,
        `student_lastname`,
        `student_password`,
        `student_joindate`,
        `student_nic`,
        `gender_gender_id`,
        `delete_status_d_id`,
        `hold_status_h_id`,
        `status_id`,
        `dob`,
        `Grade_id`,
        `student_verification_code`)
        VALUES(
            '" . $student_email . "',
            '" . $student_fname . "',
            '" . $student_lname . "',
            '" . $student_password . "',
            '" . $student_joinDate . "',
            '" . $student_nic . "',
            '" . $student_gender . "',
            '2',
            '1',
            '1',
            '" . $student_birthday . "',
            '" . $student_grade . "',
            '" . $verification_code . "'
        ) ");

                Database::iud("INSERT INTO `student_parent_details`(`parent_fname`,`parent_lname`,`parent_nic`,`student_student_email`,`parent_mobile`)VALUES('" . $parent_fname . "','" . $parent_lname . "','" . $parent_nic . "','" . $student_email . "','" . $parent_mobile . "') ");
                Database::iud("INSERT INTO `student_address` (`address_no`,`student_student_email`,`city_city_id`) VALUES ('" . $student_address . "','" . $student_email . "','" . $student_city . "') ");

                $today = date("Y-m-d");
                $treil_period = date('d-m-Y', strtotime('+1 month'));
                $expire_date = date('d-m-Y', strtotime('+1 year'));

                Database::iud("INSERT INTO `enrollment_fee` (`fee`,`student_student_email`,`Grade_id`,`is_paid`,`admit_date`,`tail_period`,`expire_date`) VALUES('1200','" . $student_email . "','" . $student_grade . "','1','" . $today . "','" . $treil_period . "','" . $expire_date . "') ");


                $subject_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='2' AND `subject_type_stype_id`='3' AND `subject_type_stype_id`='4' AND `subject_type_stype_id`='5' ");
                $subject_num = $subject_rs->num_rows;

                if ($subject_num != 0) {
                    for ($i = 0; $i < $subject_num; $i++) {
                        $subject_data = $subject_rs->fetch_assoc();

                        Database::iud("INSERT INTO `student_has_subject` (`student_student_email`,`subject_subject_id`)VALUES('" . $student_email . "','" . $subject_data["subject_id"] . "') ");
                    }
                    $status = 1;
                }
            }
            // Ordinary Student
        }

        if ($status == 1) {

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
            $mail->addAddress($student_email);
            $mail->isHTML(true);
            $mail->Subject = 'University Of ACU Student Login Details';
            $bodyContent = '<div>
            <h1>UserName : <span>' . $student_email . '</span></h1>
            <h1>Password : <span>' . $student_password . '</span></h1>
            <h1>Verification Code : <span>' . $verification_code . '</span></h1>
            </div>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo ("Verification code sending failed ???");
            } else {
                echo ("Verification Code Successfully Send Your Email");
            }
        }
    }
}
