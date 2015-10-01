<?php
if(!isset($_SESSION)){
  session_start();
}
require_once("../connect.php");
//include("../encrypt/encrypt.php");
?>
<?php
$right_name="bookings";// the right needed to access this content
$username=$_SESSION['username'];
$group_id=$_SESSION['group_id'];
$branch_id=$_SESSION['branch_id'];
if(isset($_SESSION[''.$right_name.''])){
   $branches=$_SESSION[''.$right_name.'_branches'];
   $view=$_SESSION[''.$right_name.'_view']; 
   $add=$_SESSION[''.$right_name.'_add'];
   $edit=$_SESSION[''.$right_name.'_edit'];
   $delete=$_SESSION[''.$right_name.'_delete'];
}else{
   header("Location:index.php");
}
//var_dump($_SESSION);
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
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>        
	                                    <li class="active"><h3>Bookings</h3></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <?php  
					$count=0;
					if($branches=='all'){
					   $selb=mysql_query("select * from branch")or die(mysql_error());
					}else{
					   $selb=mysql_query("select * from branch where branch_id='$branch_id'")or die(mysql_error());
					}
					while($valb=mysql_fetch_array($selb)){
					 $count++;
					 $name=$valb['branch_name'];
					 $address=$valb['address'];
					 $cell=$valb['branch_cellphone'];
					 $tel=$valb['branch_telephone'];
					 $photo=$valb['branch_photo'];
					 $branch_id=$valb['branch_id'];
					?>
					<?php if($count%2!=0){ 
					//first column at the left
					?>
					<div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $name;?></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table width="100%">                                        
                                        <tbody>
                                            <tr>
                                                <td width="40%"><img src="../images/branches/<?php echo $photo; ?>" style="border:1px solid #CCCCCC; border-radius:10px" width="100%" /></td>
                                                <td width="60%" align="center"><?php echo $address; ?><br/>
												<span style="color:#CC0000"><?php echo $tel; ?> / <?php echo $cell; ?></span><br/>
<a href="bookings.php?cmd=<?php
 $data = '{"branch_id":"'.$branch_id.'","branch_name":"'.$name.'","branch_photo":"'.$photo.'"}';
$encryption=new Encryption; $encrypted = $encryption->encode($data); 	echo $encrypted; ?>"><input type="button" value="Today's bookings" class="btn-success"/></a>&nbsp;&nbsp;	<a href="other_bookings.php?cmd=<?php
	$data = '{"branch_id":"'.$branch_id.'","branch_name":"'.$name.'","branch_photo":"'.$photo.'"}'; $encryption=new Encryption;
	$encrypted = $encryption->encode($data);  echo $encrypted; 	?>">
	<input type="button" value="Others" class="btn-success"/></a>
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
                                    <div class="muted pull-left"><?php echo $name;?></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table width="100%">                                        
                                        <tbody>
                                            <tr>
                                                <td width="40%"><img src="../images/branches/<?php echo $photo; ?>" style="border:1px solid #CCCCCC; border-radius:10px" width="100%" /></td>
                                                <td width="60%" align="center"><?php echo $address; ?><br/>
												<span style="color:#CC0000"><?php echo $tel; ?> / <?php echo $cell; ?></span><br/>
<a href="bookings.php?cmd=<?php $data = '{"branch_id":"'.$branch_id.'","branch_name":"'.$name.'","branch_photo":"'.$photo.'"}';
$encryption=new Encryption; $encrypted = $encryption->encode($data); echo $encrypted;	?>">
<input type="button" value="Today's bookings" class="btn-success"/></a>&nbsp;&nbsp;
<a href="other_bookings.php?cmd=<?php
	$data = '{"branch_id":"'.$branch_id.'","branch_name":"'.$name.'","branch_photo":"'.$photo.'"}'; $encryption=new Encryption;
	$encrypted = $encryption->encode($data);  echo $encrypted; 	?>"><input type="button" value="Others" class="btn-success"/></a>
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