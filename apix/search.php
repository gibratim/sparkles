<?php 
include("connect.php");
if(isset($_REQUEST['keyword']) && isset($_REQUEST['userId']) && isset($_REQUEST['latitude']) && isset($_REQUEST['longitude']) && isset($_REQUEST['page'])){

$user_id= $_REQUEST['userId'];
$word= trim($_REQUEST['keyword']);
$orig_lat= $_REQUEST['latitude'];
$orig_lon= $_REQUEST['longitude'];
$page=$_REQUEST['page'];
$start=0;
  $end=5;
  $start+=($page*5)-5;


if($_REQUEST['latitude']==0.0 && $_REQUEST['longitude']==0.0){
$orig_lat= 0.3181;
$orig_lon= 32.5772;
}

if( trim($_REQUEST['keyword']=="food") ||  trim($_REQUEST['keyword']=="drinks")  || trim($_REQUEST['keyword']=="foods") ||  trim($_REQUEST['keyword']=="drink")){
$word="restaurant";
}
if( trim($_REQUEST['keyword']=="clothes") ||  trim($_REQUEST['keyword']=="dresses") || trim($_REQUEST['keyword']=="cloth") ||  trim($_REQUEST['keyword']=="dress")){
$word="boutique";
}
if( trim($_REQUEST['keyword']=="films") ||  trim($_REQUEST['keyword']=="cinemas") || trim($_REQUEST['keyword']=="film") ||  trim($_REQUEST['keyword']=="cinema") ){
$word="movie";
}
if( trim($_REQUEST['keyword']=="photos") ||  trim($_REQUEST['keyword']=="photoshop") || trim($_REQUEST['keyword']=="editing") ||  trim($_REQUEST['keyword']=="image editing") 
	 ||  trim($_REQUEST['keyword']=="photo shop") || trim($_REQUEST['keyword']=="images") ||  trim($_REQUEST['keyword']=="video editing") ){
$word="photography";
}
$json = array();
//search for a business
//$dist=1; // kilometer



/*
$result=mysql_query("SELECT t1.item_id, t1.item_name, t3.business_name, t3.business_location, t1.item_description, t3.business_icon, t3.latitude,t3.longitude ,t2.old_small_size, t2.old_medium_size, t2.old_large_size, t2.small_size, t2.medium_size, t2.large_size, t1.item_image, t1.type, t1.discount ,t1.expiry_date
FROM business t3 INNER JOIN item_table t1 
		ON (t1.cat_id=$catId and t1.business_id= t3.business_id and t1.item_id IS NOT NULL)
LEFT JOIN size_table t2  ON (t1.item_id=t2.item_id)
ORDER BY t2.medium_size ASC  LIMIT $start,$end ") or die(mysql_error());
*/
$result2=mysql_query("SELECT itm.item_id, itm.item_name, itm.item_image, itm.type, t3.medium_size, itm.item_description,itm.discount ,itm.expiry_date,itm.type, bus.business_name,bus.business_location, bus.latitude, bus.longitude,((6371 * 2 * ASIN(SQRT( POWER(SIN(($orig_lat -
abs( 
bus.latitude)) * pi()/180 / 2),2) + COS($orig_lat * pi()/180 ) * COS( 
abs
(bus.latitude) *  pi()/180) * POWER(SIN(($orig_lon-bus.longitude) * pi()/180 / 2), 2) )))/1000)
 
as distance FROM business bus INNER JOIN item_table itm ON (itm.business_id=bus.business_id)
INNER JOIN size_table t3 ON (itm.item_id=t3.item_id) 
INNER JOIN category_table t4 ON (itm.cat_id=t4.cat_id)
where MATCH (itm.item_name) AGAINST (+'$word') OR MATCH (itm.item_description) AGAINST (+'$word') OR MATCH (bus.business_location) AGAINST (+'$word') OR MATCH (t4.cat_name) AGAINST (+'$word') OR	itm.item_name LIKE '$word' OR itm.item_name LIKE '%$word%' OR itm.item_description LIKE '$word' OR itm.item_description LIKE '%$word%' OR 
					itm.item_name LIKE '%$word' OR itm.item_name LIKE '$word%' OR bus.business_location LIKE '%$word' OR bus.business_location LIKE '$word%' OR bus.business_location LIKE
					 '%$word%'	OR t4.cat_name LIKE '$word' OR t4.cat_name LIKE '%$word%' OR t4.cat_name LIKE '%$word' OR t4.cat_name LIKE '$word%'ORDER BY  t3.medium_size and distance ASC LIMIT $start,$end" )or die(mysql_error());

if(mysql_num_rows($result2)){
while($row1=mysql_fetch_assoc($result2)){
$json['itemsresults'][]=$row1;
}
$arr= array('status'=>"ok");
$json['itemsresults'][]=$arr;

//echo json_encode($json);
}//end of if for items


$result=mysql_query("SELECT business_id, business_name, business_icon, business_type, business_location, latitude, longitude ,((6371 * 2 * ASIN(SQRT( POWER(SIN(($orig_lat -
abs( 
bus.latitude)) * pi()/180 / 2),2) + COS($orig_lat * pi()/180 ) * COS( 
abs
(bus.latitude) *  pi()/180) * POWER(SIN(($orig_lon-bus.longitude) * pi()/180 / 2), 2) )))/1000)
 
as distance FROM business bus where MATCH (bus.business_type) AGAINST (+'$word') OR MATCH (bus.business_name) AGAINST (+'$word') OR MATCH (bus.business_location) AGAINST (+'$word') OR 
					business_type LIKE '$word' OR business_type LIKE '%$word%' OR bus.business_name LIKE '$word' OR bus.business_name LIKE '%$word%' OR
					business_name LIKE '%$word' OR business_name LIKE '$word%' OR bus.business_location LIKE '%$word' OR bus.business_location LIKE '$word%' OR bus.business_location LIKE '%$word%' ORDER BY distance LIMIT $start,$end")or die(mysql_error());

if(mysql_num_rows($result)){
while($row=mysql_fetch_assoc($result)){
$json['businessresults'][]=$row;
}
$arr= array('status'=>"ok");
$json['businessresults'][]=$arr;

//echo json_encode($json);
}//end of if for business

//search person
$result3=mysql_query("SELECT customer_id, customer_name, customer_profilepic, phone_number, latitude, longitude , status,((6371 * 2 * ASIN(SQRT( POWER(SIN(($orig_lat -
abs( 
bus.latitude)) * pi()/180 / 2),2) + COS($orig_lat * pi()/180 ) * COS( 
abs
(bus.latitude) *  pi()/180) * POWER(SIN(($orig_lon-bus.longitude) * pi()/180 / 2), 2) )))/1000)
 
as distance FROM customers bus where MATCH (bus.customer_name) AGAINST (+'$word') OR MATCH (bus.phone_number) AGAINST (+'$word')  OR MATCH (bus.customer_location) AGAINST (+'$word') OR
					phone_number LIKE '$word' OR phone_number LIKE '%$word%' OR bus.customer_name LIKE '$word' OR bus.customer_name LIKE '%$word%' OR
					customer_name LIKE '%$word' OR customer_name LIKE '$word%' OR customer_name LIKE '%_$word%' OR bus.customer_location LIKE '%$word' OR bus.customer_location LIKE '$word%' ORDER BY distance  LIMIT $start,$end ")or die(mysql_error());

if(mysql_num_rows($result3)){
while($row=mysql_fetch_assoc($result3)){
$json['customersresults'][]=$row;
}
$arr= array('status'=>"ok");
$json['customersresults'][]=$arr;

//echo json_encode($json);
}//end of if for customer

if(mysql_num_rows($result2)==0){
$arr= array('status'=>"empty");
$json['itemsresults'][]=$arr;
//echo json_encode($json);
}
if(mysql_num_rows($result)==0){
$arr= array('status'=>"empty");
$json['businessresults'][]=$arr;
//echo json_encode($json);
}
if(mysql_num_rows($result3)==0){
$arr= array('status'=>"empty");
$json['customersresults'][]=$arr;
//echo json_encode($json);
}




//mysql_close($con);
echo json_encode($json); 

}else{
echo "{\"request\":\"error\"}";
}
?>