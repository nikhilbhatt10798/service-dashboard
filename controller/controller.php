<?php
session_start();
error_reporting(0);
include("conn/connection.php");
include("model/model.php");

class controller{
  public $m;
  public function __construct()
  {
    $this->m = new model();
  }

  function index()
  {
      include("view/index.php");
  }
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 function get_login(){
  $email=$_POST['email'];
  $password=md5($_POST['pass']);

$output=$this->m->LoginAction($email,$password);

if($output=="login"){
 header('location:route.php?param=dashboard1');
}

elseif($output=="no record found"){
 echo "<script>alert('wrong id password');</script>";
            echo "<script>window.open('route.php?param=index','_self');</script>";  

}

 }
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function dashboard1(){
  include "view/dashboard1.php";

}

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function servicedashboard(){
  include "conn/serviceheader.php";
  include "view/servicedashboard.php"; 
  include "conn/servicefooter.php";
}

//::::::::::::::::::::::::::::::  customer dashboard  :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function customerdashboard(){ 
  include "conn/customerheader.php";
  include "view/customerdashboard.php"; 
  include "conn/customerfooter.php";
}
//::::::::::::::::::::::::::    signup function    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function signup(){ 
  
  include "view/signup.php"; 

}
//::::::::::::::::::::::::::: signup Action :::::::::::::::::::::::::::::::::::::::::::::::::::::::
function signupAction(){
  $name=$_POST['name'];
  $email=$_POST['email'];
 $pass = md5($_POST['pass']);
  $Contact_Number=$_POST['Contact_Number'];
  $user_type=$_POST['userType'];
  $Reoursce_Required=$_POST['user_c_data'];
 $Total_Resource=$_POST['user_s_data']; 
 $output=$this->m->signupActionPro($name,$email,$pass,$Contact_Number,$user_type,$Reoursce_Required,$Total_Resource);
 if($output=="thankyou"){
  header('location:route.php?param=thankYou');
 }elseif($output=='signupFail'){
  echo "<script>alert('you are not signup successfully');</script>";
  echo "<script>window.open('route.php?param=signup','_self');</script>";
 }
}

//::::::::::::::::: thankYou ::::::::::::::::::::::::::::::::::::::::::::
function thankYou(){
  include "view/thankYou.php";
}
//::::::::::::::::: Verify ::::::::::::::::::::::::::::::::::::::::::::
function Verify(){
  // echo "yo";
    $vkey=$_REQUEST['vkey'];
    echo $vkey;
    $email=$_GET['email'];
    echo $email;
    $output=$this->m->Verify($vkey,$email);
    if($output=="verification_Successfull"){
      echo "<script>alert('your account verification done');</script>";
      echo "<script>window.open('route.php?param=index','_self');</script>";
    }
    elseif($output=='verification_Unsuccessfull'){
      echo "<script>alert('your account verification is unsuccessfull register again ');</script>";
      echo "<script>window.open('route.php?param=index','_self');</script>";

    }
}
//:::::::::::::::;;;
function data4Reply(){
  $row_id=$_POST['id'];
  $output=$this->m->data4Reply($row_id);
  if($output=='done'){

  }elseif($output=='not done'){
     echo "something wrong";
  }

}
//:::::::::::::::::::::::::::::::::::::::
function serviceResourceReq(){

include "conn/serviceheader.php";
include "view/serviceResourceReq.php";
include "conn/servicefooter.php";
}
//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
function modelReply(){
  //     customer details 

  $customer_id = $_POST['cid'];
  // echo $customer_id;

  $customer_name = $_POST['name'];
  // echo   nl2br($customer_name);

  $customer_email = $_POST['email'];
  // echo   nl2br($customer_email);

  $customer_requirment = $_POST['r-resource'];
  // echo   nl2br($customer_requirment);

  $customer_location = $_POST['location'];
  // echo   nl2br($customer_location);

  $customer_phone = $_POST['phone'];
  // echo   nl2br($customer_phone);

  $customer_req_oneDate = $_POST['date'];
  // echo  nl2br($customer_req_oneDate);

//service Povider (user) details  
   
  $servicepro_id=$_POST['user_id'];
  // echo nl2br($servicepro_id);

  $servicepro_name=$_POST['serviceProName'];	
  // echo nl2br($servicepro_name);

  $servicepro_email=$_POST['serviceProEmail'];
  // echo nl2br($servicepro_email);	

  $servicepro_rateOfOne=$_POST['resRate'];
  // echo nl2br($servicepro_rateOfOne);

  $servicepro_phone=$_SESSION['phone'];
  // echo nl2br($servicepro_phone);

  $servicepro_totalCost=$_POST['total_cost'];
  // echo nl2br($servicepro_totalCost);

  $status="0";
  // echo $status;	
$output=$this->m->modelReply($customer_id,$customer_name,$customer_email,$customer_requirment,$customer_location,$customer_phone,$customer_req_oneDate,$servicepro_id,$servicepro_name,$servicepro_email,$servicepro_rateOfOne,$servicepro_phone,$servicepro_totalCost,$status);
if($output=="send"){
  echo "<script>alert('you successfully Send Your Deal');</script>";
  echo "<script>window.open('route.php?param=serviceResourceReq','_self');</script>";
}elseif($output=="Not send"){
  echo "<script>alert('your deal is NOT successfully Send);</script>";
    echo "<script>window.open('route.php?param=serviceResourceReq','_self');</script>";
}
}
//:::::::::::::::::::::::::::::::::::::::
function serviceMyResponse(){

  include "conn/serviceheader.php";
  include "view/serviceMyResponse.php";
  include "conn/servicefooter.php";
  }
//:::::::::::::::::::::::::::::::::::::::
function serviceprofile(){

  include "conn/serviceheader.php";
  include "view/serviceprofile.php";
  include "conn/servicefooter.php";
  }
  //:::::::::::::::::::::::::::::::::::::::
function editUserProfile(){
  // echo 'yo';
include "view/editUserProfile.php";
  }
//:::::::::::::::::::::::::::::::::::::::
function serviceSetting(){

  include "conn/serviceheader.php";
  include "view/serviceSetting.php";
  include "conn/servicefooter.php";
  } 
//:::::::::::::::::::::::::::::::::::::: 
  function logout(){
    ob_start();
    // include ('connection.php');
    session_start(); 
      $userid =$_SESSION['id'];
    //  $sql="UPDATE user set status='Offline' where id='$userid'"; mysqli_query($con,$sql);
         session_destroy(); 
          header('location:route.php?param=index');
    ob_flush();
   
    }  
//:::::::::::::::::::::::::::::
function customerAddRequest(){

  include "conn/customerheader.php";
  include "view/customerAddRequest.php";
  include "conn/customerfooter.php";
  } 
//:::::::::::::::::;
function c_AddRequestAction(){
  $customer_id=$_SESSION['id'];
// echo nl2br("$customer_id\n");
$name=$_SESSION['name'];
// echo nl2br("$name\n");
$email=$_SESSION['email'];
// echo nl2br("$email\n");
$resource=$_POST['resource'];
$address=$_POST['address'];
$date=$_POST['date'];

$phone=$_POST['phone'];
$output=$this->m->c_AddRequestAction($customer_id,$name
, $email,$resource,$phone,$address,$date);
if($output=="done"){
  echo "Form Submitted Succesfully";
  // echo "<script>window.open('route.php?param=customerAddRequest','_self');</script>";
}elseif($output=='not done'){
  echo "Form NOT Submitted Succesfully";
  // echo "<script>window.open('route.php?param=customerAddRequest','_self');</script>";
}
}
//:::::::::::::::::: customerDeals :::::::::;
function customerDeals(){
  include "conn/customerheader.php";
  include "view/customerDeals.php";
  include "conn/customerfooter.php";
}
//::::::::::::: customerAproveDeal ::::::;
function customerAproveDeal(){
  $rowid=$_POST['rowid'];
$servicepro_email=$_POST['servicepro_email'];
$servicepro_name=$_POST['servicepro_name'];
$servicepro_id=$_POST['servicepro_id'];
$user_id =  $_SESSION['id'];
$user_name =  $_SESSION['name'];
$output=$this->m->customerAproveDeal($rowid,$servicepro_email,$servicepro_name,$servicepro_id,$user_id,$user_name);
if($output=='done'){
  echo "yes";
  // echo "<script>alert('deal Aproved');</script>";
  // echo "<script>window.open('route.php?param=customerDeals','_self');</script>";
}elseif($output=='not done'){
  echo "no";
  // echo "<script>alert('deal not aproved');</script>";
  // echo "<script>window.open('route.php?param=customerDeals','_self');</script>";
}
}
//::::::::::::: customerDeleteDeal ::::::;
function customerDeleteDeal(){
  $rowid=$_POST['rowid'];
$servicepro_email=$_POST['servicepro_email'];
$servicepro_name=$_POST['servicepro_name'];
$servicepro_id=$_POST['servicepro_id'];
$user_id =  $_SESSION['id'];
$user_name =  $_SESSION['name'];
$output=$this->m->customerDeleteDeal($rowid,$servicepro_email,$servicepro_name,$servicepro_id,$user_id,$user_name);
if($output=='done'){
  // echo "<script>alert('deal deleted');</script>";
  echo "yes";
  // echo "<script>window.open('customerDeals.php','_self');</script>";
}elseif($output=='not done'){
    echo "no";
  // echo "<script>alert('deal not deleted');</script>";
  // echo "<script>window.open('customerDeals.php','_self');</script>";
}
}
//::::::::::::::customerSendRequest
function customerSendRequest(){
  include "conn/customerheader.php";
  include "view/customerSendRequest.php";
  include "conn/customerfooter.php"; 
}
//:::::::::::::::customerDeleteSendReq
function customerDeleteSendReq(){
  $rowid=$_REQUEST['rowid'];
  $output=$this->m->customerDeleteSendReq($rowid);
  if($output=='done'){
    echo "deal deleted";
    // echo "<script>window.open('route.php?param=customerSendRequest','_self');</script>";
  }elseif($output=='not done'){
    echo "deal not deleted";
    // echo "<script>window.open('route.php?parma=customerSendRequest','_self');</script>";
  }
}
//::::::::::::::::::::::customerSeeAprovedDeals
function customerSeeAprovedDeals(){
  include "conn/customerheader.php";
  include "view/customerSeeAprovedDeals.php";
  include "conn/customerfooter.php";  
}
//:::::::::::::::::::
function customerProfile(){
  include "conn/customerheader.php";
  include "view/customerProfile.php";
  include "conn/customerfooter.php";  
}
//:::::::::::::::::::customerSetting
function customerSetting(){
  include "conn/customerheader.php";
  include "view/customerSetting.php";
  include "conn/customerfooter.php";  
}
//:::::::::::::::::::customerNotification
function customerNotification(){
  include "conn/customerheader.php";
  include "view/customerNotification.php";
  include "conn/customerfooter.php";  
}
//:::::::::::::::::::forgot
function forgot(){
 
  include "view/forgot.php";
  
}
//::::::::::::::::::: for forgot operation->emailCheck
function emailCheck(){
 $email_check=$_POST['checkEmail'];
//  echo "$email_check";
 $output=$this->m->checkEmail($email_check);
//  echo $output;
 if($output=='yes'){
  //  echo "yes";
   echo $email_check;
 }
 elseif($output=='no'){
   echo "no";
 }
}
//::::::::::::::::::: for forgot operation->resetPass
function passwordresetpage(){
  include 'view/passreset.php';
 }
//::::::::::::::::::: for forgot operation->resetPass
function resetPass(){
  $email=$_POST['email'];
  $cpass=$_POST['cpass'];
 //  echo "$email_check";
  $output=$this->m->resetPass($cpass,$email);
 //  echo $output;
  if($output=='yes'){
    echo "yes";
  }
  elseif($output=='no'){
    echo "no";
  }
 }
//;;;;;;;;;;;;;;;
}
  ?>