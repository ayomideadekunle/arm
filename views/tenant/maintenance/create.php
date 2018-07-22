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
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            <?php
                            $categories = $this->categories;
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo $category['categoryName']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="request">Request</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="request"></textarea>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>