<?php
if (isset($_POST['action'])){
    header('Location: /main/product_detail.php');
};
?>

<form action="bruh.php" method="POST">
    <input type="submit" name="action" >
</form>