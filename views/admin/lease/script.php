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
                    // console.log(item);
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

    function populate(){
        var id = $(".building_id").val();
            // console.log(id);
            $.get("http://localhost/apartment-rental-mgt/landlord/fetchApartments/" + id, function (response) {
                var apartmentNumber = $(".apartmentNumber");
                var availabileText = $(".availability");
                apartmentNumber.empty();
                $.each(JSON.parse(response), function (response, item) {
                    // console.log(item);
                    apartmentNumber.append($("<option />", {
                        value: item.id,
                        text: item.apartmentNumber + ' ' + item.apartmentType
                    }));
//                    availabileText.append($("<input />", {
//                        value: item.status,
//                    }));
                });
            });
    }

    function delete_Lease(id) {
        $("#delete_lease").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteLease/" + id, function (resp) {
                alert("Deleted");
                $("#delete_lease").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/leaseContracts";
            });
        });
        $(".cancel").click(function () {
            $("#delete_lease").modal("hide");
        })
    }

    function notifyTenant(userid) {
      // var user_id = $(".notify").attr("userid");
      // console.log(user_id);
      // console.log(userid);
      $.post("http://localhost/apartment-rental-mgt/landlord/notifyUser/" + userid, function(response){
        alert("User notified");
        console.log(response);
      });
    }

    function editLease(id, event){
        var postData = {
            tenant_id: $(".tenant_id").val(),
            building_id: $(".building_id").val(),
            apartment_id: $(".apartmentNumber").val(),
            startDate: $(".startDate").val(),
            endDate: $(".endDate").val(),
            balance: $(".balance").val(),
            securityDeposit: $(".securityDeposit").val(),
            period: $(".period").val(),
            rentalDate: $(".rentalDate").val()
        }

        var valid = true,
        message = '';

        $('.editLease input').each(function() {
          var $this = $(this);

          if(!$this.val()) {
            var inputName = $this.attr('name');
              valid = false;
              message += 'Please enter your ' + inputName + '\n';
            }
});

if(!valid) {
  alert(message);
  // return false;
  event.preventDefault();
} else {
        $.ajax({
                type: 'POST',
                url: "http://localhost/apartment-rental-mgt/landlord/editLeaseContract/" + id,
                data: postData,
                success: function (data) {
                    // $("#edit_building").modal("hide");
                    location = "http://localhost/apartment-rental-mgt/landlord/leaseContracts";
                },
                error: function () {}
            });
    }
  }

$(function() {
    // $('.datepick').daterangepicker();
    // $('.datepicker').datepicker();
$(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://localhost/apartment-rental-mgt/landlord/handleLeaseContracts";

        var valid = true,
        message = '';

        $('form input').each(function() {
          var $this = $(this);

          if(!$this.val()) {
            var inputName = $this.attr('name');
              valid = false;
              message += 'Please enter your ' + inputName + '\n';
            }
});

if(!valid) {
  alert(message);
  return false;
} else {

        $.ajax({
            type: 'POST',
            url: url,
            data: postData,
            success: function (data) {
                location = "http://localhost/apartment-rental-mgt/landlord/leaseContracts";
            },
            error: function () {}
        });
        // return false;
      }
    });
});
</script>
