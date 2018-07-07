<?php
$profile_data = $this->tenant_info;
?>

<div class="box box-primary">
    <div class="box-body box-profile">
        <!--<img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">-->
        <?php
        foreach ($profile_data as $value) {
            ?>
            <h3 class="profile-username text-center"><?php
                echo $_SESSION['fullname'];
                ?></h3>
            <p class="text-muted text-center"><?php echo $value['email']; ?></p>

            <form role="form" method="post" action="<?php echo URL; ?>landlord/change_pwd">
                 <!--method="post" action="<?php echo URL; ?>landlord/change_pwd"-->
                <div class="box-body">

                    <div class="form-group">
                        <label for="prvpassword">Password</label>
                        <input type="password" class="form-control prvpassword" placeholder="Existing Password" name="oldpassword">
                    </div>

                    <div class="form-group">
                        <label for="newpassword">Password</label>
                        <input type="password" class="form-control newpassword" placeholder="New Password" name="password">
                    </div>

                    <button type="submit" class="change_password">Save</button>

                </div>
            </form>

            <div id="success">
                <?php // echo $this->success_msg; ?>
            </div>

            <div id="errorMessage">
                <?php // echo $this->error_msg; ?>
            </div>

            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
        </div><!-- /.box-body -->
    </div>

<?php }
?>

<script type="text/javascript">

//    $(document).ready(function () {
//        $(".change_password").submit(function () {
//            var existing_pwd = $(".prvpassword").val();
//            var newpassword = $(".newpassword").val();
//            var hasError = false;
//
//            if (existing_pwd === '') {
//                $(".prvpassword").after('<span class="error">Please enter current password.</span>');
//                hasError = true;
//            } else if (newpassword === '') {
//                $(".newpassword").after('<span class="error">Please enter new password.</span>');
//                hasError = true;
//            }
//            if (hasError === true) {
//                return false;
//            }
//
//            if (hasError === false) {
//                $.ajax({
//                    type: "POST",
//                    url: "http://localhost/apartment-rental-mgt/landlord/change_pwd",
//                    data: {
//                        password: newpassword
//                    },
//                    success: function (response) {
////                        $('#success').html("<div id='message'></div>");
//                        $('#success').append("<h2>Password changed successfully!</h2>")
//                                .delay(3000).fadeOut(3000);
//                    },
//                    error: function (response) {
////                        $('#error').html("<div id='errorMessage'></div>");
//                        $('#errorMessage').html("<h3>Error, please try again!</h3>")
//                                .delay(2000).fadeOut(2000);
//                    }
//                });
//            }
//        });
//    });

</script>
