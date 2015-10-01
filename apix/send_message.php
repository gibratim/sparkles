<?php
include("connect.php");
 include("GCM.php");
    
if (isset($_POST["regId"]) && isset($_POST["message"]) && isset($_POST["sender_id"]) && isset($_POST["receiver_id"]) && isset($_POST["usertype"])) {
    $regId = $_POST["regId"];
    $message = $_POST["message"];
	$sender=$_POST["sender_id"];
	$receiver=$_POST["receiver_id"];
	$type= $_POST["usertype"];
	
	//include 'GCM.php';
    $gcm = new GCM();
 	//$send;
 	if($type =="normal_user"){
	$send=mysql_query("INSERT INTO message (message_id,sender_id, receiver_id, content, time,seen) VALUES('','$sender','$receiver','$message',NOW(),'' )") or die(mysql_error());
    //if($send){
	 
	 $registatoin_ids = array($regId);
    $message = array("message" => $message);
 
    $result = $gcm->send_notification($registatoin_ids, $message);
	$output= json_decode($result);
	
 		if($output->success==1){
		echo "{\"status\":\"success\"}";
		}else{
		echo "{\"status\":\"failed\"}";
		}
	 /*}else{
	 echo "{\"status\":\"failed\"}";
	 */
	 //}
    
    
	}else{
	 $registatoin_ids = array($regId);
    $message = array("message" => $message);
 
    $result = $gcm->send_notification($registatoin_ids, $message);
	$output= json_decode($result);
	
 		if($output->success==1){
		echo "{\"status\":\"success\"}";
		}else{
		echo "{\"status\":\"deliveryfailed\"}";
		}
		echo $result;
	}
}else{
 echo "{\"status\":\"empty\"}";
	 
}
?>