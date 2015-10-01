<?php
//set time zone to that similar to uganda
date_default_timezone_set('Africa/Nairobi');
?>
<?php
include("../encrypt/encrypt.php");
include("functions.php");
if(isset($_REQUEST['rqt'])){
   $request=$_REQUEST['rqt'];
   $xxx=new Encryption;
  $request = $xxx->decode($request);
   switch($request){
     case "calendar":
	   calendar();
	 break;
	 case "bookings":
	   bookings();
	 break;
	 case "customers":
	   customers();
	 break;
	  case "services":
	   services();
	 break;
     default:
	    $_SESSION['date']=date("Y-m-d");//reset date
	    homepage();
	break;
   }

}else{
   $_SESSION['date']=date("Y-m-d");//reset date
  homepage();
}

?>