<script src="js/md5.js"></script>
<style>
    input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
    table#password {
    position: relative;
    left: 11rem;
}
    </style>
<div class="row">
    <div class="col-sm-6">
        <!-- <form method="POST" action="editUserProfile.php"> -->
        <table id="password" style="text-align: center;">
            <tr>
                
                <td>
                    <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password"   required>
                </td>
            </tr>
            <tr>
               <td>
                    <input type="text" id="newPassword" name="newPassword" placeholder="New Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </td>
            </tr>
            <tr>
               <td>
                    <input type="text" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password"
                     pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                     onchange="checkNewPass()" required>
                </td>
            </tr>
            <tr>
                <td>
                <button class="btn btn-primary" onclick="checkOldPassword()">change Password </button>
                </td>
            </tr>
        </table>
        <p id=result></p>
        <!-- </form>   -->
       
        <?php
        // $query=mysqli_query($conn,"SELECT * FROM user where id=$user_id");
        // while($row=mysqli_fetch_array($query)){
        //     $password=$row['password'];
        // }
        ?>
        <!-- <input type="hidden" id="getpassword" value='<?php echo $password;?>'> -->
        <script>
           function checkOldPassword(){
               var old_pass=calcMD5(document.getElementById('oldPassword').value);
               var new_pass=calcMD5(document.getElementById('newPassword').value);
               var confirm_pass=calcMD5(document.getElementById('confirmPassword').value);
               
               $.ajax({
                   type:"post",
                   url: 'route.php?param=editUserProfile',
                   data:{oldPass:old_pass,newPass:new_pass,confirmPass:confirm_pass},
                   success:function(data){
                           $("#result").html(data);
                           $("#newPassword").val("");
                           $("#oldPassword").val("");
                           $("#confirmPassword").val("");
                    }
               });
           }
        //    function checkNewPass(){
        //        var new_pass=document.getElementById('newPassword').value;
        //        var confirm_pass=document.getElementById('confirmPassword').value;
        //     //    console.log(new_pass);
        //     //    console.log(confirm_pass);
        //        if(new_pass==confirm_pass){
        //         $("#result").html("new password and confirm password is match");
        //         $("#result").css({"color":"green","font-size":"110%"});
        //         }else{
        //             $("#result").html("new password and confirm password Not match");
        //         $("#result").css({"color":"red","font-size":"110%"});
        //        }
        //    }
        //    function update_password(){
        //     var pass=calcMD5(document.getElementById('getpassword'));
        //        var old_pass=calcMD5(document.getElementById('oldPassword'));
        //        var new_pass=document.getElementById('newPassword').value;
        //        var confirm_pass=document.getElementById('confirmPassword').value;
        //        if(pass!=old_pass){
        //         alert('password Not match');
        //         }
        //         if(new_pass!=confirm_pass){
        //         alert('new password and confirm password NOT match');
        //         }
        //        }
              
        </script>
    </div>
    <div class="col-sm-6">
        <!-- <button class="btn btn-primary">change email </button> -->
    </div>
</div>
