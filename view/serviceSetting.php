
<script src="js/md5.js"></script>
 
<style>
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
                        <input type="text" id="oldPassword" name="oldPassword" placeholder="Old Password" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="newPassword" name="newPassword" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-primary" onclick="checkOldPassword()">change Password </button>
                    </td>
                </tr>
            </table>
            <p id=result></p>
        <!-- </form> -->
        <script>
    function checkOldPassword() {

        var old_pass = calcMD5(document.getElementById('oldPassword').value);
        var new_pass = calcMD5(document.getElementById('newPassword').value);
        var confirm_pass = calcMD5(document.getElementById('confirmPassword').value);
        $.ajax({
            type: "post",
            url: 'route.php?param=editUserProfile',
            data: {oldPass: old_pass,newPass: new_pass,confirmPass: confirm_pass},
            success: function(data) {
                $("#result").html(data);
                $("#newPassword").val("");
                $("#oldPassword").val("");
                $("#confirmPassword").val("");
            }
        });
    }
</script>

    </div>
    
</div>

