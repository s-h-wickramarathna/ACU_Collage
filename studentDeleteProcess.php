<?php
session_start();
require "database/connection.php";

if (isset($_GET["e"])) {
    $email = $_GET["e"];
        Database::iud("UPDATE `student` SET `delete_status_d_id`='1' WHERE `student_email`='".$email."' ");
    
    echo ("Success");
}

?>