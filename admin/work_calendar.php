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
   header('Location:work_calendar.php');
}elseif(!isset($_SESSION['branch_id'],$_SESSION['branch_name'], $_SESSION['branch_photo'])){
  echo "<h1 style='color:red'>ACCESS  DENIED</h1>";
  return;
}else{
  $branch_id = $_SESSION['branch_id'];
  $branch = $_SESSION['branch_name'];
   $branch_photo = $_SESSION['branch_photo'];
}
?>
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
<link href="../datepickerx/styles/glDatePicker.default.css" rel="stylesheet" type="text/css">
<link href="../datepickerx/styles/glDatePicker.darkneon.css" rel="stylesheet" type="text/css">
<link href="../datepickerx/styles/glDatePicker.flatwhite.css" rel="stylesheet" type="text/css">
<script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js" ></script>
<script src="../datepickerx/glDatePicker.min.js"></script>
<script type="text/javascript">
$(window).load(function(){ 
   $('#pickdate-1').glDatePicker({	
      showAlways: false , cssName: 'darkneon',
	  dowOffset: 1,
      onClick: function(target, cell, date, data) {
	     var day = date.getDate();
	     var month = date.getMonth()+1;
		 if(month<10){
		  month="0"+month;
		 }
	     var year = date.getFullYear();
		 var dt=day+'/'+month+'/'+year;
		 var dx=year+'-'+month+'-'+day;
         target.val(dt);
		 datePicker(dx);
        }		
		});    
	});
</script>
<script type="text/javascript">
//function called by the calendar after date has been modified
function datePicker(date){
   document.getElementById('loading').innerHTML='<img src="../images/load.gif" alt="loading..." />';
    $('#booking_content_div').load('work_calendar_data.php?date='+date);   
   setTimeout(function(){
      document.getElementById('loading').innerHTML='&nbsp;';
    }, 5000);

}
</script>

</head>
<body>
<?php include("top_bar.php"); ?>
<div class="container-fluid">
  <div class="row-fluid" style="width:100%">
    <div class="span9" id="content" style="width:100%">
      <div class="row-fluid">
        <div class="navbar">
    <div class="navbar-inner">
 <ul class="breadcrumb">    
   <li class="active">
   <h4><img src="../images/branches/<?php echo  $branch_photo; ?>" width="50px"/>&nbsp;<?php echo $branch; ?>, work calendar&nbsp;&nbsp;<input type="button" id="pickdate-1" value="<?php 
   
   if(isset($_SESSION['date'])){
   $original = $_SESSION['date'];
   $converted = date("d-M-Y", strtotime($original)); 
   echo $converted;
   
   } else{ 
   $date = date('d-M-Y', time());    
   echo $date;
   } ?>" class="btn-success" style="width:300px; font-size:large"/>&nbsp;&nbsp;<span id="loading">&nbsp;</span>&nbsp;&nbsp;<a href="index.php"><input type="button" class="btn-danger" value="Back" /></a>
   </h4></li>
</ul>
</div>
</div>
</div>
<div class="row-fluid" id="booking_content_div">                        
   <?php include("work_calendar_data.php"); ?>                        
</div>
					
</div>
</div>
<hr>
<footer>
<p><img src="../images/logo.png" width="200px" /></p>
</footer>
</div>
<!--<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="assets/scripts.js"></script>-->
    </body>
</html>