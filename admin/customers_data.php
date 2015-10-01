<?php
if(!isset($_SESSION)){
  session_start();
}
require_once("../connect.php");
include("../encrypt/encrypt.php");
if(isset($_SESSION['break'],$_SESSION['customer_last_id'])){
$last_id=$_SESSION['customer_last_id'];
 if($_SESSION['break']==1){
    $_SESSION['break']=0;
 }else{
   return;
 }
}else{
  return;
}
?>
<?php
$right_name="customers";// the right needed to access this content
$username=$_SESSION['username'];
$group_id=$_SESSION['group_id'];
$branch_id=$_SESSION['branch_id'];
if(isset($_SESSION[''.$right_name.''])){
   $branches=$_SESSION[''.$right_name.'_branches'];
   $view=$_SESSION[''.$right_name.'_view']; 
   $add=$_SESSION[''.$right_name.'_add'];
   $edit=$_SESSION[''.$right_name.'_edit'];
   $delete=$_SESSION[''.$right_name.'_delete'];
//var_dump($_SESSION);
}else{
   header("Location:index.php");
}
?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
<tr>
<th>Customer</th>
<th>Contact</th>
<th>Total bookings</th>
<th>Total cost</th>
<th>Canceled bookings</th>
<!--<th>&nbsp;</th>-->
</tr>
</thead>
<tbody>
<?php 
$sel=mysql_query("select * from customer where customer_id > '$last_id'")or die(mysql_error());
$count=0;
while($val=mysql_fetch_array($sel)){
$count++;
if($count<20){
   //no break
}else{
   $_SESSION['break']=1;
   break;
}
$name=$val['fname']." ".$val['lname'];
$photo=$val['customer_photo'];
$contact=$val['customer_contact'];
$customer_id=$val['customer_id'];
$_SESSION['customer_last_id']=$customer_id;
$selx=mysql_query("select COUNT(*) total_bookings,sum(service_price) total_cost from booking b inner join service s on(b.service_id=s.service_id) where customer_id='$customer_id' && status !='canceled'")or die(mysql_error());
$valx = mysql_fetch_array($selx);
$total_bookings=$valx['total_bookings'];
$total_cost=$valx['total_cost'];  
$sely=mysql_query("select COUNT(*) total_canceled FROM booking where customer_id='$customer_id' && status='canceled'")or die(mysql_error());
$valy=mysql_fetch_array($sely);
$total_canceled=$valy['total_canceled'];
?>
<tr class="odd gradeX">
  <td valign="middle"><img src="../images/customer/<?php echo $photo;?>" width="40px" />&nbsp;<?php echo $name; ?></td>
  <td valign="middle" style="color:#009900"><?php echo $contact;?></td>
  <td valign="middle" style="color:#009900"><?php echo $total_bookings;?></td>
  <td valign="middle" style="color:red"><?php echo number_format($total_cost);?>/=</td>
  <td valign="middle" style="color:red"><?php echo $total_canceled;?></td>
<!--<td valign="middle"><a href="customer_details.php?cmd=<?php $data = '{"customer_id":"'.$customer_id.'"}';		$encryption=new Encryption;
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>">
	<input type="button" class="btn-success" value="Details" /></a></td>-->											
</tr>
<?php 
}
if($_SESSION['break']==1){
?>
<tr><td colspan="5"><a href="customers_data.php" class="loadNext"><input type="button" value="More" class="btn-danger" /></a></td></tr>
<?php
}
?>
</tbody>
</table>