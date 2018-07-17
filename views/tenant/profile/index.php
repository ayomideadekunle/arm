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

            <form role="form" method="post" class="change_password">
                 <!--method="post" action="<?php echo URL; ?>landlord/change_pwd"-->
                <div class="box-body">

                    <div class="form-group">
                        <label for="prvpassword">Existing Password</label>
                        <input type="password" class="form-control prvpassword" placeholder="Existing Password" name="oldpassword">
                    </div>

                    <div class="form-group">
                        <label for="newpassword">Password</label>
                        <input type="password" class="form-control newpassword" placeholder="New Password" name="password">
                    </div>

                    <button type="submit">Save</button>

                </div>
            </form>

            <div id="success">
            </div>

            <div id="errorMessage">
            </div>

        </div><!-- /.box-body -->
    </div>

<?php }
?>

<script type="text/javascript">
    $(document).ready(function () {

        $(".change_password").submit(function () {
            var data = {
                oldpassword: $(".prvpassword").val(),
                password: $(".newpassword").val()
            }
            $.post("http://localhost/apartment-rental-mgt/landlord/change_pwd", data, function (response) {
                console.log(response)
            });
            return false;
        });
    });
</script>
