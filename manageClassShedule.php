<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Manage Adminstration</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "adminHeader.php";
            require "database/connection.php";
            ?>

            <div class="col-12 mt-3">
                <p class="fs-4 fw-bold text-primary">+ Add Class Lectures ....</p>
            </div>

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Teacher Email</th>
                                <th scope="col">Teacher Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $grade_rs = Database::Search("SELECT * FROM `grade` ");
                            $grade_num = $grade_rs->num_rows;

                            $teacher_email;
                            $teacher_Name ;

                            if ($grade_num != 0) {
                                for ($x = 0; $x < $grade_num; $x++) {
                                    $grade_data = $grade_rs->fetch_assoc();

                                    $teacher_rs = Database::Search("SELECT * FROM `officer_teacher_has_grade` 
                                    INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_grade`.`officer_teacher_email`
                                    WHERE `officer_teacher_has_grade`.`Grade_id`='" . $grade_data["id"] . "' ");

                                    $teacher_num = $teacher_rs->num_rows;

                                    if ($teacher_num == 1) {
                                        $teacher_data = $teacher_rs->fetch_assoc();

                                        $teacher_email = $teacher_data["email"];
                                        $teacher_Name = $teacher_data["fname"] . " " . $teacher_data["lname"];
                                    } else {
                                        $teacher_email = "Not Assign";
                                        $teacher_Name = "-------";
                                    }

                            ?>
                                    <tr class="cursor" onclick="window.location='addClassShedule.php?g=<?php echo($grade_data['id']) ?>'">
                                        <th scope="row"><?php echo ($x + 1) ?></th>
                                        <td><?php echo ($grade_data["Grade_name"]) ?></td>
                                        <td><?php echo ($teacher_email) ?></td>
                                        <td><?php echo ($teacher_Name) ?></td>
                                    </tr>
                            <?php

                                }
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 mt-2">
        <?php include "footer.php" ?>
    </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>