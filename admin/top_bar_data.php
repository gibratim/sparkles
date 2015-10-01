<?php
if(session_id()==''){
   session_start();
}
	include("../connect.php");	
	if(isset($_REQUEST['logout'])){//log user out
	session_destroy();
	header("Location:index.php");
	}
		
?>
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
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><img src="../images/staff/<?php echo $_SESSION['user_photo'];?>" width="30px" /><?php echo  $_SESSION['full_name'];?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="?logout">Logout</a>
                                    </li>                                  
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                               &nbsp;
                            </li>
<?php 
if(isset($_SESSION['feedback'])){
?>
<li class="dropdown">
<a href="feedback.php"><span class="badge badge-important pull-right"><?php 
$sel=mysql_query("select count(*) feedback from feedback where status='0'")or die(mysql_error()); 
$val=mysql_fetch_array($sel);	
echo $val['feedback'];
?></span>Feedback&nbsp;</a>
</li>
<?php } ?>
<?php 
if(isset($_SESSION['message'],$_SESSION['email'])){
$email=$_SESSION['email'];
?>
<li class="dropdown">
<a href="messages.php"><span class="badge badge-important pull-right"><?php 
$sel=mysql_query("select count(*) messages from message where receiver_email='$email' && seen='0'")or die(mysql_error()); 
$val=mysql_fetch_array($sel);	
echo $val['messages'];
?></span> Inbox &nbsp; </a>                               
</li>
<?php } ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
		