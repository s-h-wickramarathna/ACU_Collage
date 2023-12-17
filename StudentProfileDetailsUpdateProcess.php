<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["student"])) {

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $nic = $_POST["n"];
    $address = $_POST["a"];
    $city = $_POST["c"];
    $email = $_POST["e"];

    if (empty($fname)) {
        echo ("Please Enter First Name");
    } else if (empty($lname)) {
        echo ("Please Enter Last Name");
    } else if (empty($address)) {
        echo ("Please Enter Last Name");
    } else if ($city == 0) {
        echo ("Please Select Your City");
    } else {
        Database::iud("UPDATE `student` SET `student_firstname`='" . $fname . "',
        `student_lastname`='" . $lname . "',
        `student_nic`='" . $nic . "' 
        WHERE `student_email`='" . $email . "' ");

        Database::iud("UPDATE `student_address` SET `address_no`='".$address."',
        `city_city_id`='".$city."' ");
    }
}
