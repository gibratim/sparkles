<?php
if(!isset($_SESSION)){
  session_start();
}
require_once("../connect.php");
//include("../encrypt/encrypt.php");
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
<!DOCTYPE html>
<html class="no-js">    
 <head>
  <title>Sparkles Salon</title>
   <!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
<link href="assets/styles.css" rel="stylesheet" media="screen">
<script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="jscroll-master/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jscroll-master/Gruntfile.js" ></script>
<script type="text/javascript" src="jscroll-master/jquery.jscroll.js" ></script>
<script type="text/javascript" src="jscroll-master/jquery.jscroll.min.js" ></script>

<script type="text/javascript">
$(document).ready(function(){ 
$('.customer_data_info').jscroll({
    loadingHtml: '<div style="margin:auto;width:100px;"><img src="../images/loading-bar.gif" height="20px;" alt="Loading" /></div>',
    padding: 20,
    nextSelector: 'a.loadNext:last',
	autoTriggerUntil:0
});
});
</script>
</head>
    
    <body>
        <?php include("top_bar.php"); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <?php $encryption=new Encryption;
					    if(isset($_SESSION['staff_calendar'])){?>
                        <li>
                          <a href="index.php?rqt=<?php $data = "calendar";
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>" title="Incoming bookings"><i class="icon-chevron-right"></i> Staff calender</a>
                       </li>
					   <?php } ?>
					   <?php if(isset($_SESSION['bookings'])){?>						
                       <li>
                          <a href="index.php?rqt=<?php $data = "bookings";	
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>" title="Bookings"><i class="icon-chevron-right"></i>Bookings</a>
                        </li>  
						<?php } ?>
						<?php if(isset($_SESSION['customers'])){?>                  
                        <li class="active">
                          <a href="index.php?rqt=<?php $data = "customers";	
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>" title="Registered customers"><i class="icon-chevron-right"></i> Customers</a>
                        </li>
						<?php } ?>
						<?php if(isset($_SESSION['services'])){?>
                        <li>
                           <a href="index.php?rqt=<?php $data = "services";
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>" title="Services that we offer"><i class="icon-chevron-right"></i> Services</a>
                        </li> 
						<?php } ?>         
                       
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>     <li class="active"><h4>Registered customers</h4></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>              
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registered customers</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">                                    
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
$sel=mysql_query("select * from customer")or die(mysql_error());
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
	<input type="button" class="btn-success" value="Details" /></a></td>	-->											
</tr>
<?php 
}
?>
</tbody>
</table>
<?php
if($_SESSION['break']==1){
?>
<div class="customer_data_info"><a href="customers_data.php" class="loadNext"><input type="button" value="More" class="btn-danger" /></a></div>
<?php
}
?>
</div>
</div>
</div>
<!-- /block -->
</div>                    
</div>
</div>
<hr>
<footer>
<p><img src="../images/logo.png" width="200px" /></p>
 </footer>
</div>
 <script src="bootstrap/js/bootstrap.min.js"></script>
 <script src="assets/scripts.js"></script>
</body>

</html>