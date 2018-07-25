<script>
    function edit_Refund(id) {
        $.get("http://arm/landlord/securityRefundEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_refund').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Refund(id) {
        $("#delete_refund").modal('show');
        $(".delete").click(function () {
            $.get("http://arm/landlord/deleteRefund/" + id, function (resp) {
                alert("Deleted");
                $("#delete_refund").modal('hide');
                location = "http://arm/landlord/securityRefunds";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_refund").modal("hide");
        })
    }

    function editSecRefund(id){
        var postData = {
            refundAmount: $(".refundAmount").val(),
            refundReason: $(".refundReason").val(),
            date: $(".date").val()
        }

        $.ajax({
                type: 'POST',
                url: "http://arm/landlord/editSecurityRefund/" + id,
                data: postData,
                success: function (data) {
                    location = "http://arm/landlord/securityRefunds";
                },
                error: function () {}
            });
    }

$(function(){
    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://arm/landlord/handleSecurityRefund";

        $.ajax({
            type: 'POST',
            url: url,
            data: postData,
            success: function (data) {
                location = "http://arm/landlord/securityRefunds";
            },
            error: function () {}
        });
            return false;
        });
    });
</script>