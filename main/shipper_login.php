<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipper Login</title>
    <link rel="stylesheet" href="/main/assets/css/shipper_login.css">
</head>
<body>
    <header id="header">
        <ul>
            <li><a href="#">My Account</a></li> <!--link for account page-->
            <!-- <li><a href="#">Login</a></li> link for login page -->
        </ul>
    </header>

    <form id="shipper_login" method="post" action="shipper_login.php">
        <h2>Shipper Log In</h2>
    
        <input type="text" name="username" placeholder="Username">

        <input type="password" name="password" placeholder="Password">

    
        <button class="shipper_login--login-btn" name="login_btn">LOG IN</button>

        <p>OR</p>

        <div class="shipper_login-form">
            <a class="shipper_login--forgot-btn">Forgot Password</a>

            <a href="/main/shipper_register.php" class="shipper_login--register-btn">Register</a>
        </div>
    </form>

    <footer id="footer">
        <ul>
            <li><a href="/Customer/About.html">About</a></li>
            <li><a href="/Customer/Copyright.html">Copyright</a></li>
            <li><a href="/Customer/Privacy.html">Privacy</a></li>
            <li><a href="/Customer/Help.html">Help</a></li>
        </ul>
    </footer>
</body>
</html>

<?php
    
    if (isset($_POST['login_btn'])){
        $output = '';
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
                        
        $blank = ";";
    
                            //generate output for text file
                            $output .= $username;
                            $output .= $blank;
                            $output .= $password;
                            $output .= "\n";
        
        $status = "Wrong username or password, please enter again!";
        $f = fopen("account_shipper.csv", "r");
                        while (($line = fgetcsv($f)) !== false) {
                                $row = $line[0];
                                $cells = explode(";",$row);
                                $hashed_password = $cells[1];
                                    if ($cells[0] == $username){

                                        if(password_verify($password, $hashed_password)){
                                            $status = "Login succeed!";
                                            break;
                                        }
                                        
                                    }       
                                }         
                        
                        
                        echo "<script type='text/javascript'>alert('$status');</script>";
                        fclose($f);
    
        if ($status == "Login succeed!"){
            if (file_exists("shipper_page.php")) {
                jump_to_main();
            }
            
        }
    
    }
    function jump_to_main(){
        header("Location: shipper_page.php");
    }
?>