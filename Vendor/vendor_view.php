<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="/Vendor/assets/css/vender_view.css">
</head>
<body>
    <header id="header">
        <img src="./assets/images/main/lazada-logo.png" alt="logo">
        <ul>
            <li>
                <a href="./vendor_view.php">HOME</a>
                <a href="./vendor_add.php">Add</a>
            </li>
            <li><a href="#">My Account</a></li> <!--link for account page-->
            <!-- <li><a href="#">Login</a></li> link for login page -->
        </ul>
    </header>
    
    <div id="vender_view">
        <form action="vendor_view.php" method="POST">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Price $$$</th>
                    <th>Image</th>
                    <th>Description</th>
                </tr>

                <?php
                    $f = fopen("products.csv", "r");
                    while (($line = fgetcsv($f)) !== false) {
                            $row = $line[0];
                            $cells = explode(";",$row);
                            if ($row !== '.'){
                                echo "<tr>";
                                foreach ($cells as $cell) {
                                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                                }
                                echo "</tr>\n";
                            }
                    }
                    fclose($f);
                ?>
            </table>
        </form>
    </div>

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