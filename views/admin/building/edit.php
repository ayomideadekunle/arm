<?php
$edit_data = $this->buildingData;
foreach ($edit_data as $value) {
    ?>
    <form role="form" method="post" action="<?php echo URL ?>landlord/editBuiding/<?php echo $value['id'];?>">
        <div class="box-body">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="buildingName" value="<?php echo $value['buildingName'];?>">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php echo $value['address'];?>">
            </div>

            <div class="form-group">
                <label for="zipcode">City/State zipcode</label>
                <input type="text" class="form-control" placeholder="Enter City/State Zipcode" name="cityStateZip" value="<?php echo $value['cityStateZip'];?>">
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

<?php } ?>