<?php
if(session_id()==''){
session_start();
}
if(isset($_REQUEST['date'])){
   //a request for the date
   $_SESSION['date']=$_REQUEST['date'];
   header('Location:work_calendar_data.php');
}elseif(isset($_SESSION['date'])){
   $date=$_SESSION['date'];
}else{
   $time=time();
   //date_default_timezone_set('Africa/Nairobi');
   $date= date('Y-m-d') ;
   //echo $date;
}
require_once("../connect.php");
 $branch_id = $_SESSION['branch_id'];
?>
<table cellpadding="0" cellspacing="0" width="100%" class="table table-striped table-bordered" id="example">
<thead>
<tr>
<th colspan="2">Staff</th>
<th colspan="2">8:00AM-9:00AM</th>
<th colspan="2">9:00AM-10:00AM</th>
<th colspan="2">10:00AM-11:00AM</th>
<th colspan="2">11:00AM-12:00PM</th>
<th colspan="2">12:00PM-1:00PM</th>
<th colspan="2">1:00PM-2:00PM</th>
<th colspan="2">2:00PM-3:00PM</th>
<th colspan="2">3:00PM-4:00PM</th>
<th colspan="2">4:00PM-5:00PM</th>
<th colspan="2">5:00PM-6:00PM</th>
<th colspan="2">6:00PM-7:00PM</th>
<th colspan="2">7:00PM-8:00PM</th>
</tr>
</thead>
<tbody>
<?php 
/* $count=0;
$selb=mysql_query("select * from staff where branch_id='$branch_id'")or die(mysql_error());
while($valb=mysql_fetch_array($selb)){
 $count++;
 $name=$valb['staff_name'];
 $tel=$valb['staff_contact'];
 $photo=$valb['staff_photo'];
 $id=$valb['staff_id'];*/
?>
<tr class="odd gradeX">
<td valign="middle" colspan="2"><img src="../images/staff/<?php echo $photo; ?>" width="40px" /> <?php echo $name;?></td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>	
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>	
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>	
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>	
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
&nbsp;
</td>
<td valign="middle" style="color:#006633;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">
<h4>Booked</h4>
</td>
</tr>
<?php
}//ends while
if($count==0){
?>
			
			<tr class="odd gradeX">
			 <td colspan="6" valign="middle" style="color:red; text-align:center" ><h2>No records found</h2></td>
				</tr>
			<?php } ?>
		 </tbody>
		</table>