<?php
$edit_data = $this->secRefundData;
foreach ($edit_data as $value) {
    ?>

    <form role="form" method="post">
        <div class="box-body">

            <div class="form-group">
                <label for="amount">Refund Amount</label>
                <input type="text" class="form-control refundAmount" placeholder="Enter Amount" name="refundAmount" value="<?php echo $value['refundAmount'];?>">
            </div>

            <div class="form-group">
                <label for="reason">Reason for Refund</label>
                <input type="text" class="form-control refundReason" placeholder="Enter Reason" name="refundReason" value="<?php echo $value['refundReason'];?>">
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control date" placeholder="Date" name="date" value="<?php echo $value['date'];?>">
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="editSecRefund(<?php echo $value['id']; ?>);">Submit</button>
        </div>
    </form>

<?php }
?>