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
            <input id="default-btn" type="file" name="image">
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
                    $image = filter_input(INPUT_POST, "image");
                    
                    $blank = ";";

                    
                  //   function jump_to_main($link_name){
                  //     header("Location: $link_name.php");
                  // }

                        //generate output for text file
                        $output .= $username;
                        $output .= $blank;
                        $output .= $hashed_password;
                        $output .= $blank;
                        $output .= $bname;
                        $output .= $blank;
                        $output .= $baddress;
                        $output .= $blank;
                        $output .= $image;
                        $output .= "\n";
    
    // $status = "Registration succeed!";
    // $f = fopen("account_vendor.csv", "r");
    //                 while (($line = fgetcsv($f)) !== false) {
    //                         $row = $line[0];
    //                         $cells = explode(";",$row);
    //                             if ($cells[0] == $username){
    //                                 $status = "Invalid username!";
    //                                 break;
    //                             }       
    //                         }         
                    
                    
    //                 echo "<script type='text/javascript'>alert('$status');</script>";
    //                 fclose($f);

    $valid_status = "Valid username!";
    $f = fopen("account_vendor.csv", "r");
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
    //   $fp = fopen("account_shipper.csv", "a");
    //   //write to the file
    //   fwrite($fp, $output);
    //   fclose($fp);
    //   header("Location: /main/shipper_page.php");

    //   if (file_exists("shipper_page.php")) {
    //     jump_to_main();
    // }
      // code to append info to data file and redirect to homepage
    } else {
      $status = "Registration failed!";
    }
    if ($status == "Registration succeed!"){
        //open file for output with append mode "a"
        $fp = fopen("account_vendor.csv", "a");
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
                                <h3>Business Name: $bname</h3>
                                <h3>Business Address: $baddress</h3>
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
  if (file_exists(\"vendor_register.php\")) {
      header(\"Location: vendor_register.php\");
      unlink(\"$username.php\");
      unlink(\"vendor_add_$username.php\");
      unlink(\"vendor_view_$username.php\");
  }
};
if (isset(\$_POST[\"go_to_main\"])){
  if (file_exists(\"vendor_view_$username.php\")) {
      header(\"Location: vendor_view_$username.php\");
  }
}

if (isset(\$_POST[\"update_image\"])){
    \$new_image = filter_input(INPUT_POST, \"new_image\");
    \$f = fopen(\"account_vendor.csv\", \"r\");
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
            if (file_exists("$username.php")) {
                header("location: /main/$username.php");
            } else {
                file_put_contents("$username.php", $text, FILE_APPEND | LOCK_EX);
                header("location: /main/$username.php");
            }

$new_vendor_view = "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>View Products</title>
    <link rel=\"stylesheet\" href=\"/main/assets/css/vender_view.css\">
</head>
<body>
    <header id=\"header\">
        <img src=\"./assets/images/main/lazada-logo.png\" alt=\"logo\">
        <ul>
            <li>
                <a href=\"./vendor_view_$username.php\">HOME</a>
                <a href=\"./vendor_add_$username.php\">Add</a>
            </li>
            <li>
                <a href=\"/main/$username.php\">My Account: $username</a>
            </li> <!--link for account page-->
            <!-- <li><a href=\"#\">Login</a></li> link for login page -->
        </ul>
    </header>
    
    <div id=\"vender_view\">
        <form action=\"vendor_view_$username.php\" method=\"POST\">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price $$$</th>
                    <th>Image</th>
                    <th>Description</th>
                </tr>

                <?php
                    \$f = fopen(\"products.csv\", \"r\");
                    while ((\$line = fgetcsv(\$f)) !== false) {
                            \$row = \$line[0];
                            \$cells = explode(\";\",\$row);
                            if (\$row !== '.'){
                                echo \"<tr>\";
                                foreach (\$cells as \$cell) {
                                    echo \"<td>\" . htmlspecialchars(\$cell) . \"</td>\";
                                }
                                echo \"</tr>\n\";
                            }
                    }
                    fclose(\$f);
                ?>
            </table>
        </form>
    </div>

    <footer id=\"footer\">
        <ul>
            <li><a href=\"/Customer/About.html\">About</a></li>
            <li><a href=\"/Customer/Copyright.html\">Copyright</a></li>
            <li><a href=\"/Customer/Privacy.html\">Privacy</a></li>
            <li><a href=\"/Customer/Help.html\">Help</a></li>
        </ul>
    </footer>
</body>
</html>
";

if (file_exists("vendor_view_$username.php")) {
} else {
  file_put_contents("vendor_view_$username.php", $new_vendor_view, FILE_APPEND | LOCK_EX);
}

$new_vendor_add = "


<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Add products</title>
    <link rel=\"stylesheet\" href=\"/main/assets/css/vender_add.css\">
</head>
<body>
    <header id=\"header\">
      <img src=\"/main/assets/images/Lazada-logo.png\" alt=\"logo\">
        <ul>
            <li>
                <a href=\"./vendor_view_$username.php\">HOME</a>
            </li>
            <li><a href=\"/main/$username.php\">My Account: $username</a></li> <!--link for account page-->
            <!-- <li><a href=\"#\">Login</a></li> link for login page -->
        </ul>
    </header>
    
    <form id=\"vender_add\" method=\"POST\" action=\"vendor_add_$username.php\">
            <div class=\"vender_add-content\">
                
                <input type=\"text\" placeholder=\"Name\" name=\"product_name\">
                
            <input type=\"number\" placeholder=\"Price\" name=\"product_price\">

            <textarea placeholder=\"Description\" name=\"product_description\" id=\"\" cols=\"68\" rows=\"10\"></textarea>

            <div class=\"container\">
                <!-- <div class=\"wrapper\">
                   <div class=\"image\">
                      <img src=\"./assets/images/vender_register/upload_file_logo.png\" alt=\"\">
                   </div>
                   <div class=\"content\">
                    <div class=\"icon\">
                        <i class=\"fas fa-cloud-upload-alt\"></i>
                    </div>
                      <div class=\"text\">
                    </div>
                </div>
                <div id=\"cancel-btn\">
                    <i class=\"fas fa-times\"></i>
                </div>
                <div class=\"file-name\">
                    File name here
                </div>
            </div>
            <button onclick=\"defaultBtnActive()\" id=\"custom-btn\">Choose a file</button> -->
            <input id=\"default-btn\" type=\"file\" name=\"product_image\" value=\"Choose a file\">
        </div>
        <!-- <script>
            const wrapper = document.querySelector(\".wrapper\");
            const fileName = document.querySelector(\".file-name\");
            const defaultBtn = document.querySelector(\"#default-btn\");
            const customBtn = document.querySelector(\"#custom-btn\");
            const cancelBtn = document.querySelector(\"#cancel-btn i\");
                const img = document.querySelector(\"img\");
                let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
                function defaultBtnActive(){
                  defaultBtn.click();
                }
                defaultBtn.addEventListener(\"change\", function(){
                  const file = this.files[0];
                  if(file){
                    const reader = new FileReader();
                    reader.onload = function(){
                      const result = reader.result;
                      img.src = result;
                      wrapper.classList.add(\"active\");
                    }
                    cancelBtn.addEventListener(\"click\", function(){
                      img.src = \"\";
                      wrapper.classList.remove(\"active\");
                    })
                    reader.readAsDataURL(file);
                  }
                  if(this.value){
                      let valueStore = this.value.match(regExp);
                    fileName.textContent = valueStore;
                  }
                });
                </script> -->
                
             <input type=\"submit\" value=\"SUBMIT\" class=\"submit\" name=\"vendor_add_submit\"/>
             <?php

            if(isset(\$_POST['vendor_add_submit'])){

                if(isset(\$_POST['product_name']) && isset(\$_POST['product_price']) && isset(\$_POST['product_description']) && isset(\$_POST['product_image'])){

                    //read data from form
                    \$product_name = filter_input(INPUT_POST, \"product_name\");
                    \$product_price = filter_input(INPUT_POST, \"product_price\");
                    \$product_description = filter_input(INPUT_POST, \"product_description\");
                    \$product_image = filter_input(INPUT_POST, \"product_image\");
                    
                    \$blank = \";\";
                    
                    if (\$product_name != '' && \$product_price != '' && \$product_description != '' && \$product_image != '') {
                      
                      \$id = count(file('products.csv')) + 1;


                        //generate output for text file
                        \$output = \$id;
                        \$output .= \$blank;
                        \$output .= \$product_name;
                        \$output .= \$blank;
                        \$output .= \$product_price;
                        \$output .= \$blank;
                        \$output .= \$product_image;
                        \$output .= \$blank;
                        \$output .= \$product_description;
                        \$output .= \"\\n\";
                        
                        //open file for output with append mode \"a\"
                        \$fp = fopen(\"products.csv\", \"a\");
                        //write to the file
                        fwrite(\$fp, \$output);
                        fclose(\$fp);

                        \$success_output = \"Submitted Successfully!\";
                        echo \"<h1 class=\\\"success\\\">\". \$success_output .\"</h1>\";  
                        
                    } else {
                        \$empty_output = \"Please enter all the required fields above\";
                        echo \"<h1 class=\\\"warning\\\">\". \$empty_output .\"</h1>\";  
                    }
                }
            }

            ?>
        </div>
    </form>

    <footer id=\"footer\">
      <ul>
        <li><a href=\"/Customer/About.html\">About</a></li>
        <li><a href=\"/Customer/Copyright.html\">Copyright</a></li>
        <li><a href=\"/Customer/Privacy.html\">Privacy</a></li>
        <li><a href=\"/Customer/Help.html\">Help</a></li>
      </ul>
    </footer>
</body>
</html>

";

if (file_exists("vendor_add_$username.php")) {
} else {
  file_put_contents("vendor_add_$username.php", $new_vendor_add, FILE_APPEND | LOCK_EX);
}


    }


  }
?>