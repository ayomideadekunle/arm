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
                    <table class="table table-bordered table-striped" id="data_table">
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
                                <th>Status</th>
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
                                        ?>
                                        <td><?php
                                            echo $building['buildingName'];
                                            ?>
                                        </td>
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
                                    <td><?php if($contract['status'] == 0){
                                    echo "Valid";
                                    } else {
                                        echo "Terminated";
                                    }
                                    ?></td>
                                    <td>
                                        <button onclick="edit_Lease('<?php echo $contract['id']; ?>');" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_Lease('<?php echo $contract['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

                <form role="form" method="post" class="process">
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
                        <label for="period">Start Date</label>                        
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control startDate" name="startDate" placeholder="Start Date">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                        <label for="period">End Date</label>                        
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control endDate" name="endDate" placeholder="End Date">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <input type="text" class="form-control balance" placeholder="Enter Balance" name="balance">
                        </div>

                        <div class="form-group">
                            <label for="secDeposit">Security Deposit</label>
                            <input type="text" class="form-control securityDeposit" placeholder="Enter Security Deposit" name="securityDeposit">
                        </div>

                        <div class="form-group">
                            <label for="period">Period</label>
                            <input type="text" class="form-control period" placeholder="Enter Period" name="period">
                        </div>

                        <div class="form-group">
                        <label for="period">Rental Date</label>                        
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control rentalDate" name="rentalDate" placeholder="Rental Date">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
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

<script>
    $(function () {
        $("#data_table").DataTable();
    });
</script>