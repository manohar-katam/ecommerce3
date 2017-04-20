<?php
include '../includes/db.php';
$query= "select * from customers where customer_type=0;";
$run_query = mysqli_query($con,$query);
if (isset($_GET['delete'])) {
	$_SESSION["delete_id"] =  $_GET['delete'];
	//$deletequery="delete from customers where customer_id='$delete_id';";
	//$run= mysqli_query($con,$deletequery);
	//header('location:UserProfiles.php');
	header('location:../delete_account.php');

}
if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$_SESSION['edit_id']=$_GET['edit'];
	header('location:AdminEditOptions.php');
	//header('location:../../account.php');
	exit();
}
?>


<h2 class="text-center">Customer Details</h2>
<table class="table table-bordered table-striped table-condensed">
	<thead><th>Delete Customer</th><th>Edit Customer</th><th>Customer ID</th><th>Customer Name</th><th>Email</th></thead>
	<tbody>
		<?php while($Users= mysqli_fetch_array($run_query)): ?>
			<tr>
				<td>
					<a href="getUsers.php?delete=<?=$Users['customer_id'] ?>" class="btn btn-default btn-xs"><span class="btn btn-danger btn-xs">Delete</span>
					</td>
					<td>
						<a href="getUsers.php?edit=<?=$Users['customer_id']?>" class="btn btn-default btn-xs" ><span class="glyphicon glyphicon-pencil"> EDIT</span></a>
					</td>
					<td><?=$Users["customer_id"] ?></td>
					<td><?=$Users["customer_name"] ?></td>
					
					<td><?=$Users["customer_email"] ?></td>

				</tr>
			<?php endwhile;?>
		</tbody>
	</table>
