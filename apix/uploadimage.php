<?php 
include("connect.php");
if(isset($_REQUEST['image']) && isset($_REQUEST['userId']) && isset($_REQUEST['name'])){

$user_id= $_REQUEST['userId'];
$base64string=$_REQUEST['image'];
$picname=$_REQUEST['name'];
 
 $outputfile="../images/profile_pics/".$picname;
 $ifp=fopen($outputfile,"wb");
 $fload=fwrite($ifp, base64_decode($base64string)) or die("{\"status\":\"failed\"}");
 fclose($ifp);
 
 if($fload){
 $newtask=mysql_query("UPDATE customers set customer_profilepic='$picname' where customer_id='$user_id'") or die(mysql_error());
 
 echo "{\"status\":\"ok\"}";
 }else{
 echo "{\"status\":\"failed\"}";
 }
 
}else{
echo "{\"request\":\"error\"}";
}
?>