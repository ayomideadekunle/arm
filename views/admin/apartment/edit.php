<?php
$edit_data = $this->apartmentData;
foreach ($edit_data as $value) {
    ?>
    <form role="form" method="post" class="editApartment">
        <div class="box-body">

            <div class="form-group">
                <label>Building</label>
                <select class="form-control building_id" name="building_id">
                    <?php
                    $buildings = $this->buildings;
                    foreach ($buildings as $building) {
                        ?>
                        <option value="<?php echo $building['id']; ?>"
                                <?php if ($building['id'] == $value['building_id']) echo 'selected'; ?>>
                            <?php echo $building['buildingName']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Apartment Type</label>
                <select class="form-control apartmentType" name="apartmentType">
                    <option value="Duplex" <?php if ($value['apartmentType'] == 'Duplex') echo 'selected'; ?>>
                        Duplex
                    </option>
                    <option value="3 Bedroom Flat" <?php if ($value['apartmentType'] == '3 Bedroom Flat') echo 'selected'; ?>>
                        3 Bedroom Flat
                    </option>
                    <option value="2 Bedroom Flat" <?php if ($value['apartmentType'] == '2 Bedroom Flat') echo 'selected'; ?>>
                        2 Bedroom Flat
                    </option>
                    <option value="Self Contained" <?php if ($value['apartmentType'] == 'Self Contained') echo 'selected'; ?>>
                        Self Contained
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="apartmentno">Apartment Number</label>
                <input type="text" class="form-control apartmentNumber" placeholder="Enter Apartment Number" name="apartmentNumber" value="<?php echo $value['apartmentNumber']; ?>">
            </div>

            <div class="form-group">
                <label for="rentalfee">Rental Fee</label>
                <input type="text" class="form-control rentalFee" placeholder="Enter Rental Fee" name="rentalFee" value="<?php echo $value['rentalFee']; ?>">
            </div>

            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" class="form-control size" placeholder="Enter Size" name="size" value="<?php echo $value['size']; ?>">
            </div>

            <div class="form-group">
                <label>Availability</label>
                <select class="form-control status" name="status">
                    <option value="0" <?php if ($value['status'] == 0 ) echo 'selected'; ?>>
                        Available
                    </option>
                    <option value="1" <?php if ($value['status'] == 1) echo 'selected'; ?>>
                        Unavailable
                    </option>
                </select>
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary"  onclick="editApartment(<?php echo $value['id']; ?>)">Submit</button>
        </div>
    </form>
<?php } ?>
