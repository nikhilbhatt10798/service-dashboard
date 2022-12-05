<div id="snackbar"></div>
<div class="col-lg-12">
    <div class="heading">
        <h3>Deals</h3>
    </div>
    <div class="table">
        <table class="table" id="dealsTable">
            <thead>
            <th scope="col" style="display:none;">id</th>
                <th scope="col"style="display:none;">ServicePro_id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No.</th>
                <th scope="col">Price / Resource(in RS)</th>
                <th scope="col">Request Resource</th>
                <th scope="col">Total</th>
                <th scope="col">On Date</th>
                <th scope="col">Aproved</th>
                <th scope="col">Delete</th>

            </thead>
            <tbody> <?php

                    $Sql = mysqli_query($conn, "SELECT * FROM reply WHERE  customer_name='$user_name' AND status=0");
                    while ($row = mysqli_fetch_array($Sql)) {
                    ?>
                    <tr id="tr<?php echo $row['id']; ?>">
                        <td style="display: none;"><?php $id = $row['id']; ?></td>
                        <td style="display: none;"><?php $servicepro_id = $row['servicepro_id']; ?></td>
                        <td><?= $row['servicepro_name']; ?></td>
                        <td><?= $row['servicepro_email']; ?></td>
                        <td><?= $row['servicepro_phone']; ?></td>
                        <td><?= $row['servicepro_rateOfOne']; ?></td>
                        <td><?= $row['customer_requirment']; ?></td>
                        <td><?= $row['servicepro_totalCost']; ?></td>
                        <td><?= $row['customer_req_oneDate']; ?></td>
                        <td>
                            <button type="button" 
                            onclick="aproverDeal('<?php echo $id; ?>','<?php echo $servicepro_id; ?>','<?= $row['servicepro_email']; ?>','<?= $row['servicepro_name']; ?>')" 
                        class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                </td>
                        <td>
                            <button type="button" 
                                class="btn btn-danger"
                            onclick="deleteDeal('<?php echo $id; ?>','<?php echo $servicepro_id; ?>','<?= $row['servicepro_email']; ?>','<?= $row['servicepro_name']; ?>')"
                         >
                         <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    //:::::::::::::::::::::: for aprove deal :::::::::::::::::::::::::::::::::::::::::::::::::
    function aproverDeal(rowid,servicepro_id,servicepro_email,servicepro_name){
        var result=confirm("want to aprove");
        if(result){
            $('.loader').show();
        $.ajax({
            type:"post",
            url:"route.php?param=customerAproveDeal",
            data:{rowid:rowid,servicepro_id:servicepro_id,servicepro_email:servicepro_email,servicepro_name:servicepro_name},
            success:function(data){
                if(data=="yes"){
                    var x = document.getElementById("snackbar");
                    $('#tr'+rowid).hide(200);
                    document.getElementById("snackbar").innerHTML = "Deal Aproved"; 
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000); 
                }
            }
        })
    }
    }
    //::::::::::::::::::::::::  for aprove deal :::::::::::::::::::::::;;
    function deleteDeal(rowid,servicepro_id,servicepro_email,servicepro_name){
        var result=confirm("want to delete");
        if(result){
        $.ajax({
            type:"post",
            url:"route.php?param=customerDeleteDeal",
            data:{rowid:rowid,servicepro_id:servicepro_id,servicepro_email:servicepro_email,servicepro_name:servicepro_name},
            success:function(data){
                // alert(data);
                if(data=="yes"){
                    //   alert(data);
                    $('#tr'+rowid).hide(200);
                        var x = document.getElementById("snackbar");
                    document.getElementById("snackbar").innerHTML = "deal deleted"; 
                    $("#snackbar").css("background-image", "linear-gradient(315deg, #EB3349 0%, #F45C43 74%)");
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000); 
                }
            }
        })
    }
    }

    // $(document).ready(function() {
    //             $.ajax({
    //                     url: 'customerDealsAction.php',
    //                     type: 'get',
    //                     dataType: 'JSON',
    //                     success: function(response) {

    //                         $('#dealsTable').dataTable().fnClearTable();

    //                         $('#dealsTable').dataTable().fnDestroy();
    //                         var len = response.length;
    //                         var tr_str='';
    //                         for (var i = 0; i < len; i++) {
    //                             var id = response[i].id;
    //                             var name = response[i].name;
    //                             var email = response[i].email;
    //                             var phone = response[i].phone;
    //                             var price = response[i].price;
    //                             var request_resource = response[i].request_resource;
    //                             var total = response[i].total;
    //                             var date = response[i].date;
    //                             var Aproved = response[i].Aproved;
    //                             var Delete = response[i].Delete;
    //                                  tr_str =tr_str+ "<tr>" +
    //                                 "<td align='center' style="+"display:none"+" >" + id + "</td>" +
    //                                 "<td align='center'>" + name + "</td>" +
    //                                 "<td align='center'>" + email + "</td>" +
    //                                 "<td align='center'>" + phone + "</td>" +
    //                                 "<td align='center'>" + price + "</td>" +
    //                                 "<td align='center'>" + request_resource + "</td>" +
    //                                 "<td align='center'>" + total + "</td>" +
    //                                 "<td align='center'>" + date + "</td>" +
    //                                 "<td align='center'>" + Aproved + "</td>" +
    //                                 "<td align='center'>" + Delete + "</td>" +
    //                                 "</tr>";
    //                         }
    //                         // $("#dealsTable tbody").append(tr_str);
    //                         $("#yo").append(tr_str);
    //                         $('#dealsTable').DataTable( {
    //                     paging: false,
    //                     scrollY: 400
    //                 });
    //                     }
    //                     });
    //             });

    //             function deleteDeal(){
    //      alert('delete');
    //  }
    //  function aprovedDeal(){
    //      alert('aproved');

    //  }
</script>

