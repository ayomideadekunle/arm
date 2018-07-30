<script>
    function edit_Building(id) {
        $.get("http://localhost/apartment-rental-mgt/landlord/buildingEditPage/" + id, function (resp) {
            $("#loadEditPage").html(resp);
            $('#edit_building').modal('show');
//            console.log("Worked");
        });
    }

    function delete_Building(id) {
        $("#delete_building").modal('show');
        $(".delete").click(function () {
            $.get("http://localhost/apartment-rental-mgt/landlord/deleteBuilding/" + id, function (resp) {
                alert("Deleted");
                $("#delete_building").modal('hide');
                location = "http://localhost/apartment-rental-mgt/landlord/buildings";
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

        var valid = true,
        message = '';

        $('.editBuiding input').each(function() {
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
                url: "http://localhost/apartment-rental-mgt/landlord/editBuiding/" + id,
                data: postData,
                success: function (data) {
                    // $("#edit_building").modal("hide");
                    location = "http://localhost/apartment-rental-mgt/landlord/buildings";
                },
                error: function () {}
            });
    }
  }

$(function(){
    $(".process").submit(function (e) {
        // event.preventDefault();
        var postData = $(this).serialize();
        var url = "http://localhost/apartment-rental-mgt/landlord/handleCreateBuilding";

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
                // $("#new_building").modal("hide");
                location = "http://localhost/apartment-rental-mgt/landlord/buildings";
            },
            error: function () {}
        });
            // return false;
          }
        });
    });
</script>
