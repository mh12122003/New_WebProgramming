<button class="button button1" type="button" name="add_to_cart">Add to Cart</button>

<?php
if (isset($_POST["add_to_cart"])){
  $output = array("3;","","");
  $fp = fopen('products_khang.csv', 'a');
  foreach ($output as $line)
  {
  fputcsv($fp,explode(',',$line));
  }
  // fwrite($fp, $output);
  fclose($fp);
// file_put_contents("./main/products_khang.csv", $output, FILE_APPEND | LOCK_EX);

}
?>