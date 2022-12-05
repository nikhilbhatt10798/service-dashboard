<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 98%!important;
    HEIGHT: 25EM!important;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: .3rem;
    outline: 0;
}
#replyModel1{
    position: relative;
    bottom:15em;
}
    </style>

<div class="row">

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12" id="resource_requests" >
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"> Resource Request</h6>

        </div>
        <!-- Card Body -->
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM requestedresource");


        ?>
        <div class="card-body" id='Add-res-form-div'>
            <div class="chart-area">
                <!--                                        <canvas id="myAreaChart"></canvas>-->
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Resource Required</th>
                            <th scope="col">phone No.</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        while ($table = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>

                                <td>
                                    <?php
                                    echo $table['ID'];
                                    ?>
                                </td>
                                <td><?php echo $table['c_name']; ?> </td>
                                <td><?php echo $table['c_email']; ?> </td>
                                <td><?php echo $table['c_required_resource']; ?> </td>
                                <td><?php echo $table['phone']; ?> </td>
                                <td><?php echo $table['address']; ?> </td>
                                <td><?php echo $table['date']; ?> </td>
                                <!--  <td><a class="btn-floating btn-lg btn-default" id="reply_form" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-phone" aria-hidden="true"></i></a></td> -->
                                <!-- <td> <a class="nav-link"  id="reply" data="<?php echo $table['ID']; ?>"><i class="fa fa-phone"></i></a></td> -->
                                <td><button type="button" onclick="getvalue(<?php echo $table['ID']; ?>)" class="btn btn-primary" name="update" data-toggle="modal" data-target="#reply_form<?php echo $table['ID']; ?>">
                                        <i class="fa fa-phone"></i></button>
                                </td>
                            </tr>
                            <!--::::::::::::::::: reply form modal ::::::::::::::::::::::::-->

<!-- <div class="modal inmodal" id="reply_form" tabindex="-1" role="dialog" aria-hidden="true"> -->
<div class="modal fade" id="reply_form<?php echo $table['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content animated bounceInRight">
    <div class="modal-header">
        <h3 id="reply" class="modalHeadText"> Reply </h3>
    </div>
    <div class="modal-body-modal" id="reply_modal_body">
        <form id="modelReplyForm" name="modalReplyForm" method="POST" action="route.php?param=modelReply">
                <!-- <h5>Customer details</h5> -->
                <!-- <lable for="id">id     -->
                <!-- :   <span id="modaCustomerId"><?php echo $table['ID']; ?></span></lable><br> -->
                <input type="hidden" id="id" name="cid" value="<?php echo $table['ID']; ?>" readonly="readonly"><br>
                <!-- <lable for="name">name -->

                    <input type="hidden" id="name" name="name" placeholder="Enter your Name" value="<?php echo $table['c_name']; ?>" readonly><br>
                    <!-- <lable for="email">email -->

                        <input type="hidden" id="email" name="email" placeholder="Enter your Email" value="<?php echo $table['c_email']; ?>" readonly><br>

                        <!-- <lable for="required-resource">Resource Required -->

                            <input type="hidden" id="r-resource" name="r-resource" placeholder="Enter required resource" value="<?php echo $table['c_required_resource']; ?>" readonly><br>

                            <!-- <lable for="Location">Location -->

                                <input type="hidden" id="address" name="location" placeholder="Enter Address" value="<?php echo $table['address']; ?>" readonly><br>

                                <!-- <lable for="Date">Date -->

                                    <input type="hidden" id="date" name="date" placeholder="Enter date" value="<?php echo $table['date']; ?>" readonly>
                                    <br>

                                    <!-- <lable for="Phone">Phone -->
                                        <!-- :   <span id="modaCustomerDate"><?php echo $table['date']; ?></span></lable><br> -->
                                        <input type="hidden" id="Phone" name="phone" placeholder="Enter phone No." value="<?php echo $table['phone']; ?>" readonly><br>

          
           <br> <div ID="replyModel1">
                <!-- <h5>your details</h5> -->
                <!-- <lable for="serviceProId">id </lable> -->
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" readonly><br>

                <!-- <lable for="serviceProName"> Name </lable> -->
                <input type="hidden" id="modaCustomerDate" name="serviceProName" value="<?php echo $_SESSION['name']; ?>" readonly><br>
                
                <!-- <lable for="serviceProEmail">Email </lable> -->
                <input type="hidden" name="serviceProEmail" id="modaCustomerDate" value="<?php echo $_SESSION['email']; ?>" readonly><br>
                
                <!-- <lable for="ResourceRate">Rate of one resource</lable> -->
                <input type="text" id="resRatee" name="resRate" autocomplete="off"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                 placeholder="Enter Rate" onkeyup="totall(this.value,'<?= $table['ID']; ?>')" value="" required><br>
                <lable for="noOfRes">no of resource </lable>
                <input type="text" id="noOfRes<?= $table['ID']; ?>" value=""><br>
                <!-- <div id="noOfRes"></div> -->
                <lable for="total">Total ( in Rs )</lable><input type="text" id="total_cost<?= $table['ID']; ?>" 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                name="total_cost" placeholder="total amount" required><br>
           
            <input type="submit" id="submit_reply" name="Submit">
            <!-- <input type="submit" id="submit_reply" onclick="showAToast()" name="Submit"> -->
</div>
        </form>

    </div>

</div>
</div>
</div>

<!--::::::::::::::::::::: reply form modal end ::::::::::::::::::::::-->
                        <?php
                        }
                        ?>
                    </tbody>



                </table>

            </div>
        </div>
    </div>
</div>


</div>

<!-- Content Row -->




<script>
  
    function getvalue(id) {
        // var id= id;
        console.log(id);
        $.ajax({
            method: 'POST',
            url: 'route.php?param=data4Reply',
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

