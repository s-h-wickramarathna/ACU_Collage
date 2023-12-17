<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["teacher"])) {
    if (isset($_GET["a"])) {
        $aid = $_GET["a"];

        Database::iud("UPDATE `assignments` SET `delete_status_d_id`='1' WHERE `assignment_id`='".$aid."' ");
        echo("Success");

    }
}

?>