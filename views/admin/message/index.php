
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Send Message</h3>
            </div>
            <form role="form" method="post" class="process">
                <div class="box-body">
                <div class="form-group">
                    <label>Select Tenant</label>
                    <select class="form-control select2" multiple="multiple"
                            data-placeholder="Select Tenants" style="width: 100%;" name="user">
                      <?php 
                      $tenants = $this->tenants;
                        foreach ($tenants as $tenant) {
                        ?>
                      <option value="<?php echo $tenant["id"]; ?>"><?php echo $tenant["firstname"] . " " . $tenant["lastname"]; ?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input class="form-control subject" placeholder="Subject:" name="subject">
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control message" style="height: 300px" name="message"></textarea>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        $(".process").submit(function (e) {
            // e.preventDefault();

            var url = "http://arm/landlord/notify";
            var messageData = {
                recipients: $(".select2").val(),
                subject: $(".subject").val(),
                message: $(".message").val()
            }

                var postData = {
                    user: messageData.recipients,
                    message: messageData.message,
                    subject: messageData.subject
                }
            
            // if(messageData === ""){
            //     alert("Wrng")
            // } else {
            $.post(url, postData, function(result){
                // console.log(messageData);
                location = "http://arm";
            });
            // }
            // return false;
        });
    });
</script>