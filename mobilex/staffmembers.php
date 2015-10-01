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
</head>

<body>
<div class="logo">
    <a href="#"><img src="../images/logo.png" alt="Sparkles salon" style="max-height:50px"></a>
</div>
<div id="menu_bannerx" class="header">
	<div class="wrap top-bar" style="padding-left:10px">
    	<img class="menu-show" src="images/menu-icon.png" height="30px" alt="plus">
		<img class="menu-hide" src="images/menu-icon.png" height="30px" alt="plus">
    	
        <div class="search" id="search-div">
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
    <div class="post">
	  <h5>Garden City, staff members</h5>            
    </div>        
 <div class="post">
  <?php
	//1
	$name[0]="Joan Kalule";
	$service[0]="14";
	$tel[0]="0784210858";
	//2
	$name[1]="Sempijja Martin";
	$service[1]="09";
	$tel[1]="0704345687";
	//3
	$name[2]="Jenifer Matovu";
	$service[2]="13";
	$tel[2]="0703564412";
	//4
	$name[3]="Kabwama Victor";
	$service[3]="07";
	$tel[3]="070387512";
	//5
	$name[4]="Nuwagaba Eddie";
	$service[4]= "34";
    $tel[4]="0753097865";
	$count=0;
	while($count<5){		
	?>
    <div class="booking" style="border-bottom:1px solid #CCCCCC; margin-bottom:5px;">
	<p class="profile"><img src="../images/ccz.png" width="50px">&nbsp;<a href="#"><?php echo $name[$count]; ?></a></p>
		<p align="center">Has <span style="color:red"><?php echo $service[$count]; ?></span> bookings today.</p>
	<p class="details" align="right"><a class="service" href="staffcalender.php"><input type="button" value="Calender" class="btn-success"/></a> </p>
	</div>
  	<?php
	  $count++;
	}
	?>
	<style type="text/css">
	.booking .profile a{ color:#000099; font-size:large; }
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
