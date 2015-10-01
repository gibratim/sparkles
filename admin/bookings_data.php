<?php
if(session_id()==''){
session_start();
}
 //24-hour time to 12-hour time 
 //$time_in_12_hour_format  = date("g:i a", strtotime("13:30"));
 //12-hour time to 24-hour time 
 //$time_in_24_hour_format  = date("H:i", strtotime("1:30PM"));
if(isset($_REQUEST['date'])){
   //a request for the date
   $_SESSION['date']=$_REQUEST['date'];
   header('Location:bookings_data.php');
}elseif(isset($_SESSION['date'])){
   $date=$_SESSION['date'];
}else{
   $time=time();
   //date_default_timezone_set('Africa/Nairobi');
   $_SESSION['date']= date('Y-m-d');
   $date = $_SESSION['date'];
   //echo $date;
}
require_once("../connect.php");
 $branch_id = $_SESSION['branch_id'];
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
		        <label for="tab-1" class="tab-label-1">Served customers</label>
		
	            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
		        <label for="tab-2" class="tab-label-2">Pending bookings</label>
		
	            <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
		        <label for="tab-3" class="tab-label-3">Canceled bookings</label>
			    <div class="clear-shadow"></div>			
  <div class="content">
  <div class="content-1" id="served-customer-div">
		<?php include("served_customer_data.php"); ?>
   </div>
   <div class="content-2" id="pending-customer-div">
	<?php include("pending_customer_data.php"); ?>
</div>
<div class="content-3" id="canceled-customer-div">
  <?php include("canceled_customer_data.php"); ?>
 </div>
</div>
</section>
</div>
</body>
</html>