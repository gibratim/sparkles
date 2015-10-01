<?php
//delete any saved sessions
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
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
    </head>
    <body id="page">
        <ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Beauty</h3></div></li>
            <li><span>Image 02</span><div><h3>Hair</h3></div></li>
            <li><span>Image 03</span><div><h3>Nails</h3></div></li>
            <li><span>Image 04</span><div><h3>Sparkles salon</h3></div></li>
            <li><span>Image 05</span><div><h3>Make up</h3></div></li>
            <li><span>Image 06</span><div><h3>Facial</h3></div></li>
        </ul>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="index.php">
                    <strong>&laquo; HOME: </strong>
                </a>
                <span class="right">
                    <a href="#" target="_blank">SPARKLES SALON</a>
                    <a href="#" target="_blank">ABOUT US</a>
                    <a href="#">
                        <strong>Contact us</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
			<header>
                <h1><img src="images/logo.png"/></h1>
                
				<p class="codrops-demos">					
			  <form action="" method="post">
					<table>
					<tr><td align="center"><h2>Staff login</h2></td></tr>
					<tr><td align="center"><input class="login-text-input" name="contact" type="text" placeholder="Username"/></td></tr>
					<tr><td align="center"><input class="login-text-input" type="password" name="password" placeholder="Password" /></td></tr>
					<tr><td style="color:#99FFFF" align="center"><?php 
					include("connect.php");
					if(isset($_REQUEST['contact'],$_REQUEST['password'])){
					  $contact=$_REQUEST['contact'];
					  $password=sha1($_REQUEST['password']);
					  $sel=mysql_query("select * from user u inner join user_group g on(u.group_id=g.group_id) where (email='$contact' || contact='$contact') && password='$password'")or die(mysql_error());
					  $val=mysql_fetch_array($sel);
					  if($val){
					     session_start();
					     $_SESSION['username']=$contact;//email
						 $_SESSION['email']=$val['email'];//email
						 $_SESSION['contact']=$val['contact'];//contact
					     $_SESSION['branch_id']=$val['branch_id'];//branch_id
						 $_SESSION['full_name']=$val['staff_name'];//name
						 $_SESSION['user_photo']=$val['photo'];//photo
					     $_SESSION['group_id']=$val['group_id'];//user group for the user rights					   
					     require_once("devicex.php");//for detecting the device of the user
					  if($mobile_device){
					     header("Location:mobilex/");
					  }else{
					     header("Location:admin/");
					  }
					  }else{
					    echo "Invalid user name or password!";
					  }
					}
					
					?></td></tr>
					<tr><td align="center"><input id="submit-button" type="submit" value="Login" /></td></tr>
					
					<tr><td align="center"><h2>NOTE: If you are our client, download<br/> our app from the <a href="#">Google play store</a></h2></td></tr>
					</table>
			  </form>
				</p>
				<style type="text/css">
				 .login-text-input{
				  border:none;
				  margin:5px;
				  padding:5px;
				  background-color:#993300;
				  font-family:"Times New Roman", Times, serif;
				  font-stretch:expanded;
				  font-size:large;
				  color:#FFFFFF;
				  font-weight:bold;
				  border-radius:5px; 
				 }
				 #submit-button{
				  border:none;
				  border-radius:15px;
				  margin:5px;
				  padding:5px;
				  font-size:x-large;
				  font-weight:bold;
				  font-family:"Times New Roman", Times, serif;
				  color:#993300;
				  font-stretch:expanded;
				  
				 }
				</style>
            </header>
        </div>
    </body>
</html>