<?php 
include("GCM.php");


 /**
     * Getting all users
     */
    function getAllUsers() {
        $result = mysql_query("select * FROM customers where gcm_regid is not null");
        return $result;
    }
	
	 function getAllbusinesses() {
        $result = mysql_query("select business_id, business_name, business_location, latitude, longitude FROM business");
        return $result;
    }
	
	function getAllMerchants() {
        $result = mysql_query("select * FROM merchant where gcm_id is not null");
        return $result;
    }
	function getnewmessages($user_id) {
	$json=array();
        $result = mysql_query("select c.customer_name,m.message_id, m.content, m.time FROM message m inner join customers c on(m.sender_id=c.customer_id)where m.receiver_id='$user_id' and  m.seen=0") or die(mysql_error());
		$json;
		if (mysql_num_rows($result)) {
			while($row=mysql_fetch_assoc($result)){
				$json['messages'][]=$row;
				}
				$ary=array("status"=>"ok");
				$json['messages'][]=$ary;
		$seen= mysql_query("UPDATE message SET seen='1' where receiver_id='$user_id'") or die(mysql_error());
    	}else{
		
		$result3 = mysql_query("select c.customer_name,m.message_id, m.content, m.time FROM message m inner join customers c on(m.sender_id=c.customer_id)where m.receiver_id='$user_id' order by m.time desc limit 5") or die(mysql_error());
		if (mysql_num_rows($result3)) {
			while($row=mysql_fetch_assoc($result3)){
				$json['messages'][]=$row;
				}
				$ary=array("status"=>"ok");
				$json['messages'][]=$ary;
		}
		}
		echo json_encode($json);
	}
	
	function getVerificationCodes($user_id, $type) {
	$json=array();
	$result;
        if($type=='merchant'){
		$result = mysql_query("select a.status ,a.id, a.verification_code, a.time
FROM
	table_ordered_items a 
LEFT JOIN
    order_container b ON (b.order_id= a.id )
INNER JOIN
    item_table itm ON (b.item_id = itm.item_id)
INNER JOIN	
	merchant mct ON (mct.business_id=itm.business_id)
INNER JOIN
    business bus ON (bus.business_id = mct.business_id)		

where mct.merchant_id= '$user_id' and a.verification_code is not null ORDER BY a.time Desc") or die(mysql_error());
		
		}else{
		$result = mysql_query("select m.status ,m.id, m.verification_code, m.time
		
FROM table_ordered_items m where m.user_id='$user_id' and m.verification_code is not null ORDER BY m.time Desc") or die(mysql_error());
		
		}$json;
		if (mysql_num_rows($result)) {
			while($row=mysql_fetch_assoc($result)){
			$marray=array("status"=>$row['status'], "verification_code"=>implode(" ", str_split($row['verification_code'], 4)),
							"id"=>$row['id'], "time"=>$row['time']
			);
				$json['messages'][]=$marray;
				}
				$ary=array("status"=>"ok");
				$json['messages'][]=$ary;
		//$seen= mysql_query("UPDATE message SET seen='1' where receiver_id='$user_id'") or die(mysql_error());
    	}else{
		$ary=array("status"=>"empty");
		$json['messages'][]=$ary;
		}
		echo json_encode($json);
	}//end of verification codes
	
	function getactivities($user_id,$page) {
	 if($user_id != "no"){
  updateaAppearances($user_id,"activity");
  }
  
	$start=0;
  $end=5;
  $start+=($page*5)-5;
  
    $result=mysql_query("SELECT myActivities.id as activity_id,t1.customer_name,myActivities.activity, myActivities.time,myActivities.activity_pic,myActivities.author_type
    
FROM (
            SELECT follower_id AS followerId,followee_id AS followeeId, followee_type AS followeeType
            FROM follow
            where follower_id=$user_id and followee_type='customer'
        ) AS followingIds
       
INNER JOIN (
            SELECT id,user_id as act_user,activity ,time,activity_pic ,author_type
            FROM activity
            
			        ) AS myActivities
        ON followingIds.followeeId= myActivities.act_user AND followingIds.followeeType=myActivities.author_type
INNER JOIN customers t1 
 ON  myActivities.act_user = t1.customer_id AND myActivities.author_type=followingIds.followeeType 
 order by myActivities.time desc LIMIT $start,$end 
") or die(mysql_error());

$result2=mysql_query("SELECT myActivities.id as activity_id,t2.business_name,myActivities.activity, myActivities.time,myActivities.activity_pic,myActivities.author_type
    
FROM (
            SELECT follower_id AS followerId,followee_id AS followeeId, followee_type AS followeeType
            FROM follow
            where follower_id=$user_id and followee_type='business'
        ) AS followingIds
       
INNER JOIN (
            SELECT id,user_id as act_user,activity ,time,activity_pic ,author_type
            FROM activity
            
			        ) AS myActivities
        ON followingIds.followeeId= myActivities.act_user AND followingIds.followeeType=myActivities.author_type
INNER JOIN business t2 
 ON  myActivities.act_user = t2.business_id AND myActivities.author_type=followingIds.followeeType 
 order by myActivities.time desc LIMIT $start,$end 
") or die(mysql_error());

$json=array();
		if (mysql_num_rows($result)) {
			while($row=mysql_fetch_assoc($result)){
				$json['customers'][]=$row;
				}
				
		$ary=array("status"=>"ok");
		$json['customers'][]=$ary;
		
		}else{
		$ary=array("status"=>"empty");
		$json['customers'][]=$ary;
		}
		//for business
		if (mysql_num_rows($result2)) {
			while($row=mysql_fetch_assoc($result2)){
				$json['business'][]=$row;
				}
				$ary=array("status"=>"ok");
				$json['business'][]=$ary;
		
		}else{
		$ary=array("status"=>"empty");
		$json['business'][]=$ary;
		}
		echo json_encode($json);
		
	}
	
	function getAddress($lat,$lon) {
	$name;
	    $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&sensor=false');

        $output= json_decode($geocode);

    for($j=0;$j<count($output->results[0]->address_components);$j++){
	if($output->results[0]->address_components[$j]->types[0]=="neighborhood"){
	$name=$output->results[0]->address_components[$j]->long_name;
				}
     	
			}
			return $name;
    }
	// encrypt pin
	function ENCRYPT_DECRYPT($Str_Message) { 
	$Str_Encrypted_Message=sha1($Str_Message);
    return $Str_Encrypted_Message; 
} 
 /**
     * Storing new user
     * returns user details
     */
	 
	 function unregisteruser($gcm_regid) {
        $result = mysql_query("DELETE FROM customers WHERE gcm_regid='$gcm_regid' ") or die(mysql_error());
        if($result){
		echo "{\"status\":\"deleted\"}";
		}
    }
 
 function signIn($name,$pin,$gcm_regid,$acctype){
 	$pin1=sha1($pin);
	
	if($acctype=="merchant"){
	$sel=mysql_query("select * from merchant where phone_number LIKE '$name' AND password LIKE '$pin' ")or die(mysql_error());
   
     $val=mysql_fetch_array($sel);
     if($val){
	 $id=$val['merchant_id'];
	 $newtask=mysql_query("UPDATE merchant set gcm_id='$gcm_regid' where merchant_id='$id'") or die(mysql_error());
    echo "{\"status\":\"success\",\"userId\":\"$val[merchant_id]\",\"acctype\":\"merchant\",\"username\":\"$val[name]\",\"email\":\"$val[email]\",\"number\":\"$val[phone_number]\",\"userpin\":\"$pin\"}";
	
	$message="Dear ".$val['name'].", Welcome to Justdeals!";
	Sendmessage($gcm_regid,$message,1,$id, $acctype);//to send message to new customer
	    return;
		}else{
		echo  "{\"status\":\"wrong\"}";
		}
		
	}else{//normal user
	
	$sel=mysql_query("select * from customers where phone_number LIKE '$name' AND customer_pin= '$pin1' ")or die(mysql_error());
   
     $val=mysql_fetch_array($sel);
     if($val){
	 $id=$val['customer_id'];
	 $newtask=mysql_query("UPDATE customers set gcm_regid='$gcm_regid' where customer_id='$id'") or die(mysql_error());
    echo "{\"status\":\"success\",\"userId\":\"$val[customer_id]\",\"acctype\":\"normal_user\",\"username\":\"$val[customer_name]\",\"email\":\"$val[customer_email]\",\"number\":\"$val[phone_number]\",\"userpin\":\"$pin\"}";
	
	$message="Dear ".$name.", we missed you alot!\nHey, amazing deals are awaiting!";
	Sendmessage($gcm_regid,$message,1,$id,$acctype);//to send message to new customer
	    return;
		}else{
		echo  "{\"status\":\"wrong\"}";
		}
	}
 	
 }
    function storeUser($name, $email, $gcm_regid, $phone, $pin) {
		$encryptedpin=ENCRYPT_DECRYPT($pin);
		$json=array();
		$sel=mysql_query("select * from customers where customer_name = '$name' AND customer_email= '$email' OR phone_number= '$phone'")or die(mysql_error());
     $val=mysql_fetch_array($sel);
     if($val){
        echo  "{\"status\":\"Already registered\"}";
        return;
		}else{
        // insert user into database
        $result = mysql_query("INSERT INTO customers(customer_name, customer_email,customer_pin, gcm_regid, phone_number, created_at) VALUES('$name', '$email', 						'$encryptedpin','$gcm_regid', '$phone', NOW())") or die(mysql_error());
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
			$insAcc = mysql_query("INSERT INTO justdeals_account VALUES('', $id, 'customer', 0,'')") or die(mysql_error()); //create user account
			$result2 = mysql_query("SELECT * FROM customers t1 INNER JOIN 
									justdeals_account t2 ON t1.customer_id= t2.owner AND t2.type='customer' WHERE customer_id = $id") or die(mysql_error());
            if($insAcc){// return user details
			$val2=mysql_fetch_array($result2);
     		
            if (mysql_num_rows($result2) && $val2) {
			while($row=mysql_fetch_assoc($result2)){
				$json['user'][]=$row;
				}
				echo "{\"status\":\"success\",\"userId\":\"$id\",\"username\":\"$name\",\"email\":\"$val2[customer_email]\",\"number\":\"$val2[phone_number]\",\"userpin\":\"$pin\"}";
	
	$message="Dear ".$name." _".$phone.", thank you for joining justdeals.\nAmazing deals are awaiting!";
				Sendmessage($gcm_regid,$message,1,$id,"customer");//to send message to new customer
				
            } else {
			$out1= strip_tags("{\"status\":\"user failed\"}");
                echo $out1; 
            }
			
			}else {
			$out3= strip_tags("{\"status\":\"account failed\"}");
                echo $out3; 
            }//echo "{\"status\":\"success\",\"userId\":\"$id\",\"userpin\":\"$decryptedpin\"}";
        } else {
            $out4= strip_tags("{\"status\":\"user failed\"}");
                echo $out4; 
        }
    }
	}
	
	function storeDeliveryUser($name, $email, $gcm_regid, $phone, $pin) {
		$encryptedpin=ENCRYPT_DECRYPT($pin);
		$json=array();
		$sel=mysql_query("select * from delivery_user where user_name = '$name' AND user_email= '$email' OR phone_number= '$phone'")or die(mysql_error());
     $val=mysql_fetch_array($sel);
     if($val){
        echo  "{\"status\":\"Already registered\"}";
        return;
		}else{
        // insert user into database
        $result = mysql_query("INSERT INTO delivery_user(user_name, user_email,user_pin, gcm_regid, phone_number, createdat) VALUES('$name', '$email', 						'$encryptedpin','$gcm_regid', '$phone', NOW())") or die(mysql_error());
        // check for successful store
        if ($result) {
		$id = mysql_insert_id(); // last inserted id
			
		echo "{\"status\":\"success\",\"userId\":\"$id\",\"username\":\"$name\",\"email\":\"$email\",\"number\":\"$phone\",\"userpin\":\"$pin\"}";
	
	$message="welcome to justdeals delivery app!";
		Sendmessage($gcm_regid,$message,1,$id,"merchant");//to send message to new customer
				
		} else {
            $out4= strip_tags("{\"status\":\"user failed\"}");
                echo $out4; 
        }
    }
	}
	
function getGcmRegIdsForMerchants($order, $user_id){
$json = array();

$result2=mysql_query("SELECT DISTINCT mct.gcm_id
FROM
	table_ordered_items a 
INNER JOIN
    order_container b ON (b.order_id= a.id )
INNER JOIN
    item_table itm ON (b.item_id = itm.item_id)
INNER JOIN	
	merchant mct ON (mct.business_id=itm.business_id)
INNER JOIN
    business bus ON (bus.business_id = mct.business_id)

WHERE a.user_id= '$user_id' AND a.id ='$order' and mct.gcm_id is not null " )or die(mysql_error());

if(mysql_num_rows($result2)){
while($row1=mysql_fetch_array($result2)){
$json[]=$row1['gcm_id'];
}
//echo json_encode($json);
}//end of if for items




if(mysql_num_rows($result2)==0){
$json[]="empty";
//echo json_encode($json);
}
//mysql_close($con);
return $json; 


}//end of get gcm ids for merchants



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
 
 //send message function many
 function SendmessageMany($regId,$message,$sender,$receiver,$type){
     $gcm = new GCM();
 	if($type=="merchant"){
	$registatoin_ids = $regId;
    $message = array("message" => $message);
 
    $result = $gcm->send_notification($registatoin_ids, $message);
	$output= json_decode($result);
	
 		if($output->success==1){
		//echo "{\"status\":\"success\"}";
		}else{
		//echo "{\"status\":\"gcmfailed\"}";
		}
	}else{
	$send=mysql_query("INSERT INTO message (message_id,sender_id, receiver_id, content, time,seen) VALUES('','$sender','$receiver','$message',NOW(),'' )") or die(mysql_error());
     if($send){
	 
	 $registatoin_ids = $regId;
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
 
 function sendidea($user_id,$content){
 $result = mysql_query("INSERT INTO idea VALUES('', '$user_id','$content', NOW())") or die(mysql_error());
  if($result){
  echo "{\"status\":\"ok\"}";
	}else{
	 echo "{\"status\":\"failed\"}";
	 }      
 }
 
 function reportbug($user_id,$content){
 $result = mysql_query("INSERT INTO bug VALUES('', '$user_id','$content', NOW())") or die(mysql_error());
  if($result){
  echo "{\"status\":\"ok\"}";
	}else{
	 echo "{\"status\":\"failed\"}";
	 }      
 
 }
 
  function AllitemsTrending($user_id,$page){
  $det;
  if($user_id != "no"){
  updateaAppearances($user_id,"trend");
  $det=DetermineProfilevalue($user_id);
  }else{
  $det="not";
 }
  
  $start=0;
  $end=5;
  $start+=($page*5)-5;
  
  $disc;
$result=mysql_query("select t1.item_id, t1.item_name, t1.item_description, t1.item_image, t2.medium_size, t3.business_name,t3.latitude,t3.longitude, t3.business_icon, t3.business_location,
(SELECT CASE WHEN business_discount <=10      THEN 0
            WHEN business_id = 29 THEN 0
            WHEN business_discount >10 THEN (0.1*business_discount)
                             ELSE 0
       END
FROM business where business_id=t3.business_id) as business_discount,t1.type from business t3 inner join item_table t1 inner join size_table t2 on(t1.business_id=t3.business_id and t1.item_id=t2.item_id and t1.rating =5) order by t1.lasttime desc LIMIT $start,$end ")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['AllitemsTrending'][]=$row;
}
$ary=array("status"=>"ok");
$ary2=array("updateprof"=>$det);
$json['AllitemsTrending'][]=$ary;
$json['AllitemsTrending'][]=$ary2;
echo json_encode($json); 
}else{
$ary=array("status"=>"empty");
$ary2=array("updateprof"=>$det);
$json['AllitemsTrending'][]=$ary;
$json['AllitemsTrending'][]=$ary2;
echo json_encode($json); 
}
//mysql_close($con);

}//end of trending items

function Mostpopular($user_id,$page){
 if($user_id != "no"){
  updateaAppearances($user_id,"shop");
  }
$start=0;
  $end=5;
  $start+=($page*5)-5;
  
$result=mysql_query("select t1.item_id, t1.item_name, t1.item_description, t1.item_image, t2.medium_size, t3.business_name, t3.business_icon,t3.latitude,t3.longitude , t3.business_location,
(SELECT CASE WHEN business_discount <=10      THEN 0
            WHEN business_discount >10 THEN (0.1*business_discount)
                             ELSE 0
       END
FROM business where business_id=t3.business_id) as business_discount, t1.type from business t3 inner join item_table t1 inner join size_table t2 on(t1.business_id=t3.business_id and t1.item_id=t2.item_id and t1.rating =4) order by t1.lasttime desc LIMIT $start,$end ")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['mostpupular'][]=$row;
}$ary=array("status"=>"ok");
$json['mostpupular'][]=$ary;
echo json_encode($json); 
}else{
$ary=array("status"=>"empty");
$json['mostpupular'][]=$ary;
echo json_encode($json); 
}
}
//check where balance is enough
 function checkAccountBalance($user_id){
 $result=mysql_query("select t1.customer_name, t1.phone_number, t3.balance, (t3.id + 201500000) as accountNo 
 from customers t1 inner join justdeals_account t3 on(t1.cusotmer_id=t3.owner and t3.type ='customer')
  WHERE t1.cusotmer_id= $user_id ")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['useraccount'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

 }//end of check user bal
 
 function profile_base64_to_image($base64string,$user_id){
 $picname="customer$user_id.jpg";
 
 $outputfile="../images/profile_pics/".$picname;
 $ifp=fopen($outputfile,"wb");
 $fload=fwrite($ifp, base64_decode($base64string)) or die("{\"status\":\"failed\"}");
 fclose($ifp);
 
 if($fload){
 $newtask=mysql_query("UPDATE customers set customer_profilepic='$picname' where customer_id='$user_id'") or die(mysql_error());
 echo "{\"status\":\"ok\"}";
 }else{
 echo "{\"status\":\"failed\"}";
 }
 
 }//end of profile_pic
 
 function MyAccount($user_id, $type){
$result=mysql_query("select balance,credits from justdeals_account WHERE owner=$user_id and type='$type'")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['balance'][]=$row;
	}
//echo json_encode($json);
$result1=mysql_query("SELECT t1.item_name, t2.time, t2.total_amount_items, t2.delivery_cost, t2.id
FROM table_ordered_items t2 
INNER JOIN order_container t3  ON (t2.id=t3.order_id)
INNER JOIN item_table t1  ON (t1.item_id=t3.item_id) 
WHERE t2.user_id= $user_id
ORDER BY t2.time DESC") or die(mysql_error());

//$json2 = array();
if(mysql_num_rows($result1)){
while($row1=mysql_fetch_assoc($result1)){
$json['receipt'][]=$row1;
	}
$arr= array('status'=>"ok");
$json['receipt'][]=$arr;
}else{
$arr= array('status'=>"emptyrec");
$json['receipt'][]=$arr;
}
echo json_encode($json);

}else{

echo "{\"status\":\"empty\"}"; 
}
}
 
 function Allitems(){
$result=mysql_query("select * from item_table t1 inner join size_table t2 on(t1.item_id=t2.item_id) order by lasttime  Desc")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['Allitems'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
//profile info
function ProfileInfo($userId){
 $result=mysql_query("SELECT t1.customer_id,t1.customer_name,t1.status, t1.customer_email, t1.phone_number,t1.customer_religion, t1.customer_dob, t1.customer_location, t1.customer_profilepic,
    COALESCE(followerscount.numfollowers,0) followers,
    COALESCE(followingcount.numfollowing,0) AS following
FROM customers t1 
LEFT JOIN (
            SELECT COUNT(*) AS numfollowers, followee_id AS followeeId, followee_type AS followeeType
            FROM follow
            where followee_type LIKE 'customer' GROUP BY followee_id
        ) AS followerscount
        ON followerscount.followeeId = t1.customer_id AND t1.customer_id=$userId AND followerscount.followeeType='customer'
    LEFT JOIN (
            SELECT COUNT(*) AS numfollowing, follower_id AS followerId, follower_type AS followerType
            FROM follow
            where followee_type LIKE 'customer' GROUP BY follower_id
        ) AS followingcount
        ON followingcount.followerId = t1.customer_id AND followingcount.followerType='customer'
		WHERE t1.customer_id= $userId
") or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['userprofile'][]=$row;
	}
echo json_encode($json);
}
else echo "{\"status\":\"user does not exist\"}";
 
}

//profile info for business
function ProfileInfoBusiness($busId){
 $result=mysql_query("SELECT t1.business_name,t1.status, t1.business_email,t1.business_mobile,t1.business_location, t1.business_icon,
    COALESCE(followerscount.numfollowers,0) followers,
    COALESCE(followingcount.numfollowing,0) AS following
FROM business t1 
LEFT JOIN (
            SELECT COUNT(*) AS numfollowers, followee_id AS followeeId, followee_type AS followeeType
            FROM follow
            where followee_type LIKE 'business' GROUP BY followee_id
        ) AS followerscount
        ON t1.business_id = $busId AND followerscount.followeeId = t1.business_id AND followerscount.followeeType='business'
    LEFT JOIN (
            SELECT COUNT(*) AS numfollowing, follower_id AS followerId, follower_type AS followerType
            FROM follow
            where follower_type LIKE 'business' GROUP BY follower_id
        ) AS followingcount
        ON followingcount.followerId = t1.business_id AND followingcount.followerType='business' 
		WHERE t1.business_id = $busId
") or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['businessprofile'][]=$row;
	}
echo json_encode($json);
}
//echo json_encode($json);
}

//update profile for user
function updateUserProfile($userId, $name, $status, $email, $phone, $dob, $address, $religion){

$result=mysql_query("Update customers  set customer_name='$name', customer_email='$email', status='$status', phone_number='$phone',
customer_dob= '$dob', customer_location='$address', customer_religion= '$religion' where customer_id=$userId ")or die(mysql_error());
if($result){
//mysql_close($con);
echo "{\"status\":\"ok\"}"; 
}else{
	echo "{\"status\":\"failed\"}"; 
}
}

function updateuserattribute($type,$value,$userId){

if($type=="dob"){
$result=mysql_query("Update customers  set customer_dob= '$value' where customer_id=$userId ")or die(mysql_error());
}else if ($type=="religion"){
$result=mysql_query("Update customers  set customer_religion= '$value' where customer_id=$userId ")or die(mysql_error());
}else if($type=="address"){
$result=mysql_query("Update customers  set customer_location= '$value' where customer_id=$userId ")or die(mysql_error());
}else{
}

}
	 
//update profile for business
function updateBusinessProfile($busId, $name, $status, $email, $phone, $address){
$result=mysql_query("Update business  set business_name='$name', business_email='$email', status='$status', business_mobile='$phone',
business_location='$address' where customer_id=$busId ")or die(mysql_error());
if($result){
//mysql_close($con);
echo "{\"status\":\"ok\"}"; 
}else{
	echo "{\"status\":\"failed\"}"; 
}
}

//add followers
function followMe($followerId, $followeeId, $followertype, $followeetype){
if($followerId==$followeeId){
echo "{\"status\":\"own\"}"; 
}else{
$sel =mysql_query("select * from follow where follower_id = '$followerId' AND followee_id = '$followeeId' and followee_type='$followeetype' and follower_type='$followertype'")or die(mysql_error());
$val=mysql_fetch_array($sel);
if($val){
echo "{\"status\":\"already\"}"; 

}else{
$result=mysql_query("insert into follow  values ('', $followeeId, $followerId,'$followeetype' ,'$followertype')")or die(mysql_error());
if($result){
//mysql_close($con);
echo "{\"status\":\"ok\"}"; 
}else{
	echo "{\"status\":\"failed\"}"; 
}


}//end if for sel

}//end of owner

}


function AllitemsIntThisCatgory($user_id, $catId, $page){
if($user_id != "1"){
  updateaAppearances($user_id,"items");
  }
$start=0;
  $end=5;
  $start+=($page*5)-5;

 $result=mysql_query("SELECT t1.item_id, t1.item_name, t3.business_name, t3.business_location, t1.item_description, t3.business_icon, t3.latitude,t3.longitude ,t2.old_small_size, t2.old_medium_size, t2.old_large_size, t2.small_size, t2.medium_size, t2.large_size, t1.item_image, t1.type, t1.discount ,t1.expiry_date
FROM business t3 INNER JOIN item_table t1 
		ON (t1.cat_id=$catId and t1.business_id= t3.business_id and t1.item_id IS NOT NULL)
LEFT JOIN size_table t2  ON (t1.item_id=t2.item_id)
ORDER BY t2.medium_size ASC  LIMIT $start,$end ") or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['AllitemsCat'][]=$row;
	}
$ary=array("status"=>"ok");
$json['AllitemsCat'][]=$ary;
echo json_encode($json); 
}else{
$ary=array("status"=>"empty");
$json['AllitemsCat'][]=$ary;
echo json_encode($json); 
}

}//end of function items in cat

function PeopleAlsoBought($user_id, $ItemId, $page){
if($user_id != "1"){
  updateaAppearances($user_id,"items");
  }
$start=0;
  $end=5;
  $start+=($page*5)-5;

 $result=mysql_query("SELECT t1.item_id, t1.item_name, t3.business_name, t3.business_location, t1.item_description, t3.business_icon, t3.latitude,t3.longitude ,t2.old_small_size, t2.old_medium_size, t2.old_large_size, t2.small_size, t2.medium_size, t2.large_size, t1.item_image, t1.type, t1.discount ,t1.expiry_date
FROM business t3 INNER JOIN item_table t1 
		ON (t1.business_id= t3.business_id and t1.item_id IS NOT NULL)
LEFT JOIN size_table t2  ON (t1.item_id=t2.item_id)
ORDER BY t2.medium_size ASC  LIMIT $start,$end ") or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['Otheritems'][]=$row;
	}
$ary=array("status"=>"ok");
$json['Otheritems'][]=$ary;
echo json_encode($json); 
}else{
$ary=array("status"=>"empty");
$json['Otheritems'][]=$ary;
echo json_encode($json); 
}

}//end of other bought

function ItemsSuggestedForYou($user_id,$page){
if($user_id != "1"){
  updateaAppearances($user_id,"items");
  }
$start=0;
  $end=5;
  $start+=($page*5)-5;

 $result=mysql_query("SELECT t1.item_id, t1.item_name, t3.business_name, t3.business_location, t1.item_description, t3.business_icon, t3.latitude,t3.longitude ,t2.old_small_size, t2.old_medium_size, t2.old_large_size, t2.small_size, t2.medium_size, t2.large_size, t1.item_image, t1.type, t1.discount ,t1.expiry_date
FROM business t3 INNER JOIN item_table t1 
		ON (t1.business_id= t3.business_id and t1.item_id IS NOT NULL)
LEFT JOIN size_table t2  ON (t1.item_id=t2.item_id)
ORDER BY t2.medium_size DESC  LIMIT $start,$end ") or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['Suggesteditems'][]=$row;
	}
$ary=array("status"=>"ok");
$json['Suggesteditems'][]=$ary;
echo json_encode($json); 
}else{
$ary=array("status"=>"empty");
$json['Suggesteditems'][]=$ary;
echo json_encode($json); 
}

}//end of suggested items


function CalculateDeliveryCostshoppinglist($user_id,$dist,$total_price) {
$delivery;
$distance=intval($dist);
		if($dist==0){
		$delivery= 0;
		}
	    else if($dist <= 1 && floatval((intval($total_price)*0.05)/2000) > 2){
			$delivery= 0;
			
		}else if($dist <= 1){
			$delivery= 0;
		
		}else if($dist >= 1 && (($total_price*0.05)/(2000*$dist)) >= 2 ){
			$delivery= 0;
		
		}else if($dist >3 && $dist <=4){
			$delivery= 5000;
		}else if($dist > 4 && $dist <=5){
			$delivery= 7000;
		}else if($dist > 5 && $dist <=8){
			$delivery= 10000;
		}else if($dist > 8 && $dist <=12){
			$delivery= 15000;
		}else if($dist <= 1 && (($total_price*0.05)/2000) <= 2){
			$delivery= 2000;
		}else{
			$delivery= intval(($distance)*2000);
		}
echo "{\"cost\":\"$delivery\",\"distance\":\"$dist\"}"; 
    
	}

//get followers of some one 
function myfollowers($id){
$sel=mysql_query("select * from follow_table where followee_id= $id ")or die(mysql_error());
$json = array();
$ids= array();
$val=mysql_fetch_array($sel);
 
if(mysql_num_rows($sel)){
while($row=mysql_fetch_assoc($sel)){
$json['followers'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
 
function places(){
$result=mysql_query("select * from business order by placeName ASC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['places'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}

//update location
function updatelocation($long, $lat, $pin, $deviceidID, $type){
$result=mysql_query("Update $type  set longitude=$long, latitude=$lat, lasttime=NOW() where pin=$pin and deviceid=$deviceID")or die(mysql_error());
if($result){
//mysql_close($con);
echo "{\"status\":\"updated\"}"; 
}else{
	echo "{\"status\":\"failed\"}"; 
}
}

//get business types
function allTypes(){
$result=mysql_query("SELECT DISTINCT business_type FROM business ORDER BY business_type ASC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['businessTypes'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}

//get businesses near me
function allBusinessNearMe($user_id,$orig_lat, $orig_lon){
 if($user_id != "no"){
  updateaAppearances($user_id,"nearme");
  }
  
$dist=0.3; // kilometer
$result=mysql_query("SELECT business_id, business_name, business_icon, business_type, business_location, latitude, longitude ,((6371 * 2 * ASIN(SQRT( POWER(SIN(($orig_lat -
abs( 
bus.latitude)) * pi()/180 / 2),2) + COS($orig_lat * pi()/180 ) * COS( 
abs
(bus.latitude) *  pi()/180) * POWER(SIN(($orig_lon-bus.longitude) * pi()/180 / 2), 2) )))/1000)
 
as distance FROM business bus HAVING distance < $dist ORDER BY distance LIMIT 10")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['nearme'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}

//get businesses in a given type
function allBusinessesInType($user_id, $type){
$result=mysql_query("SELECT business_id, business_name, deals FROM business where MATCH (business_type) AGAINST (+'$type') OR 
					business_type LIKE '$type' OR business_type LIKE '%$type%' ORDER  BY business_type ASC")or die(mysql_error());
if($user_id != "no"){
  updateaAppearances($user_id,"businames");
  }
  
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['businessesInType'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}

function MostCategories(){
$result=mysql_query("select distinct t1.cat_id, t1.cat_name, t1.deals, t1.image1, t1.image2, t1.icon from category_table t1 order by t1.deals DESC LIMIT 4")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['categories'][]=$row;
}
$ary=array("status"=>"ok");
$json['categories'][]=$ary;
//mysql_close($con);
echo json_encode($json); 

}else{
$ary=array("status"=>"empty");
$json['categories'][]=$ary;
echo json_encode($json); 
}

}//end of most categories for menu


function allCategories(){
$result=mysql_query("select distinct t1.cat_id, t1.cat_name, t1.deals, t1.image1, t1.image2, t1.icon from category_table t1 order by t1.deals DESC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['categories'][]=$row;
}
$ary=array("status"=>"ok");
$json['categories'][]=$ary;
//mysql_close($con);
echo json_encode($json); 

}else{
$ary=array("status"=>"empty");
$json['categories'][]=$ary;
echo json_encode($json); 
}

}//end of all categories for menu


//get categories
function allCategoriesForBusiness($user_id,$busId){
 if($user_id != "no"){
  updateaAppearances($user_id,"busincats");
  }
  
$result=mysql_query("select distinct t1.cat_id, t1.cat_name, t1.deals from category_table t1 inner join item_table t2 inner join size_table t3 on (t1.business_id=$busId and t1.business_id= t2.business_id and t2.item_id= t3.item_id) order by t1.cat_name ASC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['categories'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
//get subcategories
function allSubcategories($user_id,$catid){
$result=mysql_query("select * from subcategory where categoryId= $catid order by SubCategoryName ASC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['subcategories'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
///analytics
function analytics(){
$result=mysql_query("select placeName,placeType,cost,views,sales from place p right outer join views v on(p.placeId=v.placeId) order by placeType ASC,cost DESC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['places'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
function searchPlace($query){
$result=mysql_query("select * from place where placeName like '$query' or placeName like '$query %' or placeName like '% $query' or placeName like '% $query %'  or placeName like '%$query %' or placeName like '$query%' or placeName like '% $query%' order by placeName ASC")or die(mysql_error());
$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['places'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
function searchItem($query){
$result=mysql_query("select * from deal where dealType like '$query' or dealType like '$query %' or dealType like '% $query' or dealType like '% $query %'  or dealType like '%$query %' or dealType like '$query%' or dealType like '% $query%' order by dealType ASC")or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['items'][]=$row;
}
}
//mysql_close($con);
echo json_encode($json); 

}
function searchService($query){

}
//function addBussiness for adding a new business
function addBusiness($name,$type,$contact,$country,$district,$area,$latitude,$longitude,$username,$password){
//
if($name&&$type&&$contact&&$country&&$district&&$area&&$latitude&&$longitude&&$username&&$password){
   $sel=mysql_query("select * from place where placeName like '$name' && placeType='$type' && contact like '$contact' && country like '$country' && district like '$district' && area like '$area'")or die(mysql_error());
   $val=mysql_fetch_array($sel);
   if($val){
     echo  "{\"status\":\"Place exists\"}";
      return;
   }else{
     $sel=mysql_query("select * from account where username = '$username'")or die(mysql_error());
     $val=mysql_fetch_array($sel);
     if($val){
        echo  "{\"status\":\"Username exist\"}";
        return;
       }else{
	        mysql_query("insert into account set username='$username',password='$password'")or die(mysql_error());
			$selx=mysql_query("select * from account where username = '$username' && password='$password'")or die(mysql_error());
             $valx=mysql_fetch_array($selx);
			 $accountId=$valx['accountId'];
			 $time=time();
			 mysql_query("INSERT INTO place set placeName='$name',placeType='$type',contact='$contact',country='$country',district='$district',area='$area',latitude='$latitude',longitude='$longitude',accountId='$accountId',time='$time'")or die(mysql_error());
			 $selv=mysql_query("select * from place where accountId = '$accountId'")or die(mysql_error());
             $valv=mysql_fetch_array($selv);
			 $pId=$valv['placeId'];
			 mysql_query("INSERT INTO views set placeId='$pId', views='0'")or die(mysql_error());			
              echo "{\"status\":\"success\",\"placeId\":\"$pId\"}";
        }
   }
}else{
 echo "{\"status\":\"error\"}";
}
}

function deductaccount($user_id, $amount){
$currentbal;
$result=mysql_query("select t3.balance 
 from customers t1 inner join justdeals_account t3 on(t1.customer_id=t3.owner and t3.type ='customer')
  WHERE t1.customer_id= $user_id ")or die(mysql_error());
  
  $val=mysql_fetch_array($result);

if($val){
$currentbal=intval($val['balance']);
$amt=intval($amount);
$left=$currentbal-$amt;
$result=mysql_query("Update justdeals_account  set balance=$left where owner=$user_id and type='customer' ")or die(mysql_error());
}

}//end of deduct account

function updateaAppearances($user_id,$page){
$current;
$result=mysql_query("select visits 
 from customers WHERE customer_id= $user_id ")or die(mysql_error());

$val=mysql_fetch_array($result);

if($val){
$current=intval($val['visits']);
$left=$current+1;
$result=mysql_query("Update customers  set visits=$left, lasttime=NOW(), lastpage='$page' where customer_id= $user_id ")or die(mysql_error());
}

}//end of update visits

function DetermineProfilevalue($user_id){
$dob;
$relg;
$addr;
$visit;
$result=mysql_query("select customer_dob, customer_religion, customer_location, visits 
 from customers WHERE customer_id= $user_id ")or die(mysql_error());

$val=mysql_fetch_array($result);

if($val){
$dob=$val['customer_dob'];
$relg=$val['customer_religion'];
$addr=$val['customer_location'];
$visit=$val['visits'];
}
if($dob="null" && $visit > 50 && $visit < 100){
return "dob";
}else if($dob==NULL && $visit > 50 && $visit < 100){
return "dob";
}else if($visit > 100 && $relg == NULL && $visit < 150){
return "religion";
}else if($visit > 100 && $relg="null"  && $visit < 150){
return "religion";
}else if($visit > 150 && $addr == NULL && $visit < 200){
return "address";
}else if($visit > 150 && $addr="null"  && $visit < 200){
return "address";
}else{
return "not";
}
}//end of determine what to update


//adding items to order for paid is yes
function addItemsToOrder($json,$user_id,$amount,$paid, $phone, $pin){
//$loc=strval(getAddress($lat,$long));
//$loc="wandegeya";
$userId=$user_id;
$pin_encrypt= sha1($pin);//to be used for mobile money

$ins=mysql_query("insert into table_ordered_items(id,user_id,time,total_amount_items,paid,phone_number) values('',$user_id, NOW(),$amount, '$paid','$phone')")or die(mysql_error());
 
   if($ins){
   //
	$order_id = mysql_insert_id(); // last inserted id
	$stringSize=strlen($json);//the size of the sent string
$currentString=substr($json,1);//the currently remaining string
$count=1;//the counter
$item_id;//category
$isItemId=false;

$qty;//subcategory
$isqty=false;

$item_size;//item
$isSize=false;

$isInstruction=false;
$Instruction;

do{
$index=strpos($currentString,'|');//get index of |
$value=substr($currentString,0,$index);//get value
$currentString=substr($currentString,$index+1);//move to next value
$value=trim($value);
//echo $value." ";
$count+=$index;
$count++;
//adding items
if($isItemId ){//waiting for item id
 $isItemId=false;
 $item_id=$value;
}elseif($isqty){
$isqty=false;
$qty=$value;
}elseif($isSize){
 $isSize=false;
 $item_size=$value;
 }elseif($isInstruction){
$isInstruction=false;
$Instruction=$value;
mysql_query("INSERT INTO order_container VALUES ('', $order_id, $item_id, $qty, '$item_size', '$Instruction', 'no')")or die(mysql_error());      
}

//setting boolens
if($value=="item_id"){
$isItemId=true;
}elseif($value=="qty"){
$isqty=true;
}elseif($value=="size"){
$isSize=true;
}elseif($value=="instruction"){
$isInstruction=true;
}

}while($count<$stringSize);

 //deductaccount($userId, $amountval);//call deduct account $currentbaldet
    echo "{\"status\":\"ok\",\"message\":\"Order has been sent for processing, please wait for your Verification Code. Thank you!\"}";          
	$gcmid_array= getGcmRegIdsForMerchants($order_id, $user_id);
	
	$message="incoming order, see your new orders now...";
	SendmessageMany($gcmid_array,$message,1,1, "merchant");//to send message to new customer
	    return; 
		}else{
   echo "{\"status\":\"failed\"}"; 
    return;
  }

}//end of save order

function generate_new_code(){//start
$length = 10;
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$notexist;
	
$string = "";    
for ($p = 0; $p < $length; $p++) 
{
    $string .= $characters[mt_rand(2, strlen($characters)-1)];
}
$tim= time();
$final_str= $string.$tim;

return $final_str;
}//end


function generate_code($order_id,$user_id){//star of function generate code
$notexist=true;
$times=15;
$i=0;
$new_string;
while($notexist && $i <= $times){
$new_string= generate_new_code();
$sel=mysql_query("select * from table_ordered_items WHERE verification_code LIKE '$new_string' ")or die(mysql_error());

$val=mysql_fetch_array($sel);
if($val){
$notexist=false;
}else{
$notexist=true;
}
$i+=1;
}//end while
$split= implode(" ", str_split($new_string, 4));
echo  "{\"status\":\"sucsess\",\"code\":\"$split\"}";

}



//viewing order
function vieworder(){
$result=mysql_query("SELECT
	a.customer_name, b.phone_number,b.location, b.time, b.delivery, b.id
FROM
	table_ordered_items b
LEFT JOIN
	customers a ON a.customer_id = b.user_id
")or die(mysql_error());

$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['alloders'][]=$row;
}
echo json_encode($json);
}else{
echo "{\"status\":\"empty\"}";}
//mysql_close($con);
 

}

//viewing order details
function vieworderDetails($order_id,$user_id, $acctype){
$result;
if($acctype=="merchant"){
$result=mysql_query("SELECT
	itm.item_id,itm.item_image,itm.item_name, b.special_instruction,a.time, b.quantity, b.size, (b.quantity*b.size) as amount,
	(SELECT CASE WHEN discount <=10      THEN 5
            WHEN discount >10 THEN (0.1* discount)
                             ELSE 0
       END
FROM item_table where item_id=itm.item_id) as customer_discount, bus.business_location, bus.business_name
FROM
	table_ordered_items a 
INNER JOIN
    order_container b ON (b.order_id= a.id and b.order_id= '$order_id')
INNER JOIN
    item_table itm ON (b.item_id = itm.item_id)
INNER JOIN	
	merchant mct ON (mct.business_id=itm.business_id)
INNER JOIN
    business bus ON (bus.business_id = mct.business_id)
where mct.merchant_id= '$user_id'" )or die(mysql_error());

}else{


$result=mysql_query("SELECT
	c.item_id,c.item_image,c.item_name, b.special_instruction,a.time, b.quantity, b.size, (b.quantity*b.size) as amount,
	(SELECT CASE WHEN discount <=10      THEN 5
            WHEN discount >10 THEN (0.1* discount)
                             ELSE 0
       END
FROM item_table where item_id=c.item_id) as customer_discount, d.business_location, d.business_name
FROM
	table_ordered_items a 
LEFT JOIN
    order_container b ON (b.order_id= '$order_id' and b.order_id = a.id)
INNER JOIN
    item_table c ON b.item_id = c.item_id
INNER JOIN
    business d ON d.business_id = c.business_id
WHERE a.user_id='$user_id'" )or die(mysql_error());
}


$json = array();
if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['orderItems'][]=$row;
}
$ary=array("status"=>"ok");
$json['orderItems'][]=$ary;
echo json_encode($json); 

}else{
$ary=array("status"=>"empty");
$json['orderItems'][]=$ary;
echo json_encode($json); 
//echo "{\"status\":\"empty\"}";}
} 

}
//adding new items
function addItems($json,$placeId){
$sel=mysql_query("select * from place where placeId='$placeId'")or die(mysql_error());
 $val=mysql_fetch_array($sel);
  if($val){
    //
  }else{
   echo "Place does not exist"; 
    return;
  }
  
$stringSize=strlen($json);//the size of the sent string
$currentString=substr($json,1);//the currently remaining string
$count=1;//the counter
$category;//category
$catId;
$isCat=false;
$subcategory;//subcategory
$isSubCat=false;
$item;//item
$isItem=false;
$size;//size
$isSize=false;
$price;//price
$isPrice=false;
$isSubCatId=false;
$subCatId;

do{
$index=strpos($currentString,'|');//get index of |
$value=substr($currentString,0,$index);//get value
$currentString=substr($currentString,$index+1);//move to next value
$value=trim($value);
//echo $value." ";
$count+=$index;
$count++;
//adding items
if($isCat ){//waiting for category
   $isCat=false;
   
 $category=$value;
 $sel=mysql_query("select * from category where categoryName like '$category' && placeId='$placeId'")or die(mysql_error());
 $val=mysql_fetch_array($sel);
  if($val){
    $catId=$val['categoryId'];
  }else{
    /*mysql_query("INSERT INTO category set categoryName='$category', placeId='$placeId'")or die(mysql_error());
    $sel=mysql_query("select * from category where categoryName like '$category' && placeId='$placeId'")or die(mysql_error());
    $val=mysql_fetch_array($sel);
	$catId=$val['categoryId'];  
  */}
}elseif($isItem){
$isItem=false;
$item=$value;
}elseif($isSize){
 $isSize=false;
 $size=$value;
}elseif($isPrice){
 $isPrice=false;
 $price=$value;
}elseif($isSubCatId){
 $isSubCatId=false;
 $subCatId=$value;
$sel=mysql_query("select count(*) total from item where itemName like '$item' && size like '$size' && price='$price' && subCategoryId='$subCatId' && businessId='$placeId'")or die(mysql_error());
 $val=mysql_fetch_array($sel);
  if($val['total']>0){
    // Item does not exists
	  }else{
    mysql_query("INSERT INTO item set subCategoryId='$subCatId', itemName='$item',size='$size',price='$price',businessId='$placeId'")or die(mysql_error());      
  }
}
//setting boolens
if($value=="category"){
$isCat=true;
}elseif($value=="sub category"){
$isSubCat=true;
}elseif($value=="item"){
$isItem=true;
}elseif($value=="size"){
$isSize=true;
}elseif($value=="price"){
$isPrice=true;
}elseif($value=="subCategoryId"){
$isSubCatId=true;
}

}while($count<$stringSize);

echo "ok";
}

?>