
<div class="col-lg-12">
    <div class="heading">
        <h3>All Aproved Deals</h3>
    </div>
    <div class="table">
        <table class="table" id="allAprovedDataTable">
            <thead>
                <th scope="col" style="display: none;">id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No.</th>
                <th scope="col">Price / Resource(in RS)</th>
                <th scope="col">Request Resource</th>
                <th scope="col">Total</th>
                <th scope="col">On Date</th>
                <th scope="col">Aproved</th>
                

            </thead>
            <tbody> <?php

                    $Sql = mysqli_query($conn, "SELECT * FROM reply WHERE  customer_name='$user_name' AND status=1");
                    while ($row = mysqli_fetch_array($Sql)) {
                    ?>
                    <tr>
                        <td style="display: none;"><?php $id = $row['id']; ?></td>
                        <td><?= $row['servicepro_name']; ?></td>
                        <td><?= $row['servicepro_email']; ?></td>
                        <td><?= $row['servicepro_phone']; ?></td>
                        <td><?= $row['servicepro_rateOfOne']; ?></td>
                        <td><?= $row['customer_requirment']; ?></td>
                        <td><?= $row['servicepro_totalCost']; ?></td>
                        <td><?= $row['customer_req_oneDate']; ?></td>
                        <td style="text-align: center;color:#4e73df;"><i class="fa fa-check" aria-hidden="true"></i></td>
                        <!-- <td><button type="button" onclick="document.location='customerDeleteDeal.php?rowid=<?php echo $id; ?>&servicepro_email=<?= $row['servicepro_email']; ?>&servicepro_name=<?= $row['servicepro_name']; ?>'" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



