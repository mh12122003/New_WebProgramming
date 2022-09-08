<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Page</title>
    <script src="https://kit.fontawesome.com/56d2d270ab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/main/assets/css/Customer.css">
  </head>
  <body>
    <!--header-->
    <header id="header">
      <img src="/main/assets/images/Lazada-logo.png" alt="Lazada-logo" width="200" height="100">
      <ul>
        <li class="active"><a href="/main/customer.php">Home</a></li>
        <li>
          <a href="#">Shopping Cart</a>
          <a href="#">My Account</a>
        </li> <!--link for account page-->
      </ul>
    </header>

    <form class="Product_list" action="customer.php" method="POST">
          <!--price_filter-->
      <h3>Price Filtering</h3>
      <div class="filter">
              
        <input type="text" id="min" placeholder="Minimum price">
        <input type="text" id="max"  placeholder="Maximum price">
        
        <input type="submit" value="Search">
      </div>
      
        <!--search_bar-->
        <div class="search">
          <input type="text" class="searchTerm" placeholder="What are you looking for?">
          <button type="submit" class="searchButton">
            <i class="fa fa-search"></i>
          </button>
        </div>
       
      <!--products_images_and_details-->
    <h2>Available Products</h2>
    <div class="Products">
      <?php
                    $f = fopen("products.csv", "r");
                    while (($line = fgetcsv($f)) !== false) {
                            $row = $line[0];
                            $cells = explode(";",$row);
                            if ($row !== '.'){
                                echo "<div class=\"Product_item\">\n";
                                echo "<p class=\"text\">$cells[1]</p>";
                                echo "<p class=\"product_price\"><sup><u>đ</u></sup> $cells[2]</p>";
                                echo "<a href=\"#\"><input class=\"image\" type=\"image\" alt=\"hand bag\"
                                width=\"300\" height=\"300\" src=\"/main/assets/images/Product1.1.jpg\"></a>";
                                echo "<button class=\"submit\" type=\"submit\" name=\"$cells[0]\">Click here to see the product details</button>";
                                echo "</div>\n";
                            }
                    }
                    fclose($f);

            for ($i = 1; $i <= count(file('products.csv')); $i++) {
              if(isset($_POST[$i])){
                create_new($i);
              }
            }
            
            if(isset($_POST['product_item_click'])){}
            function create_new($id)
            {
              $name = '';
              $price = '';
              $image = '';
              $description = '';
              
              
              $f = fopen("products.csv", "r");
              while (($line = fgetcsv($f)) !== false) {
                      $row = $line[0];
                      $cells = explode(";",$row);
                      if ($row !== '.'){
                        if ($cells[0] == $id){
                          $name = $cells[1];
                          $price = $cells[2];
                          $image = $cells[3];
                          $description = $cells[4];
                        }
                      }
              }
              fclose($f);
              
              
                  $text = "
                  <!DOCTYPE html>
              <html lang=\"en\">
                <head>
                  <meta charset=\"utf-8\">
                  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                  <title>Product Detail</title>
                  <link rel=\"stylesheet\" href=\"/main/assets/css/ProductDetail.css\">
                </head>
                <body>   
                  <!--header-->
                  <header id=\"header\">
                    <img src=\"/main/assets/images/Lazada-logo.png\" alt=\"Lazada-logo\" width=\"200\" height=\"100\">
                    <ul>
                      <li class=\"active\" name=\"product_detail_home\"><a href=\"/main/customer.php\">Home</a></li>
                      <li><a href=\"#\">My Account</a></li> <!--link for account page-->
                      <li><a href=\"#\">Login</a></li> <!--link for login page-->
                    </ul>
                  </header>
              
                  <section class=\"Product_detail\">
                    <!--product_detail-->
                    <div id=\"detail_box\">
                      <h2 id=\"product_title\">$name</h2>
                      <p id=\"product_price\"><sup><u>đ</u></sup> $price</p>
                      
                    </div>
              
                    <!--image_box-->
                    <div id=\"image_block\">
                      <input class=\"image\" type=\"image\" src=\"/main/assets/images/Product1.jpg\" alt=\"men's shirt\" width=\"425\" height=\"425\">
                      <p>$image</p>
                      <div id=\"image_box\"> <!--small pictures of the product-->
                        <p>Description: $description</p>
                      </div>
                    </div>
              
                    <button class=\"button button1\" type=\"button\">Add to Cart</button>
                    
                  </section>
              
                  <!--footer-->
                  <footer id=\"footer\">
                      <ul>
                        <li><a href=\"About.html\">About</a></li>
                        <li><a href=\"Copyright.html\">Copyright</a></li>
                        <li><a href=\"Privacy.html\">Privacy</a></li>
                        <li><a href=\"Help.html\">Help</a></li>
                      </ul>
                  </footer>
                </body>
              </html>
                  ";
                  if (file_exists("$id.html")) {
                      header("location: /main/$id.html");
                  } else {
                      file_put_contents("$id.html", $text, FILE_APPEND | LOCK_EX);
                      header("location: /main/$id.html");
                  }
              };
            
          
                ?>
    </div>
  </form>


  </body>
  <!--footer-->
  <footer id="footer">
      <ul>
        <li><a href="About.html">About</a></li>
        <li><a href="Copyright.html">Copyright</a></li>
        <li><a href="Privacy.html">Privacy</a></li>
        <li><a href="Help.html">Help</a></li>
      </ul>
  </footer>
</html>