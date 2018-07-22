<script>
    function edit_Apartment(id) {
        $.get("http://arm/landlord/apartmentEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_apartment').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Apartment(id) {
        $("#delete_apartment").modal('show');
        $(".delete").click(function () {
            $.get("http://arm/landlord/deleteapartment/" + id, function (resp) {
                alert("Deleted");
                $("#delete_apartment").modal('hide');
                location = "http://arm/landlord/apartments";
            });
        });
        $(".cancel").click(function () {
            $("#delete_apartment").modal("hide");
        })

    }

    function processSubmission() {
        $(".apartmentForm").submit(function () {
            var postData = $(this).serialize();
            var url = $(this).attr("action");

            $.ajax({
                type: 'POST',
                url: url,
                data: postData,
                success: function (data) {
//                    alert("Successful");
                    $("#success").removeClass("hidden");
                    $('#success').append("<h4>Successfull!!!</h4>").delay(3000).fadeOut(3000);

                    $("#new_apartment").modal("hide");
                },
                error: function () {
                }
            });
            return false;
        });
//        event.preventDefault();
    }
</script>