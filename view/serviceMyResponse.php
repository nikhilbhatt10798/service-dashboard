
<!-- End of Topbar -->

<!-- Begin Page Content -->

<div class="col-sm-12">
<div class="table-heading">
    <h3 style="align-content: center;"> My Response </h3></div>
    <div class="myResponseData">
    <table class="table" id="myResponse">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">id</th> -->
                                    <!-- <th scope="col">customer_id</th> -->
                                    <th scope="col">customer_name</th>
                                    <th scope="col">customer_email</th>
                                    <th scope="col">requirment</th>
                                    <th scope="col">location</th>
                                    <th scope="col">customer_phone</th>
                                    <th scope="col">On Date</th>
                                    <!-- <th scope="col">servicepro_id</th> -->
                                    <!-- <th scope="col">servicepro_name</th> -->
                                    <!-- <th scope="col">servicepro_email</th> -->
                                    <!-- <th scope="col">servicepro_rateOfOne</th> -->
                                    <!-- <th scope="col">servicepro_phone</th> -->
                                    <th scope="col">total Cost</th>
                                    <th scope="col">status</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 
  
  $Sql =mysqli_query($conn, "SELECT * FROM reply WHERE servicepro_id='$user_id' AND servicepro_name='$user_name'");
    while($row= mysqli_fetch_array($Sql)){
?>
<tr>
    <td><?= $row['customer_name']?></td>
    <td><?= $row['customer_email']?></td>
    <td><?= $row['customer_requirment']?></td>
    <td><?= $row['customer_location']?></td>
    <td><?= $row['customer_phone']?></td>
    <td><?= $row['customer_req_oneDate']?></td>
    <td><?= $row['servicepro_totalCost']?></td>
    <td><?php if( $row['status']==0){
        echo "not aproved";}
        else{
        echo"aproved";}?></td>
 
</tr>
    <?php } ?>


                            </tbody>
    </table>
    </div>
</div>


<script src="js-toast-master/toast.js"></script>

<script>
  
    function getvalue(id) {
        // var id= id;
        console.log(id);
        $.ajax({
            method: 'POST',
            url: 'data4Reply.php',
            data: {
                id: id
            },
            datatype: 'json',
            success: function(htmll) {
                console.log(htmll);
                // getAlldata();
                //   $('#add').val('data sent sent');
                //   document.getElementById('noOfRes').setAttribute('value',htmll);
                $('#noOfRes' + id).val(htmll);
            }
        });
    };

    function totall(val, id) {
        // var a=document.getElementById("resRatee").value;
        // console.log(val);
        var b = document.getElementById("noOfRes" + id).value;
        console.log(b);
        var c = val * b;
        console.log(c);
        document.getElementById("total_cost" + id).value = c;
        b = null;
        // document.getElementById("total_cost").innerHTML= c;
    };
    function showAToast() {
	iqwerty.toast.toast('Hello!');
}
</script>
