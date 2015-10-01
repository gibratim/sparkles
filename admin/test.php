<?php
require_once("../connect.php");
session_start();
if(isset($_SESSION['username'],$_REQUEST['username'])){
if($_SESSION['username']==$_REQUEST['username']){
$sel=mysql_query("select * from branch")or die(mysql_error());
$val=mysql_fetch_array($sel);
$branch_id=$val['branch_id'];
$branch_name=$val['branch_name'];
$branch_photo=$val['branch_photo'];
$string='{"branch_id":"'.$branch_id.'","branch_name":"'.$branch_name.'","photo":"'.$branch_photo.'"}';
echo $string;
}else{
$string='{"status":"access denied"}';
echo $string;
}
}else{
$string='{"status":"access denied"}';
echo $string;
}
?>