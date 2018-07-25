<?php
$l_mod = new Landlord_Model();
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Terminated Contracts</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tenant</th> 
                                <th>Leaving Date</th>
                                <th>Leaving Reason</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $terminatedContracts = $this->terminatedContracts;
                            foreach ($terminatedContracts as $terminatedContract) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <?php
                                    $tenant_infos = $l_mod->tenantInfo($terminatedContract['tenant_id']);
                                    foreach ($tenant_infos as $tenant) {
                                        ?>
                                        <td><?php
                                            echo $tenant['firstname'];
                                            echo ' ';
                                            echo $tenant['lastname'];
                                            ?> </td>
                                    <?php } ?>
                                    <td><?php echo $terminatedContract["leavingDate"];?></td>
                                    <td><?php echo $terminatedContract["leavingReason"];?></td>
                                    <!-- <td></td> -->
                                    <td>
                                    <button onclick="deleteRecord('<?php echo $terminatedContract['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

<div id="delete_record" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Terminated Contract</h4>
            </div>
            <div class="modal-body">
                <!-- <p><strong>Are you sure you want to reject</strong></p> -->
                <button class="btn btn-primary delete">Yes</button>
                <button class="btn btn cancel">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteRecord(id) {
        $("#delete_record").modal('show');
        $(".delete").click(function () {
            $.post("http://arm/landlord/deleteContract/" + id, function (resp) {
                alert("Deleted");
                $("#delete_record").modal('hide');
                location = "http://arm/landlord/terminatedContracts";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_record").modal("hide");
        })

    }
</script>

<script>
    $(function () {
        $("#data_table").DataTable();
    });
</script>