<script>
    function edit_Building(id) {
        $.get("http://arm/landlord/buildingEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_building').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Building(id) {
        $("#delete_building").modal('show');
        $(".delete").click(function () {
            $.get("http://arm/landlord/deleteBuilding/" + id, function (resp) {
                alert("Deleted");
                $("#delete_building").modal('hide');
                location = "http://arm/landlord/buildings";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_building").modal("hide");
        })
    }

    function editBuilding(id){
        var postData = {
            buildingName: $(".buildingName").val(),
            address: $(".address").val(),
            cityStateZip: $(".cityStateZip").val()
        }
        // console.log(postData);
        // console.log(id);
        $.ajax({
                type: 'POST',
                url: "http://arm/landlord/editBuiding/" + id,
                data: postData,
                success: function (data) {
                    // $("#edit_building").modal("hide");
                    location = "http://arm/landlord/buildings";
                },
                error: function () {}
            });
    }

$(function(){
    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://arm/landlord/handleCreateBuilding";

        $.ajax({
            type: 'POST',
            url: url,
            data: postData,
            success: function (data) {
                // $("#new_building").modal("hide");
                location = "http://arm/landlord/buildings";
            },
            error: function () {}
        });
            return false;
        });
    });
</script>