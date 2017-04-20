<?php
include 'AdminProfile.php';
include '../includes/db.php';
$sql= "SELECT * FROM brand ORDER BY brand";
$result = $con->query($sql);
if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$edit_id=(int)$_GET['edit'];
	$sql2="SELECT * FROM brand WHERE brand_id='$edit_id'";
	$edit_result=$con->query($sql2);
	$editbrand= mysqli_fetch_assoc($edit_result);
}
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id=(int)$_GET['delete'];
	$sql="DELETE FROM brand WHERE brand_id='$delete_id'";
	$con->query($sql);
	header("location: brands.php");
}

if(isset($_POST['add_submit'])){
    $brand=$_POST['brand'];

// check if brand is blank
	if($_POST['brand'] == ''){
		echo "Please enter a brand name";
	}
//check if brand exists in database
	$sql= "SELECT * FROM brand WHERE brand='$brand'";
	if(isset($_GET['edit'])){
	$sql="SELECT * FROM brand WHERE brand='$brand' AND brand_id!='$edit_id'";
	}
	$result=$con->query($sql);
	$count=mysqli_num_rows($result);
	// if exists
	if ($count > 0) {
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b>$brand already exists, Please enter a new brand !!!</b>
		</div>
		";
		exit();
	}
	else{
	$sql="INSERT INTO brand(brand) VALUES('$brand')";
	if(isset($_GET['edit'])){
		$sql="UPDATE brand SET brand='$brand' WHERE brand_id='$edit_id'";
	}
	$run_query = mysqli_query($con, $sql);
	header("location: brands.php");
	}
}
?>

<h2 class="text-center">Brands </h2><hr>
<div class ="text-center">
<form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
<div class="form-group">
<?php
$brand_value= '';
if(isset($_GET['edit'])){
	$brand_value=$editbrand['brand'];
	}else{
		if(isset($_POST['brand'])){
			$brand_value=$_POST['brand'];
		}
		} ?>
<label for="brand"><?=(isset($_GET['edit']))?'Edit ':'Add ';?>  brand :</label>

<input type= "text" name="brand" id="brand" class="form-control" value="<?=$brand_value;?>">
<?php if(isset($_GET['edit'])):?>
<a href="brands.php" class="btn btn-default">Cancel</a>

<?php endif;?>
<input type= "submit" name="add_submit" value="<?=(isset($_GET['edit']))?'Edit ':'Add ';?>brand " class= " btn btn-success" >
</div>
</form>
</div><hr>
<table class="table table-bordered table-stripped table-auto">
	<thead>
		<th></th><th>Brand</th><th></th>
	</thead>
	<tbody>
	<?php while ( $brand = mysqli_fetch_array($result)):  ?>
		<tr>
			 <td><a href = "brands.php?edit=<?= $brand['brand_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span> EDIT</a></td>
			<td><?=$brand['brand'];?></td>
			<td><a href ="brands.php?delete=<?= $brand['brand_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> DELETE</a></td> 
		</tr>
	<?php endwhile; ?>
</tbody>
</table>

