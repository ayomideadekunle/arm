<?php
$edit_data = $this->secRefundData;
foreach ($edit_data as $value) {
    ?>

    <form role="form" method="post" action="<?php echo URL ?>landlord/editSecurityRefund/<?php echo $value['id']; ?>">
        <div class="box-body">

            <div class="form-group">
                <label for="amount">Refund Amount</label>
                <input type="text" class="form-control" placeholder="Enter Amount" name="refundAmount" value="<?php echo $value['refundAmount'];?>">
            </div>

            <div class="form-group">
                <label for="reason">Reason for Refund</label>
                <input type="text" class="form-control" placeholder="Enter Reason" name="refundReason" value="<?php echo $value['refundReason'];?>">
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" placeholder="Date" name="date" value="<?php echo $value['date'];?>">
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

<?php }
?>