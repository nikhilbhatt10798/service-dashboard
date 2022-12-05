<style>
    select.select {
        position: relative !important;
        width: auto !important;

    }

    input.EditProfile {
        width: fit-content !important;
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
    if (empty($profile_pic)) {
        $profile_pic = "images/img-01";
    }

    //  echo $profile_pic;

?>
    <div id="snackbar"></div>
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
                                if (response != 0) {
                    var x = document.getElementById("snackbar");
                                    $("#img").attr("src", response).show("fast");
                                    document.getElementById("snackbar").innerHTML = "Pofile Pic Change Successfully";
                                    x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000);
                                    // $(".preview img").show(); // Display image element
                                } else {
                    var x = document.getElementById("snackbar");
                    
                                }
                            }
                        });
                    }
                }
            </script>
            <script>
                // :::::::::::::::::::: for update username :::::::::::::::::::::::::::::::



                function username() {
                    var a = document.getElementById('username');
                    var b = document.getElementById('editName');
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
                    var a = document.getElementById('username');
                    var b = document.getElementById('editName');
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
                                    }, 3000);
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
                //     // document.getElementById('bouncing_loader').style.display="block";
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
                //             // document.getElementById('bouncing_loader').style.display="none";
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
                    var pattern = /^\d{10}$/;
                    // alert(editName);
                    if(editPhone.match(pattern)){
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
                    });   }else{
                        var x = document.getElementById("snackbar");
                            document.getElementById("snackbar").innerHTML = "Enter 10 digit no.";
                                    $("#snackbar").css("background-image", "linear-gradient(315deg, #EB3349 0%, #F45C43 74%)");
                                    x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000); 
                    }

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

                // function userType() {
                //     var td_userType = document.getElementById('userType');
                //     if (td_userType.style.display == "block") {
                //         td_userType.style.display = "none";
                //     } else {
                //         td_userType.style.display = "block";
                //     }
                //     var td_edit_userType = document.getElementById('edit_userType');
                //     if (td_edit_userType.style.display == "none") {
                //         td_edit_userType.style.display = "block";
                //     } else {
                //         td_edit_userType.style.display = "none";
                //     }
                // }

                // function newUserType() {
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
                //     if (td_userType.style.display == "none") {
                //         td_userType.style.display = "block";
                //     } else {
                //         td_userType.style.display = "none";
                //     }
                //     if (td_edit_userType.style.display == "block") {
                //         td_edit_userType.style.display = "none";
                //     } else {
                //         td_edit_userType.style.display = "block";
                //     }
                // }


 // ::::::::::::::::::::::::::::  required resource  ::::::::::::::::::::::::::::::::::::::


 function required_resource() {
                    var edit_requiredresource = document.getElementById('required_resource_select');
                    var td_required_resource = document.getElementById('required_resource');
                    if (td_required_resource.style.display == "block") {
                        td_required_resource.style.display = "none";
                    } else {
                        td_required_resource.style.display = "block";
                    }
                    var td_edit_requiredresource = document.getElementById('edit_requiredresource');
                    if (td_edit_requiredresource.style.display == "none") {
                        td_edit_requiredresource.style.display = "block";
                    } else {
                        td_edit_requiredresource.style.display = "none";
                    }
                }

                function newRequiredResource() {
                    var edit_requiredresource = document.getElementById('required_resource_select').value;
                    var td_required_resource = document.getElementById('required_resource');
                    var td_edit_requiredresource = document.getElementById('edit_requiredresource');
                    $.ajax({
                        type: 'post',
                        url: 'route.php?param=editUserProfile',
                        data: {
                            required_resource: edit_requiredresource
                        },
                        // dataType:json,
                        success: function(data) {
                            // alert(data);
                            data = data + '<button class="btn" onclick="required_resource()"><i class="fas fa-edit fa-xs"></i></button>';
                            $("#required_resource").html(data);
                    var x = document.getElementById("snackbar");
                            document.getElementById("snackbar").innerHTML = "Required Resource Change Successfully";
                                    x.className = "show";
                                    setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                    }, 3000); 
                        }
                    });
                    if (td_required_resource.style.display == "none") {
                        td_required_resource.style.display = "block";
                    } else {
                        td_required_resource.style.display = "none";
                    }
                    if (td_edit_requiredresource.style.display == "block") {
                        td_edit_requiredresource.style.display = "none";
                    } else {
                        td_edit_requiredresource.style.display = "block";
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
                                <button class="btn" onclick="phone()"><i class="fas fa-edit fa-xs"></i></button>
                            </td>
                            <td id=editPhone style="display: none;">
                                <input type="text" class="EditProfile" id="user_phone_input" pattern="[0-9]{10}"
                                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $row['phone']; ?>">
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
                            <td> Required Resource</td>
                            <td id="required_resource" style="display: block;"> <?php echo $row['required_resource']; ?>
                                <button class="btn" onclick="required_resource()"><i class="fas fa-edit fa-xs"></i></button>
                            </td>
                            <td id="edit_requiredresource" style="display: none;">
                                <select class="select" name="requiredresource" id="required_resource_select">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="70">70</option>
                                    <option value="80">80</option>
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                </select>
                                <button class="btn btn-success" onclick="newRequiredResource()"><i class="fas fa-check-circle"></i></button>
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