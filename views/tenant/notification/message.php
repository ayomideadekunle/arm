<div class="row">
<div class="col-md-6">
<div class="box-body no-padding message">
                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                  <div class="mailbox-read-info">
                    <h3 id="subject">Subject</h3>
                    <h5>From: <b id="sender"></b><span class="mailbox-read-time pull-right" id="date_sent"></span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-read-message">
                    <p>Hello <?php echo $_SESSION["fullname"]; ?>,</p>
                    <p id="message"></p>

                  </div> <!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer message">
                  <button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                </div><!-- /.box-footer -->
    </div>
        </div>

<?php require 'script.php'; ?>