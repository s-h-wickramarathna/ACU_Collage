// jquery POST Method

// admin signin
function admin_login() {
    var email = $('#admin_email');
    var password = $('#admin_password');
    $.ajax({
        method: "POST",
        url: "adminSigninProcess.php",
        data: {
            e: email.val(),
            p: password.val(),
        },
    }).then(
        // resolve/success callback 
        function(response) {
            var t = response;

            if (t == "Please Enter Email Address." || t == "Invalid Email Address.") {
                email.addClass("is-invalid");
                $('#adminSigninAlert').html(response);
                $('#adminSigninAlert').removeClass("d-none");

            } else if (t == "Please Enter Password." || t == "Password Must Have Between 5-20 Charactors.") {
                password.addClass("is-invalid");
                $('#adminSigninAlert').html(response);
                $('#adminSigninAlert').removeClass("d-none");

            } else if (t == "Invalid Email Address Or Password") {
                email.addClass("is-invalid");
                password.addClass("is-invalid");
                $('#adminSigninAlert').html(response);
                $('#adminSigninAlert').removeClass("d-none");

            } else if (t == "Success") {
                window.location = 'adminPanel.php';
            } else {
                console.log(t);
            }
        },
        // reject/failure callback 
        function() {
            alert('There was some error!');
        }
    );
}
// admin signin

// Officer's & Teacher's Registration
function Officer_teacher_registration() {
    var userType = $("#R_userType");
    var firstName = $("#R_firstName");
    var lastName = $("#R_lastName");
    var email = $("#R_email");
    var password = $("#R_password");
    var NIC = $("#R_NIC");
    var mobile = $("#R_mobile");
    var gender = $("#R_gender");
    var city = $("#R_city");
    var address = $("#R_address");

    $.ajax({
        type: "POST",
        url: "officer&teacherRegistrationProcess.php",
        data: {
            ut: userType.val(),
            fn: firstName.val(),
            ln: lastName.val(),
            e: email.val(),
            nic: NIC.val(),
            m: mobile.val(),
            g: gender.val(),
            c: city.val(),
            a: address.val(),
        },
    }).then(

        function(response) {
            var t = response;

            if (t == "Please Select User Type.") {
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                userType.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Enter First Name.") {
                userType.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                firstName.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Enter Last Name.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                lastName.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Enter Email Address." || t == "Invalid Email Address.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                email.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Enter NIC No." || t == "Invalid NIC No.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                NIC.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Enter Mobile No." || t == "Invalid Mobile Number.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                mobile.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Select Gender.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                gender.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Select City.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                address.removeClass('is-invalid');
                city.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Please Enter Address." || t == "invalid Address.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.addClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "This User Already Exist.") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Verification code sending failed ???") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').removeClass('d-none');

            } else if (t == "Verification Code Successfully Send Your Email") {
                userType.removeClass('is-invalid');
                firstName.removeClass('is-invalid');
                lastName.removeClass('is-invalid');
                email.removeClass('is-invalid');
                NIC.removeClass('is-invalid');
                mobile.removeClass('is-invalid');
                gender.removeClass('is-invalid');
                city.removeClass('is-invalid');
                address.removeClass('is-invalid');
                $('#officeTeachererrorMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeachererrorMSG').addClass('d-none');
                $('#officeTeacherSuccessMSGContent').html('&nbsp;&nbsp;' + t);
                $('#officeTeacherSuccessMSG').removeClass('d-none');
                setTimeout(function() {
                    window.location.reload();
                }, 3000);

            } else {
                console.log(t);
            }

        },
        function() {
            console.log("There was some error!");
        }


    );

}
// Officer's & Teacher's Registration

function teacherUpdate() {
    var email = $("#T_email");
    var fname = $("#T_fname");
    var lname = $("#T_lname");
    var nic = $("#T_nic");
    var mobile = $("#T_mobile");
    var city = $("#T_city");
    var address = $("#T_address");
    var status = 1;

    $.ajax({
        type: "POST",
        url: "TeacherUpdateProcess.php",
        data: {
            e: email.val(),
            f: fname.val(),
            l: lname.val(),
            n: nic.val(),
            m: mobile.val(),
            c: city.val(),
            a: address.val(),
            s: status
        },
    }).then(
        function(response) {
            if (response == "Success") {
                window.location.reload();
            } else {
                alert(response);
            }
        },
        function() {
            console.log("There was some error!");
        }
    );
}

function teacherDeactive(activeStatus) {
    var email = $("#T_email");
    var status = 2;

    $.ajax({
        type: "POST",
        url: "TeacherUpdateProcess.php",
        data: {
            e: email.val(),
            s: status,
            ac: activeStatus
        },
    }).then(
        function(response) {
            if (response == "Success") {
                window.location.reload();
            }

        },
        function() {
            console.log("There was some error!");
        }
    );
}

function teacherDelete(email) {
    var status = 3;
    $.ajax({
        type: "POST",
        url: "TeacherUpdateProcess.php",
        data: { e: email, s: status },
    }).then(
        function(response) {
            if (response == "Success") {
                window.location = "Manage_teachers.php";
            } else {
                console.log(response);
            }

        },
        function() {
            console.log("There was some error!");
        }
    );
}

var gModel;

function viewAddGradeModel(gid) {
    $('#gradeModel' + gid).modal('show');
}

// jquery GET Method
function AddSectionToTeacher(gid) {
    var temail = $('#teacherEmail' + gid);

    $.ajax({
        method: "GET",
        url: "addSectionteacher.php?e=" + temail.val() + "&gid=" + gid,
    }).then(
        // resolve/success callback 
        function(response) {
            var t = response;

            if (t == "error") {
                temail.addClass('is-invalid');

            } else if (t == "Success") {
                temail.removeClass('is-invalid');
                window.location.reload();
            }
        },
        // reject/failure callback 
        function() {
            alert('There was some error!');
        }
    );
}
// jquery GET Method



function AddGradeToSubject() {
    var Grade = $('#AddGrade123');
    var subject = $('#AddSubject');
    var Teacher = $('#AddTeacher');
    $.ajax({
        type: "POST",
        url: "addGradeToSubject.php",
        data: {
            g: Grade.val(),
            s: subject.val(),
            t: Teacher.val()
        },

    }).then(
        function(response) {
            if (response == "Success") {
                window.location.reload();

            } else if (response == "error") {
                Grade.addClass('is-invalid');
                subject.addClass('is-invalid');
                Teacher.addClass('is-invalid');

            } else {
                alert(response);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function addNewSubject() {
    var subject = $("#newSubject");
    var subject_type = $("#stypeSubject");

    $.ajax({
        type: "GET",
        url: "AddNewSubject.php?s=" + subject.val() + "&t=" + subject_type.val(),
    }).then(

        function(data) {

            if (data == "Success") {
                subject.addClass("is-valid");
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            } else if (data == "Subject Already Exist") {
                subject.removeClass("is-valid");
                subject.addClass("is-invalid");
            } else {
                alert(data);
            }

        },
        function() {
            alert('There was some error!');
        }

    );
}

function searchSubjectConnection() {
    var searchText = $("#searchConnection");

    $.ajax({
        type: "GET",
        url: "searchSubjectConnection.php?st=" + searchText.val(),

    }).then(
        function(data) {
            $('#SubjectSearchDIV').html(data);
        },
        function() {
            alert('There was some error!');
        }
    );

}

function AddGrade() {
    var grade = $("#AddGrade");
    $.ajax({
        type: "GET",
        url: "addGrade.php?g=" + grade.val()
    }).then(
        function(data) {
            if (data == "error") {
                grade.addClass("is-invalid");

            } else if (data == "Success") {
                grade.removeClass("is-invalid");
                grade.addClass("is-valid");
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function showConnectionModel(hsid) {
    $('#connectionModel' + hsid).modal('show');
}

function AddGradeSubjecttoTeacher(thsid) {
    var teacher = $("#ConnectionteacherEmail" + thsid);
    $.ajax({
        type: "GET",
        url: "SaveGradeSubjectConnection.php?e=" + teacher.val() + "&ths=" + thsid,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else if (data == "error") {
                teacher.addClass("is-invalid");
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function DeleteGradeSubjecttoTeacher(thsid) {
    $.ajax({
        type: "GET",
        url: "DeleteGradeSubjectConnection.php?ths=" + thsid,
    }).then(
        function(data) {
            if (data == "success") {
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function viewSingleStudentDetails(email) {
    window.location = "student_singleView.php?sid=" + email;

}

function studentDetailsUpdate(email) {
    var fname = $("#S_fname");
    var lname = $("#S_lname");
    var Sclass = $("#S_class");
    var address = $("#S_address");
    var city = $("#S_city");

    $.ajax({
        type: "POST",
        url: "studentDetailsUpdateProcess.php",
        data: {
            e: email,
            f: fname.val(),
            l: lname.val(),
            a: address.val(),
            c: city.val()
        },
    }).then(

        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}

function studentDeactivate(email) {

    $.ajax({
        type: "GET",
        url: "studentActiveDeactivProcess.php?e=" + email,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            }

        },
        function() {
            alert('There was some error!');
        }
    );

}

function studentDelete(email) {
    $.ajax({
        type: "GET",
        url: "studentDeleteProcess.php?e=" + email,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location = "manage_student.php";
            }

        },
        function() {
            alert('There was some error!');
        }
    );

}

function loadteachers(gid) {

    var subject = $('#sheduleSubject').val();

    $.ajax({
        type: "GET",
        url: "loadteacher.php?s=" + subject + "&g=" + gid,
    }).then(
        function(data) {
            $("#loadteacherSH").html(data);
        },
        function() {
            alert('There was some error!');
        }
    );

}

function AddClassShedule(gid) {

    var HeldDate = $('#HeldDate');
    var subject = $('#sheduleSubject');
    var teacher = $('#loadteacherSH');
    var startTime = $('#st_time');
    var endTime = $('#En_time');

    $.ajax({
        type: "POST",
        url: "AddClassSheduleProcess.php",
        data: {
            h: HeldDate.val(),
            s: subject.val(),
            t: teacher.val(),
            st: startTime.val(),
            e: endTime.val(),
            g: gid
        }
    }).then(
        function(data) {
            if (data == "Successfully Added" || data == "Lecture Already Listed ....") {
                HeldDate.removeClass("is-invalid");
                subject.removeClass("is-invalid");
                teacher.removeClass("is-invalid");
                startTime.removeClass("is-invalid");
                endTime.removeClass("is-invalid");
                $("#lectureSheduleMSG").html(data);
                $("#lectureSheduleMSG").removeClass("d-none");
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            } else if (data == "1") {
                $("#lectureSheduleMSG").addClass("d-none");
                HeldDate.addClass("is-invalid");
                subject.addClass("is-invalid");
                teacher.addClass("is-invalid");
                startTime.addClass("is-invalid");
                endTime.addClass("is-invalid");
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}

function showlectureUpdateModel(lid) {
    $('#lectureUpdate' + lid).modal('show');
}

function updateLecture(shid) {
    var stime = $("#l_start" + shid);
    var etime = $("#l_end" + shid);
    var teacher = $("#l_teacher" + shid);

    $.ajax({
        type: "POST",
        url: "UpdateClassShedule.php",
        data: {
            s: stime.val(),
            e: etime.val(),
            t: teacher.val(),
            sh: shid
        },
    }).then(
        function(data) {
            if (data == "error") {
                stime.addClass("is-invalid");
                etime.addClass("is-invalid");
                teacher.addClass("is-invalid");

            } else if (data == "success") {
                stime.removeClass("is-invalid");
                etime.removeClass("is-invalid");
                teacher.removeClass("is-invalid");
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function cancelLecture(shid) {
    $.ajax({
        type: "GET",
        url: "CancelLectureProcess.php?sh=" + shid,

    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function searchLectures(gid) {
    var date = $("#searchDate");
    var subject = $("#searchSubject");

    $.ajax({
        type: "POST",
        url: "searchsheduleLectures.php",
        data: {
            g: gid,
            d: date.val(),
            s: subject.val()
        },
    }).then(
        function(data) {
            $("#SearchLeactureLoadDiv").html(data);

        },
        function() {
            alert('There was some error!');
        }
    );

}

function img_pathUrl(input) {
    $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

function adminUpdate(email) {
    var fname = $('#a_fname');
    var lname = $('#a_lname');
    var mobile = $('#a_mobile');
    var email = $('#a_email');
    var files = $('#img_file')[0].files[0];

    var f = new FormData();
    f.append('file', files);
    f.append('f', fname.val());
    f.append('l', lname.val());
    f.append('m', mobile.val());
    f.append('e', email.val());


    $.ajax({
        type: "POST",
        url: "UpdateAdminProfile.php",
        data: f,
        contentType: false,
        processData: false,

    }).then(
        function(data) {
            if (data == "Invalid Image TypeSuccess") {
                alert("Invalid Image Type");
            } else if (data == "Success") {
                window.location.reload();
            }

        },
        function() {
            alert('There was some error!');
        }
    );

}

function Logout() {
    $.ajax({
        type: "GET",
        url: "logOutProcess.php",
    }).then(
        function(data) {
            if (data == "1") {
                window.location = "index.php";
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function officerTeacher_login() {
    var email = $('#tf_email');
    var password = $('#tf_password');

    var f = new FormData();
    f.append('e', email.val());
    f.append('p', password.val());

    $.ajax({
        type: "POST",
        url: "teacherOfficerSignIn.php",
        data: f,
        contentType: false,
        processData: false,
    }).then(
        function(data) {
            if (data == "Academic_Officer") {
                window.location = "AcademicOfficerPanel.php";

            } else if (data == "teacher") {
                window.location = "teacherPanel.php";

            } else if (data == "show Model") {
                $("#showtfverificationM").modal('show');

            } else if (data == "Enter Email Address") {
                password.removeClass("is-invalid");
                email.addClass("is-invalid");
                $("#tfSigninAlert").html(data);
                $("#tfSigninAlert").removeClass('d-none');

            } else if (data == "Enter Password Address") {
                email.removeClass("is-invalid");
                password.addClass("is-invalid");
                $("#tfSigninAlert").html(data);
                $("#tfSigninAlert").removeClass('d-none');

            } else if (data == "Invalid Email Address Or Password") {
                email.addClass("is-invalid");
                password.addClass("is-invalid");
                $("#tfSigninAlert").html(data);
                $("#tfSigninAlert").removeClass('d-none');
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}

function verifiytfAccount() {
    var code = $('#tf_vcode');
    var email = $('#tf_email');

    var f = new FormData();
    f.append('e', email.val());
    f.append('v', code.val());

    $.ajax({
        type: "POST",
        url: "tfAccountVerifyProcess.php",
        data: f,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Academic_Officer") {
                window.location = "AcademicOfficerPanel.php";

            } else if (data == "teacher") {
                window.location = "teacherPanel.php";

            } else if (data == "Enter Verification Code" || data == "Invalid Verification Code") {
                code.addClass("is-invalid");
                $("#tfVcodeAlert").html(data);
                $("#tfVcodeAlert").removeClass('d-none');
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function loadSubjectLeasson(email) {
    var grade = $('#noteleassonGrade');

    var f = new FormData();
    f.append('g', grade.val());
    f.append('e', email);

    $.ajax({
        type: "POST",
        url: "loadAddLeasonNoteSubject.php",
        data: f,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            $('#noteleassonSubject').html(data);
        },
        function() {
            alert('There was some error!');
        }
    );

}

function AddLeasssonNote(email) {
    var grade = $('#noteleassonGrade');
    var subject = $('#noteleassonSubject');
    var title = $('#AddLeassonNotetitle');
    var file = $('#AddLeassonNotefile');

    var f = new FormData();
    f.append('g', grade.val());
    f.append('e', email);
    f.append('s', subject.val());
    f.append('t', title.val());
    f.append('f', file[0].files[0]);

    $.ajax({
        type: "POST",
        url: "AddNewLeassonNoteProcess.php",
        data: f,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Please Select Leasson_Note") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                title.removeClass('is-invalid');
                file.addClass('is-invalid');
                $('#leassonNoteERMsg').html(data);
                $('#leassonNoteERMsg').removeClass('d-none');


            } else if (data == "Please Select grade") {
                grade.addClass('is-invalid');
                subject.removeClass('is-invalid');
                title.removeClass('is-invalid');
                file.removeClass('is-invalid');
                $('#leassonNoteERMsg').html(data);
                $('#leassonNoteERMsg').removeClass('d-none');

            } else if (data == "Please Enter Title") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                title.addClass('is-invalid');
                file.removeClass('is-invalid');
                $('#leassonNoteERMsg').html(data);
                $('#leassonNoteERMsg').removeClass('d-none');

            } else if (data == "Please Select Subject") {
                grade.removeClass('is-invalid');
                subject.addClass('is-invalid');
                title.removeClass('is-invalid');
                file.removeClass('is-invalid');
                $('#leassonNoteERMsg').html(data);
                $('#leassonNoteERMsg').removeClass('d-none');

            } else if (data == "Invalid File Type ....") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                title.removeClass('is-invalid');
                file.addClass('is-invalid');
                $('#leassonNoteERMsg').html(data);
                $('#leassonNoteERMsg').removeClass('d-none');

            } else if (data == "Lecture Note Already Exist ....") {
                grade.addClass('is-invalid');
                subject.addClass('is-invalid');
                title.addClass('is-invalid');
                file.addClass('is-invalid');
                $('#leassonNoteERMsg').html(data);
                $('#leassonNoteERMsg').removeClass('d-none');

            } else if (data == "Success") {
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function updateLectureNoteModelShow(nid) {
    $('#lectureNoteUpdate' + nid).modal('show');
}

function updateLectureNote(nid) {
    var title = $('#UpdateLectureNoteTitle' + nid);
    var file = $('#UpdateLeassonNotefile' + nid);

    var f = new FormData();
    f.append("n", nid);
    f.append("t", title.val());
    f.append("f", file[0].files[0]);

    $.ajax({
        type: "POST",
        url: "UpdateLectureNote.php",
        data: f,
        contentType: false,
        processData: false
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();

            } else if (data == "Invalid File Type ....Success") {
                title.removeClass('is-invalid');
                file.addClass('is-invalid');
                $('#UpdateleassonNoteERMsg' + nid).html("Invalid File Type ....");
                $('#UpdateleassonNoteERMsg' + nid).removeClass('d-none');

            } else if (data == "Please Enter Title ....") {
                title.addClass('is-invalid');
                file.removeClass('is-invalid');
                $('#UpdateleassonNoteERMsg' + nid).html(data);
                $('#UpdateleassonNoteERMsg' + nid).removeClass('d-none');

            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}

function DeleteLectureNote(nid) {
    $.ajax({
        type: "GET",
        url: "DeleteLectureNote.php?n=" + nid,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();

            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function loadSubjectAssignment(email) {
    var grade = $('#AddAssignmentGrade');

    var f = new FormData();
    f.append('g', grade.val());
    f.append('e', email);

    $.ajax({
        type: "POST",
        url: "loadAddAssignmentSubject.php",
        data: f,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            $('#noteAssigmentSubject').html(data);
        },
        function() {
            alert('There was some error!');
        }
    );
}

function AddNewAssignment(email) {
    var grade = $('#AddAssignmentGrade');
    var subject = $('#noteAssigmentSubject');
    var term = $('#AddAssignmentTterm');
    var title = $('#AddAssignmenttitle');
    var file = $('#AddAssignmentfile');
    var date = $('#AddAssignmentDate');

    var form = new FormData();
    form.append("e", email);
    form.append("g", grade.val());
    form.append("s", subject.val());
    form.append("t", term.val());
    form.append("ttl", title.val());
    form.append("f", file[0].files[0]);
    form.append("d", date.val());

    $.ajax({
        type: "POST",
        url: "AddNewAssignmentProcess.php",
        data: form,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Please Select Assignment") {
                grade.removeClass('is-invalid');
                title.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                term.removeClass('is-invalid');
                date.removeClass('is-invalid');
                file.addClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "Please Select Grade") {
                file.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                title.removeClass('is-invalid');
                term.removeClass('is-invalid');
                date.removeClass('is-invalid');
                grade.addClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "Please Select Subject") {
                grade.removeClass('is-invalid');
                title.removeClass('is-invalid');
                file.removeClass('is-invalid');
                term.removeClass('is-invalid');
                date.removeClass('is-invalid');
                subject.addClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "Please Enter Title") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                term.removeClass('is-invalid');
                date.removeClass('is-invalid');
                file.removeClass('is-invalid');
                title.addClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "please Select Term") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                title.removeClass('is-invalid');
                date.removeClass('is-invalid');
                file.removeClass('is-invalid');
                term.addClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "Please Select Expire Date") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                term.removeClass('is-invalid');
                title.removeClass('is-invalid');
                file.removeClass('is-invalid');
                date.addClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "This Assignment Already Exist") {
                grade.removeClass('is-invalid');
                subject.removeClass('is-invalid');
                term.removeClass('is-invalid');
                date.removeClass('is-invalid');
                file.removeClass('is-invalid');
                title.removeClass('is-invalid');
                $('#AddAssingmentERMsg' + nid).html(data);
                $('#AddAssingmentERMsg' + nid).removeClass('d-none');

            } else if (data == "Succcess") {
                window.location.reload();

            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}

function ShowUpdateAssignmentModel(aid) {
    $('#UpdateAssignmentModel' + aid).modal('show');
}

function updateAssignment(aid) {
    var title = $('#UpdateAssignmentTitle' + aid);
    var date = $('#UpdateAssignmentEXDate' + aid);
    var file = $('#UpdateAssignmentfile' + aid);

    var form = new FormData();
    form.append("t", title.val());
    form.append("d", date.val());
    form.append("a", aid);
    form.append("f", file[0].files[0]);

    $.ajax({
        type: "POST",
        url: "UpdateAssignmentProcess.php",
        data: form,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Please Select Assignment File ....") {
                title.removeClass("is-invalid");
                date.removeClass("is-invalid");
                file.addClass("is-invalid");

            } else if (data == "Please Select Expire Date Time") {
                title.removeClass("is-invalid");
                file.removeClass("is-invalid");
                date.addClass("is-invalid");

            } else if (data == "Please Enter Title") {
                date.removeClass("is-invalid");
                file.removeClass("is-invalid");
                title.addClass("is-invalid");

            } else if (data == "Success") {
                window.location.reload();

            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}

function DeleteAssignments(aid) {
    $.ajax({
        type: "GET",
        url: "DeleteAssignmentProcess.php?a=" + aid,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function img_pathUrl1(input) {
    $('#img_url1')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

function teacherUpdate(email) {
    var fname = $("#t_fname");
    var lname = $("#t_lname");
    var mobile = $("#t_mobile");

    var f = new FormData();
    f.append('f', fname.val());
    f.append('l', lname.val());
    f.append('m', mobile.val());
    f.append('e', email);


    $.ajax({
        type: "POST",
        url: "UpdateTeacherProfileProcess.php",
        data: f,
        contentType: false,
        processData: false,

    }).then(
        function(data) {
            if (data == "Please Enter First Name") {
                fname.addClass("is-invalid");
                lname.removeClass("is-invalid");
                mobile.removeClass("is-invalid");

            } else if (data == "Please Enter Last Name") {
                lname.addClass("is-invalid");
                fname.removeClass("is-invalid");
                mobile.removeClass("is-invalid");

            } else if (data == "Success") {
                window.location.reload();

            } else {
                alert(data);
            }

        },
        function() {
            alert('There was some error!');
        }
    );

}

function img_pathUrl2(input) {
    $('#img_url2')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

function AcadimicUpdate(email) {
    var fname = $("#ac_fname");
    var lname = $("#ac_lname");
    var mobile = $("#ac_mobile");

    var f = new FormData();
    f.append('f', fname.val());
    f.append('l', lname.val());
    f.append('m', mobile.val());
    f.append('e', email);


    $.ajax({
        type: "POST",
        url: "UpdateTeacherProfileProcess.php",
        data: f,
        contentType: false,
        processData: false,

    }).then(
        function(data) {
            if (data == "Please Enter First Name") {
                fname.addClass("is-invalid");
                lname.removeClass("is-invalid");
                mobile.removeClass("is-invalid");

            } else if (data == "Please Enter Last Name") {
                lname.addClass("is-invalid");
                fname.removeClass("is-invalid");
                mobile.removeClass("is-invalid");

            } else if (data == "Success") {
                window.location.reload();

            } else if (data == "Invalid Image Type") {
                alert(data);

            } else {
                alert(data);
            }

        },
        function() {
            alert('There was some error!');
        }
    );

}

function LoadSubjectStudent() {
    var grade_id = $('#addS_grade').val();
    $.ajax({
        type: "GET",
        url: "loadStudentRegistrationProcess.php?g=" + grade_id,
    }).then(
        function(data) {
            $("#Show_loaddedSubjects").html(data);
        },
        function() {
            alert('There was some error!');
        }
    );

}

function studentRegistration() {
    var s_fname = $('#addS_fname');
    var s_lname = $('#addS_lname');
    var s_email = $('#addS_email');
    var s_birthday = $('#addS_bithday');
    var s_nic = $('#addS_nic');
    var s_gender = $('#addS_gender');
    var s_city = $('#addS_city');
    var s_address = $('#addS_address');
    var s_grade = $('#addS_grade');
    var p_fname = $('#addS_pfname');
    var p_lname = $('#addS_plname');
    var p_nic = $('#addS_pnic');
    var p_mobile = $('#addS_pmobile');
    var ols1 = $("#showSubSubjectsOL1");
    var ols2 = $("#showSubSubjectsOL2");
    var ols3 = $("#showSubSubjectsOL3");
    var als1 = $("#showSubSubjectsAL1");
    var als2 = $("#showSubSubjectsAL2");
    var als3 = $("#showSubSubjectsAL3");

    var form = new FormData();
    form.append("sf", s_fname.val());
    form.append("sl", s_lname.val());
    form.append("se", s_email.val());
    form.append("sb", s_birthday.val());
    form.append("sn", s_nic.val());
    form.append("sg", s_gender.val());
    form.append("sc", s_city.val());
    form.append("sgrd", s_grade.val());
    form.append("sad", s_address.val());
    form.append("pf", p_fname.val());
    form.append("pl", p_lname.val());
    form.append("pn", p_nic.val());
    form.append("pm", p_mobile.val());
    form.append("ol1", ols1.val());
    form.append("ol2", ols2.val());
    form.append("ol3", ols3.val());
    form.append("al1", als1.val());
    form.append("al2", als2.val());
    form.append("al3", als3.val());

    $.ajax({
        type: "POST",
        url: "StudentRegistrationProcess.php",
        data: form,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Please Enter Student First name") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_fname.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Student Last name") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_lname.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Student Email Address" || data == "Invalid Email Address !!!") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_email.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select Student Birthday") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_birthday.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select Student Gender") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_gender.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select Student City") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_city.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Student Address") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                s_address.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Parent First Name") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_fname.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Parent Last Name") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_lname.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Parent NIC No") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select Student Grade") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                s_grade.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Enter Parent Mobile No" || data == "Invalid Mobile Number !!!") {
                // subjects
                ols1.removeClass('is-invalid');
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                s_lname.removeClass('is-invalid');
                p_mobile.addClass('is-invalid');
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select O/L First Subject") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                ols1.addClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select O/L Second Subject") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols1.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                ols2.addClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select O/L Third Subject") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                ols3.addClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select A/L First Subject") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                als1.addClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select A/L Second Subject") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                als2.addClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Please Select A/L Third Subject") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als3.addClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Email Address Already Exist ....") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Verification code sending failed ???") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").removeClass("d-none");

            } else if (data == "Verification Code Successfully Send Your Email") {
                s_grade.removeClass('is-invalid');
                s_fname.removeClass('is-invalid');
                s_email.removeClass('is-invalid');
                s_birthday.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                s_gender.removeClass('is-invalid');
                s_city.removeClass('is-invalid');
                s_address.removeClass('is-invalid');
                p_fname.removeClass('is-invalid');
                p_lname.removeClass('is-invalid');
                s_nic.removeClass('is-invalid');
                p_mobile.removeClass('is-invalid');
                p_nic.removeClass('is-invalid');
                // subjects
                ols2.removeClass('is-invalid');
                ols3.removeClass('is-invalid');
                als1.removeClass('is-invalid');
                als2.removeClass('is-invalid');
                ols1.removeClass('is-invalid');
                als3.removeClass('is-invalid');
                // subjects
                $("#showStudentRejistrationError").html(data);
                $("#showStudentRejistrationError").addClass("alert-success");
                $("#showStudentRejistrationError").removeClass("d-none");
                setTimeout(function() {
                    window.location.reload();
                }, 2000)

            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );

}


function student_login() {
    var s_email = $('#s_email');
    var s_password = $('#s_password');

    var form = new FormData();
    form.append('se', s_email.val());
    form.append('sp', s_password.val());

    $.ajax({
        type: "POST",
        url: "studentSigninprocess.php",
        data: form,
        contentType: false,
        processData: false
    }).then(
        function(data) {
            if (data == "1") {
                $('#showtfverificationMStudent').modal("show");

            } else if (data == "2") {
                window.location = "studentPanel.php";

            } else if (data == "Please Enter Email Address ...." || data == "Invalid Email Address ....") {
                s_password.removeClass("is-invalid");
                s_email.addClass("is-invalid");
                $("#studentSigninAlert").html(data);
                $("#studentSigninAlert").removeClass("d-none");

            } else if (data == "Please Enter Password ....") {
                s_email.removeClass("is-invalid");
                s_password.addClass("is-invalid");
                $("#studentSigninAlert").html(data);
                $("#studentSigninAlert").removeClass("d-none");

            } else if (data == "Invalid Email Or Password ....") {
                s_email.addClass("is-invalid");
                s_password.addClass("is-invalid");
                $("#studentSigninAlert").html(data);
                $("#studentSigninAlert").removeClass("d-none");

            } else if (data == "3") {
                $("#studentSigninAlert").html("Your In a Trail Period");
                $("#studentSigninAlert").removeClass(" d-none");

                setTimeout(function() {
                    window.location = "studentPanel.php";
                }, 2000);

            } else if (data == "your Account Is Suspend") {
                s_email.removeClass("is-invalid");
                s_password.removeClass("is-invalid");
                $("#studentSigninAlert").html(data);
                $("#studentSigninAlert").removeClass("d-none");
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function verifiyStudentAccount() {
    var student_vcode = $('#student_vcode');
    var s_email = $('#s_email');

    var form = new FormData();
    form.append("sv", student_vcode.val());
    form.append("se", s_email.val());


    $.ajax({
        type: "POST",
        url: "StudentVerificationProcess.php",
        data: form,
        contentType: false,
        processData: false
    }).then(
        function(data) {
            if (data == "Please Enter Verification Code" || data == "Invalid Verification Code") {
                student_vcode.addClass("is-invalid");
                $("#studentVcodeAlert").html(data);
                $("#studentVcodeAlert").removeClass("d-none");

            } else if (data == "1") {
                window.location = "studentPanel.php";
            } else {
                alert(data);
            }
        },
        function() {
            alert('There was some error!');
        }
    );
}

function uploadAssignments(aid, sid, x) {
    var file = $('#assignmentAnswerUpload' + x);
    var form = new FormData();
    form.append("a", aid);
    form.append("s", sid);
    form.append("f", file[0].files[0]);

    $.ajax({
        type: "POST",
        url: "assignmentUploadProcess.php",
        data: form,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            window.location.reload();

        },
        function() {
            alert('There was some error!');
        }
    );
}

function studentProfileDetailsUpdate(email) {
    var fname = $('#us_fname');
    var lname = $('#us_lname');
    var nic = $('#us_nic');
    var city = $('#us_city');
    var address = $('#us_address');

    var form = new FormData();
    form.append('f', fname.val());
    form.append('l', lname.val());
    form.append('n', nic.val());
    form.append('c', city.val());
    form.append('a', address.val());
    form.append('e', email);

    $.ajax({
        type: "POST",
        url: "StudentProfileDetailsUpdateProcess.php",
        data: form,
        contentType: false,
        processData: false
    }).then(
        function(data) {
            alert(data);
        },
        function() {
            alert("There was some error!");
        }
    );

}

function selectsubmitedAnswersheet() {
    var grade = $('#teacherGradeAssignment');
    var subject = $('#teacherSubjectAssignment');

    var form = new FormData();
    form.append("g", grade.val());
    form.append("s", subject.val());

    $.ajax({
        type: "POST",
        url: "LoadSubmitedAnswerSheet.php",
        data: form,
        contentType: false,
        processData: false
    }).then(
        function(data) {
            if (data == "1") {
                grade.addClass("is-invalid");
                subject.addClass("is-invalid");
            } else {
                grade.removeClass("is-invalid");
                subject.removeClass("is-invalid");
                $("#loadAnswerSheets").html(data);
            }

            // alert(data);
        },
        function() {
            alert("There was some error!");
        }
    );
}

function uploadAssignmentMarks(aid, temail, ths) {
    var file = $('#studentAssignmentmSheet' + aid);

    var form = new FormData();
    form.append("f", file[0].files[0]);
    form.append("a", aid);
    form.append("t", temail);
    form.append("s", ths);

    $.ajax({
        type: "POST",
        url: "addStudentMarksToOfficersProcess.php",
        data: form,
        contentType: false,
        processData: false
    }).then(
        function(data) {
            if (data == "You are not a teacher") {
                $('#AssignmentStudentMarksheet').html(data);

            } else if (data == "Please Select Mark Sheet") {
                $('#AssignmentStudentMarksheet').html(data);

            } else if (data == "Success") {
                window.location.reload();
            } else {
                alert(data);
            }
        },
        function() {
            alert("There was some error!");
        }
    );
}

function submitedStudentMarksConfirm(student_mark_id) {
    $.ajax({
        type: "GET",
        url: "ChangeStudentMarksTask.php?id=" + student_mark_id,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else {
                alert(data);
            };
        },
        function() {
            alert("There was some error!");
        }
    );
}

function loadSubjectToGradeMarks() {
    var grade_id = $("#MarksAssignGrade");
    $.ajax({
        type: "GET",
        url: "loadAssignMarksToStudent.php?g=" + grade_id.val(),
    }).then(
        function(data) {
            $("#marksAssignSubject").html(data);

        },
        function() {
            alert("There was some error!");
        }
    );
}

function showAddMarksmodel(aid) {
    $('#showAddmarksStudentModel' + aid).modal('show');
}

function addmarkstoStudent(aid) {
    var marks = $("#studentmarks_Assign" + aid);
    $.ajax({
        type: "GET",
        url: "AddmarkstoStudents.php?a=" + aid + "&m=" + marks.val()
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            }
        },
        function() {
            alert("There was some error!");
        }
    );
}

function loadStudentMarksDetails() {
    var grade = $("#MarksAssignGrade").val();
    var subject = $("#marksAssignSubject").val();


    window.location = "releaseMarksToStudent.php?g=" + grade + "&s=" + subject;
}

function uptoNextGrade(email) {
    var fee = $("#enrolmtFee").val();
    $.ajax({
        type: "GET",
        url: "upToGradeStudentProcess.php?e=" + email + "&f=" + fee,

    }).then(
        function(data) {
            if (data == "9") {
                $("#btnbtnnextgrade").addClass("d-none");
                $("#OLMainSubjectTOSubject").removeClass("d-none");

            } else if (data == "12") {
                $("#btnbtnnextgrade").addClass("d-none");
                $("#ALMainSubjectTOSubject").removeClass("d-none");

            } else if (data == "Success") {
                window.location.reload();

            } else if (data == "p") {
                fee.addClass("is-invalid");
            } else {
                alert(data);
            }
        },
        function() {
            alert("There was some error!");
        }
    );
}

function olSubjectchange(email) {
    var s1 = $('#olmSubject1');
    var s2 = $('#olmSubject2');
    var s3 = $('#olmSubject3');
    var fee = $("#enrolmtFee");

    var form = new FormData();
    form.append("s1", s1.val());
    form.append("s2", s2.val());
    form.append("s3", s3.val());
    form.append("f", fee.val());
    form.append("e", email);

    $.ajax({
        type: "POST",
        url: "ChangeStudentSubjectOL.php",
        data: form,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else if (data == "1") {
                s1.addClass("is-invalid");
                s2.addClass("is-invalid");
                s3.addClass("is-invalid");
            } else if (data == "p") {
                fee.addClass("is-invalid");
            } else {
                alert(data);
            }
        },
        function() {
            alert("There was some error!");
        }
    );

}

function ALSubjectchange(email) {
    var s1 = $('#');
    var s2 = $('#');
    var s3 = $('#');
    var fee = $("#enrolmtFee");

    var form = new FormData();
    form.append("s1", s1.val());
    form.append("s2", s2.val());
    form.append("s3", s3.val());
    form.append("f", fee.val());
    form.append("e", email);

    $.ajax({
        type: "POST",
        url: "ChangeStudentSubjectAL.php",
        data: form,
        contentType: false,
        processData: false

    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();
            } else if (data == "1") {
                s1.addClass("is-invalid");
                s2.addClass("is-invalid");
                s3.addClass("is-invalid");
            } else if (data == "p") {
                fee.addClass("is-invalid");
            } else {
                alert(data);
            }
        },
        function() {
            alert("There was some error!");
        }
    );

}

function markPaid(eid) {
    $.ajax({
        type: "GET",
        url: "markAsPaid.php?e=" + eid,
    }).then(
        function(data) {
            if (data == "Success") {
                window.location.reload();

            }
        },
        function() {
            alert("There was some error!");
        }
    );
}

function selectSujectTOgrade() {
    var grade = $("#AddGrade123").val();;
    $.ajax({
        type: "GET",
        url: "selectGradetoSubject.php?g=" + grade,
    }).then(
        function(data) {
            $("#AddSubject").html(data);
        },
        function() {
            alert("There was some error!");
        }
    );
}