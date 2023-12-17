<?php
session_start();
require "database/connection.php";

if (isset($_POST['e']) && isset($_POST['p'])) {
    $email = $_POST["e"];
    $password = $_POST["p"];

    if (empty($email)) {
        echo ("Please Enter Email Address.");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 100) {
        echo ("Invalid Email Address.");
    } else if (empty($password)) {
        echo ("Please Enter Password.");
    } else if (strlen($password) < 5 || strlen($password) > 20) {
        echo ("Password Must Have Between 5-20 Charactors.");
    } else {

        $admin_rs = Database::Search("SELECT * FROM `admin` WHERE `email`='".$email."' AND `password`='".$password."' ");
        $admin_num = $admin_rs->num_rows;

        if ($admin_num == 1) {
            $admin_data = $admin_rs->fetch_assoc();
            $_SESSION["admin"]=$admin_data;
            echo ("Success");
        } else {
            echo ("Invalid Email Address Or Password");
        }
    }
}
?>