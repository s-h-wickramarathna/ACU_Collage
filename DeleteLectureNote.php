<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["teacher"])){
    if(isset($_GET["n"])){
        $nid = $_GET["n"];

        Database::iud("UPDATE `lecture_notes` SET `delete_status_d_id`='1' ");
        echo("Success");
    }
}

?>