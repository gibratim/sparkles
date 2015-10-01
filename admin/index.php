<?php
session_start();
//session_destroy();
if(isset($_SESSION['username'],$_SESSION['contact'],$_SESSION['email'],$_SESSION['group_id'],$_SESSION['branch_id'])){
  include("../connect.php");
  $username=$_SESSION['username'];
  $email=$_SESSION['email'];
  $contact=$_SESSION['contact'];
  $group_id=$_SESSION['group_id'];
  $branch_id=$_SESSION['branch_id'];
  $sel=mysql_query("SELECT * FROM user_right u inner join rights r on(u.right_id=r.right_id) where u.group_id='$group_id'")or die(mysql_error());
  while($val=mysql_fetch_array($sel)){
     $right_id=$val['right_id'];//right id
     $right_name=$val['right_name'];//right name
     $branches=$val['branches'];//branches that can be accessed
     $view=$val['view'];//can view
     $add=$val['add'];//can add
     $edit=$val['edit'];//can edit
     $delete=$val['delete'];//can delete
  //saving rights to 
     $_SESSION[''.$right_name.'']=true;
     $_SESSION[''.$right_name.'_branches']=$branches;
     $_SESSION[''.$right_name.'_view']=$view; 
     $_SESSION[''.$right_name.'_add']=$add;
     $_SESSION[''.$right_name.'_edit']=$edit;
     $_SESSION[''.$right_name.'_delete']=$delete;
	// var_dump($_SESSION);
  }
 include("function_call.php");
}else{
   header("Location:../login.php");
}
?>