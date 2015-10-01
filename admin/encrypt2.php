<?php
$arr_value = array("1","2","3","4");
function encrypt($text)
{
   return base64_encode($text);
}
function decrypt($text)
{
   return base64_decode($text);
}
$encrypted = encrypt($arr_value);
echo '<pre>';
var_dump($encrypted);
$decrypted = array_map("decrypt", $encrypted);
echo '<pre>';
var_dump($decrypted);
?>

<a href="<?php echo $encrypted; ?>">Click me now and see</a>