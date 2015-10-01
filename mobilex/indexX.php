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
<script src="../js/jquery.js" type="text/javascript"></script>
<script>
	//fixing
(function($)
{
    $(document).ready( function()
    {
        var elementPosTop = $('#menu_banner1').position().top;
        $(window).scroll(function()
        {
            var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
            //if top of element is in view
            if (wintop > elementPosTop)
            {
                //always in view
                $('#menu_banner1').css({ "position":"fixed", "top":"0px","0":"0","width":"100%","margin-top":"0px"});
                  document.getElementById('search-div').innerHTML="<img src='../images/logo.png' style='max-height:40px' />";

            }
            else
            {
                //reset back to normal viewing
                $('#menu_banner1').css({ "position":"inherit"});
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
<div id="menu_banner1" class="header">
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
               <li class="active">
                            <a href="index.php" title="Incoming bookings">Home</a>
                        </li>
						<li>
                            <a href="transactions.php" title="for every branch"> Bookings</a>
                        </li>
                        <li>
                            <a href="branches.php" title="Staff members"> Staff calender</a>
                        </li>                        
                        <li>
                            <a href="customers.php" title="Registered customers">Customers</a>
                        </li>
                        <li>
                            <a href="services.php" title="Services that we offer">Services</a>
                        </li>
                        <!--<li>
                            <a href="reports.php" onClick="resize_fn();" title="Summary of the business">Reports</a>
                        </li>	
                         <li>
                            <a href="offers.php" title="our offers">Offers</a>
                        </li>
                        <li>
                            <a href="tips.php" title="Beauty tips">Tips</a>-->
                        </li>

            </ul>
        </nav>
    </div>
</div>
<div class="content">
  <div class="wrap">
    <div class="post">
	  <h3>New bookings</h3>            
    </div>        
    <div class="post">
	<?php
	//1
	$name[0]="Joan Kalule";
	$service[0]="Kit relaxer without treatment";
	$cost[0]="27,000";
	//2
	$name[1]="Sempijja Martin";
	$service[1]="Vitale relaxer without treatment";
	$cost[1]="30,000";
	//3
	$name[2]="Jenifer Matovu";
	$service[2]="Beautex  anti dandruff treatment set";
	$cost[2]="40,000";
	//4
	$name[3]="Kabwama Victor";
	$service[3]="Clipper hair";
	$cost[3]="38,000";
	//5
	$name[4]="Nuwagaba Eddie";
	$service[4]= "Beautex  anti dandruff treatment set";
$cost[4]="40,000";

	  $count=0;
	  while($count<5){
		
	?>
    <div class="booking" style="border-bottom:1px solid #CCCCCC; margin-bottom:5px;">
	<p class="profile"><img src="../images/ccz.png" width="50px">&nbsp;<a href="#"><?php echo $name[$count];?></a></p>
	<p class="details">Booked for <a class="service" href="#"><?php echo $service[$count];?></a>  for <?php echo $cost[$count];?>/= due 12/09/2015 1:00PM. To be served by <a class="staff" href="#">Namuli sarah</a></p>
	<p style="color:red"><?php echo ($count+1)*2; ?> mins ago</p>
	</div>
  	<?php
	$count++;
	}
	?>
	<style type="text/css">
	.booking .profile a{ color:#000099;	 font-size:large; font-weight:bold;	}
	.booking .profile a:hover{ color:#0066FF; text-decoration:none;	}
	.details{ font-size:small; }
	.details a{ color:#006666;}
	.details a:hover{ color:#0066FF; text-decoration:none;	}
	.btn-success{
	background-color:#009900;
	padding:5px;
	border:none;
	color:#CCCCCC;
	}
	.btn-success:hover{
	background-color:#00CC00;
	color:#FFFFFF;
	}
	</style>
	<a href="#"><input type="button"  class="btn-success" value="More" /></a>            
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
