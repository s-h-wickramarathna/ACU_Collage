<?php
session_start();
require "database/connection.php";

if (isset($_SESSION["teacher"])) {
    if (isset($_POST["g"]) && isset($_POST["s"])) {
        $grade = $_POST["g"];
        $teacher = $_SESSION["teacher"];
        $subject = $_POST["s"];

        if ($grade == 0 || $subject == 0) {
            echo ("1");
        } else {

            //    process Student Assignments

            $pAssignment_rs = Database::Search("SELECT * FROM `assignments`
        INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id` 
        WHERE `Grade_id`='" . $grade . "' AND `subject_subject_id`='" . $subject . "' ");

            $pAsignment_num = $pAssignment_rs->num_rows;

            if ($pAsignment_num != 0) {
                for ($x = 0; $x < $pAsignment_num; $x++) {
                    $pAsignment_data = $pAssignment_rs->fetch_assoc();

                    $pstudent_rs = Database::Search("SELECT * FROM `student`
                    INNER JOIN `student_has_subject` ON `student_has_subject`.`student_student_email`=`student`.`student_email`
                    INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
                    WHERE `grade`.`id`='" . $pAsignment_data["Grade_id"] . "' AND `student_has_subject`.`subject_subject_id`='" . $pAsignment_data["subject_subject_id"] . "' ");

                    $pstudent_num = $pstudent_rs->num_rows;

                    if ($pstudent_num != 0) {
                        for ($i = 0; $i < $pstudent_num; $i++) {
                            $pstudent_data = $pstudent_rs->fetch_assoc();

                            $pAssignment_result = Database::Search("SELECT * FROM `assignment_result`
                            WHERE `assignments_assignment_id`='" . $pAsignment_data["assignment_id"] . "'
                            AND `student_has_subject_student_subject`='" . $pstudent_data["student_subject"] . "' ");

                            $pAsignment_result_num = $pAssignment_result->num_rows;

                            $today =  date("Y-m-d");
                            $expire_d = explode(" ", $pAsignment_data["assignment_expire_date"]);
                            $expire_date = $expire_d[0];

                            if ($pAsignment_result_num == 0 && $today > $expire_date) {
                                $d = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $d->setTimezone($tz);
                                $date = $d->format("Y-m-d H:i:s");

                                Database::iud("INSERT INTO `assignment_result` (`student_has_subject_student_subject`,`assignments_assignment_id`,`marks`,`atendents_atendent_id`,`answer_path`,`UploadDateTime`)
                                VALUES ('" . $pstudent_data["student_subject"] . "','" . $pAsignment_data["assignment_id"] . "','0','1','null','" . $date . "') ");
                            }
                        }
                    }
                }
            }



            //    process Student Assignments

?>

            <div class="col-12">
                <p class="fs-4 fw-bold text-primary">Submited Answer Sheets ....</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Submit Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Email</th>
                                <th scope="col">Answer Sheet</th>
                                <th scope="col"></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $assignmentP_rs = Database::Search("SELECT * FROM `assignment_result`
                                INNER JOIN `student_has_subject` ON `student_has_subject`.`student_subject`=`assignment_result`.`student_has_subject_student_subject`
                                INNER JOIN `student` ON `student`.`student_email`=`student_has_subject`.`student_student_email`
                                INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id`
                                INNER JOIN `assignments` ON `assignments`.`assignment_id`=`assignment_result`.`assignments_assignment_id`
                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id`
                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                INNER JOIN `officer_teacher_has_grade` ON `officer_teacher_has_grade`.`Grade_id`=`grade`.`id` 
                                WHERE `officer_teacher_has_grade`.`officer_teacher_email`='" . $teacher["email"] . "'
                                AND `atendents_atendent_id`='2'
                                AND `subject`.`subject_id`='" . $subject . "'
                                AND `grade`.`id`='" . $grade . "'
                                  ");
                            $assignmentP_num = $assignmentP_rs->num_rows;

                            if ($assignmentP_num != 0) {
                                for ($i = 0; $i < $assignmentP_num; $i++) {
                                    $assignmentP_data = $assignmentP_rs->fetch_assoc();


                            ?>
                                    <tr>
                                        <th scope="row"><?php echo ($i + 1) ?></th>
                                        <td><?php echo ($assignmentP_data["assignment_title"]); ?></td>
                                        <td><?php echo ($assignmentP_data["assignment_submit_date"]); ?></td>
                                        <td><?php echo ($assignmentP_data["assignment_expire_date"]); ?></td>
                                        <td><?php echo ($assignmentP_data["subject_name"]); ?></td>
                                        <td><?php echo ($assignmentP_data["Grade_name"]); ?></td>
                                        <td><?php echo ($assignmentP_data["student_firstname"] . " " . $assignmentP_data["student_lastname"]); ?></td>
                                        <td><?php echo ($assignmentP_data["student_email"]); ?></td>

                                        <td><button class="btn btn-primary">Download</button></td>

                                    </tr>
                                <?php
                                }

                                ?>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-8 offset-4">
                <hr class="border border-3 border-primary">
            </div>

            <div class="col-12">
                <p class="fs-4 fw-bold text-primary">Absent Students ....</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Submit Date</th>
                                <th scope="col">Expire Date</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Email</th>
                                <th scope="col">Option</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $assignmentA_rs = Database::Search("SELECT * FROM `assignment_result`
                                INNER JOIN `student_has_subject` ON `student_has_subject`.`student_subject`=`assignment_result`.`student_has_subject_student_subject`
                                INNER JOIN `student` ON `student`.`student_email`=`student_has_subject`.`student_student_email`
                                INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id`
                                INNER JOIN `assignments` ON `assignments`.`assignment_id`=`assignment_result`.`assignments_assignment_id`
                                INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`assignments`.`officer_teacher_has_subject_ths_id`
                                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                INNER JOIN `officer_teacher_has_grade` ON `officer_teacher_has_grade`.`Grade_id`=`grade`.`id` 
                                WHERE `officer_teacher_has_grade`.`officer_teacher_email`='" . $teacher["email"] . "'
                                AND `atendents_atendent_id`='1'
                                AND `subject`.`subject_id`='" . $subject . "'
                                AND `grade`.`id`='" . $grade . "'
                                ");

                            $assignmentA_num = $assignmentA_rs->num_rows;

                            if ($assignmentA_num != 0) {
                                for ($i = 0; $i < $assignmentA_num; $i++) {
                                    $assignmentA_data = $assignmentA_rs->fetch_assoc();
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo ($i + 1) ?></th>
                                        <td><?php echo ($assignmentA_data["assignment_title"]); ?></td>
                                        <td><?php echo ($assignmentA_data["assignment_submit_date"]); ?></td>
                                        <td><?php echo ($assignmentA_data["assignment_expire_date"]); ?></td>
                                        <td><?php echo ($assignmentA_data["student_firstname"] . " " . $assignmentA_data["student_lastname"]); ?></td>
                                        <td><?php echo ($assignmentA_data["student_email"]); ?></td>
                                        <td><button class="btn btn-danger">Absent</button></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-8 offset-4">
                <hr class="border border-3 border-primary">
            </div>
            <div class="col-12">
                <p class="fs-4 fw-bold text-primary">All Students....</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Student FirstName</th>
                                <th scope="col">Student LastName</th>
                                <th scope="col">Student Email</th>
                                <th scope="col"></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $student_rs = Database::Search("SELECT * FROM `student` 
                                       INNER JOIN `student_has_subject` ON `student_has_subject`.`student_student_email`=`student`.`student_email` 
                                       INNER JOIN `subject` ON `subject`.`subject_id`=`student_has_subject`.`subject_subject_id`
                                       INNER JOIN `grade` ON `grade`.`id`=`student`.`Grade_id`
                                       WHERE `student`.`Grade_id`='" . $grade . "' AND `subject`.`subject_id`='" . $subject . "' ");

                            $student_num = $student_rs->num_rows;

                            for ($s = 0; $s < $student_num; $s++) {
                                $student_data = $student_rs->fetch_assoc();
                            ?>
                                <tr>
                                    <th scope="row"><?php echo ($s + 1) ?></th>
                                    <td><?php echo ($student_data["subject_name"]) ?></td>
                                    <td><?php echo ($student_data["Grade_name"]) ?></td>
                                    <td><?php echo ($student_data["student_firstname"]) ?></td>
                                    <td><?php echo ($student_data["student_lastname"]) ?></td>
                                    <td><?php echo ($student_data["student_email"]) ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

<?php
        }
    }
}
