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
                   <a href=\\\"order_detail.html\\\">Click here to view detail →</a>
              </div>
              </div>
  
              \";
            };
          };
        }
        
        fclose(\$f);
        fclose(\$j);
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
    
    }
?>