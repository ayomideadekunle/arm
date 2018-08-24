
<section class="content-header">
          <h1>
            Read Mail
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href=""><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo count($this->notifications);?></span></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i>Inbox</i></h3>
                </div><!-- /.box-header -->
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>

                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                      <?php 
                            $messages = $this->notifications;
                              foreach ($messages as $message) {
                                // print_r($messages);
                          ?>
                        <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name"><a onclick="loadContent(<?php echo $message['id'] ?>)"><?php echo $message["sender"]; ?></a></td>
                          <td class="mailbox-subject"><b><?php echo $message["subject"]; ?></b></td>
                          <!-- <td class="mailbox-attachment"></td> -->
                          <td class="mailbox-date">5 mins ago</td>
                        </tr>
                              <?php } ?>
                      </tbody>
                    </table><!-- /.table -->
                  </div>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<?php require 'script.php'; ?>