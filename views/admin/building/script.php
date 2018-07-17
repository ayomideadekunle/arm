<script>
    function edit_Building(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/buildingEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_building').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Building(id) {
        $("#delete_building").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteBuilding/" + id, function (resp) {
                alert("Deleted");
                $("#delete_building").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/buildings";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_building").modal("hide");
        })

    }
</script>