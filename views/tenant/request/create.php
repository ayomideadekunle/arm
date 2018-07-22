<title>Request</title>

<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Request</h3>
            </div>
            <form role="form" method="post">
                <div class="box-body">

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control request_category" name="category_id">
                            <option selected="">Select request type</option>
                            <?php
                            $categories = $this->requestcats;
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo $category['type']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Move in date</label>
                        <input class="form-control" name="changeDate">
                    </div>

                    <div class="form-group">
                        <label for="newApt">New Apartment</label>
                        <select class="form-control" name="newApartment">
                            <option value=""></option>
                        </select>
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
        $(".request_category").change(function (e) {
            e.preventDefault();
            var text = this.options[this.selectedIndex].text;
            console.log(text);
        })
    })
</script>