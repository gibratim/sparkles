<?php
if(session_id()==''){
session_start();
}
include("../connect.php");
$email=$_SESSION['email'];
?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
									
										<tbody>
										<?php
										$sel=mysql_query("select * from message where receiver_email='$email' or sender_email='$email' order by time desc")or die(mysql_error());
										$count=0;
										while($val=mysql_fetch_array($sel)){
										$count++;
										$message=$val['content'];
										$time=$val['time'];
										$sender_email=$val['sender_email'];
										$receiver_email=$val['receiver_email'];
										$message_id=$val['message_id'];
										if($sender_email==$email){//sent by user
										 $sender_name=$_SESSION['full_name'];
										 $sender_photo=$_SESSION['user_photo'];
										  
										  $selx=mysql_query("select * from user where email='$receiver_email'")or die(mysql_error());
										   $valx=mysql_fetch_array($selx);
										  $receiver_name=$valx['staff_name'];
										 $receiver_photo=$valx['photo'];
										}else{
										  $selx=mysql_query("select * from user where email='$sender_email'")or die(mysql_error());
										   $valx=mysql_fetch_array($selx);
										  $sender_name=$valx['staff_name'];
										 $sender_photo=$valx['photo'];
										 mysql_query("update message set seen='1' where message_id='$message_id'")or die(mysql_error());
										}
										
																		
										?>
											<tr class="odd gradeX">
												<td valign="middle">
												<?php
if($receiver_email!=$email){
?>
 <p><span style="color:#006633"><img src="../images/staff/<?php echo $receiver_photo; ?>" width="20px" />&nbsp;<?php echo $receiver_name; ?></span></p>
 <?php }?>
 <p><?php echo $message;?></p>
<p style="font-size:small; color:#003366; font-weight:bold">

<span><img src="../images/staff/<?php echo $sender_photo; ?>" width="20px" />&nbsp;<?php echo $sender_name; ?></span>&nbsp;&nbsp;

<span style="color:#990000; float:right"><?php echo $time;?></span></p>
												</td>
	</tr>
											<?php }//end of while loop
											if($count==0){
											 ?>
											 <tr><td><h2 style="color:#999999">No messages</h2></td></tr>
											 <?php } ?>
											</tbody>
									</table>