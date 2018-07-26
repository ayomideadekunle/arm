<script>
    $(document).ready(function (e) {
//        e.preventDefault();
        $(".checkIfExists").change(function (e) {
            e.preventDefault();
            var email = $(".checkIfExists").val();
            $.get("http://localhost/apartment-rental-mgt/landlord/checkEmailExists/" + email, function (response) {
                $.each(JSON.parse(response), function (response, value) {
                    if (value.email === email) {
                        console.log("Already exists");
                        $("#errorMessage").removeClass("hidden");
//                        $('#success').html("<div id='message'></div>");
                        $('#errorMessage').append("<h4>Email already exists</h4>")
                                .delay(3000).fadeOut(3000);
                    }
//                    console.log(response);
});
            });
        });

    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://localhost/apartment-rental-mgt/landlord/handleCreateTenant";

        $.ajax({
            type: 'POST',
            url: url,
            data: postData,
            success: function (data) {
                location = "http://localhost/apartment-rental-mgt/landlord/tenants";
            },
            error: function () {}
        });
            return false;
        });
    });

    function edit_Tenant(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/tenantEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_tenant').modal('show');
//            console.log("Worked");
        });
    }

    function checkPassword(event) {
        event.preventDefault();
        var password = $("#pass").val();
        var cfpassword = $("#cfpass").val();
        if (password !== cfpassword) {
            $("#errorMessage").removeClass('hidden');
            $('#errorMessage').append("<h4>Passwords do not match</h4>")
                    .delay(3000).fadeOut(3000);
        }
    }

    function delete_Tenant(id) {
        $("#delete_tenant").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deletetenant/" + id, function (resp) {
                alert("Deleted");
                $("#delete_tenant").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/tenants";
            });
        });
        $(".cancel").click(function () {
            $("#delete_tenant").modal("hide");
        })
    }

    function editTenant(id){
        var postData = {
            firstname: $(".firstname").val(),
            lastname: $(".lastname").val(),
            phone: $(".phone").val(),
            cityStateZip: $(".cityStateZip").val(),
            currentAddress: $(".currentAddress").val(),
            email: $(".email").val()
        }

        $.ajax({
                type: 'POST',
                url: "http://localhost/apartment-rental-mgt/landlord/editTenant/" + id,
                data: postData,
                success: function (data) {
                    location = "http://localhost/apartment-rental-mgt/landlord/tenants";
                },
                error: function () {}
            });
    }
</script>
