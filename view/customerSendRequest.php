<div id="snackbar"></div>
<div class="col-sm-12">
    <div class="table-heading">
        <h3 style="align-content: center;">All Send Requests </h3>
    </div>
    <div class="myResponseData" onload="load()">
        <table class="table" id="sendRequest">
            <thead>
                <tr>
                    <th scope="col" style="display: none;">id</th>
                    <!-- <th scope="col">customer_id</th> -->
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">requirment</th>

                    <th scope="col">phone</th>
                    <th scope="col">location</th>
                    <th scope="col">delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $Sql = mysqli_query($conn, "SELECT * FROM requestedresource WHERE c_id='$user_id'");
                while ($row = mysqli_fetch_array($Sql)) {
                    $rowid = $row['ID'];
                ?>
                    <tr id="tr<?php echo $row['ID'];  ?>">
                        <td style="display: none;"><?= $row['c_name'] ?></td>
                        <td><?= $row['c_name'] ?></td>
                        <td><?= $row['c_email'] ?></td>
                        <td><?= $row['c_required_resource'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><button class="btn btn-danger" onclick="deleteDeal(<?php echo $row['ID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    function deleteDeal(id) {
        var x = document.getElementById("snackbar");
        console.log(id);
        var result = confirm("Want to delete?");
if (result) {
    

        $.ajax({
                type: 'post',
                url: 'route.php?param=customerDeleteSendReq',
                data: {
                    rowid: id
                },
                
                success: function(data) {
                    // $("#").attr("src", response);
                    $('#tr'+id).hide(200);
                    // window.open('route.php?param=customerSendRequest','_self');
                    document.getElementById("snackbar").innerHTML = data; 
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000); 
                }
            });
        }

    }
</script>