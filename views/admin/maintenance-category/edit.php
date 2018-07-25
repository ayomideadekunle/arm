<?php 
$edit_data = $this->mntcCatData;
foreach ($edit_data as $value) {
?>

<form role="form" method="post" action="<?php echo URL ?>landlord/editMaintenanceCat/<?php echo $value['id'];?>">
    <div class="box-body">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control categoryName" placeholder="Enter Category Name" name="categoryName" value="<?php echo $value['categoryName'];?>">
        </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" onclick="editCategory(<?php echo $value['id'];?>);">Submit</button>
    </div>
</form>

<?php } ?>