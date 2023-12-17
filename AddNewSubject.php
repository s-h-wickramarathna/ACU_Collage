<?php
session_start();
require "database/connection.php";

if(isset($_SESSION["admin"])){

    if(isset($_GET["s"])){
        $s = $_GET["s"];
        $stype = $_GET["t"];
        $subject = ucfirst($s);

        if(!empty($s) && $stype != 0){
            $subject_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_name` LIKE '%".$subject."%' AND `subject_type_stype_id`='".$stype."' ");
            $subject_num = $subject_rs->num_rows;
    
            if($subject_num == 0){
                Database::iud("INSERT INTO `subject` (`subject_name`,`subject_type_stype_id`) VALUES ('".$subject."','".$stype."') ");
                echo("Success");
            }else{
                echo("Subject Already Exist");
            }
        }

    }

}
