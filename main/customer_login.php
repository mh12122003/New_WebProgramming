<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="/main/assets/css/customer_login.css">
</head>
<body>
    <header id="header">
        <ul>
            <li><a href="#">My Account</a></li> <!--link for account page-->
            <!-- <li><a href="#">Login</a></li> link for login page -->
        </ul>
    </header>
    <form id="customer_login" method="post" action="customer_login.php">
    
        <h2>Customer Log In</h2>
    
        <input type="text" name="username" placeholder="Username">

        <input type="password" name="password" placeholder="Password">

    
        <button class="customer_login--login-btn" name="login_btn">LOG IN</button>

        <p>OR</p>

        <div class="customer_login-form">
            <a class="customer_login--forgot-btn">Forgot Password</a>

            <a href="/main/customer_register.php" class="customer_login--register-btn">Register</a>
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
        $name = "";
        $address = "";
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
        $f = fopen("account_customer.csv", "r");
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
            $f = fopen("account_customer.csv", "r");
                        while (($line = fgetcsv($f)) !== false) {
                                $row = $line[0];
                                $cells = explode(";",$row);
                                $hashed_password = $cells[1];
                                    if ($cells[0] == $username){

                                        if(password_verify($password, $hashed_password)){
                                            $username = $cells[0];
                                            $name = $cells[2];
                                            $address = $cells[3];
                                        }
                                        
                                    }       
                                }
                        fclose($f);
        $text1 ="
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
    <form class=\"container\" method=\"post\" action=\"$username.php\">
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
                                <h3>Name: $name</h3>
                                <h3>Address: $address</h3>
                                <h3>Image: 
                                <?php
                                        \$f = fopen(\"account_customer.csv\", \"r\");
                                        while ((\$line = fgetcsv(\$f)) !== false) {
                                            \$row = \$line[0];
                                            \$cells = explode(\";\",\$row);
                                            if (\$cells[0] == \"$username\"){
                                                echo \$cells[4];
                                            }       
                                        }
                                        fclose(\$f);

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
  if (file_exists(\"customer_register.php\")) {
    header(\"Location: customer_register.php\");
    unlink(\"$username.php\");
    unlink(\"customer_$username.php\"); 
    
    // for (\$i = 0; \$i < count(file(\"account_customer.csv\")); \$i++) {
        ";
        // unlink(\"$username+\$i.php\");

    $text3 ="
    // }
  }
};
if (isset(\$_POST[\"go_to_main\"])){
  if (file_exists(\"customer_$username.php\")) {
      header(\"Location: customer_$username.php\");
  }
}

if (isset(\$_POST[\"update_image\"])){
    \$new_image = filter_input(INPUT_POST, \"new_image\");
    \$f = fopen(\"account_customer.csv\", \"r\");
    while ((\$line = fgetcsv(\$f)) !== false) {
        \$row = \$line[0];
        \$cells = explode(\";\",\$row);
        if (\$cells[0] == \$username){
            // \$cells[4] = \$new_image;
            echo \"<h1>Change the image to \$new_image</h1>\";
        }       
    }
    fclose(\$f);
}
?>
            ";

            $text2 = "";
for ($i = 1; $i <= count(file("products.csv")); $i++) {
    
    $text2 .= "unlink(\"$username+$i.php\");\n";
};

$text = $text1 . "\n" . $text2 . "\n" . $text3; 

            if (file_exists("$username.php")) {
                header("location: /main/$username.php");
            } else {
                file_put_contents("$username.php", $text, FILE_APPEND | LOCK_EX);
                header("location: /main/$username.php");
            }

$new_customer_view = "
<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Customer Page</title>
    <script src=\"https://kit.fontawesome.com/56d2d270ab.js\" crossorigin=\"anonymous\"></script>
    <link rel=\"stylesheet\" href=\"/main/assets/css/Customer.css\">
  </head>
  <body>
    <!--header-->
    <header id=\"header\">
      <img src=\"/main/assets/images/Lazada-logo.png\" alt=\"Lazada-logo\" width=\"200\" height=\"100\">
      <ul>
        <li>
          <a href=\"#\">Shopping Cart</a>
          <a href=\"$username.php\">My Account</a>
        </li> <!--link for account page-->
      </ul>
    </header>

    <form class=\"Product_list\" action=\"customer_$username.php\" method=\"POST\">
          <!--price_filter-->
      <h3>Price Filtering</h3>
      <div class=\"filter\">
              
        <input type=\"text\" id=\"min\" placeholder=\"Minimum price\">
        <input type=\"text\" id=\"max\"  placeholder=\"Maximum price\">
        
        <input type=\"submit\" value=\"Search\">
      </div>
      
        <!--search_bar-->
        <div class=\"search\">
          <input type=\"text\" class=\"searchTerm\" placeholder=\"What are you looking for?\">
          <button type=\"submit\" class=\"searchButton\">
            <i class=\"fa fa-search\"></i>
          </button>
        </div>
       
      <!--products_images_and_details-->
    <h2>Available Products</h2>
    <div class=\"Products\">
      <?php
                    \$f = fopen(\"products.csv\", \"r\");
                    while ((\$line = fgetcsv(\$f)) !== false) {
                            \$row = \$line[0];
                            \$cells = explode(\";\",\$row);
                            if (\$row !== '.'){
                                echo \"<div class=\\\"Product_item\\\">\n\";
                                echo \"<p class=\\\"text\\\">\$cells[1]</p>\";
                                echo \"<p class=\\\"product_price\\\"><sup><u>đ</u></sup> \$cells[2]</p>\";
                                echo \"<a href=\\\"#\\\"><input class=\\\"image\\\" type=\\\"image\\\" alt=\\\"hand bag\\\"
                                width=\\\"300\\\" height=\\\"300\\\" src=\\\"/main/assets/images/Product1.1.jpg\\\"></a>\";
                                echo \"<button class=\\\"submit\\\" type=\\\"submit\\\" name=\\\"\$cells[0]\\\">Click here to see the product details</button>\";
                                echo \"<button class=\\\"submit\\\" type=\\\"submit\\\" name=\\\"\$cells[0]_buy\\\">BUY</button>\";
                                echo \"</div>\n\";
                            }
                    }
                    fclose(\$f);

                    if (file_exists(\"products_$username.csv\")){
                    } else {
                      \$test = '$username;';
                      \$test .= \"\\n\";
                      // \$p = fopen('/main/products_$username.csv', 'wb');
                      file_put_contents(\"products_$username.csv\", \$test, FILE_APPEND | LOCK_EX);
                      // fclose(\$p);
                    }                   

                    for (\$i = 1; \$i <= count(file('products.csv')); \$i++) {
                      \$buy = \$i . \"_buy\";
                      if(isset(\$_POST[\$buy])){
                        buying_product(\$i);
                      }
                    }

                    function buying_product(\$id){
                      \$output = array(\"\$id;\");
                      \$fp = fopen('products_$username.csv', 'a');
                      foreach (\$output as \$line)
                      {
                      fputcsv(\$fp,explode(',',\$line));
                      }
                      // fwrite(\$fp, \$output);
                      fclose(\$fp);
                      echo \"<h1>ADDED SUCCESSFULLY</h1>\";
                    };
                                       

            for (\$i = 1; \$i <= count(file('products.csv')); \$i++) {
              if(isset(\$_POST[\$i])){
                create_new(\$i);
              }
            }
            
            function create_new(\$id)
            {
              \$name = '';
              \$price = '';
              \$image = '';
              \$description = '';
              
              
              \$f = fopen(\"products.csv\", \"r\");
              while ((\$line = fgetcsv(\$f)) !== false) {
                      \$row = \$line[0];
                      \$cells = explode(\";\",\$row);
                      if (\$row !== '.'){
                        if (\$cells[0] == \$id){
                          \$name = \$cells[1];
                          \$price = \$cells[2];
                          \$image = \$cells[3];
                          \$description = \$cells[4];
                        }
                      }
              }
              fclose(\$f);
              
              
                  \$text = \"
                  <!DOCTYPE html>
              <html lang=\\\"en\\\">
                <head>
                  <meta charset=\\\"utf-8\\\">
                  <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1\\\">
                  <title>Product Detail</title>
                  <link rel=\\\"stylesheet\\\" href=\\\"/main/assets/css/ProductDetail.css\\\">
                </head>
                <body>   
                  <!--header-->
                  <header id=\\\"header\\\">
                    <img src=\\\"/main/assets/images/Lazada-logo.png\\\" alt=\\\"Lazada-logo\\\" width=\\\"200\\\" height=\\\"100\\\">
                    <ul>
                      <li><a href=\\\"$username.php\\\">My Account</a></li> <!--link for account page-->
                    </ul>
                  </header>
              
                  <form class=\\\"Product_detail\\\" method=\\\"post\\\" action=\\\"$username+\$id.php\\\">
                    <!--product_detail-->
                    <div id=\\\"detail_box\\\">
                      <h2 id=\\\"product_title\\\">\$name</h2>
                      <p id=\\\"product_price\\\"><sup><u>đ</u></sup> \$price</p>
                      
                    </div>
              
                    <!--image_box-->
                    <div id=\\\"image_block\\\">
                      <input class=\\\"image\\\" type=\\\"image\\\" src=\\\"/main/assets/images/Product1.jpg\\\" alt=\\\"men's shirt\\\" width=\\\"425\\\" height=\\\"425\\\">
                      <p>\$image</p>
                      <div id=\\\"image_box\\\"> <!--small pictures of the product-->
                        <p>Description: \$description</p>
                      </div>
                    </div>
              
                    
                  </form>
              
                  <!--footer-->
                  <footer id=\\\"footer\\\">
                      <ul>
                        <li><a href=\\\"About.html\\\">About</a></li>
                        <li><a href=\\\"Copyright.html\\\">Copyright</a></li>
                        <li><a href=\\\"Privacy.html\\\">Privacy</a></li>
                        <li><a href=\\\"Help.html\\\">Help</a></li>
                      </ul>
                  </footer>
                </body>
              </html>
              <?php
              // \\\$output = array(\\\"\$id;\\\");
              // \\\$fp = fopen('./main/products_$username.csv', 'a');
              // foreach (\\\$output as \\\$line)
              // {
              // fputcsv(\\\$fp,explode(',',\\\$line));
              // }
              // // fwrite(\\\$fp, \\\$output);
              // fclose(\\\$fp);
  
              


            
            ?>
                  \";
                  if (file_exists(\"$username+\$id.php\")) {
                      header(\"location: /main/$username+\$id.php\");
                  } else {
                      file_put_contents(\"$username+\$id.php\", \$text, FILE_APPEND | LOCK_EX);
                      header(\"location: /main/$username+\$id.php\");
                  }

                  if (file_exists(\"products_$username.csv\")){
                  } else {
                    \$test = \"$username;\";
                    // \$p = fopen('/main/products_$username.csv', 'wb');
                    file_put_contents(\"products_$username.csv\", \$test, FILE_APPEND | LOCK_EX);
                    // fclose(\$p);
                  }
              };
            
          
                ?>
    </div>
  </form>


  </body>
  <!--footer-->
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

if (file_exists("customer_$username.php")) {
} else {
  file_put_contents("customer_$username.php", $new_customer_view, FILE_APPEND | LOCK_EX);
}

        }
    
    }
?>