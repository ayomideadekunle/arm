
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Request</h3>
            </div>
            <form role="form" method="post" class="process">
                <div class="box-body">

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control request_category" name="category_id">
                            <option selected="">Select request type</option>
                            <?php
                            $count = 1;
                            $categories = $this->requestcats;
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category['type']; ?>" id="<?php echo "add" . $count++; ?>">
                                    <?php echo $category['type']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group aptChange" style="display: none">
                        <label for="newApt">New Apartment</label>
                        <select class="form-control newApartment" name="newApartment">
                            <option selected="">Select new apartment</option>
                            <?php
                            $apartments = $this->apartments;
                            foreach ($apartments as $apartment) {
                                ?>
                                <option value="<?php echo $apartment['id']; ?>" id="apt_id">
                                    <?php echo $apartment['apartmentNumber'] . " " . $apartment['apartmentType']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group aptChange" style="display: none">
                        <label for="date">Move in date</label>
                        <input class="form-control changeDate" name="changeDate" type="date">
                    </div>

                    <div class="form-group termination" style="display: none">
                        <label for="date">Leaving date</label>
                        <input class="form-control leavingDate" name="leavingDate" type="date">
                    </div>

                    <div class="form-group termination" style="display: none">
                        <label for="date">Leaving Reason</label>
                        <textarea class="form-control leavingReason" name="leavingReason" rows="2"></textarea>
                    </div>

                    <div class="form-group maintenance" style="display: none">
                        <label>Category</label>
                        <select class="form-control category_id" name="category_id">
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

                    <div class="form-group maintenance" style="display: none">
                        <label for="request">Request</label>
                        <textarea class="form-control request" rows="3" placeholder="Enter ..." name="request"></textarea>
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
            if (text === "Change Apartment") {
                $(".aptChange").show();
                $(".termination").hide();
                $(".maintenance").hide();
            } else if (text === "Terminate Lease") {
                $(".termination").show();
                $(".aptChange").hide();
                $(".maintenance").hide();
            } else if(text === "Maintenance"){
                $(".maintenance").show();
                $(".termination").hide();
                $(".aptChange").hide();
            } else {
                $(".termination").hide();
                $(".aptChange").hide();
                $(".maintenance").hide();
            }
            return text;
        });

        $(".process").submit(function () {
            var request_cat = $(".request_category").val();
            if(request_cat === "Change Apartment"){
                
                var url = "http://arm/tenant/handleChngAptRequest";
                var newApt = $(".newApartment").val();
                var move_in_date = $(".changeDate").val();

                $.ajax({
                type: 'POST',
                url: url,
                data: {newApartment: newApt, changeDate: move_in_date },
                success: function (data) {
                   alert("Successful");
                   location = "http://arm";
                },
                error: function () {
                }
            });
            } else if(request_cat === "Terminate Lease"){
                
                var url = "http://arm/tenant/handleContractTermination"
                var date = $(".leavingDate").val();
                var reason = $(".leavingReason").val();

                $.ajax({
                type: 'POST',
                url: url,
                data: {leavingDate: date, leavingReason: reason },
                success: function (data) {
                   alert("Successful");
                   location = "http://arm";
                },
                error: function () {
                }
            });
            } else if(request_cat === "Maintenance"){
                var url = "http://arm/tenant/handleMaintenanceRequest"
                var category = $(".category_id").val();
                var request = $(".request").val();

                $.ajax({
                type: 'POST',
                url: url,
                data: {category_id: category, request: request },
                success: function (data) {
                   alert("Successful");
                   location = "http://arm";
                },
                error: function () {
                }
            });
            } else {
                alert("Please select request type");                
            }
            // console.log(request_cat);

            return false;
        });

         $(".newApartment").change(function (e) {
            e.preventDefault();
            var apartmentid = $(this).val();
            // console.log(userid);
            $.get("http://arm/tenant/checkApartment/" + apartmentid, function (result) {
                // console.log(result);
                var currentApartment = $("#apt_id").val();
                $.each(JSON.parse(result), function (result, value) {
                    if (currentApartment === value.apartment_id) {
                        alert("Already existed");
                    }
                })
            })
        })
    });
</script>