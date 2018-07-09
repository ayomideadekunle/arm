<script>
    function edit_MntCat(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/maintenanceCatEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_mntcat').modal('show');
//            console.log("Worked");
        });
    }

    function delete_MntCat(id) {
        $("#delete_mntcat").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteMntCat/" + id, function (resp) {
                alert("Deleted");
                $("#delete_mntcat").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/maintenanceCatList";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_mntcat").modal("hide");
        })

    }
</script>