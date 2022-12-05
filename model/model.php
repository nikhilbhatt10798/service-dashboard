<?php
session_start();

include("conn/connection.php");

class model{
  public $m;
  public function conn()
  {
    $conn= mysqli_connect('localhost', 'root', '','dashboard');
    return $conn;
  }
  function __construct(){
    $this->m = $this->conn();
  }


  ///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::



  function LoginAction($email,$password){
    $query="SELECT * FROM user WHERE email='$email' AND (password='$password' AND verified='1')";
    $result=mysqli_query($this->m,$query);
    $num=mysqli_num_rows($result);
    if($num>=1)
    {
      $user = mysqli_fetch_array($result); 

      $_SESSION['id'] = $user['ID'];

      $_SESSION['name'] = $user['name'];   

      $_SESSION['user_type']=$user['user_type'];

      $_SESSION['email']=$user['email'];

      $_SESSION['phone']=$user['phone'];

      return "login";
    }
    else{

      return"no record found";
    }

  }

 //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function signupActionPro($name,$email,$pass,$Contact_Number,$user_type,$Reoursce_Required,$Total_Resource){
  $vkey=md5(time().$name);
$sql=mysqli_query($this->m,"INSERT INTO user (name,password,email,phone,user_type,required_resource,total_resource,vkey) VALUES('$name','$pass','$email','$Contact_Number','$user_type','$Reoursce_Required','$Total_Resource','$vkey')");
if($sql){
  //send email
  $to=$email;
  $subject='Email verification';
  $message="<a href='localhost/mvcpro/route.php?param=verify&vkey=$vkey&email=$email'>Register Account</a>";
  $headers="From: nikhilbhatt10798@gmail.com \r\n";
  $headers.="MIME-Version: 1.0"."\r\n";
  $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
  mail($to,$subject,$message,$headers);
  return "thankyou";
}else{
  return "signupFail";
}
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function Verify($vkey,$email){
  $sql=mysqli_query($this->m,"SELECT vkey,email FROM user WHERE vkey='$vkey' AND (email='$email' AND verified='0')");
    
  if ($sql){
      $sql2=mysqli_query($this->m,"UPDATE user SET verified='1' WHERE vkey='$vkey' AND (email='$email' AND verified='0') ");
     return "verification_Successfull";
}else{
  return "verification_Unsuccessfull";
}
  
}
//::::::::::::::::: data 4 model ;;;;;;;;;;
function data4Reply($row_id){
  $sql=mysqli_query($this->m,"SELECT c_required_resource FROM requestedresource WHERE ID='$row_id'");
  if($sql){
	

    while($row=mysqli_fetch_array($sql)){
      echo $row['c_required_resource'];
      
  
  }
  return 'done';
}
else{
  return 'not done';
}
}
//:::::::::::: model reply action :::::
function modelReply($customer_id,$customer_name,$customer_email,$customer_requirment,$customer_location,$customer_phone,$customer_req_oneDate,$servicepro_id,$servicepro_name,$servicepro_email,$servicepro_rateOfOne,$servicepro_phone,$servicepro_totalCost,$status){
  $sql=mysqli_query($this->m,"INSERT INTO reply (customer_id,
  customer_name,
  customer_email,
  customer_requirment,
  customer_location,
  customer_phone,
    customer_req_oneDate, 
    servicepro_id
    ,servicepro_name,servicepro_email,servicepro_rateOfOne,servicepro_phone,servicepro_totalCost,status)
VALUES('$customer_id'
,'$customer_name'
,'$customer_email'
,'$customer_requirment'
,'$customer_location'
,'$customer_phone'
,'$customer_req_oneDate'
,'$servicepro_id'
,'$servicepro_name','$servicepro_email','$servicepro_rateOfOne','$servicepro_phone','$servicepro_totalCost','$status'
)");	
if($sql){
  return "send";
}else{
  return "Not send";
}
}
//::::::::::::::::::::::::
function c_AddRequestAction($customer_id,$name
, $email, $resource,$phone,$address,$date){
  $SQL = "INSERT into requestedresource (c_id,c_name
 ,c_email,c_required_resource,phone,address,date)

values ('$customer_id','$name'
, '$email', '$resource','$phone','$address','$date'
)";
$query = mysqli_query($this->m, $SQL);
if($query){
  return "done";
}else{
  return "not done";
}
}
//:::::::::::::::::::::::::::::::::::::::
function customerAproveDeal($rowid,$servicepro_email,$servicepro_name,$servicepro_id,$user_id,$user_name){
  $sql=mysqli_query($this->m,"update reply set status=1 WHERE id='$rowid' ");
  if($sql){ $to=$servicepro_email;
    $subject='Deal Cancel';
    $message="Your deal is accepted by ".$_SESSION['name'] ;
    $headers="From: nikhilbhatt10798@gmail.com \r\n";
    $headers.="MIME-Version: 1.0"."\r\n";
    $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
    // mail($to,$subject,$message,$headers);
    $sql1=mysqli_query($this->m,"INSERT INTO notification (customer_id,customer_name,service_pro_id,service_pro_name,msg_to_customer,msg_to_service,icon)
     VALUES('$user_id','$user_name','$servicepro_id','$servicepro_name','You accepted Deal','your deal is accepted','yoho') ");
    return "done";
}else{
return "not done";
}
}
//:::::::::::::::::::::::::::::::::::::::
function customerDeleteDeal($rowid,$servicepro_email,$servicepro_name,$servicepro_id,$user_id,$user_name){
  $sql=mysqli_query($this->m,"delete from reply WHERE id='$rowid' ");
  if($sql){  $to=$servicepro_email;
    $subject='Deal Cancel';
    $message="Your deal is cancel by".$_SESSION['name'] ;
    $headers="From: nikhilbhatt10798@gmail.com \r\n";
    $headers.="MIME-Version: 1.0"."\r\n";
    $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
    // mail($to,$subject,$message,$headers);
    $sql1=mysqli_query($this->m,"INSERT INTO notification (customer_id,customer_name,service_pro_id,service_pro_name,msg_to_customer,msg_to_service,icon)
    VALUES('$user_id','$user_name','$servicepro_id','$servicepro_name','You deleted Deal','your deal is deleted','yoho') ");
    return "done";
}else{
return "not done";
}
}
//:::::::::::::::::customerDeleteSendReq
function customerDeleteSendReq($rowid){
  $sql=mysqli_query($this->m,"DELETE FROM requestedresource WHERE ID='$rowid'");
  if($sql){
  return 'done';
}else{
  return 'not done';
}
}
//:::::::::::::::::for forgot operation->emailCheck
function checkEmail($email_check){
  // echo "SELECT email From user WHERE email='$email_check'";
  $sql=mysqli_query($this->m,"SELECT email FROM user WHERE email='$email_check'");
  // echo $sql;
  $vkey=md5(rand().date("Y-m-d"));
  if(mysqli_num_rows($sql)){
    // $email_check1=md5($email_check);
    $to=$email_check;
    $subject='change password confirmation';
    $message="<a href='localhost/mvcpro/route.php?param=PasswordReset&email=$email_check'>Cick to Reset PAssword</a>" ;
    $headers="From: nikhilbhatt10798@gmail.com \r\n";
    $headers.="MIME-Version: 1.0"."\r\n";
    $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
    mail($to,$subject,$message,$headers);
  return 'yes';
}else{
  return 'no';
}
}
//:::::::::::::::::for forgot operation->resetPass
function resetPass($cpass,$email){
  // echo "SELECT email From user WHERE email='$email_check'";
  $sql=mysqli_query($this->m,"UPDATE user SET password='$cpass' Where email='$email'");
  // echo $sql;
  if($sql){
  return 'yes';
}else{
  return 'no';
}
}
//:::::::::::::::::::::::::::::::::::::::
}
?>