<?php
include("../connect.php");
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
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
    </head>
    
    <body>
        <?php include("top_bar.php"); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li>
                            <a href="index.php" title="Incoming bookings"><i class="icon-chevron-right"></i> Home</a>
                        </li>
						<li>
                            <a href="transactions.php" title="for every branch"><span class="badge badge-success pull-right">250</span> Bookings</a>
                        </li>
                        <li class="active">
                            <a href="branches.php" title="Staff members"><i class="icon-chevron-right"></i> Branches</a>
                        </li>                        
                        <li>
                            <a href="customers.php" title="Registered customers"><i class="icon-chevron-right"></i> Customers</a>
                        </li>
                        <li>
                            <a href="services.php" title="Services that we offer"><i class="icon-chevron-right"></i> Services</a>
                        </li>
                        <!--<li>
                            <a href="reports.php" onClick="resize_fn();" title="Summary of the business"><i class="icon-chevron-right"></i> Reports</a>
                        </li>	
                         <li>
                            <a href="offers.php" title="our offers"><i class="icon-chevron-right"></i> Offers</a>
                        </li>
                        <li>
                            <a href="tips" title="Beauty tips"><i class="icon-chevron-right"></i> Tips</a>
                        </li>-->
                                       
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!--<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success</h4>
                        	The operation completed successfully</div> -->
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="#">Adminstrator</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li class="active">Dashboard</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <?php					
					$selb=mysql_query("select * from staff")or die(mysql_error());
					$valb=mysql_fetch_array($selb);
					 $name=$valb['staff_name'];
					 $tel=$valb['staff_contact'];
					 $photo=$valb['staff_photo'];
					?>
					
					<div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Sparkles Salon</div>
                                    <div class="pull-right"><a href="#" title="Edit"><i class="icon-calendar"></i></a></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table width="100%">                                        
                                        <tbody>
                                            <tr>
                                                <td width="40%"><img src="../images/admin/<?php echo $photo; ?>" style="border:1px solid #CCCCCC; border-radius:10px" /></td>
                                                <td width="60%" align="center"><?php echo $name; ?><br/>
												<span style="color:#CC0000"><?php echo $tel; ?> </span><br/>
												</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>                        
                    </div>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Services offered by <?php echo  $name;?></div>
								<div class="pull-right"><a href="#" title="Add service"><i class="icon-calendar"></i></a></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Service</th>
												<th>Price</th>
												<th>&nbsp;</th>
												
											</tr>
										</thead>
										<tbody>
										<?php
										$selx=mysql_query("select * from staff_service a right outer join service b on(a.service_id=b.service_id) where a.staff_contact='$tel'") or die(mysql_error());
									   while($valx=mysql_fetch_array($selx)){	
									    $service=$valx['service_name'];
										$sphoto=$valx['service_photo'];
										$price=$valx['service_price'];
										?>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/services/<?php echo $sphoto; ?>" width="40px" /> <?php echo $service;?></td>
												<td valign="middle" style="color:#009900"><?php echo $price; ?></td>
												<td valign="middle" style="color:red"><input type="button" value="Delete" class="btn-danger" title="Unattach service from <?php echo $name;?>" /></td>												
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