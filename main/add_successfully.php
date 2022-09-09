<h1>ADDED SUCCESSFULLY</h1>

<?php
$output = array("3;");
$fp = fopen('./main/products_khang.csv', 'a');
foreach ($output as $line)
{
fputcsv($fp,explode(',',$line));
}
// fwrite($fp, $output);
fclose($fp);

?>