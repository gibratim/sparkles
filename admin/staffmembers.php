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
   header('Location:staffmembers.php');
}elseif(!isset($_SESSION['branch_id'],$_SESSION['branch_name'], $_SESSION['branch_photo'])){
  echo "<h1 style='color:red'>ACCESS  DENIED</h1>";
  return;
}else{
  $branch_id = $_SESSION['branch_id'];
  $branch = $_SESSION['branch_name'];
  $branch_photo = $_SESSION['branch_photo'];
}
?>
<?php $encryption=new Encryption;?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Sparkles Salon</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<style type="text/css">
 body{
   /*font-family:"Century Gothic";*/
 }
</style>
</head>
    
    <body>
        <?php include("top_bar.php"); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                         <?php if(isset($_SESSION['staff_calendar'])){?>
                        <li class="active">
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
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                   
	                                    <li class="active"><h4><img src="../images/branches/<?php echo $branch_photo;?>" width="50px"/>&nbsp;<?php echo $branch; ?>, staff members</h4></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <?php  
					$count=0;
					$selb=mysql_query("select * from staff where branch_id='$branch_id'")or die(mysql_error());
					while($valb=mysql_fetch_array($selb)){
					 $count++;
					 $name=$valb['staff_name'];
					 $tel=$valb['staff_contact'];
					 $photo=$valb['staff_photo'];
					 $id=$valb['staff_id'];
					?>
					<?php if($count%2!=0){ 
					//first column at the left
					?>
					<div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $branch;?></div>
                                 </div>
                                <div class="block-content collapse in">
                                    <table width="100%">                                        
                                        <tbody>
                                            <tr>
                                                <td width="40%"><img src="../images/admin/<?php echo $photo; ?>" style="border:1px solid #CCCCCC; border-radius:10px" /></td>
 <td width="60%" align="center"><?php echo $name; ?><br/>
<span style="color:#CC0000"><?php echo $tel; ?> </span><br/>
<a href="staffcalendar.php?cmd=<?php $data = '{"staff_id":"'.$id.'","staff_name":"'.$name.'","staff_photo":"'.$photo.'"}';
$encryption=new Encryption;		$encrypted = $encryption->encode($data); echo $encrypted; ?>">
<input type="button" value="Calender" class="btn-success"/></a>
												</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
						<?php } else{
						//second column at the right
						?>
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $branch;?></div>
                                 </div>
                                <div class="block-content collapse in">
                                    <table width="100%">                                        
                                        <tbody>
                                            <tr>
                                                <td width="40%"><img src="../images/admin/<?php echo $photo; ?>" style="border:1px solid #CCCCCC; border-radius:10px" /></td>
                                                <td width="60%" align="center"><?php echo $name; ?><br/>
												<span style="color:#CC0000"><?php echo $tel; ?></span><br/>
		<a href="staffcalendar.php?cmd=<?php $data = '{"staff_id":"'.$id.'","staff_name":"'.$name.'","staff_photo":"'.$photo.'"}';
$encryption=new Encryption;		$encrypted = $encryption->encode($data); echo $encrypted; ?>">
<input type="button" value="Calender" class="btn-success"/></a>
												</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                    </div>
					<?php
					  }//ends else
					  
				}//ends while			
				
		?>   
		<?php 
		if($count>0 && $count%2!=0){
		?> 
		</div>
		<?php
		  }
		  if($count==0){
		    
		?> 
		<div><h2 style="color:#6F0037; text-align:center">No staff records found</h2></div>
		<?php
		}
		?>               
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