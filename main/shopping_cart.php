<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="/main/assets/css/ShoppingCart.css">
  </head>
  <body>   
    <!--header-->
    <header id="header">
      <img src="/main/assets/images/Lazada-logo.png" alt="Lazada-logo" width="200" height="100">
      <ul>
        <li class="active"><a href="Customer.html">Home</a></li>
        <li><a href="#">My Account</a></li> <!--link for account page-->
      </ul>
    </header>

    <form class="Product_list" method="POST" action="shopping_cart.php">

  <h2>Your order</h2>
  <div class="Products">
  
    <div class="Product_item">
        <a href="ProductDetail.html"><input class="image" type="image" src="/main/assets/images/Product1.jpg" alt="men's shirt"
        width="300" height="300"></a>
        <p class="text">Men's Shirt</p>
        <p class="product_price"><sup><u>đ</u></sup> 200,000</p>
        <button class="button1" type="button">Remove Product</button>
    </div>

  </div>
</form>


    
    <button class="button button2" type="button">CONFIRM ORDER</button>

    <!--footer-->
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

