<title>Request</title>

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
                        <select class="form-control request_category" name="category_id" onchange="getText(this);">
                            <option selected="">Select request type</option>
                            <?php
                            $count = 1;
                            $categories = $this->requestcats;
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category['id']; ?>" id="<?php echo "add" . $count++; ?>">
                                    <?php echo $category['type']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group aptChange">
                        <label for="newApt">New Apartment</label>
                        <select class="form-control newApartment" name="newApartment">
                            <option selected="">Select new apartment</option>
                            <?php
                            $apartments = $this->apartments;
                            foreach ($apartments as $apartment) {
                                ?>
                                <option value="<?php echo $apartment['id']; ?>">
                                    <?php echo $apartment['apartmentNumber'] . " " . $apartment['apartmentType']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group aptChange">
                        <label for="date">Move in date</label>
                        <input class="form-control changeDate" name="changeDate">
                    </div>

                    <div class="form-group termination">
                        <label for="date">Leaving date</label>
                        <input class="form-control leavingDate" name="leavingDate">
                    </div>

                    <div class="form-group termination">
                        <label for="date">Leaving Reason</label>
                        <input class="form-control leavingReason" name="leavingReason">
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
                $(".aptChange").removeClass("aptChange");
//                $(".termination").hide("slow", function () {
//                    alert("Animation Done.");
//                });
            } else if (text === "Terminate Lease") {
                // console.log("okay");
//                $(".aptChange").hide("slow", function () {
//                    alert("Animation Done.");
//                });
                $(".termination").removeClass("termination");
            }
            return text;
        });

        $(".process").submit(function () {
            // var request_cat = $(".request_category").val()

            var url = "http://arm/tenant/handleChngAptRequest";

            var newApt = $(".newApartment").val();
            var move_in_date = $(".changeDate").val();

            // $.ajax({
            //     type: 'POST',
            //     url: url,
            //     data: {newApartment: newApt, changeDate: move_in_date },
            //     success: function (data) {
            //        alert("Successful");
            //         // $("#success").removeClass("hidden");
            //         // $('#success').append("<h4>Successfull!!!</h4>").delay(3000).fadeOut(3000);
            //     },
            //     error: function () {
            //     }
            // });
            return false;
        });
    });
</script>

<style>
    .aptChange {
        display: none;
    }
    .termination {
        display: none;
    }
</style>