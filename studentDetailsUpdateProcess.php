<?php
session_start();
require "database/connection.php";


if (isset($_SESSION["admin"])) {

    if (isset($_POST["e"])) {
        $email = $_POST["e"];
        $fname = $_POST["f"];
        $lname = $_POST["l"];
        $address = $_POST["a"];
        $city = $_POST["c"];

        // echo($email);
        // echo(" ");
        // echo($fname);
        // echo(" ");
        // echo($lname);
        // echo(" ");
        // echo($class);
        // echo(" ");
        // echo($address);
        // echo(" ");
        // echo($city);

        Database::iud("UPDATE `student`
         SET
          `student_firstname`='".$fname."',
          `student_lastname`='".$lname."'
          WHERE `student_email`='".$email."'
         ");

         Database::iud("UPDATE `student_address`
         SET
         `address_no`='".$address."',
         `city_city_id`='".$city."'
         WHERE `student_student_email`='".$email."'
          ");

          echo("Success");

    }
}

?>