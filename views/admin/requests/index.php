<title>Maintenance Requests</title>

<?php
$l_mod = new Landlord_Model();
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Requests</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sender</th> 
                                <th>Apartment Number</th>
                                <th>Category</th>
                                <th>Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $maintenance_requests = $this->mntncReqs;
                            foreach ($maintenance_requests as $maintenance_request) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <?php
                                    $tenant_infos = $l_mod->tenantInfo($maintenance_request['tenant_id']);
                                    foreach ($tenant_infos as $tenant) {
                                        ?>
                                        <td><?php
                                            echo $tenant['firstname'];
                                            echo ' ';
                                            echo $tenant['lastname'];
                                            ?> </td>
                                    <?php } ?>
                                    <?php 
                                    $apartment_infos = $l_mod->apartmentInfo($maintenance_request['apartment_id']);
                                    foreach($apartment_infos as $apartment_info){ ?>
                                    <td><?php 
                                    echo $apartment_info['apartmentNumber'] ." " . $apartment_info["apartmentType"]; ?>
                                    </td>
                                    <?php } ?>
                                    <?php 
                                    $cat_infos = $l_mod->maintenanceCatInfo($maintenance_request['category_id']);
                                    foreach($cat_infos as $cat_info){ ?>
                                    <td><?php 
                                    echo $cat_info['categoryName']; ?>
                                    </td>
                                    <?php } ?>
                                    <td><?php echo $maintenance_request["request"];?></td>
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