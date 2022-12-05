<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<style>
    select.select {
    position: relative!important;
    width: auto!important;
  
}
    input.EditProfile {
    width: fit-content!important;
}

    .img img {
        object-fit: cover;
        height: 10em;
        position: relative;
        left: 6rem;
        width: 10em;
    }

    h2.profile {
        position: relative;
        left: 5rem;
        color: black;
    }

    button#addpic {
        position: absolute;
        left: 235px;
        top: 134px;
    }
</style>

<?php
$profile = mysqli_query($conn, "SELECT * FROM user WHERE ID='$user_id'");
while ($row = mysqli_fetch_array($profile)) {
    $profile_pic = $row['image'];
    //  echo $profile_pic;

?>
    <div class="col-lg-12">
        <h2 class="profile">Profile</h2>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="img">
                <img src="<?php echo $profile_pic; ?>" id=img alt="profile image">
                <button id="addpic" class="btn btn" onclick="addPiccc()"><i class="fas fa-camera"></i></button>

            </div>
            <input type="file" id="files" name="file" oninput="myFunction()" style="display: none;">
            <!-- <p id="demo"></p> -->

            <script>
                function addPiccc() {
                    $('#files').click();
                    // document.getElementById(files).click();
                }

                function myFunction() {
                    var x = document.getElementById("files").value;
                    // document.getElementById("demo").innerHTML = "You wrote: " + x;
                    // var files = $('#files')[0].files;
                    //   var n = files.length;
                    //   console.log(n);
                    // console.log(files);
                    var fd = new FormData();
                    var files = $('#files')[0].files;
                    console.log(files);

                    // Check file selected or not
                    if (files.length > 0) {
                        fd.append('file', files[0]);
                        console.log(fd);
                        $.ajax({
                            type: 'post',
                            url: 'route.php?param=editUserProfile',
                            data: fd,
                            contentType: false,
                            processData: false,
                            // success: function(resultData) {

                            //     alert(resultData);
                            // }
                            success: function(response) {
                    var x = document.getElementById("snackbar");
                                if (response != 0) {
                                    $("#img").attr("src", response);
                                    document.getElementById("snackbar").innerHTML = "Pofile Pic Change Successfully";
                                    x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000)
                                    // $(".preview img").show(); // Display image element
                                } else {
                                    alert('file not uploaded');
                                }
                            }
                        });
                    }
                }
            </script>
        </div>
        <div class="col-sm-8">
            <h4>
                <div id="username" style="display: block;"><?php echo ucwords($row['name']); ?>
                    <button class="btn" onclick="username()" id="user_name"><i class="fas fa-edit fa-xs"></i></button>
                </div>
                <div id="editName" style="display: none;">
                    <input type="text" class="EditProfile" id="username_input" value="<?php echo ucwords($row['name']); ?>">
                    <button class="btn btn-success" onclick="newusername()"><i class="fas fa-check-circle"></i></button>
                </div>
            </h4>
            <script>
                // :::::::::::::::::::: for update username :::::::::::::::::::::::::::::::

                var a = document.getElementById('username');
                var b = document.getElementById('editName');

                function username() {

                    if (a.style.display == "block") {
                        a.style.display = "none";
                    } else {
                        a.style.display = "block";
                    }

                    if (b.style.display == "none") {
                        b.style.display = "block";
                    } else {
                        b.style.display = "none";
                    }
                }

                function newusername() {
                    var editName = document.getElementById("username_input").value;
                    // alert(editName);
                    $.ajax({
                        type: 'post',
                        url: 'route.php?param=editUserProfile',
                        data: {
                            name: editName
                        },
                        // dataType:json,
                        success: function(data) {
                    var x = document.getElementById("snackbar");
                            // alert(data);
                            data = data + ' <button class="btn" onclick="username()" id="user_name"><i class="fas fa-edit fa-xs"></i></button>';
                            $("#username").html(data);
                            document.getElementById("snackbar").innerHTML = "User Name Change Successfully";
                            x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000)
                        }

                    })
                    if (a.style.display == "none") {
                        a.style.display = "block";
                    } else {
                        a.style.display = "block";
                    }

                    if (b.style.display == "block") {
                        b.style.display = "none";
                    } else {
                        b.style.display = "none";
                    }

                }


                // :::::::::::::::::::: for update email :::::::::::::::::::::::::::::::




                // function email() {
                //     var td_email = document.getElementById('email');
                //     if (td_email.style.display == "block") {
                //         td_email.style.display = "none";
                //     } else {
                //         td_email.style.display = "block";
                //     }
                //     var td_editEmail = document.getElementById('editEmail');
                //     if (td_editEmail.style.display == "none") {
                //         td_editEmail.style.display = "block";
                //     } else {
                //         td_editEmail.style.display = "none";
                //     }
                // }

                // function newuseremail() {
                //     var td_email = document.getElementById('email');
                //     var td_editEmail = document.getElementById('editEmail');
                //     var editEmail = document.getElementById("user_email_input").value;
                //     // alert(editName);
                //     $.ajax({
                //         type: 'post',
                //         url: 'route.php?param=editUserProfile',
                //         data: {
                //             email: editEmail
                //         },
                //         // dataType:json,
                //         success: function(data) {
                //             // alert(data);
                //             data = data + '<button class="btn" onclick="email()" id="user_name"><i class="fas fa-edit fa-xs"></i></button>';
                //             $("#email").html(data);
                //         }
                //     });
                //     if (td_email.style.display == "none") {
                //         td_email.style.display = "block";
                //     } else {
                //         td_email.style.display = "none";
                //     }
                //     if (td_editEmail.style.display == "block") {
                //         td_editEmail.style.display = "none";
                //     } else {
                //         td_editEmail.style.display = "block";
                //     }
                // }

                // :::::::::::::::::::::::: for update phone number ::::::::::::::::::::::::::::::::::
                function phone() {
                    var td_phone = document.getElementById('phone');
                    if (td_phone.style.display == "block") {
                        td_phone.style.display = "none";
                    } else {
                        td_phone.style.display = "block";
                    }
                    var td_editPhone = document.getElementById('editPhone');
                    if (td_editPhone.style.display == "none") {
                        td_editPhone.style.display = "block";
                    } else {
                        td_editPhone.style.display = "none";
                    }
                }

                function newUserPhone() {
                    var td_phone = document.getElementById('phone');
                    var td_editPhone = document.getElementById('editPhone');
                    var editPhone = document.getElementById("user_phone_input").value;
                    // alert(editName);
                    $.ajax({
                        type: 'post',
                        url: 'route.php?param=editUserProfile',
                        data: {
                            phone: editPhone
                        },
                        // dataType:json,
                        success: function(data) {
                            // alert(data);
                            data = data + ' <button class="btn" onclick="phone()" id="user_name"><i class="fas fa-edit fa-xs"></i></button>';
                            $("#phone").html(data);
                            var x = document.getElementById("snackbar");
                            document.getElementById("snackbar").innerHTML = "Phone Number Change Successfully";
                                    x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000); 
                        }
                    });
                    if (td_phone.style.display == "none") {
                        td_phone.style.display = "block";
                    } else {
                        td_phone.style.display = "none";
                    }
                    if (td_editPhone.style.display == "block") {
                        td_editPhone.style.display = "none";
                    } else {
                        td_editPhone.style.display = "block";
                    }
                }

                // :::::::::::::::::::::::: update user type ::::::::::::::::::::::::::::

                // function userType(){
                //     var td_userType = document.getElementById('userType');
                //     if(td_userType.style.display=="block"){
                //         td_userType.style.display="none";
                //     }else{
                //         td_userType.style.display="block";
                //     }
                //     var td_edit_userType = document.getElementById('edit_userType');
                //     if(td_edit_userType.style.display=="none"){
                //         td_edit_userType.style.display="block";  
                //     }else{
                //         td_edit_userType.style.display="none"; 
                //     }
                // }
                // function newUserType(){
                //     var editUserType = document.getElementById("User_type_select").value;
                //     var td_userType = document.getElementById('userType');
                //     var td_edit_userType = document.getElementById('edit_userType');
                //     $.ajax({
                //         type: 'post',
                //         url: 'route.php?param=editUserProfile',
                //         data: {
                //             user_type: editUserType
                //         },
                //         // dataType:json,
                //         success: function(data) {
                //             // alert(data);
                //             data = data + '<button class="btn" onclick="userType()" ><i class="fas fa-edit fa-xs"></i></button>';
                //             $("#userType").html(data);
                //         }
                //     });
                //     if(td_userType.style.display=="none"){
                //         td_userType.style.display="block";
                //     }else{
                //         td_userType.style.display="none";
                //     }
                //     if(td_edit_userType.style.display=="block"){
                //         td_edit_userType.style.display="none";  
                //     }else{
                //         td_edit_userType.style.display="block"; 
                //     }
                // }


                // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


                function totalResource(){
                    var edit_totalresource=document.getElementById('total_resource_select');
                    var td_total_resource=document.getElementById('total_resource');
                    if(td_total_resource.style.display=="block"){
                        td_total_resource.style.display="none";
                    }else{
                        td_total_resource.style.display="block";
                    }
                   var td_edit_totalresource=document.getElementById('edit_totalresource');
                   if(td_edit_totalresource.style.display=="none"){
                    td_edit_totalresource.style.display="block";
                   }else{
                    td_edit_totalresource.style.display="none";
                   }
                }
               function newTotalResource(){
                var edit_totalresource=document.getElementById('total_resource_select').value;
                var td_total_resource=document.getElementById('total_resource');
                var td_edit_totalresource=document.getElementById('edit_totalresource');
                $.ajax({
                        type: 'post',
                        url: 'route.php?param=editUserProfile',
                        data: {
                            total_resource: edit_totalresource
                        },
                        // dataType:json,
                        success: function(data) {
                            // alert(data);
                            data = data + '<button class="btn" onclick="totalResource()"><i class="fas fa-edit fa-xs"></i></button>';
                            $("#total_resource").html(data);
                            var x = document.getElementById("snackbar");
                            document.getElementById("snackbar").innerHTML = "Total Resource Change Successfully";
                                    x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000); 
                        }
                    });
                    if(td_total_resource.style.display=="none"){
                        td_total_resource.style.display="block";
                    }else{
                        td_total_resource.style.display="none";
                    }
                    if(td_edit_totalresource.style.display=="block"){
                    td_edit_totalresource.style.display="none";
                   }else{
                    td_edit_totalresource.style.display="block";
                   }
               }
            </script>
    <div id="snackbar"></div>
           <div class="table">
                <table>
                    <tbody>
                        <tr>
                            <td> email</td>
                            <td id=email style="display: block;"> <?php echo $row['email']; ?>
                                <!-- <button class="btn" onclick="email()" id="user_name"><i class="fas fa-edit fa-xs"></i></button> -->
                            </td>
                            <td id=editEmail style="display: none;">
                                <input type="text" class="EditProfile" id="user_email_input" value="<?php echo $row['email']; ?>">
                                <button class="btn btn-success" onclick="newuseremail()"><i class="fas fa-check-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td> phone</td>
                            <td id="phone" style="display:block;"> <?php echo $row['phone']; ?>
                                <button class="btn" onclick="phone()" ><i class="fas fa-edit fa-xs"></i></button>
                            </td>
                            <td id=editPhone style="display: none;">
                                <input type="text" class="EditProfile" id="user_phone_input" pattern="[0-9]{10}" title="Enter 10 digit no." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $row['phone']; ?>">
                                <button class="btn btn-success" onclick="newUserPhone()"><i class="fas fa-check-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td> user_type</td>
                            <td id="userType" style="display:block"> <?php echo $row['user_type']; ?>
                                <!-- <button class="btn" onclick="userType()" ><i class="fas fa-edit fa-xs"></i></button> -->
                            </td>
                            <td id="edit_userType" style="display: none;">
                                <select class="select" name="userType" id="User_type_select">
                                    <option value="service_provider">service_provider</option>
                                    <option value="customer">customer</option>
                                </select>
                                <button class="btn btn-success" onclick="newUserType()"><i class="fas fa-check-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td> Total Resource</td>
                            <td id="total_resource" style="display: block;"> <?php echo $row['total_resource']; ?>
                                <button class="btn" onclick="totalResource()"><i class="fas fa-edit fa-xs"></i></button>
                            </td>
                            <td id="edit_totalresource" style="display: none;">
                            <select class="select" name="totalresource" id="total_resource_select">
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                    <option value="600">600</option>
                                    <option value="700">700</option>
                                    <option value="800">800</option>
                                    <option value="900">900</option>
                                    <option value="1000">1000</option>
                                </select>
                                <button class="btn btn-success" onclick="newTotalResource()"><i class="fas fa-check-circle"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- <button class="btn btn-secondary" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button> -->
            </div>
        </div>
    </div>
    <!-- ::::::::::::::::::       edit profile modal     ::::::::::::::::: -->
    <!-- <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <h5>
                            Add image </h5> <input type="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- :::::::::::::::::::::::::: edit profile modal end :::::::::::: -->

<?php } ?>
