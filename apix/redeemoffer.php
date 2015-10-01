<?php 
include("connect.php");
if(isset($_REQUEST['keyword']) && isset($_REQUEST['userId']) && isset($_REQUEST['item_id'])){

$user_id= $_REQUEST['userId'];
$word= trim($_REQUEST['keyword']);
$item=$_REQUEST['item_id'];

$json = array();

$result2=mysql_query("SELECT itm.item_id, itm.item_name, itm.item_image, itm.type, b.size,b.quantity,b.special_instruction,itm.discount ,b.redeemed, b.order_id, itm.expiry_date,itm.type, bus.business_name,bus.business_location, mct.merchant_id 
FROM
	table_ordered_items a 
INNER JOIN
    order_container b ON (b.order_id= a.id )
INNER JOIN
    item_table itm ON (b.item_id = itm.item_id and itm.item_id= '$item')
INNER JOIN	
	merchant mct ON (mct.business_id=itm.business_id)
INNER JOIN
    business bus ON (bus.business_id = mct.business_id)

WHERE mct.merchant_id= '$user_id' AND a.verification_code LIKE '$word'" )or die(mysql_error());

$vale=mysql_fetch_array($result2);
     if($vale){
	 $orderid=$vale['order_id']; 
$redeemtime= "yes";
$updateoffer =mysql_query("UPDATE order_container set redeemed='$redeemtime' where order_id='$orderid' and item_id='$item'") or die(mysql_error());

if($updateoffer){
echo "{\"status\":\"ok\"}";
}else{
echo "{\"status\":\"empty\"}";
}	
}//end of if for items
else{
echo "{\"status\":\"empty\"}";

}

}else{
echo "{\"request\":\"error\"}";
}
?>