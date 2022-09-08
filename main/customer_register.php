<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Register</title>
    <link rel="stylesheet" href="./assets/css/customer_register.css">
</head>
<body>
  <header id="header">
    <ul>
        <li class="active"><a href="/Customer/Customer.html">Home</a></li>
        <li><a href="#">My Account</a></li> <!--link for account page-->
        <!-- <li><a href="#">Login</a></li> link for login page -->
    </ul>
  </header>
    <form id="customer_register" method="post" action="customer_register.php">
        <h2>Customer Register</h2>
    
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="text" name="name" placeholder="Name" required>

        <input type="text" name="address" placeholder="Address" required>
    
        <div class="container">
            <input id="default-btn" type="file">
        </div>

        <button class="customer_register--register-btn" name="register_btn">REGISTER</button>

        <p>OR</p>

        <div class="customer_register-form">
            <a class="customer_register--forgot-btn">Forgot Password</a>
            
            <a href="/main/customer_login.php" class="customer_register--login-btn">Log In</a>
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

if (isset($_POST['register_btn'])){
    $output = '';
    $username = filter_input(INPUT_POST, "username");
                    $password = filter_input(INPUT_POST, "password");
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $name = filter_input(INPUT_POST, "name");
                    $address = filter_input(INPUT_POST, "address");
                    
                    $blank = ";";

                        //generate output for text file
                        $output .= $username;
                        $output .= $blank;
                        $output .= $hashed_password;
                        $output .= $blank;
                        $output .= $name;
                        $output .= $blank;
                        $output .= $address;
                        $output .= "\n";
    
    $status = "Registration succeed!";
    $f = fopen("account_customer.csv", "r");
                    while (($line = fgetcsv($f)) !== false) {
                            $row = $line[0];
                            $cells = explode(";",$row);
                                if ($cells[0] == $username){
                                    $status = "Invalid username!";
                                    break;
                                }       
                            }         
                    
                    
                    // echo "<script type='text/javascript'>alert('$status');</script>";
                    fclose($f);

    if ($status == "Registration succeed!"){
        $fp = fopen("account_customer.csv", "a");
        //write to the file
        fwrite($fp, $output);
        fclose($fp);
        if (file_exists("customer.php")) {
            jump_to_main();
        }
    }


}

function jump_to_main(){
    header("Location: /main/customer.php");
}

?>