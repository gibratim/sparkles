<?php
session_start();
//session_destroy();
require_once("../connect.php");
include("../encrypt/encrypt.php");

if(isset($_REQUEST['cmd'])){
  $encrypted=$_REQUEST['cmd'];
  $encryption=new Encryption;
  $data = $encryption->decode($encrypted);
  $json = json_decode($data);
  $_SESSION['branch_id'] = $json->{"branch_id"};
  $_SESSION['branch_name'] = $json->{"branch_name"};
  $_SESSION['branch_photo']= $json->{"branch_photo"};
   header('Location:bookings.php');
}elseif(!isset($_SESSION['branch_id'],$_SESSION['branch_name'], $_SESSION['branch_photo'])){
  echo "<h1 style='color:red'>ACCESS  DENIED</h1>";
  return;
}else{
  $branch_id = $_SESSION['branch_id'];
  $branch = $_SESSION['branch_name'];
  $branch_photo = $_SESSION['branch_photo'];
}
?>

<?php
 $time=time();
   //date_default_timezone_set('Africa/Nairobi');
   $date= date('Y-m-d') ;
   $_SESSION['date']=$date;
   $date2=date('d-M-Y');
   //echo $date;
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
        <?php include("top_bar.php");?>
        <div class="container-fluid">
            <div class="row-fluid">
			<!--
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
                       <li class="active">
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
                        <li>
                           <a href="index.php?rqt=<?php $data = "services";
	$encrypted = $encryption->encode($data);	echo $encrypted; ?>" title="Services that we offer"><i class="icon-chevron-right"></i> Services</a>
                        </li> 
						<?php } ?>         
                   
                    </ul>
                </div>
                -->
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        
                        	<div class="navbar" style="width:100%">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
										<li class="active"> <h4><img src="../images/branches/<?php echo $branch_photo;?>" width="50px"/>&nbsp;&nbsp;<span style="color:#59002D"><?php echo $branch;?></span> Today (<?php echo $date2;?>) &nbsp;&nbsp;<a href="index.php"><input type="button" class="btn-danger" value="Back" /></a></h4></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    
					<div class="row-fluid">
					<?php include("bookings_data.php"); ?>
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
		<style type="text/css">
article.tabs
{
	position: relative;
	display: block;
	width: 90%;
	height: 90%;
	
	/*margin: 2em auto;*/
}
article.tabs section
{
	position: absolute;
	display: block;
	top: 1.8em;
	left: 0;
	width:100%;
	height: 100%;
	padding: 10px 20px;
	background-color:#FFFFFF;
	border-radius: 5px;
	border-top:1px solid #EAEAEA;
	box-shadow: 0 3px 3px rgba(0,0,0,0.1);
	z-index: 0;
}
article.tabs section:first-child
{
	z-index: 1;
}
article.tabs section h2
{
	position: absolute;
	font-size: 1em;
	font-weight: normal;
	width: auto;
	height: 1.8em;
	top: -1.8em;
	left: 10px;
	padding-left: 5px;
	padding-right: 5px;
	margin: 0;
	margin-left: 5px;
	color:#FFFFFF;
	background-color:#D97566;
	border-radius: 5px 5px 0 0;
}

article.tabs section:nth-child(2) h2
{
	left: 132px;
}

article.tabs section:nth-child(3) h2
{
	left: 254px;
}

article.tabs section h2 a
{
	display: block;
	width: 100%;
	line-height: 1.8em;
	text-align: center;
	text-decoration: none;
	color: inherit;
	outline: 0 none;
}
article.tabs section:target,
article.tabs section:target h2
{
	color: #333;
	background-color:#fff;
	z-index: 2;
}
article.tabs section,
article.tabs section h2
{
	-webkit-transition: all 500ms ease;
	-moz-transition: all 500ms ease;
	-ms-transition: all 500ms ease;
	-o-transition: all 500ms ease;
	transition: all 500ms ease;
}
</style>
    </body>

</html>