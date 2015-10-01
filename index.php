<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Sparkles salon</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Fullscreen Background Image Slideshow with CSS3 - A Css-only fullscreen background image slideshow" />
        <meta name="keywords" content="css3, css-only, fullscreen, background, slideshow, images, content" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="slide/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="slide/css/style3.css" />
		<script type="text/javascript" src="slide/js/modernizr.custom.86080.js"></script>
			<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
		  function resize_fn(){
		   var total = $(window).height();
		  var bn1=$("#top_banner").height();
		  var bn2=$("#menu_banner1").height();
		  var ht=total-bn1-bn2-50;
		  document.getElementById('empty_banner').style.height=ht+'px';
		   //alert("Banner 1: "+bn1+" Banner2: "+bn2+" total: "+total+" remaining: "+ht);
		   //alert("Method here");
		 }
</script>
	
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
                $('#menu_banner1').css({ "position":"fixed", "top":"0px","0":"0","width":"100%","margin-top":"0px","background-color":"rgba(255,255,255,0.99)","transition":"background 3s"});
            }
            else
            {
                //reset back to normal viewing
                $('#menu_banner1').css({ "position":"inherit","background-color":"rgba(255,255,255,0.5)","transition":"background 1s"});
            }
        });
    });
})(jQuery);

</script>
<style type="text/css">
.scrolled {
    background-color: red;

}

</style>

    </head>
    <body id="page" onLoad="resize_fn();" onResize="resize_fn();" onFocus="resize_fn();"  >
	
        <ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Beauty</h3></div></li>
            <li><span>Image 02</span><div><h3>Hair Dressing</h3></div></li>
            <li><span>Image 03</span><div><h3>Nails</h3></div></li>
            <li><span>Image 04</span><div><h3>Barber</h3></div></li>
            <li><span>Image 05</span><div><h3>Facial</h3></div></li>
            <li><span>Image 06</span><div><h3>Grooming</h3></div></li>
        </ul>
        <div class="container">
		   <!-- Codrops top bar -->
            <div id="top_banner" class="codrops-top">
                
                <span class="right">
                    <a href="#" target="_blank">ABOUT US</a>
                    <a href="#">
                        <strong>Contact us</strong>
                    </a>
					<a href="login.php">
                        <strong>Log in</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->			
			<div id="menu_banner1" style="background-color:rgba(255,255,255,0.5); text-align:left"><table width="100%"><tr><td width="40%"><img src="images/logo.png" width="70%"/></td><td width="60%" align="center"><ul id="salon_menu"><li><a href="#">Women</a></li><li><a href="#">Men</a></li><li><a href="#">Kids</a></li><li><a href="#">Bridal</a></li><li><a href="#">Gallery</a></li></ul></td></tr></table></div>
			<style type="text/css">
            #salon_menu{
			 
			}
			#salon_menu li{
			 display:inline;
			 margin:5px;
			 font-size:large;
			 /*background-color:rgba(255,255,255,0.5);*/
			 padding:5px;
			 font-family:Arial, Helvetica, sans-serif;
			 border-radius:10px;			 
			}
			#salon_menu li a{
			  color:#333333;
			}
			#salon_menu li:hover{
			 background-color:rgba(0,0,0,0.5);
			 
			}
			#salon_menu li a:hover{
			   color:#CCCCCC;
			}
			</style>
			<!--Empty div to put the scroll down icon at the bottom-->
			<div id="empty_banner" >&nbsp;</div>
			<!--Empty div to put the scroll down icon at the bottom-->
			<div style="text-align:center; margin:0px;"><img src="images/scroll-to-content-tab.png" height="50px"  /></div>
			<div style=" width:100%;margin:auto; background-color:rgba(255,255,255,0.8); padding:2%;">			
			
			<div style="width:40%; float:left; padding:5px; border-radius:10px; text-align:left">
			<h1 style="color:#B30915; font-family:Arial, Helvetica, sans-serif; font-size:x-large; text-align:center">Sparkles Salons</h1>
			<p style="color:#333333; font-family:Arial, Helvetica, sans-serif;">With a dedicated line of professionals and unisex units, our branches are all well within appropriate range for price, proximity and identity. We welcome first time and repeat patrons to take advantage of our award winning services, yet also value all feedback as the most critical asset in our growth and development.</p>
			</div>
			<div style="width:40%; margin-left:50%;padding:5px;border-radius:10px;">
			<h1 style="color:#B30915; font-family:Arial, Helvetica, sans-serif; font-size:x-large">Award winning Services</h1>
			<p style="color:#333333; font-family:Arial, Helvetica, sans-serif; text-align:left">Sparkles Salons offer an outstanding array of services  across our his and her’s lines. We welcome local and international patrons, given that our team of stylists across our various sites are talented at what they do and will work as hard as always to please and impress.
			</p>
			</div>			
			
			</div>
			
			
			
			
			
		
			<div style="margin:0px; background-color:#330000; border-top:1px solid #CCCCCC;"><img src="images/logo.png"  height="50px" /></div>
			
            
        </div>
		
    </body>
</html>