<?php
include 'AdminProfile.php';
include '../includes/db.php';
$sql="SELECT * FROM categories WHERE parent_category=0";
$result=$con->query($sql);
$category='';
$post_parent='';
//edit
if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$edit_id= (int)$_GET['edit'];
	$edit_sql="SELECT * FROM categories WHERE category_id='$edit_id'";
	$edit_result=$con->query($edit_sql);
	$edit_category=mysqli_fetch_assoc($edit_result);
}
//
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id= (int)$_GET['delete'];
	$sql="SELECT * FROM categories WHERE category_id='$delete_id'";
	$result=$con->query($sql);
	$category=mysqli_fetch_assoc($result);
	if($category['parent_category']==0){
		$sql="DELETE FROM categories WHERE parent_category='$delete_id' ";
		$con->query($sql);
	}
	$sql3="DELETE FROM categories WHERE category_id='$delete_id' ";
	$con->query($sql3);

	header("location: categories.php");
}



if(isset($_POST) && !empty($_POST)){
	$post_parent=$_POST['parent_category'];
	$category=$_POST['category_name'];
	$sqlform="SELECT * FROM categories WHERE category_name='$category' AND parent_category='$post_parent'";
	if (isset($_GET['edit'])) {
		$category_id = $edit_category['category_id'];
		$sqlform = "SELECT * FROM categories WHERE category_name='$category' AND parent_category='$post_parent' AND category_id = '$category_id' ";
	}
	$fresult=$con->query($sqlform);
	$count= mysqli_num_rows($fresult);


	if($category==''){
		echo "The category cannot be left blank";
	}
	elseif($count>0){
		echo "Category already exists in database";
	}
	else{
		$updatesql="INSERT INTO categories(category_name,parent_category) VALUES ('$category','$post_parent')";
		if (isset($_GET['edit'])) {
			$updatesql="UPDATE categories SET category_name = '$category', parent_category ='$post_parent' WHERE category_id = '$edit_id' ";
		}
		$con->query($updatesql);
		header("location:categories.php");
	}

}
$category_value='';
$parent_value=0;
if(isset($_GET['edit'])){
	$category_value=$edit_category['category_name'];
	$parent_value=$edit_category['parent_category'];
}else{
	if(isset($_POST)){
		$category_value=$category;
		$parent_value=$post_parent;
	}
}
?>
<h2 class="text-center">Categories</h2><hr>
<div class="row">
	<div class="col-md-6">
		<form class="form" action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
			<legend><?=((isset($_GET['edit']))?'Edit':'Add');?> Category</legend>
			<div class ="form-group">
				<label for="parent_category">Parent</label>
				<select class="form-control" name="parent_category" id="parent_category">
					<option value="0"<?=(($parent_value == 0)?' selected="selected"':''); ?>>Parent</option>
					<?php while($parent=mysqli_fetch_assoc($result)):?>
						<option value="<?=$parent['category_id'];?>"<?=(($parent_value == $parent['category_id'])?' selected="selected"':''); ?>><?=$parent['category_name'];?></option>	
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group">
				<label for="category_name">Category</label>
				<input type="text" class="form-control" id="category_name" name="category_name" value="<?=$category_value;?>">
			</div>
			<div class="form-group">
				<input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Category" class="btn btn-success">
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<table class ="table table-bordered table striped table-inverse">
			<thead>
				<th>Category</th><th>Parent</th><th></th>
			</thead>
			<tbody>
				<?php 
				$sql="SELECT * FROM categories WHERE parent_category=0";
				$result=$con->query($sql);
				while($parent=mysqli_fetch_assoc($result)):
					$parent_id= (int)$parent['category_id'];
				$sql2= "SELECT * FROM categories WHERE parent_category='$parent_id'";
				$child_result=$con->query($sql2);
				?>
				<tr class="bg-primary">
					<td><?=$parent['category_name'];?></td>
					<td>Parent</td>
					<td>
						<a href = "categories.php? edit=<?=$parent['category_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href = "categories.php? delete=<?=$parent['category_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a></td>

						<?php while($child=mysqli_fetch_assoc($child_result)):?>
							<tr class="bg-info">
								<td><?=$child['category_name'];?></td>
								<td><?=$parent['category_name'];?></td>
								<td>
									<a href = "categories.php? edit=<?=$child['category_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href = "categories.php? delete=<?=$child['category_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a></td>
								<?php endwhile;?>
							<?php endwhile;?>
						</tbody>
					</tr>
				</tr>

			</tbody>
		</table>
	</div>
</div>

