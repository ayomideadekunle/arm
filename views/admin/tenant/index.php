<title>Manage Tenants</title>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Tenants</h3>
                    <span class="pull-right">
                        <button class="btn btn-primary" data-target="#new_tenant" data-toggle="modal">
                            Add Tenant
                        </button>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City/State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $tenants = $this->tenants;
                            foreach ($tenants as $tenant) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $tenant['firstname']; ?> </td>
                                    <td><?php echo $tenant['lastname']; ?></td>
                                    <td><?php echo $tenant['email']; ?></td>
                                    <td><?php echo $tenant['phone']; ?></td>
                                    <td><?php echo $tenant['currentAddress']; ?></td>
                                    <td><?php echo $tenant['cityStateZip']; ?></td>
                                    <td>
                                        <button onclick="edit_Tenant('<?php echo $tenant['id']; ?>');" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_Tenant('<?php echo $tenant['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $count++; ?>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

<!-- Add Apartment Modal -->
<div id="new_tenant" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Tenant</h4>
            </div>
            <div class="modal-body">

                <div id="success" class="alert alert-success hidden" role="alert">
                </div>

                <div id="errorMessage" class="alert alert-danger hidden" role="alert">
                </div>

                <form role="form" method="post" action="<?php echo URL ?>landlord/handleCreateTenant" onsubmit="checkPassword(event)">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" placeholder="Enter First Name" name="firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name" name="lastname">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control checkIfExists" placeholder="Enter Email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" placeholder="Enter phone number" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="zipcode">City/State zipcode</label>
                            <input type="text" class="form-control" placeholder="Enter city or state zipcode" name="cityStateZip">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" placeholder="Enter current address" name="currentAddress">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="pass" placeholder="Enter password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" id="cfpass" 
                                   placeholder="Confirm password">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="edit_tenant" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Tenant</h4>
            </div>
            <div class="modal-body" id="loadEditPage">
            </div>
        </div>
    </div>
</div>

<div id="delete_tenant" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Tenant</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-primary delete">Yes</button>
                <button class="btn btn cancel">No</button>
            </div>
        </div>
    </div>
</div>

<?php
require 'script.php';
?>


<script>
    $(function () {
        $("#data_table").DataTable();
    });
</script>