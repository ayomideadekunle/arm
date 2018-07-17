<title>Maintenance Categories</title>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Maintenance Categories</h3>
                    <span class="pull-right">
                        <button class="btn btn-primary" data-target="#new_mntcat" data-toggle="modal">
                            Add Category
                        </button>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $mntcats = $this->maintenanceCats;
                            foreach ($mntcats as $mntcat) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $mntcat['categoryName']; ?> </td>
                                    <td>
                                        <button onclick="edit_MntCat('<?php echo $mntcat['id']; ?>');" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_MntCat('<?php echo $mntcat['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
<div id="new_mntcat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Maintenance Category</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?php echo URL ?>landlord/handleCreateMntCat">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" name="categoryName">
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

<div id="edit_mntcat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Maintenance Category</h4>
            </div>
            <div class="modal-body" id="loadEditPage"></div>
        </div>
    </div>
</div>

<div id="delete_mntcat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Category</h4>
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