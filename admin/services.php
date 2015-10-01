<?php
if(!isset($_SESSION)){
  session_start();
}
require_once("../connect.php");
//include("../encrypt/encrypt.php");
?>
<?php
$right_name="services";// the right needed to access this content
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
                        <li>
                          <a href="index.php?rqt=<?php $data = "customers";	
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>" title="Registered customers"><i class="icon-chevron-right"></i> Customers</a>
                        </li>
						<?php } ?>
						<?php if(isset($_SESSION['services'])){?>
                        <li class="active">
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
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    
	                                    <li class="active"><h4>Our Services</h4></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Services</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Service</th>
												<th>Duration</th>
												<th>Cost</th>
												<!--<th>&nbsp;</th>-->
											</tr>
										</thead>
										<tbody>
										<?php
										$sel=mysql_query("select * from service")or die(mysql_error());
										while($val=mysql_fetch_array($sel)){
										$service_id=$val['service_id'];
										$service_name=$val['service_name'];
										$service_duration=$val['service_duration'];
										$service_photo=$val['service_photo'];
										$service_price=$val['service_price'];
										?>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/services/<?php echo $service_photo; ?>" width="40px" />&nbsp;<?php echo $service_name; ?>
</td>
	<td valign="middle" style="color:#009900"><?php echo $service_duration; ?> min</td>
	<td valign="middle" style="color:red"><?php echo $service_price; ?></td>
	<!--<td><a href="service_details.php?cmd=<?php $data = '{"service_id":"'.$service_id.'"}';		$encryption=new Encryption;
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>"><input type="button" class="btn-danger" value="Details"/></a></td>	-->											
											</tr>
											<?php } ?>
											</tbody>
									</table>
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
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>