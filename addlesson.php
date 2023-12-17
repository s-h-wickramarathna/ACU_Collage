<?php
session_start();
require "database/connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Add Leasson's</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["teacher"])) {
                $teacher_email = $_SESSION["teacher"]["email"];

                $teacher_rs = Database::Search("SELECT * FROM `officer_teacher_has_subject`
                INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                 WHERE `officer_teacher_email`='" . $teacher_email . "' ");
                $teacher_num = $teacher_rs->num_rows;

                if ($teacher_num != 0) {

                    $num = $teacher_num;
            ?>

                    <div class="col-12 mt-2 mb-2">
                        <div class="row g-3">

                            <div class="col-6">
                                <p class="fs-4 fw-bold text-primary m-0 mt-2 mb-2">Add New Leasson Note :-</p>
                            </div>
                            <div class="col-6">
                                <div class="alert alert-danger d-none" id="leassonNoteERMsg" role="alert"></div>
                            </div>

                            <div class="col-6 col-md-3">
                                <select class="form-select" id="noteleassonGrade" onchange="loadSubjectLeasson('<?php echo ($teacher_email) ?>');">
                                    <option value="0">Select Grade</option>
                                    <?php
                                    for ($g = 0; $g < $teacher_num; $g++) {
                                        $grade = $teacher_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($grade["Grade_id"]) ?>"><?php echo ($grade["Grade_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 col-md-3">
                                <select class="form-select" id="noteleassonSubject">
                                    <option value="0">Select Grade First</option>
                                </select>
                            </div>
                            <div class="col-6 col-md-3">
                                <input type="text" class="form-control" placeholder="Enter lesson Note Title ...." id="AddLeassonNotetitle" />
                            </div>
                            <div class="col-6 col-md-3">
                                <input type="file" class="form-control" id="AddLeassonNotefile" />
                            </div>
                            <div class="col-12 text-end">
                                <button class="btn btn-primary" onclick="AddLeasssonNote('<?php echo ($teacher_email) ?>');">+ Add</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-8">
                        <hr class="border border-4 border-primary">
                    </div>

                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-12">
                                <p class="fs-4 fw-bold text-primary m-0 mt-2 mb-2">Added Leasson Notes ....</p>
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <div class="table-responsive table_heigth">
                                    <table class="table table-dark table-hover">
                                        <thead>

                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Grade</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Date Time</th>
                                                <th scope="col"></th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $lecture_rs = Database::Search("SELECT * FROM `lecture_notes`
                                        INNER JOIN `officer_teacher_has_subject` ON `officer_teacher_has_subject`.`ths_id`=`lecture_notes`.`officer_teacher_has_subject_ths_id` 
                                        INNER JOIN `subject` ON `subject`.`subject_id`=`officer_teacher_has_subject`.`subject_subject_id`
                                        INNER JOIN `grade` ON `grade`.`id`=`officer_teacher_has_subject`.`Grade_id`
                                        WHERE `officer_teacher_email`='" . $teacher_email . "' AND `delete_status_d_id`='2' ");

                                            $lecture_num = $lecture_rs->num_rows;

                                            if ($lecture_num != 0) {
                                                for ($a = 0; $a < $lecture_num; $a++) {
                                                    $lecture_data = $lecture_rs->fetch_assoc();
                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo ($a + 1) ?></th>
                                                        <td><?php echo ($lecture_data["Grade_name"]) ?></td>
                                                        <td><?php echo ($lecture_data["subject_name"]) ?></td>
                                                        <td><?php echo ($lecture_data["lecture_title"]) ?></td>
                                                        <td><?php echo ($lecture_data["lectuer_dateime"]) ?></td>
                                                        <td>
                                                            <button class="btn btn-info" onclick="updateLectureNoteModelShow(<?php echo ($lecture_data['note_id']) ?>)">Update</button>
                                                        </td>
                                                    </tr>
                                                    <!-- update Model -->
                                                    <div class="modal" tabindex="-1" id="lectureNoteUpdate<?php echo ($lecture_data['note_id']) ?>">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Lecture Note</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-6 mt-2">
                                                                                <p class="fw-bold m-0 mb-2">Grade :</p>
                                                                                <input type="text" class="form-control" value="<?php echo ($lecture_data["Grade_name"]) ?>" disabled />
                                                                            </div>
                                                                            <div class="col-6 mt-2">
                                                                                <p class="fw-bold m-0 mb-2">Subject :</p>
                                                                                <input type="text" class="form-control" value="<?php echo ($lecture_data['subject_name']) ?>" disabled />
                                                                            </div>
                                                                            <div class="col-6 mt-2">
                                                                                <p class="fw-bold m-0 mb-2">Title :</p>
                                                                                <input type="text" class="form-control" value="<?php echo ($lecture_data['lecture_title']) ?>" id="UpdateLectureNoteTitle<?php echo ($lecture_data['note_id']) ?>" />
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <p class="fw-bold m-0 mb-2">Select File :</p>
                                                                                <input type="file" class="form-control" id="UpdateLeassonNotefile<?php echo ($lecture_data['note_id']) ?>" />
                                                                            </div>
                                                                            <div class="col-6 mt-2">
                                                                                <p class="fw-bold m-0 mb-2">Date :</p>
                                                                                <input type="text" class="form-control" value="<?php echo ($lecture_data['lectuer_dateime']) ?>" disabled />
                                                                            </div>
                                                                            <div class="col-12 mt-2">
                                                                                <div class="alert alert-danger d-none" id="UpdateleassonNoteERMsg<?php echo ($lecture_data['note_id']) ?>" role="alert"></div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" onclick="updateLectureNote(<?php echo ($lecture_data['note_id']) ?>)">Save</button>
                                                                    <button type="button" class="btn btn-danger" onclick="DeleteLectureNote(<?php echo ($lecture_data['note_id']) ?>)">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- update Model -->
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>--------</td>
                                                    <td>--------</td>
                                                    <td>--------</td>
                                                    <td>--------</td>
                                                    <td>--------</td>
                                                </tr>
                                            <?php
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div class="col-12 vh-100 d-flex justify-content-center align-items-center">
                        <p class="fs-4 fw-bold text-black-50">Admin Is Not Assign Subjects To You</p>
                    </div>
            <?php
                }
            }


            ?>
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