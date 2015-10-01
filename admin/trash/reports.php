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
<script type="text/javascript">
		  function resize_fn(){
		   var height = $(window).height();
		   var width = $(window).width();
		   if(width<500){
		     window.location.href = "../mobile/reports.php";
		   }		   
		 }
</script>  </head>
    
    <body onLoad="resize_fn()" onResize="resize_fn();">
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><img src="../images/logo.png" width="100px"/></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> Admin <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Logout</a>
                                    </li>                                  
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="badge badge-important pull-right">812</span> Bookings&nbsp;
                                </a>
                                
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important pull-right">254</span> Feedback&nbsp;
                                </a>
                             </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important pull-right">13</span> Notifications &nbsp; 

                                </a>                               
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
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
                        <li>
                            <a href="branches.php" title="Staff members"><i class="icon-chevron-right"></i> Branches</a>
                        </li>                        
                        <li>
                            <a href="customers.php" title="Registered customers"><i class="icon-chevron-right"></i> Customers</a>
                        </li>
                        <li>
                            <a href="services.php" title="Services that we offer"><i class="icon-chevron-right"></i> Services</a>
                        </li>
                        <li class="active">
                            <a href="#" title="Summary of the business"><i class="icon-chevron-right"></i> Reports</a>
                        </li>	
                         <li>
                            <a href="offers.php" title="our offers"><i class="icon-chevron-right"></i> Offers</a>
                        </li>
                        <li>
                            <a href="tips.php" title="Beauty tips"><i class="icon-chevron-right"></i> Tips</a>
                        </li>
                                       
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
	                                    
	                                    <li class="active"><h3>New bookings</h3></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                  <!--  <div class="row-fluid">-->
                        <!-- block -->
						<!--
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Statistics</div>
                                <div class="pull-right"><span class="badge badge-warning">View More</span>

                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span3">
                                    <div class="chart" data-percent="50">1250</div>
                                    <div class="chart-bottom-heading"><span class="badge badge-inverse">Today's booking</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="-50">857</div>
                                    <div class="chart-bottom-heading"><span class="badge badge-inverse">Today's sales</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="50">1987</div>
                                    <div class="chart-bottom-heading"><span class="badge badge-inverse">Today's visits</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="50">650</div>
                                    <div class="chart-bottom-heading"><span class="badge badge-inverse">Today's unique visits</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                   <!-- </div>-->
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Bookings</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Customer</th>
												<th>Booked date</th>
												<th>Time</th>
												
											</tr>
										</thead>
										<tbody>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">Just now</td>												
											</tr>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">Just now</td>												
											</tr>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">1 min ago</td>												
											</tr>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">1 min ago</td>												
											</tr>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">2 min ago</td>												
											</tr>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">2 min ago</td>												
											</tr>
											<tr class="odd gradeX">
												<td valign="middle"><img src="../images/ccz.png" width="40px" />Joan Kalule</td>
												<td valign="middle" style="color:#009900">02/09/2015</td>
												<td valign="middle" style="color:red">2 min ago</td>												
											</tr>
										</tbody>
									</table>
									<a href="#"><input type="button" class="btn-success" value="More" /></a>
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