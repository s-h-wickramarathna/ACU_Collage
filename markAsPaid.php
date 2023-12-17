<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){
    if(isset($_GET["e"])){
        $e_id = $_GET["e"];

        Database::iud("UPDATE `enrollment_fee` SET `is_paid`='2' WHERE `id`='$e_id' ");
        echo("Success");

    }
}

?>