<title>Manage Contracts</title>

<?php
$l_mod = new Landlord_Model();
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lease Contracts</h3>
                    <span class="pull-right">
                        <button class="btn btn-primary" data-target="#new_apartment" data-toggle="modal">
                            Add Lease Contract
                        </button>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tenant</th>
                                <th>Building</th>
                                <th>Apartment Number</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Balance</th>
                                <th>Security Deposit</th>
                                <th>Period</th>
                                <th>Rental Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $contracts = $this->leaseContracts;
                            foreach ($contracts as $contract) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <?php
                                    $tenant_infos = $l_mod->tenantInfo($contract['tenant_id']);
                                    foreach ($tenant_infos as $tenant) {
                                        ?>
                                        <td><?php
                                            echo $tenant['firstname'];
                                            echo ' ';
                                            echo $tenant['lastname'];
                                            ?> </td>
                                    <?php } ?>
                                    <?php
                                    $building_infos = $l_mod->buildingInfo($contract['building_id']);
                                    foreach ($building_infos as $building) {
//                                      print_r($building_infos);
                                        ?>
                                        <td><?php echo $building['buildingName']; ?> </td>
                                    <?php } ?>
                                    <?php
                                    $apartment_infos = $l_mod->apartmentInfo($contract['apartment_id']);
                                    foreach ($apartment_infos as $apartment) {
                                        ?>
                                        <td><?php echo $apartment['apartmentNumber']; ?> </td>
                                    <?php } ?>
                                    <td><?php echo $contract['startDate']; ?> </td>
                                    <td><?php echo $contract['endDate']; ?></td>
                                    <td><?php echo $contract['balance']; ?></td>
                                    <td><?php echo $contract['securityDeposit']; ?></td>
                                    <td><?php echo $contract['period']; ?></td>
                                    <td><?php echo $contract['rentalDate']; ?></td>
                                    <td>
    <!--                                        <a href="<?php echo URL; ?>landlord/apartmentEditPage/<?php echo $contract['id']; ?>" class="btn btn-success btn-sm">
                                            Edit
                                        </a>-->
                                        <button onclick="edit_Lease('<?php echo $contract['id']; ?>');" class="btn btn-success btn-sm">Edit</button>
                                        <button onclick="delete_Lease('<?php echo $contract['id']; ?>');" class="btn btn-danger btn-sm">Delete</button>
                                        <!-- <a href="<?php echo URL; ?>landlord/deleteLease/<?php echo $contract['id']; ?>" class="btn btn-danger btn-sm">
                                            Delete
                                        </a> -->
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
<div id="new_apartment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Lease Contract</h4>
            </div>
            <div class="modal-body">

                <div id="success" class="alert alert-success hidden" role="alert">
                </div>

                <div id="errorMessage" class="alert alert-danger hidden" role="alert">
                </div>

                <form role="form" method="post" action="<?php echo URL ?>landlord/handleLeaseContract">
                    <div class="box-body">

                        <div class="form-group">
                            <label>Tenant</label>
                            <select class="form-control checkIfExists" name="tenant_id">
                                <option selected>Select User</option>
                                <?php
                                $tenants = $this->tenants;
                                foreach ($tenants as $tenant) {
                                    ?>
                                    <option value="<?php echo $tenant['id']; ?>" id="tenant_id">
                                        <?php
                                        echo $tenant['firstname'];
                                        echo ' ';
                                        echo $tenant['lastname'];
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Building</label>
                            <select class="form-control buildingsSelect" name="building_id">
                                <option selected>Select Building</option>
                                <?php
                                $buildings = $this->buildings;
                                foreach ($buildings as $value) {
                                    ?>
                                    <option value="<?php echo $value['id']; ?>">
                                        <?php echo $value['buildingName']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Apartment Number & Type</label>
                            <select class="form-control apartmentNumber" name="apartment_id">
                            </select>
                            <!-- <div class="text availability" style="margin-top: 5px;">
                            </div> -->
                        </div>

                        <div class="form-group availability">
                        </div>

                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" placeholder="Enter Start Date" name="startDate">
                        </div>

                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" placeholder="Enter End Date" name="endDate">
                        </div>

                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <input type="text" class="form-control" placeholder="Enter Balance" name="balance">
                        </div>

                        <div class="form-group">
                            <label for="secDeposit">Security Deposit</label>
                            <input type="text" class="form-control" placeholder="Enter Security Deposit" name="securityDeposit">
                        </div>

                        <div class="form-group">
                            <label for="period">Period</label>
                            <input type="text" class="form-control" placeholder="Enter Period" name="period">
                        </div>

                        <div class="form-group">
                            <label for="rentalDate">Rental Date</label>
                            <input type="text" class="form-control" placeholder="Enter Rental Date" name="rentalDate">
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

<div id="edit_lease" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Lease</h4>
            </div>
            <div class="modal-body" id="loadEditPage"></div>
        </div>
    </div>
</div>

<div id="delete_lease" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Lease</h4>
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
