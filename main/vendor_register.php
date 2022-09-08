<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Register</title>
    <link rel="stylesheet" href="/main/assets/css/vender_register.css">
    
</head>
<body>
  <header id="header">
    <img src="/main/assets/images/main/lazada-logo.png" alt="logo">
    <ul>
    </ul>
  </header>

    <form id="vender_register" method="post" action="vendor_register.php">
      <h2>Vender Register</h2>
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>


        <input type="text" name="bname" placeholder="Business Name" required>

        <input type="text" name="baddress" placeholder="Business Address" required>
    
        <div class="container">
            <input id="default-btn" type="file">
        </div>

        <button class="vender_register--register-btn" name="register_btn">REGISTER</button>

        <p>OR</p>

        <div class="vender_register-form">
            <a class="vender_register--forgot-btn">Forgot Password</a>
            
            <a href="/main/vendor_login.php" class="vender_register--login-btn">Log In</a>
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
                    $bname = filter_input(INPUT_POST, "bname");
                    $baddress = filter_input(INPUT_POST, "baddress");
                    
                    $blank = ";";

                        //generate output for text file
                        $output .= $username;
                        $output .= $blank;
                        $output .= $hashed_password;
                        $output .= $blank;
                        $output .= $bname;
                        $output .= $blank;
                        $output .= $baddress;
                        $output .= "\n";
    
    $status = "Registration succeed!";
    $f = fopen("account_vendor.csv", "r");
                    while (($line = fgetcsv($f)) !== false) {
                            $row = $line[0];
                            $cells = explode(";",$row);
                                if ($cells[0] == $username){
                                    $status = "Invalid username!";
                                    break;
                                }       
                            }         
                    
                    
                    echo "<script type='text/javascript'>alert('$status');</script>";
                    fclose($f);

    if ($status == "Registration succeed!"){
        //open file for output with append mode "a"
        $fp = fopen("account_vendor.csv", "a");
        //write to the file
        fwrite($fp, $output);
        fclose($fp);
        if (file_exists("vendor_view.php")) {
          jump_to_main();
      }
    }


  }
  function jump_to_main(){
      header("Location: vendor_view.php");
  }
?>