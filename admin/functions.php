<?php
//home page
function homepage(){
   if(isset($_SESSION['staff_calendar'])){
      $staff_calendar=$_SESSION['staff_calendar'];
      if($staff_calendar){
         include("calendar_menu.php");
      }
    }elseif(isset($_SESSION['bookings'])){
       $bookings=$_SESSION['bookings'];
       if($bookings){
          include("bookings_menu.php");
      }
   }elseif(isset($_SESSION['customers'])){
       $bookings=$_SESSION['customers'];
       if($bookings){
          include("customers.php");
      }
   }elseif(isset($_SESSION['services'])){
       $bookings=$_SESSION['services'];
       if($bookings){
          include("services.php");
      }
   }else{
    echo "<h1>ACCESS DENIED: Unknown user</h1>";
   }
}
//sataff calendar
function calendar(){
   if(isset($_SESSION['staff_calendar'])){//if you have access to the calendar
      $staff_calendar=$_SESSION['staff_calendar'];
      if($staff_calendar){
         include("calendar_menu.php");
      }
    }else{
	  header("Location:index.php");
	}
}
//bookings
function bookings(){
   if(isset($_SESSION['bookings'])){//if you have access to the calendar
      $bookings=$_SESSION['bookings'];
      if($bookings){
         include("bookings_menu.php");
      }
    }else{
	  header("Location:index.php");
	}
}
//customers
function customers(){
   if(isset($_SESSION['customers'])){//if you have access to the calendar
      $customers=$_SESSION['customers'];
      if($customers){
         include("customers.php");
      }
    }else{
	  header("Location:index.php");
	}
}
//services
function services(){
   if(isset($_SESSION['services'])){//if you have access to the calendar
      $services=$_SESSION['services'];
      if($services){
         include("services.php");
      }
    }else{
	  header("Location:index.php");
	}
}
?>