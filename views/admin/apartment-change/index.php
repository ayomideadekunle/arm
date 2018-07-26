<?php
$l_mod = new Landlord_Model();
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Change Apartment Request</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tenant</th> 
                                <th>Leaving Apartment</th>
                                <th>New Apartment</th>
                                <th>Move in date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $aptChng_requests = $this->aprtChngReqs;
                            foreach ($aptChng_requests as $aptChng_request) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <?php
                                    $tenant_infos = $l_mod->tenantInfo($aptChng_request['tenant_id']);
                                    foreach ($tenant_infos as $tenant) {
                                        ?>
                                        <td><?php
                                            echo $tenant['firstname'];
                                            echo ' ';
                                            echo $tenant['lastname'];
                                            ?> </td>
                                    <?php } ?>
                                    <?php 
                                    $apartment_infos = $l_mod->apartmentInfo($aptChng_request['leavingAprtmentid']);
                                    foreach($apartment_infos as $apartment_info){ ?>
                                    <td><?php 
                                    echo $apartment_info['apartmentNumber'] ." " . $apartment_info["apartmentType"]; ?>
                                    </td>
                                    <?php } ?>
                                    <?php 
                                    $new_apt_infos = $l_mod->apartmentInfo($aptChng_request['newApartment']);
                                    foreach($new_apt_infos as $new_apt_info){ ?>
                                    <td><?php 
                                    echo $new_apt_info['apartmentNumber'] ." " . $new_apt_info["apartmentType"]; ?>
                                    </td>
                                    <?php } ?>
                                    <td><?php echo $aptChng_request["changeDate"];?></td>
                                    <td><?php if ($aptChng_request["status"] == 0) {
                                        echo "None";
                                    } else if($aptChng_request["status"] == 1){
                                        echo "Granted";
                                    } else if($aptChng_request["status"] == 2){
                                        echo "Rejected";
                                    }
                                    ?></td>
                                    <td>
                                    <?php
                                    if ($aptChng_request["status"] == 1 || $aptChng_request["status"] == 2) { ?>
                                    <?php echo " "; ?>
                                    <?php } else if($aptChng_request["status"] == 0){ ?>
                                    <button onclick="grant_Request('<?php echo $aptChng_request['id']; ?>');" class="btn btn-success btn-sm">Grant</button>
                                    <button onclick="reject_Request('<?php echo $aptChng_request['id']; ?>');" class="btn btn-danger btn-sm">Reject</button>
                                    <?php } ?>
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

<div id="reject" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reject</h4>
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
    function reject_Request(id) {
        $("#reject").modal('show');
        $(".delete").click(function () {
            $.post("http://localhost/apartment-rental-mgt/landlord/reject/" + id, function (resp) {
                alert("Rejected");
                $("#delete_request").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/apartment_change_requests";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#reject").modal("hide");
        })

    }

    function grant_Request(id){
        $.post("http://localhost/apartment-rental-mgt/landlord/grant/" + id, function (resp) {
                alert("Granted");
                console.log(resp);
                location = "http://localhost/apartment-rental-mgt/landlord/apartment_change_requests";
//                window.reload;
            });
    }
</script>

<script>
    $(function () {
        $("#data_table").DataTable();
    });
</script>