<?php
if(session_id()==''){
   session_start();
}
if(isset($_REQUEST['date'])){
   //a request for the date
   $_SESSION['date']=$_REQUEST['date'];
   //echo $_SESSION['date'];
   header('Location:work_calendar_data.php');
}elseif(isset($_SESSION['date'])){
   $date=$_SESSION['date'];
}else{
   //$time=time();
   //date_default_timezone_set('Africa/Nairobi');
   $date= date('Y-m-d');
   $_SESSION['date']=$date;
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
 $count=0;
$selb=mysql_query("select * from staff where branch_id='$branch_id'")or die(mysql_error());
while($valb=mysql_fetch_array($selb)){
 $count++;
 $name=$valb['staff_name'];
 $tel=$valb['staff_contact'];
 $photo=$valb['staff_photo'];
 $staff_id=$valb['staff_id'];
 //empty column
 $empty="<td>&nbsp;Free</td>";
 if($count%2==1){
   $booked='<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(0, 255,100, 0.9) 0%, rgba(0, 255, 100, 0.4) 59%, rgba(0, 255, 100, 0.5) 100%);">&nbsp;</td>';
 }else{
   $booked='<td valign="middle" style="color:#009900;background: linear-gradient(to right, rgba(255, 0,100, 0.9) 0%, rgba(255, 0, 100, 0.4) 59%, rgba(255, 0, 100, 0.5) 100%);">&nbsp;</td>';
 }
?>

<tr class="odd gradeX">
<td valign="middle" colspan="2"><img src="../images/staff/<?php echo $photo; ?>" width="40px" /><?php echo $name; ?></td>
<?php 
//check if there is a booking before 8:30am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time < '08:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 8:30am -9:00am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '08:30' && booked_time<'09:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 9:00am -9:30am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '09:00' && booked_time < '09:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 9:30am -10:00am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '09:30' && booked_time < '10:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 10:0am -10:30am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '10:00' && booked_time < '10:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 10:30am -11:00am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '10:30' && booked_time < '11:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
//check if there is a booking between 11:00am -11:30am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '11:00' && booked_time < '11:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 11:30am -12:00am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '11:30' && booked_time < '12:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 12:00am -12:30am
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '12:00' && booked_time < '12:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 12:30-13:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '12:30' && booked_time < '13:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 13:00-13:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '13:00' && booked_time < '13:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 13:30-14:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '13:30' && booked_time < '14:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
  //check if there is a booking between 14:00-14:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '14:00' && booked_time < '14:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
  //check if there is a booking between 14:30-15:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '14:30' && booked_time < '15:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
//check if there is a booking between 15:00-15:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '15:00' && booked_time < '15:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 15:30-16:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '15:30' && booked_time < '16:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
  //check if there is a booking between 16:00-16:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '16:00' && booked_time < '16:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
   //check if there is a booking between 16:30-17:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '16:30' && booked_time < '17:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 17:00-17:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '17:00' && booked_time < '17:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 17:30-18:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '17:30' && booked_time < '18:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
  //check if there is a booking between 18:00-18:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '18:00' && booked_time < '18:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
 //check if there is a booking between 18:30-19:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '18:30' && booked_time < '19:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
  //check if there is a booking between 19:00-19:30
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '19:00' && booked_time < '19:30' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
   //check if there is a booking between 19:30-20:00
$sel=mysql_query("select * from booking where staff_id='$staff_id' && booked_time >= '19:30' && booked_time < '20:00' && booked_date='$date' && status !='canceled' ")or die(mysql_error());
 $val=mysql_fetch_array($sel);
 if($val){
   echo $booked;
 }else{
  echo $empty;
 }
?>
</tr>
<?php 

}//end while loop

?>
 </tbody>
		</table>
<?php
//set automatic update of calendar if the date selected is today's date
$selected=$_SESSION['date'];	
 $today= date('Y-m-d') ;	
 //echo "<h1>Selected: $selected<br/>Today: $today</h1>";
if($selected==$today){	
//echo "<h1>This is today</h1>";	
?>
<script type="text/javascript">
 setTimeout(function(){
  $('#booking_content_div').load('work_calendar_data.php');
    }, 60000);
</script>
<?php
}
?>