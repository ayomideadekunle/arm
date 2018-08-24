<?php
$notifications = $this->notifications;
?>

<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Messages</h3>
    </div>

<div class="box-body">
        <table class="table table-bordered table-striped" id="data_table">
          <thead>
            <tr>
                <th>#</th>
                <th>Sender</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Sent Date</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                $count = 1;
                foreach($notifications as $notification) { ?>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $notification['sender']; ?> </td>
                    <td><?php echo $notification['subject']; ?></td>
                    <td><?php echo $notification['message']; ?></td>
                    <td><?php echo $notification['date']; ?></td>
                    <td>
                    <button onclick="delete_Message('<?php echo $notification['id']; ?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
              </tr>
              <?php $count++;?>
                <?php } ?>                        
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
        </div>
      </div>
    </div>
  </section>


<div id="delete_message" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Message</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-primary delete">Yes</button>
                <button class="btn btn cancel">No</button>
            </div>
        </div>
    </div>
</div>

<script>
function delete_Message(id) {
        $("#delete_message").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/tenant/deleteMsg/" + id, function (resp) {
                alert("Deleted");
                location = "http://localhost/apartment-rental-mgt/tenant/notifications";
            });
        });
        $(".cancel").click(function () {
            $("#delete_message").modal("hide");
        })
    }
</script>