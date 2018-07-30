<?php
$l_mod = new Landlord_Model();
$edit_data = $this->leaseData;
foreach ($edit_data as $value) {
    ?>
    <form role="form" method="post" class="editLease">
        <div class="box-body">

            <div class="form-group">
                <label>Tenant</label>
                <select class="form-control tenant_id" name="tenant_id" id="tenant_id">
                    <?php
                    $tenants = $this->tenants;
                    foreach ($tenants as $tenant) {
                        ?>
                        <option value="<?php echo $tenant['id']; ?>" <?php if ($tenant['id'] == $value['tenant_id']) echo "selected"; ?>>
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
                <select class="form-control buildingsSelect building_id" name="building_id" id="buildingsSelect" onchange="populate();">
                <option selected>Select Building</option>
                    <?php
                    $buildings = $this->buildings;
                    foreach ($buildings as $building) {
                        ?>
                         <!-- <?php if ($building['id'] == $value['building_id']) echo 'selected'; ?> -->
                        <option value="<?php echo $building['id']; ?>">
                            <?php echo $building['buildingName']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Apartments</label>
                <select class="form-control apartmentNumber" name="apartment_id">
                    <!-- <option selected>Select Apartment</option> -->
                </select>
            </div>

            <div class="form-group">
                <label for="startDate">Start Date</label>
                <!-- <input type="date" class="form-control startDate" placeholder="Enter Start Date" name="startDate" > -->
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" name="startDate" placeholder="Start Date" value="<?php echo $value['startDate'] ?>">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="endDate">End Date</label>
                <!-- <input type="date" class="form-control" placeholder="Enter End Date" name="endDate" value="<?php echo $value['endDate'] ?>"> -->
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" name="endDate" placeholder="End Date" data-date="<?php echo $value['endDate'] ?>">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
            </div>

            <div class="form-group">
                <label for="balance">Balance</label>
                <input type="text" class="form-control balance" placeholder="Enter Balance" name="balance" value="<?php echo $value['balance'] ?>">
            </div>

            <div class="form-group">
                <label for="secDeposit">Security Deposit</label>
                <input type="text" class="form-control securityDeposit" placeholder="Enter Security Deposit" name="securityDeposit" value="<?php echo $value['securityDeposit'] ?>">
            </div>

            <div class="form-group">
                <label for="period">Period</label>
                <input type="text" class="form-control period" placeholder="Enter Period" name="period" value="<?php echo $value['period'] ?>">
            </div>

            <div class="form-group">
                <label for="rentalDate">Rental Date</label>
                <!-- <input type="text" class="form-control rentalDate" placeholder="Enter Rental Date" name="rentalDate" value="<?php echo $value['rentalDate'] ?>"> -->
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" name="rentalDate" placeholder="Rental Date" value="<?php echo $value['rentalDate'] ?>">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="editLease(<?php echo $value['id']; ?>, event);">Submit</button>
        </div>
    </form>

<?php }
?>
<?php // require 'script.php'; ?>
