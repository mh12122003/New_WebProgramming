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
                                echo "<p class=\"text\">$cells[0]</p>";
                                echo "<p class=\"product_price\"><sup><u>đ</u></sup> $cells[1]</p>";
                                echo "<a href=\"#\"><input class=\"image\" type=\"image\" alt=\"hand bag\"
                                width=\"300\" height=\"300\" src=\"/main/assets/images/Product1.1.jpg\"></a>";
                                echo "<button class=\"submit\" type=\"submit\" name=\"product_item_click\">Click here to see the product details</button>";
                                echo "</div>\n";
                            }
                    }
                    fclose($f);

            
            if(isset($_POST['product_item_click'])){
                header("location: /main/product_detail.php");
            }
          
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