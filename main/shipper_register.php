<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipper Register</title>
    <link rel="stylesheet" href="/main/assets/css/shipper_register.css">
</head>
<body>
  <header id="header">
    <ul>
        <li><a href="#">My Account</a></li> <!--link for account page-->
        <!-- <li><a href="#">Login</a></li> link for login page -->
    </ul>
  </header>
    <form id="shipper_register" method="post" action="shipper_register.php">
    
        <h2>Shipper Register</h2>
    
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <div class="dropdown">
          <div class="select">
            <span class="selected">Select your preferred distribution hub</span>
            <div class="caret"></div>
          </div>
          <ul class="menu">
            <li>Hub 1 - 1st Street 1, District 1</li>
            <li>Hub 2 - 2nd Street 2, District 2</li>
            <li>Hub 3 - 3rd Street 3, District 3</li>
          </ul>
        </div>

        <script>
          const dropdowns = document.querySelectorAll('.dropdown');
          dropdowns.forEach(dropdown => {
            const select = dropdown.querySelector('.select');
            const caret = dropdown.querySelector('.caret');
            const menu = dropdown.querySelector('.menu');
            const options = dropdown.querySelectorAll('.menu li');
            const selected = dropdown.querySelector('.selected');

            select.addEventListener('click', () => {
              select.classList.toggle('select-clicked');
              menu.classList.toggle('menu-open');
            });

            options.forEach(option => {
              option.addEventListener('click', () => {
                selected.innerText = option.innerText;
                select.classList.remove('select-clicked');
                menu.classList.remove('menu-open');
                options.forEach(option => {
                  option.classList.remove('active1');
                });
                option.classList.add('active1');
              });
            });
          });
        </script>


        <button class="shipper_register--register-btn" name="register_btn">REGISTER</button>

        <p>OR</p>

        <div class="shipper_register-form">
            <a class="shipper_register--forgot-btn">Forgot Password</a>
            
            <a href="/main/shipper_login.php" class="shipper_register--login-btn">Log In</a>
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
                    $hub = filter_input(INPUT_POST, "hub");
                    
                    $blank = ";";

                        //generate output for text file
                        $output .= $username;
                        $output .= $blank;
                        $output .= $hashed_password;
                        $output .= $blank;
                        $output .= "\n";
    
    $status = "Registration succeed!";
    $f = fopen("account_shipper.csv", "r");
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
        $fp = fopen("account_shipper.csv", "a");
        //write to the file
        fwrite($fp, $output);
        fclose($fp);
        if (file_exists("shipper_page.php")) {
          jump_to_main();
      }
    }

    
  }
  
  function jump_to_main(){
      header("Location: /main/shipper_page.php");
  }
?>