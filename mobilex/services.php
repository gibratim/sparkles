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
	  <h4>Our services</h4>            
    </div>        
    <div class="post">
<?php
//1
$name[0]="Adult medium braids short ";
$service[0]="20";
$cost[0]="Not specified";
//2
$name[1]="Undoing medium size braids";
$service[1]="15";
$cost[1]="Not specified";
//3
$name[2]="Undoing weave, pencil, own hair, all Swahili styles";
$service[2]="14";
$cost[2]="Not specified";
//4
$name[3]="Wash, condition and set normal ";
$service[3]="13";
$cost[3]="Not specified";
//5
$name[4]="Wash and gel puff";
$service[4]="12";
$cost[4]="Not specified";
$count=0;
while($count<5){
								
								
?>
 <div class="booking" style="border-bottom:1px solid #CCCCCC; margin-bottom:5px;">
 <p class="profile"><img src="../images/services/default.png" width="40px">&nbsp;<a href="#"><?php echo $name[$count];?></a></p>
 <p class="details">Duration: <?php echo $service[$count];?> min <br/>Cost: <?php echo $cost[$count];?></p>									
 <p align="right"><input type="button" value="Details" class="btn-success" /></p>
 </div>
  	<?php
	$count++;
	}
	?>
	<style type="text/css">
	.booking .profile a{ color:#000099; font-size:small}
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
