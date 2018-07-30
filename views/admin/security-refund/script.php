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
                location = "http://localhost/apartment-rental-mgt/landlord/securityRefunds";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_refund").modal("hide");
        })
    }

    function editSecRefund(id, event){
        var postData = {
            refundAmount: $(".refundAmount").val(),
            refundReason: $(".refundReason").val(),
            date: $(".date").val()
        }

        var valid = true,
        message = '';

        $('.editSecRefund input').each(function() {
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
                url: "http://localhost/apartment-rental-mgt/landlord/editSecurityRefund/" + id,
                data: postData,
                success: function (data) {
                    location = "http://localhost/apartment-rental-mgt/landlord/securityRefunds";
                },
                error: function () {}
            });
    }
  }

$(function(){
    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://localhost/apartment-rental-mgt/landlord/handleSecurityRefund";

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
                location = "http://localhost/apartment-rental-mgt/landlord/securityRefunds";
            },
            error: function () {}
        });
            // return false;
          }
        });
    });
</script>
