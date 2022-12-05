<?php
include "conn/connection.php";
session_start();
$user_id =  $_SESSION['id'];

$user_name =  $_SESSION['name'];
// $image=$_POST['check'];
// echo $image;
// if(isset($_FILES['file']['name'])){



//**************************    for change profile picture     ***************************  */


if (!empty($_FILES['file']['name'])) {
    /* Getting file name */
    $filename = $_FILES['file']['name'];
    //  echo $filename;
    /* Location */
    $location = "images/" . $filename;
    // echo $location;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    // echo $imageFileType;
    $imageFileType = strtolower($imageFileType);
    // echo $imageFileType;
    // /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png");
    //   print_r($valid_extensions);
    $response = 0;
    // /* Check file extension */
    if (in_array($imageFileType, $valid_extensions)) {
        //    /* Upload file */
        $a =  move_uploaded_file($_FILES['file']['tmp_name'], $location);
        if ($a) {
            $response = $location;
            //   echo "done";

            $sql = mysqli_query($conn, "UPDATE user SET image ='$response' where ID='$user_id'");
        }
    }

    echo $response;
    // exit;
} 
//***********************      update name           ********************* */
elseif (!empty($_POST['name'])) {
    $name = $_POST['name'];
    // echo $name;
    // echo $name."yo ho hi gya";
    $sql = mysqli_query($conn, "UPDATE user SET name='$name' where ID='$user_id'");
    if($sql){
        // echo "done";
        $sql1 = mysqli_query($conn, "SELECT name FROM user where ID='$user_id'");
        while($name=mysqli_fetch_array($sql1)){
            echo $name['name'];
        }
       
    }
    else{
        echo"no done";
    }
}



//**************************    for change email     ***************************  */


    elseif (!empty($_POST['email'])) {
        $email = $_POST['email'];
        // echo $name."yo ho hi gya";
        $sql = mysqli_query($conn, "UPDATE user SET email='$email' where ID='$user_id'");
        if($sql){
            // echo "done";
            $sql1 = mysqli_query($conn, "SELECT email FROM user where ID='$user_id'");
            while($email=mysqli_fetch_array($sql1)){
                echo $email['email'];
            }
           
        }
        else{
            // echo"no done";
        }
    
}


//**************************    for change phone Number     ***************************  */


elseif (!empty($_POST['phone'])) {
    $phone = $_POST['phone'];
    // echo $name."yo ho hi gya";
    $sql = mysqli_query($conn, "UPDATE user SET phone='$phone' where ID='$user_id'");
    if($sql){
        // echo "done";
        $sql1 = mysqli_query($conn, "SELECT phone FROM user where ID='$user_id'");
        while($phone=mysqli_fetch_array($sql1)){
            echo $phone['phone'];
        }
       
    }
    else{
        // echo"no done";
    }

}

//**************************    for change user type    ***************************  */

elseif (!empty($_POST['user_type'])) {
    $user_type = $_POST['user_type'];
    // echo $name."yo ho hi gya";
    $sql = mysqli_query($conn, "UPDATE user SET user_type='$user_type' where ID='$user_id'");
    if($sql){
        // echo "done";
        $sql1 = mysqli_query($conn, "SELECT user_type FROM user where ID='$user_id'");
        while($usertype=mysqli_fetch_array($sql1)){
            echo $usertype['user_type'];
        }
       
    }
    else{
        // echo"no done";
    }

}

//**************************    for change total Resorce   ***************************  */



elseif (!empty($_POST['total_resource'])) {
    $total_resource = $_POST['total_resource'];
    // echo $name."yo ho hi gya";
    $sql = mysqli_query($conn, "UPDATE user SET total_resource='$total_resource' where ID='$user_id'");
    if($sql){
        // echo "done";
        $sql1 = mysqli_query($conn, "SELECT total_resource FROM user where ID='$user_id'");
        while($totalresource=mysqli_fetch_array($sql1)){
            echo $totalresource['total_resource'];
        }
       
    }
    else{
        // echo"no done";
    }

}

//**************************    for change Required Resorce   ***************************  */



elseif (!empty($_POST['required_resource'])) {
    $required_resource = $_POST['required_resource'];
    // echo $name."yo ho hi gya";
    $sql = mysqli_query($conn, "UPDATE user SET required_resource='$required_resource' where ID='$user_id'");
    if($sql){
        // echo "done";
        $sql1 = mysqli_query($conn, "SELECT required_resource FROM user where ID='$user_id'");
        while($requiredresource=mysqli_fetch_array($sql1)){
            echo $requiredresource['required_resource'];
        }
       
    }
    else{
        // echo"no done";
    }

}

// :::::::::::::::::::::::::::::::: update password :::::::::::::::::::::::::::::::::::::::


 elseif(!empty($_POST['oldPass'])){
     $oldpass=$_POST['oldPass'];
     $newPass=$_POST['newPass'];
     $confirmPass=$_POST['confirmPass'];
    //  echo $oldpass;
     $query=mysqli_query($conn,"SELECT * FROM user where id=$user_id");
        while($row=mysqli_fetch_array($query)){
            $password=$row['password'];
        }
        if($oldpass!=$password){
            echo "<h5 style='color:red;'>** password incorrect **</h5>";
        }
        elseif( $newPass!=$confirmPass){
            echo "<h5 style='color:red;'>**New password and Confirm password NOT matching **</h5>";
        }
        else{
            $sql = mysqli_query($conn, "UPDATE user SET password='$confirmPass' where ID='$user_id'");
            echo "<h5 style='color:green;'>password update</h5>";
        }
 }
 //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
