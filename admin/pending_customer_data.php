<?php
if(session_id()==''){
   session_start();
}
include("../connect.php");
$date=$_SESSION['date'];
$branch_id=$_SESSION['branch_id'];
?>
<table cellpadding="0" cellspacing="0" width="100%" class="table table-striped table-bordered" id="example">
	 <thead>
	  <tr>
		<th>Customer</th>
		<th>Service</th>
		<th>Price</th>
		<th>Staff</th>
		<th>Booked time</th>
		<!--<th>&nbsp;</th>-->
	 </tr>
	</thead>
	<tbody>
<?php 
 //echo $date." ".$branch_id;
 //return;
 $selbk=mysql_query("select * from booking where booked_date='$date' && branch_id='$branch_id' && status='pending'")or die(mysql_error());
 $countbk=0;
 while($valbk=mysql_fetch_array($selbk)){			 
    $countbk++;//counter
	$booking_id=$valbk['booking_id'];
	$customer_id=$valbk['customer_id'];
	$branch_id=$valbk['branch_id'];
	$service_id=$valbk['service_id'];
	$staff_id=$valbk['staff_id'];
	$booking_id=$valbk['booking_id'];
	$booked_time=$valbk['booked_time'];
	$booked_date=$valbk['booked_date'];
	//convert 24-hour time to 12-hour time 
    $booked_time = date("g:i a", strtotime($booked_time));//convert booked time
	//get customer details
	$selc=mysql_query("select * from customer where customer_id='$customer_id'")or die(mysql_error());
	$valc=mysql_fetch_array($selc);
	$customer_name=$valc['fname']." ".$valc['lname'];
	$customer_photo=$valc['customer_photo'];
	$customer_contact=$valc['customer_contact'];
	$sex=$valc['sex'];
	//getting service details
	$sels=mysql_query("select * from service where service_id='$service_id'")or die(mysql_error());
	$vals=mysql_fetch_array($sels);
	$service_name=$vals['service_name'];
	$service_price=$vals['service_price'];
	//getting staff details
	$selsx=mysql_query("select * from staff where staff_id='$staff_id'")or die(mysql_error());
	$valsx=mysql_fetch_array($selsx);
	$staff_name=$valsx['staff_name'];
	$staff_photo=$valsx['staff_photo'];
	?>
	<tr class="odd gradeX">
	 <td valign="middle"><img src="../images/customer/<?php echo $customer_photo; ?>" width="40px" /> <?php echo $customer_name;?></td>
	 <td valign="middle" style="color:#009900"><?php echo $service_name;?></td>												
	 <td valign="middle"><img src="../images/staff/<?php echo $staff_photo; ?>" width="40px" /><?php echo $staff_name; ?></td>
	 <td valign="middle" style="color:red"><?php echo $service_price; ?>/=</td>
	 <td valign="middle" style="color:red"><?php echo $booked_time; ?></td>
	<!-- <td valign="middle" style="color:red"><a href="customer_booking.php?booking_id=<?php echo $booking_id; ?>" style="text-decoration:none"><span class="btn-danger" style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;">Details</span></a></td>	-->											
   </tr>
<?php
}//ends while
if($countbk==0){
?>
<tr class="odd gradeX">
 <td colspan="5" valign="middle" style="color:red; text-align:center" ><h2>No records found</h2></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php
//set automatic update of calendar if the date selected is today's date
$selected=$_SESSION['date'];	
 $today= date('Y-m-d') ;	
//echo "<h1>Selected: $selected<br/>Today: $today</h1>";
if($selected==$today){	
//echo "<h1>This is today</h1>";	
?>
<script type="text/javascript">
 setTimeout(function(){
  $('#pending-customer-div').load('pending_customer_data.php');
    }, 60000);
</script>
<?php
}
?>