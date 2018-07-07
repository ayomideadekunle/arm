<script>
    $(document).ready(function () {
//        e.preventDefault;
        $(".checkIfExists").change(function () {
            var email = $(".checkIfExists").val();
            $.get("http://localhost/apartment-rental-mgt/landlord/checkEmailExists/" + email, function (response) {
                $.each(JSON.parse(response), function (response, value) {
                    if (value.email === email) {
                        console.log("Already exists");
                        $("#error").removeClass("hidden");
                    }
//                    console.log(response);
                });
            });
        });
    });

    function edit_Tenant(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/tenantEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_tenant').modal('show');
//            console.log("Worked");
        });
    }

    function checkPassword() {
//        event.preventDefault;
        var password = $("#pass").val();
        var cfpassword = $("#cfpass").val();
        if (password !== cfpassword) {
            $("#passworderror").removeClass('hidden');
        }
    }

    function delete_Tenant(id) {
        $("#delete_tenant").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deletetenant/" + id, function (resp) {
                alert("Deleted");
            });
        });
        $(".cancel").click(function () {
            $("#delete_tenant").modal("hide");
        })

    }
</script>
