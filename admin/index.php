<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>

<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           All Accounts
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        user_accounts.firstname, 
                        user_accounts.lastname, 
                        user_accounts.phone_number, 
                        user_accounts.role, 
                        user_accounts.user_id
                    FROM
                        user_accounts
                    WHERE
                        user_accounts.user_id != '$user_id' ";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><?= $row['firstname']; ?> <?= $row['lastname']; ?></td>
                                    <td><?= $row['phone_number']; ?></td>
                                    <td>
                                    <?php
                                    // Assuming $row['role'] contains the role information (1 or 2)
                                    if ($row['role'] == 1) {
                                        echo 'Tutee';
                                    } elseif ($row['role'] == 2) {
                                        echo 'Tutor';
                                    } else {
                                        // Handle other cases if needed
                                        echo 'Unknown Role';
                                    }
                                    ?>
</td>
                                   
                                    <td class="text-center">

<div class="btn-group" role="group" aria-label="Basic outlined example">
<a type="button" class="btn btn-outline-primary" href="view_details.php?id=<?=$row['user_id'];?>">View Details</a>
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
