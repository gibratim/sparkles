<?php
include("../connect.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Sparkles Salon</title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link rel="stylesheet" href="style.css" type="text/css" media="all">
<style type="text/css">
boby{
color:#666666;
text-align:justify;
}
</style>
<!--<script src="../js/jquery.js" type="text/javascript"></script>-->
<script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script>
	//fixing
(function($)
{
    $(document).ready( function()
    {
        var elementPosTop = $('#menu_bannerx').position().top;
        $(window).scroll(function()
        {
            var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
            //if top of element is in view
            if (wintop > elementPosTop)
            {
                //always in view
                $('#menu_bannerx').css({ "position":"fixed", "top":"0px","0":"0","width":"100%","margin-top":"0px"});
                  document.getElementById('search-div').innerHTML="<img src='../images/logo.png' style='max-height:40px' />";

            }
            else
            {
                //reset back to normal viewing
                $('#menu_bannerx').css({ "position":"inherit"});
                  document.getElementById('search-div').innerHTML="&nbsp;";
            }
        });
    });
})(jQuery);
</script>
<link href="../datepickerx/styles/glDatePicker.default.css" rel="stylesheet" type="text/css">
<link href="../datepickerx/styles/glDatePicker.darkneon.css" rel="stylesheet" type="text/css">
<link href="../datepickerx/styles/glDatePicker.flatwhite.css" rel="stylesheet" type="text/css">

<script src="../datepickerx/glDatePicker.min.js"></script>

<script type="text/javascript">
function resize_date_picker(){
var width = $(window).width();
if(width>300){
document.getElementById("datepicker-1").style.width = "300px";
}else{
  width=width-50;
 document.getElementById("datepicker-1").style.width = ""+width+"px";
}
$('#datepicker-1').glDatePicker({	
		 showAlways: false , cssName: 'darkneon',
		 dowNames:[ 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa' ]
		 ,
		 monthNames:[ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
		
		});
}

</script>
<!--<script type="text/javascript">
function date(){
 document.getElementById('loading').innerHTML='<img src="../images/load.gif" />';
 clear_loading();
}
function clear_loading(){
  setInterval(   function (){
       document.getElementById('loading').innerHTML='&nbsp;';
     }, 6000); // refresh every 10000 milliseconds
}
</script>-->
</head>

<body onLoad="resize_date_picker()"  onResize="resize_date_picker()">
<div class="logo">
    <a href="#"><img src="../images/logo.png" alt="Sparkles salon" style="max-height:50px"></a>
</div>
<div id="menu_bannerx" class="header">
	<div class="wrap top-bar" style="padding-left:10px">
    	<img class="menu-show" src="images/menu-icon.png" height="30px" alt="plus">
		<img class="menu-hide" src="images/menu-icon.png" height="30px" alt="plus">
    	
        <div class="search" id="search-div">
        	<!--<form>
            	<input type="text">
                <input type="submit" value="">
            </form>-->
        </div>
        <div class="clear-both"></div>
        <nav class="menu">
            <ul>
             <li>
			                <a href="index.php" title="Incoming bookings">Bookings</a>
                        </li>
                        <li>
                            <a href="branches.php" title="Staff members">Staff calendar</a>
                        </li>                        
                        <li>
                            <a href="customers.php" title="Registered customers">Customers</a>
                        </li>
                        <li>
                            <a href="services.php" title="Services that we offer">Services</a>
                        </li>
            </ul>
        </nav>
    </div>
</div>
<div class="content">
  <div class="wrap">
    <div class="post" style="background-color:#F0F0F0;  padding-left:2px">
	 <p class="profile"><img src="../images/ccz.png" width="50px">&nbsp;<a href="#">Joan Kalule</a>'s schedule</p>
	 <p  align="left"> 
	 <input type="button" class="btn-success" id="datepicker-1" onChange="alert('I have changed')"  
	 value="<?php $date = date('d-m-Y', time()); echo $date; ?>" 
	 style="color:#FFFFFF; font-size:medium; text-align:center; margin-right:10px;"  /><span id="loading">&nbsp;</span>
	  </p>        
    </div>        
 <div class="post">
  <?php
	//1
	$status[0]="working";
	$time[0]="8:00AM - 8:35AM";
	$customer[0]="Namuli Sarah";
	$service[0]="Beautex  anti dandruff treatment set";
	$cost[0]="45,000";
	//2
	$status[1]="working";
	$time[1]="8:35AM - 9:17AM";
	$customer[1]="Zoey Lyn";
	$service[1]="Mayonnaise";
	$cost[1]="35,000";
	//
	$status[2]="Free";
	$time[2]="9:17AM - 11:17AM";
	//
	$status[3]="working";
	$time[3]="11:17AM - 12:03PM";
	$customer[3]="Jenifer Matovu";
	$service[3]="Vitale treatment";
	$cost[3]="60,000";
	//
	$status[4]="Free";
	$time[4]="12:03PM - 03:14PM";
	//
	$status[5]="working";
	$time[5]="03:15PM - 04:02PM";
	$customer[5]="Nakato Jenifer";
	$service[5]="Vitale treatment";
	$cost[5]="60,000";
	//4
	//
	$status[6]="Free";
	$time[6]="04:03PM - 06:34PM";
	//
	$status[7]="working";
	$time[7]="06:35PM - 07:22PM";
	$customer[7]="Kabwama Victor";
	$service[7]="Clipper hair";
	$cost[7]="45,000";
	//5
	$status[8]="working";
	$time[8]="07:23PM - 08:00PM";	
	$customer[8]="Nuwagaba Eddie";
	$service[8]= "Clipper hair";
    $cost[8]="45,000";
	$count=0;
	while($count<9){
	?>
	<?php 
	if($status[$count]=="working"){	
	?>
    <div class="booking" style="border-bottom:1px solid #CCCCCC; margin-bottom:5px; text-align:justify;">
	<p style="color:#006600"><?php echo $time[$count];?></p>
	<p class="profile" style="font-size:small;"><img src="../images/ccz.png" width="30px">&nbsp;<?php echo $customer[$count]; ?></p>
	<p style="font-size:small;"><?php echo $service[$count]." at ".$cost[$count]; ?>/=</p>
	</div>
	<?php
	}else{
	?>
	<div class="booking" style="border-bottom:1px solid #CCCCCC; margin-bottom:5px;background-color:#F0F0F0; padding-left:5px">
	<p style="color:#006600"><?php echo $time[$count];?></p>	
		<p ><span style="color:red">Vacant</span></p>
	</div>
	<?php
	}
	?>
  	<?php
	  $count++;
	}
	?>
	<style type="text/css">
	.booking .profile a{ color:#000099;}
	.booking .profile a:hover{ color:#0066FF; text-decoration:none;	}
	.details{ font-size:small; }
	.details a{ color:#006666;}
	.details a:hover{ color:#0066FF; text-decoration:none;	}
	.btn-success{
	background-color:#009900;
	padding:5px;
	border:none;
	color:#CCCCCC;
	border-radius:5px;
	}
	.btn-success:hover{
	background-color:#00CC00;
	color:#FFFFFF;
	}
	</style>
	<!-- <a href="#"><input type="button"  class="btn-success" value="More" /></a> -->           
        </div>
		
    </div>
</div>
<div class="footer">
	<div class="wrap bot-bar">
    	<img src="../images/logo.png" style="max-height:50px;" /> 
        <div class="clear-both"></div>
    </div>
</div>
<script type="text/javascript">
	$('.menu').hide();
	$('.menu-show').show();
	$('.menu-hide').hide();
	$('.menu-show').click(function(){
		$('.menu-show').toggle();
		$('.menu-hide').toggle();
		$('.menu').slideDown();
	});
	$('.menu-hide').click(function(){
		$('.menu-hide').toggle();
		$('.menu-show').toggle();
		$('.menu').slideUp();
	});
</script>
</body>
</html>
