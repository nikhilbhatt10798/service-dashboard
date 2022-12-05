
<table class="table"><thead><th>ALL Notification</th></thead>
    <tbody class="col-sm-12"><td>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM notification WHERE customer_id='$user_id'");
        while ($notification = mysqli_fetch_array($query)) {
            $date = $notification['datetime'];
            $message = $notification['msg_to_customer'];

            $Noti = '<a class="dropdown-item d-flex align-items-center" href="route.php?param=customerSeeAprovedDeals">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-sm-12 small text-gray-500">' . $date . '</div>
                                            <span class="col-sm-12 font-weight-bold">' . $message . '</span>
                                        </div>
                                    </a><br>';
            echo $Noti;
        }
        ?>
        </td>
    </tbody>
</table>
