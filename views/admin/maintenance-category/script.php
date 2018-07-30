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
                location = "http://localhost/apartment-rental-mgt/landlord/maintenanceCategories";
//                window.reload;
            });
        });
        $(".cancel").click(function () {
            $("#delete_mntcat").modal("hide");
        })
    }

    function editCategory(id, event){
        var postData = {
            categoryName: $(".categoryName").val()
        }

        var valid = true,
        message = '';

        $('.editCategory input').each(function() {
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
                url: "http://localhost/apartment-rental-mgt/landlord/editMaintenanceCat/" + id,
                data: postData,
                success: function (data) {
                    location = "http://localhost/apartment-rental-mgt/landlord/maintenanceCategories";
                },
                error: function () {}
            });
          }
    }

$(function(){
    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://localhost/apartment-rental-mgt/landlord/handleCreateMntCat";

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
                location = "http://localhost/apartment-rental-mgt/landlord/maintenanceCategories";
            },
            error: function () {}
        });
            // return false;
          }
        });
    });
</script>
