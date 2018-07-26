<script>
    function edit_Apartment(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/apartmentEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_apartment').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Apartment(id) {
        $("#delete_apartment").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteapartment/" + id, function (resp) {
                alert("Deleted");
                $("#delete_apartment").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/apartments";
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
                url: "http://localhost/apartment-rental-mgt/landlord/editApartment/" + id,
                data: postData,
                success: function (data) {
                    // $("#edit_apartment").modal("hide");
                    location = "http://localhost/apartment-rental-mgt/landlord/apartments";
                },
                error: function () {}
            });
    }

    $(function(){
        $(".apartmentForm").submit(function (e) {
            // event.preventDefault();
            var postData = $(this).serialize();
            var url = "http://localhost/apartment-rental-mgt/landlord/handleCreateApartment";

            $.ajax({
                type: 'POST',
                url: url,
                data: postData,
                success: function (data) {
                    // $("#new_apartment").modal("hide");
                    location = "http://localhost/apartment-rental-mgt/landlord/apartments";
                },
                error: function () {}
            });
            return false;
        });
    });
</script>