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
                location = "http://localhost/apartment-rental-mgt/landlord/apartmentList";
            });
        });
        $(".cancel").click(function () {
            $("#delete_apartment").modal("hide");
        })

    }
</script>