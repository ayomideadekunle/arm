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

    function editApartment(id){
        var postData = {
            building_id: $(".building_id").val(),
            apartmentType: $(".apartmentType").val(),
            apartmentNumber: $(".apartmentNumber").val(),
            rentalFee: $(".rentalFee").val(),
            size: $(".size").val(),
            status: $(".status").val()
        }
        // console.log(postData);
        // console.log(id);
        $.ajax({
                type: 'POST',
                url: "http://arm/landlord/editApartment/" + id,
                data: postData,
                success: function (data) {
                    // $("#edit_apartment").modal("hide");
                    location = "http://arm/landlord/apartments";
                },
                error: function () {}
            });
    }

    $(function(){
        $(".apartmentForm").submit(function (e) {
            // event.preventDefault();
            var postData = $(this).serialize();
            var url = "http://arm/landlord/handleCreateApartment";

            $.ajax({
                type: 'POST',
                url: url,
                data: postData,
                success: function (data) {
                    // $("#new_apartment").modal("hide");
                    location = "http://arm/landlord/apartments";
                },
                error: function () {}
            });
            return false;
        });
    });
</script>