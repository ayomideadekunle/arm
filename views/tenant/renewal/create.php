<title>Request Maintenance</title>

<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Request Maintenance</h3>
            </div>
            <form role="form" method="post" action="<?php echo URL ?>tenant/handleMaintenanceRequest">
                <div class="box-body">

                    <div class="form-group">
                        <label for="request">Request</label>
                        <input class="form-control" rows="3" placeholder="Enter ..." name="request">
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>