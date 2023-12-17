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
                <p class="fs-4 fw-bold text-primary">Manage Grade ....</p>
            </div>

            <div class="col-4 offset-5">
                <input type="text" class="form-control" placeholder="Format : Grade 00" id="AddGrade">
            </div>
            <div class="col-3 d-grid">
                <button class="btn btn-dark" onclick="AddGrade();">+ Add</button>
            </div>

            <div class="col-12 mt-3">
                <div class="table-responsive table_heigth">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Section</th>
                                <th scope="col">Teacher Email</th>
                                <th scope="col">Teacher First Name</th>
                                <th scope="col">Teacher Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $grade_rs = Database::Search("SELECT * FROM `grade` ");
                            $grade_num = $grade_rs->num_rows;

                            $teacher_first_name = "-------";
                            $teacher_last_name = "-------";
                            $teacher_email = "Not Assign";

                            if ($grade_num != 0) {
                                for ($x = 0; $x < $grade_num; $x++) {
                                    $grade_data = $grade_rs->fetch_assoc();
                                    $grade_has_techer_rs = Database::Search("SELECT * FROM `officer_teacher_has_grade` WHERE `Grade_id`='" . $grade_data["id"] . "' ");
                                    $grade_has_teacher_num = $grade_has_techer_rs->num_rows;

                            ?>
                                    <tr class="cursor" onclick="viewAddGradeModel(<?php echo ($grade_data['id']) ?>);">
                                        <th scope="row"><?php echo ($x + 1); ?></th>
                                        <td><?php echo ($grade_data["Grade_name"]); ?></td>
                                        <?php
                                        if ($grade_has_teacher_num != 0) {
                                            $grade_has_techer_data = $grade_has_techer_rs->fetch_assoc();
                                            $teacherGrade_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `email`='" . $grade_has_techer_data["officer_teacher_email"] . "' ");
                                            $teacherGrade_data = $teacherGrade_rs->fetch_assoc();
                                        ?>
                                            <td><?php echo ($teacherGrade_data["email"]); ?></td>
                                            <td><?php echo ($teacherGrade_data["fname"]); ?></td>
                                            <td><?php echo ($teacherGrade_data["lname"]); ?></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><?php echo ($teacher_email); ?></td>
                                            <td><?php echo ($teacher_first_name); ?></td>
                                            <td><?php echo ($teacher_last_name); ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <!-- grade Model -->
                                    <div class="modal" tabindex="-1" id="gradeModel<?php echo ($grade_data['id']); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php echo ($grade_data["Grade_name"]); ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Assign Teacher :-</p>

                                                    <select class="form-select shadow-none" id="teacherEmail<?php echo ($grade_data['id']); ?>">
                                                        <option value="0">Select Teacher</option>
                                                        <?php
                                                        $teacherA_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `user_type_id`='1' AND `status_id`='2' AND `hold_status_id`='1' AND `delete_status_d_id`='2' ");
                                                        $teacherA_num = $teacherA_rs->num_rows;

                                                        if ($teacherA_num != 0) {
                                                            for ($t = 0; $t < $teacherA_num; $t++) {
                                                                $teacherA_data = $teacherA_rs->fetch_assoc();
                                                        ?>
                                                                <option value="<?php echo ($teacherA_data["email"]) ?>"><?php echo ($teacherA_data["fname"] . " " . $teacherA_data["lname"]) ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="AddSectionToTeacher(<?php echo ($grade_data['id']); ?>);">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- grade Model -->
                            <?php
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-12 mt-3">
                <p class="fs-4 fw-bold text-primary">Manage Subjects ....</p>
            </div>

            <div class="col-12 mt-3">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <select class="form form-select" id="AddGrade123" onchange="selectSujectTOgrade();">
                            <option value="0">Select Grade</option>
                            <?php
                            $AddGrade_rs = Database::Search("SELECT * FROM `grade`");
                            $AddGrade_num = $AddGrade_rs->num_rows;

                            if ($AddGrade_num != 0) {
                                for ($ag = 0; $ag < $AddGrade_num; $ag++) {
                                    $AddGrade_data = $AddGrade_rs->fetch_assoc();
                            ?>
                                    <option value="<?php echo ($AddGrade_data["id"]) ?>"><?php echo ($AddGrade_data["Grade_name"]) ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form form-select" id="AddSubject">
                            <option value="0">First Select Grade</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form form-select" id="AddTeacher">
                            <option value="0">Select Teacher</option>
                            <?php
                            $Addteacher_rs = Database::Search("SELECT * FROM `officer_teacher`  WHERE `status_id`='2' AND `hold_status_id`='1' AND `delete_status_d_id`='2' AND `user_type_id`='1' ");
                            $Addteacher_num = $Addteacher_rs->num_rows;

                            if ($Addteacher_num != 0) {
                                for ($ag = 0; $ag < $Addteacher_num; $ag++) {
                                    $Addteacher_data = $Addteacher_rs->fetch_assoc();
                            ?>
                                    <option value="<?php echo ($Addteacher_data["email"]) ?>"><?php echo ($Addteacher_data["fname"] . " " . $Addteacher_data["lname"]) ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 d-grid">
                        <button class="btn btn-primary" onclick="AddGradeToSubject();">+ Add Connection</button>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <select class="form-select" id="stypeSubject">
                                <option value="0">Select Subject Type</option>
                                <?php
                                $stype_rs = Database::Search("SELECT * FROM `subject_type` ");
                                $stype_num = $stype_rs->num_rows;

                                if($stype_num != 0){
                                    for ($s=0; $s < $stype_num; $s++) { 
                                        $stype_data = $stype_rs->fetch_assoc();
                                        ?>
                                        <option value="<?php echo($stype_data["stype_id"]) ?>"><?php echo($stype_data["stype_name"]) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter New Subject Name ...." id="newSubject">
                            <button class="btn btn-dark" type="button" onclick="addNewSubject();">+ Add</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter Grade Or Subject Name" id="searchConnection" onkeyup="searchSubjectConnection();">
                            <button class="btn btn-dark" type="button" onclick="searchSubjectConnection();">Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-3">
                <div class="table-responsive table_heigth">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $subject_rs = Database::Search("SELECT * FROM `subject` ");
                            $subject_num = $subject_rs->num_rows;

                            $teacher_subject_first_name = "-------";
                            $teacher_subject_last_name = "-------";
                            $teacher_subject_email = "Not Assign";

                            if ($subject_num != 0) {
                                for ($s = 0; $s < $subject_num; $s++) {
                                    $subject_data = $subject_rs->fetch_assoc();
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo ($s + 1); ?></th>
                                        <td><?php echo ($subject_data["subject_name"]); ?></td>
                                    </tr>
                            <?php

                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-9 mt-3">
                <div class="table-responsive table_heigth">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Subject Name</th>
                                <th scope="col">Teacher Email</th>
                                <th scope="col">Teacher First Name</th>
                                <th scope="col">Teacher Last Name</th>
                            </tr>
                        </thead>
                        <tbody id="SubjectSearchDIV">
                            <?php

                            $subjecthasteacher_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
                            INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
                            INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_subject`.`officer_teacher_email`
                            INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                            ORDER BY `officer_teacher_has_subject`.`Grade_id` ASC ");
                            $subjecthasteacher_num = $subjecthasteacher_rs->num_rows;

                            if ($subjecthasteacher_num != 0) {
                                for ($s = 0; $s < $subjecthasteacher_num; $s++) {
                                    $subjecthasteacher_data = $subjecthasteacher_rs->fetch_assoc();
                            ?>
                                    <tr onclick="showConnectionModel(<?php echo ($subjecthasteacher_data['ths_id']); ?>);">
                                        <th scope="row"><?php echo ($s + 1); ?></th>
                                        <td><?php echo ($subjecthasteacher_data["Grade_name"]); ?></td>
                                        <td><?php echo ($subjecthasteacher_data["subject_name"]); ?></td>
                                        <td><?php echo ($subjecthasteacher_data["email"]); ?></td>
                                        <td><?php echo ($subjecthasteacher_data["fname"]); ?></td>
                                        <td><?php echo ($subjecthasteacher_data["lname"]); ?></td>
                                    </tr>
                                    <!-- connection Model -->
                                    <div class="modal" tabindex="-1" id="connectionModel<?php echo ($subjecthasteacher_data['ths_id']); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php echo ($subjecthasteacher_data["Grade_name"]); ?></h5>&nbsp;||&nbsp;
                                                    <h5 class="modal-title"><?php echo ($subjecthasteacher_data["subject_name"]); ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Assign Teacher :-</p>

                                                    <select class="form-select shadow-none" id="ConnectionteacherEmail<?php echo ($subjecthasteacher_data['ths_id']); ?>">
                                                        <option value="0">Select Teacher</option>
                                                        <?php
                                                        $teacherCon_rs = Database::Search("SELECT * FROM `officer_teacher` WHERE `user_type_id`='1' AND  `status_id`='2' AND `hold_status_id`='1' AND `delete_status_d_id`='2' ");
                                                        $teacherCon_num = $teacherCon_rs->num_rows;

                                                        if ($teacherC_num != 0) {
                                                            for ($t = 0; $t < $teacherCon_num; $t++) {
                                                                $teacherCon_data = $teacherCon_rs->fetch_assoc();
                                                        ?>
                                                                <option value="<?php echo ($teacherCon_data["email"]) ?>"><?php echo ($teacherCon_data["fname"] . " " . $teacherA_data["lname"]) ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="AddGradeSubjecttoTeacher(<?php echo ($subjecthasteacher_data['ths_id']); ?>);">Save</button>
                                                    <button type="button" class="btn btn-danger" onclick="DeleteGradeSubjecttoTeacher(<?php echo ($subjecthasteacher_data['ths_id']); ?>);">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- connection Model -->
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
    <script src="frameworks/bootstrap.js"></script>
    <script src="frameworks/jquery_v3.6.2.js"></script>
    <script src="script.js"></script>
</body>

</html>