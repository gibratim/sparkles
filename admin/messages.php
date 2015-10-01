<?php
if(!isset($_SESSION)){
  session_start();
}
require_once("../connect.php");
include("../encrypt/encrypt.php");
?>
<?php
$right_name="message";// the right needed to access this content
$username=$_SESSION['username'];
$group_id=$_SESSION['group_id'];
$branch_id=$_SESSION['branch_id'];
if(isset($_SESSION[''.$right_name.''],$_SESSION['email'])){
   $branches=$_SESSION[''.$right_name.'_branches'];
   $view=$_SESSION[''.$right_name.'_view']; 
   $add=$_SESSION[''.$right_name.'_add'];
   $edit=$_SESSION[''.$right_name.'_edit'];
   $delete=$_SESSION[''.$right_name.'_delete'];
//var_dump($_SESSION);
}else{
   header("Location:index.php");
}
$email=$_SESSION['email'];
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
<script type="text/javascript">
 setInterval(function(){
  $('#message_data_div').load('message_data.php');
    }, 60000);
</script>
 </head>    
<body>
 <?php include("top_bar.php"); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    &nbsp;
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    
	                                    <li class="active"><h4>Messages &nbsp;&nbsp;<a href="index.php"><input type="button" class="btn-danger" value="Back" /></a></h4></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Messages</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12" id="message_data_div">                                    
  									<?php include("message_data.php");?>
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
      
    </body>

</html>