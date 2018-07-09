<script>
    function edit_Refund(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/securityRefundEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_refund').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Refund(id) {
        $("#delete_refund").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteRefund/" + id, function (resp) {
                alert("Deleted");
                $("#delete_refund").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/secRefundList";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_refund").modal("hide");
        })

    }
</script>