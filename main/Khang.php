
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/main/assets/css/profife.css">
</head>
<body>
    <form class="container" method="post" action="Khang.php">
        <div class="main">
            <div class="topbar">
            <button name="go_to_main">HOME</button>
                <button href="">UPDATE</button>
                <button name="log_out" href="">SIGN OUT</button>
            </div>
            <div class="row">
                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar">
                        <div class="card-body">
                            <!-- <img src="image.jpg" class="rounded-circle" width="150"> -->
                            <div class="mt-3">
                                <h3>Username: Khang</h3>
                                <h3>Business Name: Cong Ty</h3>
                                <h3>Business Address: Dia Chi</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-1">
                    <form class="card mb-3 content">
                        <h1 class="m-3 pt-3">My Account</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Username</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <input type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Password</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <input type="text">
                        </div>
                    </div>
                    <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>New password</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <input type="text">
                </div>
            </div>
        </div>
    </form>


</body>

</html>
<?php
if (isset($_POST["log_out"])){
    if (file_exists("vendor_register.php")) {
        header("Location: vendor_register.php");
        unlink("Khang.php");
    }
};
if (isset($_POST["go_to_main"])){
    if (file_exists("vendor_view.php")) {
        header("Location: vendor_view.php");
    }
}
?>
            