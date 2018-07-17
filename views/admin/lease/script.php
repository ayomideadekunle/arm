<script>

    $(document).ready(function (e) {
//         alert("Ready");
//        e.preventDefault();

        // populate apartment dropdown based on building selected
        $(".buildingsSelect").change(function (e) {
            e.preventDefault();
            var id = $(this).val();
            // console.log(id);
            $.get("http://localhost/apartment-rental-mgt/landlord/fetchApartments/" + id, function (response) {
                var apartmentNumber = $(".apartmentNumber");
                var availabileText = $(".availability");
                apartmentNumber.empty();
                $.each(JSON.parse(response), function (response, item) {
                    console.log(item);
                    apartmentNumber.append($("<option />", {
                        value: item.id,
                        text: item.apartmentNumber + ' ' + item.apartmentType
                    }));
//                    availabileText.append($("<input />", {
//                        value: item.status,
//                    }));
                });
            });
        });
        // check if user chosen is already in the lease contract table

        $(".checkIfExists").change(function (e) {
            e.preventDefault();
            var userid = $(this).val();
            // console.log(userid);
            $.get("http://localhost/apartment-rental-mgt/landlord/tenantExists/" + userid, function (result) {
                // console.log(result);
                var currentTenant = $("#tenant_id").val();
                $.each(JSON.parse(result), function (result, value) {
                    if (currentTenant === value.tenant_id) {
                        // alert("Already existed");
                        $("#errorMessage").removeClass("hidden");
                        $('#errorMessage').append("<h4>User already exists</h4>")
                                .delay(3000).fadeOut(3000);
                    }
                })
            })
        })
    });
    function edit_Lease(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/leaseContractEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_lease').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Lease(id) {
        $("#delete_lease").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteLease/" + id, function (resp) {
                alert("Deleted");
                $("#delete_lease").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/leaseContractList";
            });
        });
        $(".cancel").click(function () {
            $("#delete_lease").modal("hide");
        })

    }
</script>
