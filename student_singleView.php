 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ACU || Student Details</title>
     <link rel="icon" href="resources/app/university_logo.png" />
     <link rel="stylesheet" href="frameworks/bootstrap.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
     <link rel="stylesheet" href="style.css" />
 </head>

 <body>
     <div class="container-fluid">
         <div class="row">
             <?php include "adminHeader.php";
                require "database/connection.php";

                if (isset($_GET["sid"])) {
                    $student_email = $_GET["sid"];

                    $student_rs = Database::Search("SELECT * FROM `student`
                INNER JOIN `gender` ON `gender`.`gender_id`=`student`.`gender_gender_id`
                INNER JOIN `status` ON `student`.`status_id`=`status`.`id`
                INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
                INNER JOIN `hold_status` ON `hold_status`.`h_id`=`student`.`hold_status_h_id`
                INNER JOIN `student_address` ON `student_address`.`student_student_email`=`student`.`student_email`
                INNER JOIN `city` ON `city`.`city_id`=`student_address`.`city_city_id`
                INNER JOIN `district` ON `city`.`district_district_id`=`district`.`district_id`
                INNER JOIN `province` ON `province`.`province_id`=`district`.`province_province_id`
                INNER JOIN `student_parent_details` ON `student_parent_details`.`student_student_email`=`student`.`student_email`
                WHERE `student_email`='" . $student_email . "' ");

                    $student_data = $student_rs->fetch_assoc();

                ?>
                 <div class="col-12 mt-3">
                     <p class="fs-4 fw-bold text-primary">Manage Students ....</p>
                 </div>

                 <div class="col-12">
                     <div class="row">
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">Email Address :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_email"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">first Name :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_firstname"]) ?>" id="S_fname" />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">Last Name :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_lastname"]) ?>" id="S_lname" />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">Grade:</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["Grade_name"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">Date Of Birth :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["dob"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">NIC No :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_nic"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <div class="row">
                                 <p class="fw-bold text-black-50">Status $ Verification</p>
                                 <div class="col-6">
                                     <input type="text" class="form-control shadow" value="<?php echo ($student_data["hold_type"]) ?>" disabled />
                                 </div>
                                 <div class="col-6">
                                     <input type="text" class="form-control shadow" value="<?php echo ($student_data["status"]) ?>" disabled />
                                 </div>
                             </div>
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">Gender :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["gender_type"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-4 mb-4">
                             <p class="fw-bold text-black-50">Join Date :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["student_joindate"]) ?>" disabled />
                         </div>

                         <div class="col-6 col-lg-6 mb-4">
                             <p class="fw-bold text-black-50">Address :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["address_no"]) ?>" id="S_address" />
                         </div>
                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">City :</p>
                             <select class="form-select shadow" id="S_city">
                                 <option value="0">User City</option>
                                 <?php

                                    $city_rs = Database::Search("SELECT * FROM `city` ");
                                    $city_num = $city_rs->num_rows;

                                    for ($c = 0; $c < $city_num; $c++) {
                                        $city_data = $city_rs->fetch_assoc();
                                        if ($student_data["city_city_id"] == $city_data["city_id"]) {
                                    ?>
                                         <option selected value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                     <?php
                                        } else {
                                        ?>
                                         <option value="<?php echo ($city_data["city_id"]) ?>"><?php echo ($city_data["city_name"]) ?></option>
                                 <?php
                                        }
                                    }

                                    ?>
                             </select>
                         </div>
                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">District :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["district_name"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">Province :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["province_name"]) ?>" disabled />
                         </div>

                         <div class="col-8 offset-4">
                             <hr class="border border-3 border-dark">
                         </div>

                         <div class="col-12">
                             <p class="fs-4 fw-bold text-primary">Parent Details </p>
                         </div>

                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">First Name :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_fname"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">Last Name :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_lname"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">NIC No :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_nic"]) ?>" disabled />
                         </div>
                         <div class="col-6 col-lg-3 mb-4">
                             <p class="fw-bold text-black-50">Mobile No :</p>
                             <input type="text" class="form-control shadow" value="<?php echo ($student_data["parent_mobile"]) ?>" disabled />
                         </div>

                         <div class="col-8 offset-4">
                             <hr class="border border-3 border-dark">
                         </div>
                         <div class="col-12 mt-2 mb-4 text-end">
                             <button class="btn btn-primary" onclick="studentDetailsUpdate('<?php echo ($student_data['student_email']) ?>');">Update</button>
                             <?php

                                if ($student_data["hold_status_h_id"] == 1) {
                                ?>
                                 <button class="btn btn-warning" onclick="studentDeactivate('<?php echo ($student_data['student_email']) ?>');">Deactivate</button>
                             <?php
                                } else {
                                ?>
                                 <button class="btn btn-dark" onclick="studentDeactivate('<?php echo ($student_data['student_email']) ?>');">Active</button>
                             <?php
                                }

                                ?>

                             <button class="btn btn-danger" onclick="studentDelete('<?php echo ($student_data['student_email']) ?>');">Delete</button>
                         </div>
                     </div>
                 </div>

                 <div class="col-12">
                     <div class="row">

                         <div class="col-12">
                             <p class="fs-4 fw-bold text-primary">Subjects & Teacher's .....</p>
                         </div>

                         <div class="col-12 mt-3 mb-4">
                             <div class="row">

                                 <div class="table-responsive">
                                     <table class="table table-hover">
                                         <thead>
                                             <tr>

                                                 <th scope="col">#</th>
                                                 <th scope="col">Subject Type</th>
                                                 <th scope="col">Subject</th>
                                                 <th scope="col">Teacher Name</th>
                                                 <th scope="col">Teacher Email</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php
                                                $subject_rs = Database::Search("SELECT * FROM `student_has_subject`
                                            INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id`
                                            INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`subject_subject_id`=`subject`.`subject_id`
                                            INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_subject`.`officer_teacher_email`
                                            INNER JOIN `subject_type` ON `subject_type`.`stype_id`=`subject`.`subject_type_stype_id`
                                            WHERE `student_student_email`='" . $student_email . "' ");

                                                $subject_num = $subject_rs->num_rows;

                                                if ($subject_num != 0) {
                                                    for ($x = 0; $x < $subject_num; $x++) {
                                                        $subject_data = $subject_rs->fetch_assoc();
                                                ?>
                                                     <tr>
                                                         <th scope="row"><?php echo ($x + 1); ?></th>
                                                         <td><?php echo ($subject_data["stype_name"]) ?></td>
                                                         <td><?php echo ($subject_data["subject_name"]) ?></td>
                                                         <td><?php echo ($subject_data["fname"] . " " . $subject_data["lname"]) ?></td>
                                                         <td><?php echo ($subject_data["officer_teacher_email"]) ?></td>

                                                     </tr>
                                             <?php
                                                    }
                                                }

                                                ?>

                                         </tbody>
                                     </table>
                                 </div>

                             </div>
                         </div>

                     </div>
                 </div>

                 <div class="col-12">
                     <div class="row">

                         <div class="col-12">
                             <p class="fs-4 fw-bold text-primary">All Grade Assignments .....</p>
                         </div>

                         <div class="col-12 mt-3 mb-4">
                             <div class="row">

                                 <div class="table-responsive">
                                     <table class="table table-hover">
                                         <thead>
                                             <tr>

                                                 <th scope="col">#</th>
                                                 <th scope="col">Grade</th>
                                                 <th scope="col">Subject</th>
                                                 <th scope="col">Assignment Title</th>
                                                 <th scope="col">Submited DateTime</th>
                                                 <th scope="col">Expire DateTime</th>
                                                 <th scope="col">Teacher Name</th>
                                                 <th scope="col">Marks</th>
                                                 <th scope="col">Attendents</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php
                                                $result_rs = Database::Search("SELECT * FROM `assignment_result`
                                                 INNER JOIN `assignments` ON `assignments`.`assignment_id`=`assignment_result`.`assignments_assignment_id` 
                                                INNER JOIN `student_has_subject` ON `student_has_subject`.`student_subject`=`assignment_result`.`student_has_subject_student_subject`
                                                INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id`
                                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id`
                                                INNER JOIN `officer_teacher` ON `officer_teacher`.`email`=`officer_teacher_has_subject`.`officer_teacher_email`
                                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                                WHERE `student_has_subject`.`student_student_email` ='" . $student_email . "'                                                
                                                 ");

                                                $result_num = $result_rs->num_rows;

                                                if ($result_num != 0) {
                                                    for ($i = 0; $i < $result_num; $i++) {
                                                        $result_data = $result_rs->fetch_assoc();
                                                ?>
                                                     <tr>
                                                         <th scope="row"><?php echo ($i + 1); ?></th>
                                                         <th scope="row"><?php echo ($result_data["Grade_name"]) ?></th>
                                                         <td>
                                                             <?php echo ($result_data["subject_name"]) ?>
                                                         </td>
                                                         <td>
                                                             <?php echo ($result_data["assignment_title"]) ?>
                                                         </td>
                                                         <td>
                                                             <?php echo ($result_data["assignment_submit_date"]) ?>
                                                         </td>
                                                         <td>
                                                             <?php echo ($result_data["assignment_expire_date"]) ?>
                                                         </td>
                                                         <td><?php echo ($result_data["fname"] . " " . $result_data["lname"]) ?></td>
                                                         <td><?php echo ($result_data["marks"]) ?></td>
                                                         <td>
                                                             <?php
                                                                if ($result_data["atendents_atendent_id"] == 1) {
                                                                ?>
                                                                 <button class="btn btn-danger">Absent</button>
                                                             <?php
                                                                } else if ($result_data["atendents_atendent_id"] == 2) {
                                                                ?>
                                                                 <button class="btn btn-success">Present</button>
                                                             <?php
                                                                }

                                                                ?>
                                                         </td>
                                                     </tr>
                                             <?php
                                                    }
                                                }
                                                ?>

                                         </tbody>
                                     </table>
                                 </div>

                             </div>
                         </div>

                     </div>
                 </div>

                 <div class="col-12 mt-3 mb-4">
                     <div class="row justify-content-end">
                         <div class="col-4">
                             <p class="fw-bold">Enter Enrollment fee LKR :</p>
                             <input type="number" class="form-control" id="enrolmtFee">
                         </div>
                     </div>
                 </div>

                 <div class="col-12 mt-3 mb-4 text-end" id="btnbtnnextgrade">
                     <button class="btn btn-outline-info" onclick="uptoNextGrade('<?php echo ($student_email) ?>');">Up to Next Grade</button>
                 </div>

                 <div class="col-12 mt-3 mb-4 d-none" id="OLMainSubjectTOSubject">
                     <div class="row">
                         <div class="col-12">
                             <p class="fs-4 fw-bold text-primary">Select Sub O/L Subjects ....</p>
                         </div>
                         <div class="col-4">
                             <p class="fw-bold">Select Subject 01</p>
                             <select class="form-select" id="olmSubject1">
                                 <option value="0">Sub Subject 01</option>
                                 <?php
                                    $sub_01_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='3' ");
                                    $sub_01_num = $sub_01_rs->num_rows;

                                    if ($sub_01_num != 0) {
                                        for ($i = 0; $i < $sub_01_num; $i++) {
                                            $sub_01_data = $sub_01_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo ($sub_01_data["subject_id"]) ?>"><?php echo ($sub_01_data["subject_name"]) ?></option>
                                 <?php
                                        }
                                    }
                                    ?>
                             </select>
                         </div>
                         <div class="col-4">
                             <p class="fw-bold">Select Subject 02</p>
                             <select class="form-select" id="olmSubject2">
                                 <option value="0">Sub Subject 02</option>
                                 <?php
                                    $sub_02_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='4' ");
                                    $sub_02_num = $sub_02_rs->num_rows;

                                    if ($sub_02_num != 0) {
                                        for ($i = 0; $i < $sub_02_num; $i++) {
                                            $sub_02_data = $sub_02_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo ($sub_02_data["subject_id"]) ?>"><?php echo ($sub_02_data["subject_name"]) ?></option>
                                 <?php
                                        }
                                    }
                                    ?>
                             </select>
                         </div>
                         <div class="col-4">
                             <p class="fw-bold">Select Subject 03</p>
                             <select class="form-select" id="olmSubject3">
                                 <option value="0">Sub Subject 03</option>
                                 <?php
                                    $sub_03_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='5' ");
                                    $sub_03_num = $sub_03_rs->num_rows;

                                    if ($sub_03_num != 0) {
                                        for ($i = 0; $i < $sub_03_num; $i++) {
                                            $sub_03_data = $sub_03_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo ($sub_03_data["subject_id"]) ?>"><?php echo ($sub_03_data["subject_name"]) ?></option>
                                 <?php
                                        }
                                    }
                                    ?>
                             </select>
                         </div>
                         <div class="col-12 text-end">
                             <button class="btn btn-primary" onclick="olSubjectchange('<?php echo ($student_email) ?>');">Next</button>
                         </div>
                     </div>
                 </div>

                 <div class="col-12 mt-3 mb-4 d-none" id="ALMainSubjectTOSubject">
                     <div class="row">
                         <div class="col-12">
                             <p class="fs-4 fw-bold text-primary">Select Sub A/L Subjects ....</p>
                         </div>
                         <div class="col-4">
                             <p class="fw-bold">Select Subject 01</p>
                             <select class="form-select" id="alsubject1">
                                 <option value="0">Sub Subject 01</option>
                                 <?php
                                    $subAL_01_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='7' ");
                                    $subAL_01_num = $sub_01_rs->num_rows;

                                    if ($subAL_01_num != 0) {
                                        for ($i = 0; $i < $subAL_01_num; $i++) {
                                            $subAL_01_data = $subAL_01_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo ($subAL_01_data["subject_id"]) ?>"><?php echo ($subAL_01_data["subject_name"]) ?></option>
                                 <?php
                                        }
                                    }
                                    ?>
                             </select>
                         </div>
                         <div class="col-4">
                             <p class="fw-bold">Select Subject 02</p>
                             <select class="form-select" id="alsubject2">
                                 <option value="0">Sub Subject 02</option>
                                 <?php
                                    $subAL_02_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='8' ");
                                    $subAL_02_num = $subAL_02_rs->num_rows;

                                    if ($subAL_02_num != 0) {
                                        for ($i = 0; $i < $subAL_02_num; $i++) {
                                            $subAL_02_data = $subAL_02_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo ($subAL_02_data["subject_id"]) ?>"><?php echo ($subAL_02_data["subject_name"]) ?></option>
                                 <?php
                                        }
                                    }
                                    ?>
                             </select>
                         </div>
                         <div class="col-4">
                             <p class="fw-bold">Select Subject 03</p>
                             <select class="form-select" id="alsubject3">
                                 <option value="0">Sub Subject 03</option>
                                 <?php
                                    $subAL_03_rs = Database::Search("SELECT * FROM `subject` WHERE `subject_type_stype_id`='9' ");
                                    $subAL_03_num = $subAL_03_rs->num_rows;

                                    if ($subAL_03_num != 0) {
                                        for ($i = 0; $i < $subAL_03_num; $i++) {
                                            $subAL_03_data = $subAL_03_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo ($subAL_03_data["subject_id"]) ?>"><?php echo ($subAL_03_data["subject_name"]) ?></option>
                                 <?php
                                        }
                                    }
                                    ?>
                             </select>
                         </div>
                         <div class="col-12 text-end">
                             <button class="btn btn-primary" onclick="ALSubjectchange('<?php echo ($student_email) ?>');">Next</button>
                         </div>
                     </div>
                 </div>

             <?php
                }
                ?>
         </div>
     </div>
     <script src="frameworks/jquery_v3.6.2.js"></script>
     <script src="script.js"></script>
 </body>

 </html>
 <?php



    ?>