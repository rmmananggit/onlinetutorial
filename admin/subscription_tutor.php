<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>

<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Subscription</li>
        <li class="breadcrumb-item active">Tutor</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Tutee Subscription
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mode of Payment</th>
                            <th>Reference Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Mode of Payment</th>
                            <th>Reference Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query = "SELECT
                        user_accounts.user_id, 
                        user_accounts.firstname, 
                        user_accounts.lastname, 
                        subscriptions.subscription_type, 
                        subscriptions.`status`, 
                        subscriptions.approved_date, 
                        subscriptions.expiration_date, 
                        subscriptions.reference, 
                        subscriptions.modeofpayment, 
                        subscriptions.receipt, 
                        user_accounts.role
                    FROM
                        user_accounts
                        INNER JOIN
                        subscriptions
                        ON 
                            user_accounts.user_id = subscriptions.user_id
                    WHERE
                        user_accounts.role = 2";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><?= $row['firstname']; ?> <?= $row['lastname']; ?></td>
                                    <td><?= $row['modeofpayment']; ?></td>
                                    <td><?= $row['reference']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td class="text-center">

<div class="btn-group" role="group" aria-label="Basic outlined example">
<a type="button" class="btn btn-outline-primary" href="sub_tutee.php?id=<?=$row['user_id'];?>">View Details</a>
</div></td>                         
                                
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
 include('./includes/footer.php');
 ?>
