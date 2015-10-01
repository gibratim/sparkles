<?php
include("../connect.php");
include("GCM.php");
function login(){
if(isset($_REQUEST['username'],$_REQUEST['password'],$_REQUEST['gcm'])){
     $username=$_REQUEST['username'];
      $password=sha1($_REQUEST['password']);
	  $gcm=$_REQUEST['gcm'];
	  //echo '{"username":"'.$username.'","password":"'.$password.'","gcm":"'.$gcm.'"}';
	  //return;
	 if($username && $password && $gcm){//checking if phone number and password was submitted
	     $sel=mysql_query("select * from customer where (customer_contact='$username' && password='$password') or (customer_email='$username' && password='$password')")or die(mysql_error());
		 if(mysql_num_rows($sel)){
		   $row=mysql_fetch_array($sel);
		   $id=$row['customer_id'];
		   $fname=$row['fname'];
		   $sex=$row['sex'];
		   $lname=$row['lname'];
		   $email=$row['customer_email'];
		   $contact=$row['customer_contact'];
		   echo'{"status":"success","userId":"'.$id.'","fname":"'.$fname.'","lname":"'.$lname.'","email":"'.$email.'","sex":"'.$sex.'","contact":"'.$contact.'","accountType":"customer"}';
	$message="Dear $fname $lname ".$contact.", welcome to sparkles salon.";
				Sendmessage($gcm,$message,0,$id,"customer");//to send message to customer		 
	}else{
	   $sel=mysql_query("select * from user where (contact='$username' && password='$password') or (email='$username' && password='$password')")or die(mysql_error());
		 if(mysql_num_rows($sel)){
		   $row=mysql_fetch_array($sel);
		   $id=$row['user_id'];
		   $name=$row['name'];
		   $email=$row['email'];
		  // $contact=$row['customer_contact'];
		   echo'{"status":"success","userId":"'.$id.'","fname":"'.$name.'","lname":" ","email":"'.$email.'","contact":" ","accountType":"staff"}';
	$message="Dear $name  , welcome to sparkles salon.";
				Sendmessage($gcm,$message,0,$id,"staff");//to send message to customer		 
	}else{
      
	   echo '{"status":"invalid"}';
   }
  }
	  }else{//if no contact and password, return error message
	     echo '{"status":"empty1"}';
	  }
   }else{
     //if no contact and password, return error message
	 echo '{"status":"empty2"}';
   }
}//end of function login
//place booking
function placeBooking(){
   if(isset($_REQUEST['customer_id'],$_REQUEST['branch_id'],$_REQUEST['service_id'],$_REQUEST['staff_id'],
       $_REQUEST['booked_time'],$_REQUEST['booked_date'])){
      $customer_id=$_REQUEST['customer_id'];
      $branch_id=$_REQUEST['branch_id'];
      $service_id=$_REQUEST['service_id'];
      $staff_id=$_REQUEST['staff_id'];
      $booked_time=$_REQUEST['booked_time'];
      $booked_date=$_REQUEST['booked_date'];
	  if($customer_id && $branch_id && $service_id && $staff_id && $booked_time && $booked_date){
	     mysql_query("INSERT INTO BOOKING set customer_id='$customer_id', branch_id='$branch_id', service_id='$service_id' , staff_id='$staff_id', booked_time='$booked_time', booked_date='$booked_date',status='pending'")or die('{"status":"failed"}');
	    echo '{"status":"success"}';
	  }else{
	    echo '{"status":"failed"}';
	  }
   }
}
//function services
function services(){
  if(isset($_REQUEST['department_type'])){
     $department_type=$_REQUEST['department_type'];
     $sel=mysql_query("SELECT * FROM SERVICE s INNER JOIN DEPARTMENT d on(s.department_id=d.department_id) WHERE department_type='$department_type'")or die('{"status":"failed"}');
	 if(mysql_num_rows($sel)){
        while($row=mysql_fetch_assoc($sel)){
           $json['result'][]=$row;
        }
		echo json_encode($json); 
      }
     //mysql_close($con);
     echo '{"status":"not service"}'; 
}elseif(isset($_REQUEST['department_id'])){
     $department_id=$_REQUEST['department_id'];
	 $sel=mysql_query("SELECT * FROM SERVICE where department_id='$department_id'")or die('{"status":"failed"}');
	 if(mysql_num_rows($sel)){
        while($row=mysql_fetch_assoc($sel)){
           $json['result'][]=$row;
        }
           echo json_encode($json);
	  }
  }else{
       $sel=mysql_query("SELECT * FROM SERVICE")or die('{"status":"failed"}');
	 if(mysql_num_rows($sel)){
        while($row=mysql_fetch_assoc($sel)){
           $json['result'][]=$row;
        }
          echo json_encode($json);
	  }
   }
}///end of function service
//register
function register(){
   if(isset($_REQUEST['fname'],$_REQUEST['lname'],$_REQUEST['sex'],$_REQUEST['contact'],
       $_REQUEST['email'],$_REQUEST['gcm'],$_REQUEST['password'])){
       $fname = $_REQUEST['fname'];
       $lname = $_REQUEST['lname'];
       $sex = $_REQUEST['sex'];
       $contact = $_REQUEST['contact'];
       $email = $_REQUEST['email'];
       $gcm = $_REQUEST['gcm'];
	   $password = $_REQUEST['password'];
       if($fname && $lname && $sex && $contact && $password && $email){
	    $password=sha1($password);//encrypted password
	    $sel=mysql_query("select * from customer where customer_contact='$contact' or customer_email='$email'")or die(mysql_error());
		if(mysql_num_rows($sel)){
		   echo  "{\"status\":\"Already registered\"}";
		 }else{
	       mysql_query("INSERT INTO CUSTOMER set  fname='$fname', lname='$lname' , sex='$sex', customer_contact='$contact', customer_email='$email',gcm_id='$gcm',password='$password',customer_photo='default.png', time='NOW()'")or die(mysql_error());
	        $id = mysql_insert_id(); // last inserted id
		 	echo'{"status":"success","userId":"'.$id.'","sex":"'.$sex.'","fname":"'.$fname.'","lname":"'.$lname.'","email":"'.$email.'","contact":"'.$contact.'"}';
	$message="Dear $fname $lname ".$contact.", welcome to sparkles salon.";
				Sendmessage($gcm,$message,0,$id,"customer");//to send message to new customer
		}
	  }else{
	       echo '{"status":"required fields missing"}';
	  }
   }else{
             echo '{"status":"required fields missing"}';
  }
}
//send message function
 function Sendmessage($regId,$message,$sender,$receiver,$type){
     $gcm = new GCM();
 	if($type=="merchant"){
	$registatoin_ids = array($regId);
    $message = array("message" => $message);
 
    $result = $gcm->send_notification($registatoin_ids, $message);
	$output= json_decode($result);
	
 		/*if($output->success==1){
		echo "{\"status\":\"success\"}";
		}else{
		echo "{\"status\":\"gcmfailed\"}";
		}*/
	}else{
	$send=mysql_query("INSERT INTO message (message_id,sender_id, receiver_id, content, time,seen) VALUES('','$sender','$receiver','$message',NOW(),'' )") or die(mysql_error());
     if($send){
	 
	 $registatoin_ids = array($regId);
    $message = array("message" => $message);
 
    $result = $gcm->send_notification($registatoin_ids, $message);
	$output= json_decode($result);
	
 		/*if($output->success==1){
		echo "{\"status\":\"success\"}";
		}else{
		echo "{\"status\":\"gcmfailed\"}";
		}*/
	 }else{
	 echo "{\"status\":\"failed\"}";
	 }
	}
 	
 }
 
?>