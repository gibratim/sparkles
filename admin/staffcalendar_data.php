<?php
if(session_id()==''){
   session_start();
}
if(isset($_REQUEST['date'])){
   //a request for the date
   $_SESSION['date']=$_REQUEST['date'];
   header('Location:staffcalendar_data.php');
}elseif(isset($_SESSION['date'])){
   $date=$_SESSION['date'];
    //echo $date;
   //return;
}else{
   $time=time();
   //date_default_timezone_set('Africa/Nairobi');
   $date= date('Y-m-d') ;
  // echo $date;
  // return;
}
require_once("../connect.php");
$branch_id = $_SESSION['branch_id'];
$staff_id = $_SESSION['staff_id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Bookings</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
       <!--<link rel="stylesheet" type="text/css" href="menu/css/demo.css" />-->
        <link rel="stylesheet" type="text/css" href="menu/css/style2.css" />
		<script type="text/javascript" src="menu/js/modernizr.custom.04022.js"></script>
		</head>
    <body>
  <div class="container">
	<section class="tabs">
	  <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
	  <label for="tab-1" class="tab-label-1">Schedule</label>
	  <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
	  <label for="tab-3" class="tab-label-3">Canceled bookings</label>
	  <div class="clear-shadow"></div>			
<div class="content">
<div class="content-1" id="schedule-content-div">
<?php
require_once("staff_work_calendar_data.php");
?>
</div>
		
			        <div class="content-3" >
<table cellpadding="0" cellspacing="0" width="100%" class="table table-striped table-bordered" id="example">
<thead>
<tr>
 <th>Customer</th>
 <th>Service</th>
 <th>Price</th>
 <th>Reason</th>												
 <th>Canceled</th>
 <!--<th>&nbsp;</th>-->
</tr>
</thead>
<tbody>
<?php 
 //echo $date." ".$branch_id;
 //return;
 $selbk=mysql_query("select * from booking where booked_date='$date' && branch_id='$branch_id' && status='canceled' && staff_id='$staff_id'")or die(mysql_error());
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
 <td valign="middle" style="color:red"><?php echo $service_price; ?>/=</td>
 <td valign="middle" style="color:red">Not specified</td>
 <td valign="middle" style="color:red"><?php echo $booked_time; ?></td>
 <!--<td valign="middle" style="color:red"><a href="customer_booking.php?booking_id=<?php echo $booking_id; ?>" style="text-decoration:none"><span class="btn-danger" style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;">Details</span></a></td>-->													
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
				    </div>
				 
	          </div>
			</section>
        </div>
    </body>
</html>