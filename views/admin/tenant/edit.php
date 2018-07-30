<!--<title>Edit Tenant</title>-->

<?php
$edit_data = $this->tenantData;
foreach ($edit_data as $value) {
    ?>

    <form role="form" method="post" class="editTenant">
        <div class="box-body">

            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control firstname" placeholder="Enter First Name" name="firstname" value="<?php echo $value['firstname'] ?>">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control lastname" placeholder="Enter Last Name" name="lastname" value="<?php echo $value['lastname'] ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control email" placeholder="Enter Email" name="email" value="<?php echo $value['email'] ?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control phone" placeholder="Enter phone number" name="phone" value="<?php echo $value['phone'] ?>">
            </div>

            <div class="form-group">
                <label for="zipcode">City/State zipcode</label>
                <input type="text" class="form-control cityStateZip" placeholder="Enter city or state zipcode" name="cityStateZip" value="<?php echo $value['cityStateZip'] ?>">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control currentAddress" placeholder="Enter current address" name="currentAddress" value="<?php echo $value['currentAddress'] ?>">
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="editTenant(<?php echo $value['id'];?>, event);">Submit</button>
        </div>
    </form>


<?php } ?>
