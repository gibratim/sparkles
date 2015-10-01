<?php
include("connect.php");
include("function.php");
if(isset($_REQUEST['command'])){
$req=$_REQUEST['command'];
switch($req){
 case "mymessages":
 getnewmessages($_REQUEST['userId']);
 
 break;
 
 case "myverificationcodes":
 getVerificationCodes($_REQUEST['userId'],$_REQUEST['acctype']);
 
 break;
 case "getverificationcode":
 generate_code($_REQUEST['orderId'],$_REQUEST['userId']);
 
 break;
 
 case "analytics":
 analytics();
 break;
 case "categories":
 allCategories();
 break;
 
 case "mostpopularcategories":
 MostCategories();
 break;
 
 //categories for a given busines
 case "businesscategories":
 allCategoriesForBusiness($_REQUEST['userId'],$_REQUEST['busId']);
 break;
 
 case "sendmessage":
 Sendmessage($_REQUEST["regId"],$_REQUEST["message"],$_REQUEST["sender_id"],$_REQUEST["receiver_id"] ,$_REQUEST["type"]);
 break;
 
 case "nearme":
 allBusinessNearMe($_REQUEST['userId'],$_REQUEST['latitude'], $_REQUEST['longitude']);
 break;
 
 case "getdeliverycostshoppinglist":
 CalculateDeliveryCostshoppinglist($_REQUEST['userId'],$_REQUEST['maxdistance'], $_REQUEST['amount']);
 break;
  //user account
 case "myactivities":
 getactivities($_REQUEST['userId'], $_REQUEST['page']);
 break;
 //user profile
 case "userprofile":
 ProfileInfo($_REQUEST['userId']);
 break;
  //user account
 case "myaccount":
 MyAccount($_REQUEST['userId'], $_REQUEST['type']);
 break;
  //business profile
 case "businessprofile":
 ProfileInfoBusiness($_REQUEST['busId']);
 break;
  //user account balance
 case "checkuseraccount":
 checkAccountBalance($_REQUEST['userId'], $_REQUEST['pin']);
 break;
  //user account
 case "myaccount":
 MyAccount($_REQUEST['userId'], $_REQUEST['type']);
 break;
 //update business profile
 case "updatebusinessprofile":
 updateBusinessProfile($_REQUEST['busId'], $_REQUEST['name'], $_REQUEST['status'], $_REQUEST['email'], $_REQUEST['phone'], $_REQUEST['address']);
 break;
//update business profile
 case "updateUserProfile":
 updateuserProfile($_REQUEST['userId'], $_REQUEST['name'], $_REQUEST['status'], $_REQUEST['email'], $_REQUEST['phone'],$_REQUEST['dob'], $_REQUEST['address'],$_REQUEST['religion']);
 break;
//following
 case "followme":
 followMe($_REQUEST['fwerId'], $_REQUEST['fweeId'], $_REQUEST['fwertype'], $_REQUEST['fweetype']);
 break;
 case "searchPlace": 
 searchPlace($_REQUEST['query']);
 break;
 
 case "signinuser": 
 signIn($_REQUEST['name'], $_REQUEST['pin'],$_REQUEST['regId'],$_REQUEST['acctype']);
 break;
 
 case "allitemstrending": 
 AllitemsTrending($_REQUEST['userId'],$_REQUEST['page']);
 break;
 
 case "mostpopular": 
 Mostpopular($_REQUEST['userId'],$_REQUEST['page']);
 break;
 
 case "uploadimageuser": 
 profile_base64_to_image($_REQUEST['image'],$_REQUEST['userId']);
 break;
 
 case "allitems": 
 Allitems();
 break;
 
 case "vieworders": 
 vieworder();
 break;
 
 case "vieworderdetails": 
 vieworderDetails($_REQUEST['orderId'],$_REQUEST['userId'],$_REQUEST['acctype'] );
 break;
 
 case "allitemsCat": 
 AllitemsIntThisCatgory($_REQUEST['userId'],$_REQUEST['catId'], $_REQUEST['page']);
 break;
 
 case "alsobought": 
 PeopleAlsoBought($_REQUEST['userId'],$_REQUEST['ItemId'], $_REQUEST['page']);
 break;
 
 case "suggesteditems": 
 ItemsSuggestedForYou($_REQUEST['userId'],$_REQUEST['page']);
 break;
 
 case "searchItem": 
 searchItem($_REQUEST['query']);
 break;
 //updating location for deliverers
 
 case "registeruser": 
 storeUser($_REQUEST['name'],$_REQUEST['email'],$_REQUEST['regId'],$_REQUEST['phone'],$_REQUEST['pin']);
 break;
 
 case "registerdeliveryuser": 
 storeDeliveryUser($_REQUEST['name'],$_REQUEST['email'],$_REQUEST['regId'],$_REQUEST['phone'],$_REQUEST['pin']);
 break;
 
 case "unregisteruser": 
 storeUser($_REQUEST['regId']);
 break;
 
 //all business types
 case "businesstypes": 
 allTypes();
 break;
 
 case "storeprofilepic": 
 profile_base64_to_image($_REQUEST['base64string'], $_REQUEST['username'], $_REQUEST['user_id']);
 break;
 
 case "sendidea":
 sendidea($_REQUEST['userId'],$_REQUEST['content']);
 break;
 
 case "reportbug":
 reportbug($_REQUEST['userId'],$_REQUEST['content']);
 break;
 
 case "businessnamesintype": 
 allBusinessesInType($_REQUEST['userId'],$_REQUEST['type']);
 break;
 //updating location for deliverers
 case "sendorder":
if(isset($_REQUEST['type'],$_REQUEST['value'])){
       addItemsToOrder($_REQUEST['jsonvalue'],$_REQUEST['user_id'], $_REQUEST['amount'], $_REQUEST['paid'], $_REQUEST['phone'], $_REQUEST['pin']);
 
 updateuserattribute($_REQUEST['type'],$_REQUEST['value'],$_REQUEST['user_id']);
	  
   }else{
    addItemsToOrder($_REQUEST['jsonvalue'],$_REQUEST['user_id'], $_REQUEST['amount'], $_REQUEST['paid'], $_REQUEST['phone'], $_REQUEST['pin']);
 }
 break;
 
 case "updatelocation": 
 updateLocation($_REQUEST['longitude'], $_REQUEST['latitude'], $_REQUEST['pin'], $_REQUEST['deviceId'], $_REQUEST['type']);
 break;
 
 case "searchService": 
 searchService($_REQUEST['query']);
 break;
 case "addItems": 
   if(isset($_REQUEST['jsonvalue'],$_REQUEST['placeId'])){
      addItems($_REQUEST['jsonvalue'],$_REQUEST['placeId']);
   }else{
     echo "{\"status\":\"failed\"}";
 }
 break;
 case "addBusiness":
 if(isset($_REQUEST['name'],$_REQUEST['type'],$_REQUEST['contact'],$_REQUEST['country'],$_REQUEST['district'],$_REQUEST['area'],$_REQUEST['latitude'],$_REQUEST['longitude'],$_REQUEST['username'],$_REQUEST['password'])){ 
 addBusiness($_REQUEST['name'],$_REQUEST['type'],$_REQUEST['contact'],$_REQUEST['country'],$_REQUEST['district'],$_REQUEST['area'],$_REQUEST['latitude'],$_REQUEST['longitude'],$_REQUEST['username'],$_REQUEST['password']);
 }else{
   echo "{\"status\":\"error\"}";
 }
 break;
}
}else{
echo "{\"results\":\"error\"}";
}
?>