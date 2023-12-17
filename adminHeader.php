<?php
session_start();
if(isset($_SESSION["admin"])){
    $admin_fullName = $_SESSION["admin"]["fname"]." ".$_SESSION["admin"]["lname"];
    $admin_email = $_SESSION["admin"]["email"]; 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frameworks/bootstrap.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="col-12">
        <div class="row">
            <div class="col-4 ps-3 my-1">
                <img src="resources/app/university_logo.png" height="100px">
            </div>
            <div class="col-8 text-end pe-3">
                <p class="m-0 fs-2 mt-3">University Of ACU</p>
                <p class="m-0">Manager : <span class="fw-bold text-black-50"><?php echo($admin_fullName) ?></span></p>
            </div>
            <div class="col-8 offset-4">
                <hr class="m-0 border border-3 border-dark">
            </div>
        </div>
    </div>

</body>

</html>