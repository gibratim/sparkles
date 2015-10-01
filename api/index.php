<?php
if(isset($_REQUEST['cmd'])){
   $cmd=$_REQUEST['cmd'];
   if($cmd){//checking if a command has been submitted
      include("functions.php");
      switch($cmd){
	     case "login":
	        login();
	     break;
		 case "placeBooking":
	        placeBooking();
	     break;
		 case "getServices":
	        services();
	     break;
		 case "registerCustomer":
	        register();
	     break;
	     default:
	        $json=array();
	        $ary=array("status"=>"invalid request");
	        $json['result'][]=$ary;
	        echo json_encode($json);
	      break;
	  }
   }else{//if no command was submitted return error message
     $json=array();
	 $ary=array("status"=>"invalid request");
	 $json['result'][]=$ary;
	 echo json_encode($json);
   }
}else{// if no command was submitted return error message
    $json=array();
	 $ary=array("status"=>"invalid request");
	 $json['result'][]=$ary;
	 echo json_encode($json);
}


?>