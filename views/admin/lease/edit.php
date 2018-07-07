<?php
$l_mod = new Landlord_Model();
$edit_data = $this->leaseData;
foreach ($edit_data as $value) {
    ?>

    <form role="form" method="post" action="<?php echo URL ?>landlord/editLeaseContract/<?php echo $value['id'] ?>">
        <div class="box-body">

            <div class="form-group">
                <label>Tenant</label>
                <select class="form-control" name="tenant_id" id="tenant_id">
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

            <div class="alert alert-warning alert-dismissable hidden" id="error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-warning"></i>Already Existed</div>

            <div class="form-group">
                <label>Building</label>
                <select class="form-control buildingsSelect" name="building_id" id="buildingsSelect">
                    <?php
                    $buildings = $this->buildings;
                    foreach ($buildings as $building) {
                        ?>
                        <option value="<?php echo $building['id']; ?>" <?php if ($building['id'] == $value['building_id']) echo 'selected'; ?>>
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
                <input type="date" class="form-control" placeholder="Enter Start Date" name="startDate" value="<?php echo $value['startDate'] ?>">
            </div>

            <div class="form-group">
                <label for="endDate">End Date</label>
                <input type="date" class="form-control" placeholder="Enter End Date" name="endDate" value="<?php echo $value['endDate'] ?>">
            </div>

            <div class="form-group">
                <label for="balance">Balance</label>
                <input type="text" class="form-control" placeholder="Enter Balance" name="balance" value="<?php echo $value['balance'] ?>">
            </div>

            <div class="form-group">
                <label for="secDeposit">Security Deposit</label>
                <input type="text" class="form-control" placeholder="Enter Security Deposit" name="securityDeposit" value="<?php echo $value['securityDeposit'] ?>">
            </div>

            <div class="form-group">
                <label for="period">Period</label>
                <input type="text" class="form-control" placeholder="Enter Period" name="period" value="<?php echo $value['period'] ?>">
            </div>

            <div class="form-group">
                <label for="rentalDate">Rental Date</label>
                <input type="text" class="form-control" placeholder="Enter Rental Date" name="rentalDate" value="<?php echo $value['rentalDate'] ?>">
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

<?php }
?>
<?php // require 'script.php'; ?>

<script type="text/javascript">

//    $(document).ready(function () {
//        window.onload(function (){
            
//        })
        // populate apartment dropdown based on building selected
//        alert("Ready");
//        $(".buildingsSelect").change(function () {
//            var id = $(this).val();
//            $.get("http://localhost/apartment-rental-mgt/landlord/fetchApartments/" + id, function (response) {
//                var apartmentNumber = $(".apartmentNumber");
//                var availabileText = $(".availability");
//                apartmentNumber.empty();
//                $.each(JSON.parse(response), function (response, item) {
//                    console.log(item);
//                    apartmentNumber.append($("<option />", {
//                        value: item.id,
//                        text: item.apartmentNumber + ' ' + item.apartmentType
//                    }));
//                });
//            });
//        });
//    });
</script>
