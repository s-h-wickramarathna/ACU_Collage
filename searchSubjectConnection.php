<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_GET["st"])) {
        $subject = $_GET["st"];
echo($subject);
        $subject_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
        INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
        INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_subject`.`officer_teacher_email`
        INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
        WHERE `subject_name` LIKE '%".$subject."%' ");
        $subject_num = $subject_rs->num_rows;

        if ($subject_num != 0) {
            for ($x = 0; $x < $subject_num; $x++) {
                $subject_data = $subject_rs->fetch_assoc();

?>
                <tr>
                    <th scope="row"><?php echo ($x + 1); ?></th>
                    <td><?php echo ($subject_data["Grade_name"]); ?></td>
                    <td><?php echo ($subject_data["subject_name"]); ?></td>
                    <td><?php echo ($subject_data["email"]); ?></td>
                    <td><?php echo ($subject_data["fname"]); ?></td>
                    <td><?php echo ($subject_data["lname"]); ?></td>
                </tr>
<?php

            }
        }else{
            echo($subject_num);
        }
    }
}

?>