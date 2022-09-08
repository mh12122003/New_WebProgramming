<?php
$name = '';
$price = '';
$image = '';
$description = '';


$f = fopen("products.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        $row = $line[0];
        $cells = explode(";",$row);
        if ($row !== '.'){
            $name = $cells[0];
            $price = $cells[1];
            $image = $cells[2];
            $description = $cells[3];
        }
}
fclose($f);

if (isset($_POST['action'])){
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
    if (file_exists("$name.html")) {
        header("location: /$name.html");
    } else {
        file_put_contents("$name.html", $text, FILE_APPEND | LOCK_EX);
        header("location: /$name.html");
    }
};
?>

<form action="bruh.php" method="POST">
    <input type="submit" name="action" >
</form>