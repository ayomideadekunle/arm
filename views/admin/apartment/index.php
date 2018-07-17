<title>Manage Apartments</title>
<?php
$l_mod = new Landlord_Model();
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Apartments</h3>
                    <span class="pull-right">
                        <button class="btn btn-primary" data-target="#new_apartment" data-toggle="modal">
                            Add Apartment
                        </button>
                    </span>
                </div>
                <div class="box-body">
                    <table id="data_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Building</th>
                                <th>Apartment Type</th>
                                <th>Apartment Number</th>
                                <th>Rental Fee</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $apartments = $this->apartments;
                            foreach ($apartments as $apartment) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <?php
                                    $building_infos = $l_mod->buildingInfo($apartment['building_id']);
                                    foreach ($building_infos as $building) {
//                                      print_r($building_infos);
                                        ?>
                                        <td><?php echo $building['buildingName']; ?> </td>
                                    <?php } ?>
                                    <td><?php echo $apartment['apartmentType']; ?> </td>
                                    <td><?php echo $apartment['apartmentNumber']; ?></td>
                                    <td><?php echo $apartment['rentalFee']; ?></td>
                                    <td><?php echo $apartment['size']; ?></td>
                                    <td>
                                        <button onclick="edit_Apartment('<?php echo $apartment['id']; ?>');" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_Apartment('<?php echo $apartment['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Add New Apartment</h4>
            </div>
            <div class="modal-body">

                <div id="success" class="alert alert-success hidden" role="alert">
                </div>

                <div id="errorMessage" class="alert alert-danger hidden" role="alert">
                </div>

                <form role="form" class="apartmentForm" onclick="processSubmission()"
                      action="<?php echo URL ?>landlord/handleCreateApartment">
                    <div class="box-body">

                        <div class="form-group">
                            <label>Building</label>
                            <select class="form-control" name="building_id">
                                <?php
                                $buildings = $this->buildings;
                                foreach ($buildings as $building) {
                                    ?>
                                    <option value="<?php echo $building['id']; ?>">
                                        <?php echo $building['buildingName']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Apartment Type</label>
                            <select class="form-control" name="apartmentType">
                                <option value="Duplex">
                                    Duplex
                                </option>
                                <option value="3 Bedroom Flat">
                                    3 Bedroom Flat
                                </option>
                                <option value="2 Bedroom Flat">
                                    2 Bedroom Flat
                                </option>
                                <option value="Self Contained">
                                    Self Contained
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="apartmentno">Apartment Number</label>
                            <input type="text" class="form-control" placeholder="Enter Apartment Number" name="apartmentNumber">
                        </div>

                        <div class="form-group">
                            <label for="rentalfee">Rental Fee</label>
                            <input type="text" class="form-control" placeholder="Enter Rental Fee" name="rentalFee">
                        </div>

                        <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" placeholder="Enter Size" name="size">
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

<div id="edit_apartment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Apartment</h4>
            </div>
            <div class="modal-body" id="loadEditPage"></div>
        </div>
    </div>
</div>

<div id="delete_apartment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Apartment</h4>
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
