<script>
    function edit_MntCat(id) {
        $.get("http://arm/landlord/maintenanceCatEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_mntcat').modal('show');
//            console.log("Worked");
        });
    }

    function delete_MntCat(id) {
        $("#delete_mntcat").modal('show');
        $(".delete").click(function () {
            $.get("http://arm/landlord/deleteMntCat/" + id, function (resp) {
                alert("Deleted");
                $("#delete_mntcat").modal('hide');
                location = "http://arm/landlord/maintenanceCategories";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_mntcat").modal("hide");
        })
    }

    function editCategory(id){
        var postData = {
            categoryName: $(".categoryName").val()
        }

        $.ajax({
                type: 'POST',
                url: "http://arm/landlord/editMaintenanceCat/" + id,
                data: postData,
                success: function (data) {
                    location = "http://arm/landlord/maintenanceCategories";
                },
                error: function () {}
            });
    }

$(function(){
    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://arm/landlord/handleCreateMntCat";

        $.ajax({
            type: 'POST',
            url: url,
            data: postData,
            success: function (data) {
                location = "http://arm/landlord/maintenanceCategories";
            },
            error: function () {}
        });
            return false;
        });
    });
</script>