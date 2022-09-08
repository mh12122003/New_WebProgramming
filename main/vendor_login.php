<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Login</title>
    <link rel="stylesheet" href="/main/assets/css/vender_login.css">
</head>
<body>
    <header id="header">
        <ul>
            <li><a href="#">My Account</a></li> <!--link for account page-->
            <!-- <li><a href="#">Login</a></li> link for login page -->
        </ul>
    </header>

    <form id="vender_login" method="post" action="vendor_login.php">
        <h2>Vender Log In</h2>

    
        <input type="text" name="username" placeholder="Username">

        <input type="text" name ="password" placeholder="Password">

    
        <button class="vender_login--login-btn" name="login_btn">LOG IN</button>

        <p>OR</p>

        <div class="vender_login-form">
            <a class="vender_login--forgot-btn">Forgot Password</a>

            <a href="/main/vendor_register.php" class="vender_login--register-btn">Register</a>
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
        $hashed_password = '';
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
                        
        $blank = ";";
    
                            //generate output for text file
                            $output .= $username;
                            $output .= $blank;
                            $output .= $password;
                            $output .= "\n";
        
        $status = "Wrong username or password, please enter again!";
        $f = fopen("account_vendor.csv", "r");
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
            if (file_exists("vendor_view.php")) {
                jump_to_main();
            }
        }
    
    }

    function jump_to_main(){
        header("Location: vendor_view.php");
    }
?>