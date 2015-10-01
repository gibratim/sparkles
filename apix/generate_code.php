<?php
include "connect.php";
if(isset($_REQUEST['userId'],$_REQUEST['orderId'])){
$order_id=$_REQUEST['orderId'];

$length = 10;
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
$string = "";    
for ($p = 0; $p < $length; $p++) 
{
    $string .= $characters[mt_rand(2, strlen($characters)-1)];
}
$tim= time();
$final_str= $string.$tim;
echo  "{\"status\":\"sucsess\",\"code\":\"$final_str\"}";

   }else{
   echo "{\"results\":\"error\"}";
   }

?>