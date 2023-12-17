<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACU || Admin Signin</title>
    <link rel="icon" href="resources/app/university_logo.png" />
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- form side -->
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 text-center mt-2">
                        <img src="resources/app/university_logo.png" height="150px">
                    </div>
                    <div class="col-12 mt-3">
                        <p class="m-0 fw-bold text-primary fs-4">Log As Admin</p>
                        <hr class="border border-4 border-primary">
                    </div>
                    <!-- form -->
                    <div class="col-12 mt-3">
                        <div class="row justify-content-center">
                            <div class="col-11 shadow rounded-3">
                                <div class="row g-3 my-3">
                                    <div class="col-12">
                                        <p class="fw-bold">Enter Email</p>
                                        <input type="email" class="form-control" placeholder="Email" id="admin_email" required />
                                    </div>
                                    <div class="col-12">
                                        <p class="fw-bold">Enter Password</p>
                                        <input type="password" class="form-control" placeholder="Password" id="admin_password" required />
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-danger m-0 d-none" id="adminSigninAlert" role="alert">
                                            
                                        </div>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary" onclick="admin_login();" type="submit">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- form -->

                </div>
            </div>
            <!-- form side -->

            <!-- side Image -->
            <div class="col-12 col-md-6 admin_Logo_Image d-flex align-items-end justify-content-center mt-3 mt-md-0">
                <p class="m-0 fw-bold ">2022||ACU University.lk</p>
            </div>
            <!-- side Image -->

        </div>
    </div>

    <script src="frameworks/jquery_v3.6.2.js"></script>
    <script src="script.js"></script>
</body>

</html>