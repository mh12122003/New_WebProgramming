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
          <li><a href="About.html">About</a></li>
          <li><a href="Copyright.html">Copyright</a></li>
          <li><a href="Privacy.html">Privacy</a></li>
          <li><a href="Help.html">Help</a></li>
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
    
    $valid_status = "Valid username!";
    $f = fopen("account_shipper.csv", "r");
                    while (($line = fgetcsv($f)) !== false) {
                            $row = $line[0];
                            $cells = explode(";",$row);
                                if ($cells[0] == $username){
                                    $valid_status = "Invalid username!";
                                    echo "<script type='text/javascript'>alert('$valid_status');</script>";
                                    break;
                                }       
                            }
                    
                    fclose($f);

    $user_status = " ";
                    $user_uppercase = preg_match('@[A-Z]@', $username);
                    $user_lowercase = preg_match('@[a-z]@', $username);
                    $user_number    = preg_match('@[0-9]@', $username);

                    if(!$user_uppercase || !$user_lowercase || !$user_number || strlen($username) < 8 || strlen($username) > 15) {
                      $user_status = "Username must have a length from 8 to 15 characters and include at least one lowercase letter, one uppercase letter and one number";
                      echo "<script type='text/javascript'>alert('$user_status');</script>";
                  } else { 
                      $user_status = "Strong username";
                  }

    $pass_status = " ";                        
                    $pass_uppercase = preg_match('@[A-Z]@', $password);
                    $pass_lowercase = preg_match('@[a-z]@', $password);
                    $pass_number    = preg_match('@[0-9]@', $password);
                    $pass_specialChars = preg_match('@[^\w]@', $password);

                    if(!$pass_uppercase || !$pass_lowercase || !$pass_number || !$pass_specialChars || strlen($password) < 8 || strlen($password) > 20) {
                      $pass_status = "Password must have a length from 8 to 20 characters and include at least one lowercase letter, one uppercase letter, one number, and one special character.";
                      echo "<script type='text/javascript'>alert('$pass_status');</script>";
                  } else {
                      $pass_status = "Strong password";
                  }

    
             
    if ($valid_status == "Valid username!" && $user_status == "Strong username" && $pass_status == "Strong password") {
      $status = "Registration succeed!";
      echo "<script type='text/javascript'>alert('$status');</script>";
      //open file for output with append mode "a"
      // $fp = fopen("account_shipper.csv", "a");
      // //write to the file
      // fwrite($fp, $output);
      // fclose($fp);
      // header("Location: /main/shipper_page.php");

    //   if (file_exists("shipper_page.php")) {
    //     jump_to_main();
    // }
      // code to append info to data file and redirect to homepage
    } else {
      $status = "Registration failed!";
    }

    if ($status == "Registration succeed!"){

      $fp = fopen("account_shipper.csv", "a");
        //write to the file
        fwrite($fp, $output);
        fclose($fp);

        $text ="
            <!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Document</title>
    <link rel=\"stylesheet\" href=\"/main/assets/css/profife.css\">
</head>
<body>
<form class=\"container\" method=\"post\" action=\"shipper_account_$username.php\">
<div class=\"main\">
    <div class=\"topbar\">
    <button name=\"go_to_main\">HOME</button>
    <button name=\"update_image\">UPDATE</button>
        <button name=\"log_out\" href=\"\">SIGN OUT</button>
    </div>
    <div class=\"row\">
        <div class=\"col-md-4 mt-1\">
            <div class=\"card text-center sidebar\">
                <div class=\"card-body\">
                    <!-- <img src=\"image.jpg\" class=\"rounded-circle\" width=\"150\"> -->
                    <div class=\"mt-3\">
                        <h3>Username: $username</h3>
                        <h3>Image: 
                        <?php
                                        \$f = fopen(\"account_vendor.csv\", \"r\");
                                        while ((\$line = fgetcsv(\$f)) !== false) {
                                            \$row = \$line[0];
                                            \$cells = explode(\";\",\$row);
                                            if (\$cells[0] == \"$username\"){
                                                echo \$cells[4];
                                            }       
                                        }
                                    ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-md-8 mt-1\">
            <form class=\"card mb-3 content\">
                <h1 class=\"m-3 pt-3\">My Account</h1>
                <div class=\"card-body\">
                    <div class=\"row\">
                        <div class=\"col-md-3\">
                            <h5>Update Image</h5>
                        </div>
                        <div class=\"col-md-9 text-secondary\">
                            <input type=\"file\" name=\"new_image\">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 
</form>


</body>

</html>
<?php
\$username = \"$username\";

if (isset(\$_POST[\"log_out\"])){
  if (file_exists(\"shipper_register.php\")) {
      header(\"Location: shipper_register.php\");
      unlink(\"shipper_account_$username.php\");
      unlink(\"shipper_page_$username.php\");
  }
};
if (isset(\$_POST[\"go_to_main\"])){
  if (file_exists(\"shipper_page_$username.php\")) {
      header(\"Location: shipper_page_$username.php\");
  }
}

if (isset(\$_POST[\"update_image\"])){
    \$new_image = filter_input(INPUT_POST, \"new_image\");
    \$f = fopen(\"account_shipper.csv\", \"r\");
    while ((\$line = fgetcsv(\$f)) !== false) {
        \$row = \$line[0];
        \$cells = explode(\";\",\$row);
        if (\$cells[0] == \$username){
            // \$cells[4] = \$new_image;
            echo \"<h1>Change the image to \$new_image</h1>\";
        }       
    }
}
?>
            ";
            if (file_exists("shipper_account_$username.php")) {
                header("location: /main/shipper_account_$username.php");
            } else {
                file_put_contents("shipper_account_$username.php", $text, FILE_APPEND | LOCK_EX);
                header("location: /main/shipper_account_$username.php");
            }
            

            $create_shipper = "
            
            <!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Shipper Page</title>
    <link rel=\"stylesheet\" href=\"/main/assets/css/shipper_page.css\">
  </head>
  <body>   
    <!--header-->
    <header id=\"header\">
        <img src=\"./assets/images/main/lazada-logo.png\" alt=\"logo\">
        <ul>
            <li class=\"active\"><a href=\"#\">Home</a></li>
            <li><a href=\"shipper_account_$username.php\">My Account</a></li> <!--link for account page-->
            <!-- <li><a href=\"#\">Login</a></li> link for login page -->
        </ul>
      </header>
    <!--main-->
    <form id=\"shipper_page\" method=\"POST\" action=\"shipper_page_$username.php\">
        <!-- <div class=\"shipper_page-content\">
            <img src=\"./assets/images/vender_page/product_manage_icon.png\" alt=\"\">
            <div class=\"shipper_page-content_description\">
                 <h2>San pham lam dep cao .</h2>
                 <h4>99.00$</h4>
                 <h3>Customer: <span>TaoDepZai</span></h3>
                 <h5>Status: <span>Active</span></h5>
                 <a href=\"order_detail.html\">Click here to view detail →</a>
            </div>
        </div> -->
      <?php
      \$username_array = [];
      \$count = 0;

      \$file_open = fopen(\"account_customer.csv\", 'r');
      while ((\$line = fgetcsv(\$file_open)) !== false) {
        \$row = \$line[0];
        \$cells = explode(\";\",\$row);
        // echo \$cells[0];
        \$username_array[\$count] = \$cells[0];
        \$count++;
      };

      for (\$i = 0; \$i < count(file('account_customer.csv')); \$i++) {
        get_customer(\$username_array[\$i]);
      }

      function get_customer(\$username) {
        \$link = \"products_\$username.csv\";

        if (file_exists(\$link)) {

          \$f = fopen(\"products.csv\", \"r\");
          \$j = fopen(\$link, \"r\");
    
    
          \$csvFile = file(\$link);
          \$data = [];
          foreach (\$csvFile as \$line) {
            \$data[] = str_getcsv(\$line[0]);
          }
          // echo \$data[2][0];
    
          while ((\$line = fgetcsv(\$f)) !== false) {
            \$row = \$line[0];
            \$cells = explode(\";\",\$row);
            // echo \$cells[0];
            for (\$i = 0; \$i < count(file(\$link)); \$i++) {
              if (\$cells[0] == \$data[\$i][0]){
                echo \"
                
                <div class=\\\"shipper_page-content\\\">
                <img src=\\\"./assets/images/vender_page/product_manage_icon.png\\\" alt=\\\"\\\">
                <div class=\\\"shipper_page-content_description\\\">
                     <h2>\$cells[1]</h2>
                     <h4>\$cells[2]\$</h4>
                     <h3>Customer: <span>\$username</span></h3>
                     <h5>Status: <button><span>Active</span></button></h5>
                </div>
                </div>
    
                \";
              };
            };
          }
          
          fclose(\$f);
          fclose(\$j);

        } else {
          echo \"<h1>No Products From \$username To Be Shown</h1>\";
        };

      }

      ?>
        
    </form>
    <!--footer-->
  </body>
  <footer id=\"footer\">
      <ul>
        <li><a href=\"About.html\">About</a></li>
        <li><a href=\"Copyright.html\">Copyright</a></li>
        <li><a href=\"Privacy.html\">Privacy</a></li>
        <li><a href=\"Help.html\">Help</a></li>
      </ul>
  </footer>
</html>
            
            ";

            if (file_exists("shipper_page_$username.php")) {
            } else {
              file_put_contents("shipper_page_$username.php", $create_shipper, FILE_APPEND | LOCK_EX);
            }

    }

    function jump_to_main(){
      header("Location: /main/shipper_page.php");
  }
}
?>
