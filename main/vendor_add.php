

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
    <link rel="stylesheet" href="/main/assets/css/vender_add.css">
</head>
<body>
    <header id="header">
      <img src="/main/assets/images/Lazada-logo.png" alt="logo">
        <ul>
            <li>
                <a href="./vendor_view.php">HOME</a>
            </li>
            <li><a href="/main/profile_vendor.php">My Account</a></li> <!--link for account page-->
            <!-- <li><a href="#">Login</a></li> link for login page -->
        </ul>
    </header>
    
    <form id="vender_add" method="POST" action="vendor_add.php">
            <div class="vender_add-content">
                
                <input type="text" placeholder="Name" name="product_name">
                
            <input type="number" placeholder="Price" name="product_price">

            <textarea placeholder="Description" name="product_description" id="" cols="68" rows="10"></textarea>

            <div class="container">
                <!-- <div class="wrapper">
                   <div class="image">
                      <img src="./assets/images/vender_register/upload_file_logo.png" alt="">
                   </div>
                   <div class="content">
                    <div class="icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                      <div class="text">
                    </div>
                </div>
                <div id="cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                <div class="file-name">
                    File name here
                </div>
            </div>
            <button onclick="defaultBtnActive()" id="custom-btn">Choose a file</button> -->
            <input id="default-btn" type="file" name="product_image" value="Choose a file">
        </div>
        <!-- <script>
            const wrapper = document.querySelector(".wrapper");
            const fileName = document.querySelector(".file-name");
            const defaultBtn = document.querySelector("#default-btn");
            const customBtn = document.querySelector("#custom-btn");
            const cancelBtn = document.querySelector("#cancel-btn i");
                const img = document.querySelector("img");
                let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
                function defaultBtnActive(){
                  defaultBtn.click();
                }
                defaultBtn.addEventListener("change", function(){
                  const file = this.files[0];
                  if(file){
                    const reader = new FileReader();
                    reader.onload = function(){
                      const result = reader.result;
                      img.src = result;
                      wrapper.classList.add("active");
                    }
                    cancelBtn.addEventListener("click", function(){
                      img.src = "";
                      wrapper.classList.remove("active");
                    })
                    reader.readAsDataURL(file);
                  }
                  if(this.value){
                      let valueStore = this.value.match(regExp);
                    fileName.textContent = valueStore;
                  }
                });
                </script> -->
                
             <input type="submit" value="SUBMIT" class="submit" name="vendor_add_submit"/>
             <?php

            if(isset($_POST['vendor_add_submit'])){

                if(isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_description']) && isset($_POST['product_image'])){

                    //read data from form
                    $product_name = filter_input(INPUT_POST, "product_name");
                    $product_price = filter_input(INPUT_POST, "product_price");
                    $product_description = filter_input(INPUT_POST, "product_description");
                    $product_image = filter_input(INPUT_POST, "product_image");
                    
                    $blank = ";";
                    
                    if ($product_name != '' && $product_price != '' && $product_description != '' && $product_image != '') {
                      
                      $id = count(file('products.csv')) + 1;


                        //generate output for text file
                        $output = $id;
                        $output .= $blank;
                        $output .= $product_name;
                        $output .= $blank;
                        $output .= $product_price;
                        $output .= $blank;
                        $output .= $product_image;
                        $output .= $blank;
                        $output .= $product_description;
                        $output .= "\n";
                        
                        //open file for output with append mode "a"
                        $fp = fopen("products.csv", "a");
                        //write to the file
                        fwrite($fp, $output);
                        fclose($fp);

                        $success_output = "Submitted Successfully!";
                        echo "<h1 class=\"success\">". $success_output ."</h1>";  
                        
                    } else {
                        $empty_output = "Please enter all the required fields above";
                        echo "<h1 class=\"warning\">". $empty_output ."</h1>";  
                    }
                }
            }

            ?>
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
