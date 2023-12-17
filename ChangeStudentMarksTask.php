<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["officer"])){
    if(isset($_GET["id"])){
        $student_mark_id = $_GET["id"];
        Database::iud("UPDATE `student_marks` SET `task`='2' WHERE `student_marks_id`='".$student_mark_id."' ");
        echo("Success");
    }
}

?>