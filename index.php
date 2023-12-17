<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || University Collage</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid bg-light">
        <div class="row overflow-hidden">
            <?php include "header.php" ?>

            <div class="main-Image" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12 bg-transparent text-center mt-3">
                    <p class="fs-1 fw-bold text-warning" data-aos="fade-up" data-aos-duration="1000">Hi, Welcome To The Best University Collage In The World ....</p>
                </div>
            </div>

            <div class="col-12 mt-4 mb-2">
                <div class="row">
                    <div class="col-6" data-aos="fade-right" data-aos-duration="1000">
                        <div class="row">
                            <div class="col-12">
                                <p class="fs-2 fw-bold text-primary">ABOUT US ....</p>
                            </div>
                            <div class="col-12">
                                <p class="fw-bold">We provide you with the world's number 1 education and give students work during holidays and assignments related to that lesson at the end of a lesson. <br> And every exam is held without delay.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" data-aos="fade-left" data-aos-duration="1000">
                        <div class="row">
                            <img src="resources/app/boy.jpg">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <hr class="border border-4 border-primary" />
            </div>

            <div class="col-12 mt-2 mb-2 text-center">
                <label class="mx-5 my-2 fw-bold" onclick="window.location='studentSignin.php';"><i class="bi bi-mortarboard fs-2"></i><br>Log As Student</label>
                <label class="mx-5 my-2 fw-bold" onclick="window.location='teacher&officerSignin.php';"><i class="bi bi-person-fill fs-2"></i><br>Log As Teacher</label>
                <label class="mx-5 my-2 fw-bold" onclick="window.location='teacher&officerSignin.php';"><i class="bi bi-person-badge-fill fs-2"></i><br>Log As Acedemic Officer</label>
                <label class="mx-5 my-2 fw-bold" onclick="window.location='admin_signIn.php';"><i class="bi bi-person-square fs-2"></i><br>Log As Admin</label>
            </div>

        </div>
    </div>

    <div class="col-12 mt-2">
        <?php include "footer.php" ?>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script.js"></script>
</body>
<script>
    AOS.init();
</script>

</html>