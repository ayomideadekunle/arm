<title>Security Refunds</title>
<?php
$l_mod = new Landlord_Model();
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Security Refund</h3>
                    <span class="pull-right">
                        <button class="btn btn-primary" data-target="#new_refund" data-toggle="modal">
                            Add Refund
                        </button>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Refunded Amount</th>
                                <th>Reason for Refund</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $refunds = $this->refunds;
                            foreach ($refunds as $refund) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $refund['refundAmount']; ?> </td>
                                    <td><?php echo $refund['refundReason']; ?></td>
                                    <td><?php echo $refund['date']; ?></td>
                                    <td>
                                        <button onclick="edit_Refund('<?php echo $refund['id']; ?>');" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_Refund('<?php echo $refund['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
<div id="new_refund" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Security Refund</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?php echo URL ?>landlord/handleSecurityRefund">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="amount">Refund Amount</label>
                            <input type="text" class="form-control" placeholder="Enter Amount" name="refundAmount">
                        </div>

                        <div class="form-group">
                            <label for="reason">Reason for Refund</label>
                            <input type="text" class="form-control" placeholder="Enter Reason" name="refundReason">
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" placeholder="Date" name="date">
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

<div id="edit_refund" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Security Refund</h4>
            </div>
            <div class="modal-body" id="loadEditPage"></div>
        </div>
    </div>
</div>

<div id="delete_refund" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Security Refund</h4>
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