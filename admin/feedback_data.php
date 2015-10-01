<?php 
include("../connect.php");
?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<tbody>
<?php
$sel=mysql_query("select * from feedback f inner join customer c on(f.customer_email=c.customer_email) order by feedback_id desc")or die(mysql_error());
$count=0;
	while($val=mysql_fetch_array($sel)){
    	$count++;
		$message=$val['message'];
        $time=$val['time'];
		$customer_name=$val['fname']." ".$val['lname'];
		$contact=$val['customer_contact'];
		$photo=$val['customer_photo'];
		$customer_id=$val['customer_id'];
		$feedback_id=$val['feedback_id'];
		mysql_query("update feedback set status='1' where feedback_id='$feedback_id'")or die(mysql_error());
?>
<tr class="odd gradeX">
<td valign="middle">
												<p><?php echo $message;?></p>
												<p style="font-size:small; color:#003366; font-weight:bold"><img src="../images/customer/<?php echo $photo; ?>" width="20px" />&nbsp;<span><?php echo $customer_name." ".$contact." "; ?></span><span style="color:#990000; float:right"><?php echo $time;?></span></p>
</td>
	<!--<td valign="middle" style="color:#009900"><?php //echo $service_duration; ?> min</td>
	<td valign="middle" style="color:red"><?php //echo $service_price; ?></td>
	<td><a href="service_details.php?cmd=<?php //$data = '{"service_id":"'.$service_id.'"}';		$encryption=new Encryption;
	//$encrypted = $encryption->encode($data);	echo $encrypted; ?>"><input type="button" class="btn-danger" value="Details"/></a></td>												
								-->			</tr>
<?php }//end of while loop
											if($count==0){
											 ?>
											 <tr><td><h2 style="color:#999999">No feedback</h2></td></tr>
											 <?php } ?>
											</tbody>
									</table>