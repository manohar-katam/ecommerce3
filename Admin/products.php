<?php
include 'AdminProfile.php';
include '../includes/db.php';
include 'parsers/header.php';

$sql="SELECT * FROM products WHERE deleted=0";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id=(int)$_GET['delete'];
	$sql="DELETE FROM products WHERE product_id='$delete_id'";
	$con->query($sql);
	header("location: products.php");
}

$results=$con->query($sql);
if(isset($_GET['add']) ||isset($_GET['edit'])){
	$brandq=$con->query("SELECT * FROM brand");
	$parentq=$con->query("SELECT * FROM categories WHERE parent_category=0 ");
	$childq=$con->query("SELECT * FROM categories WHERE parent_category!=0 ");
	$title=((isset($_POST['title']) && $_POST['title']!='')?$_POST['title']:'');
	$brand=((isset($_POST['brand']) && !empty($_POST['brand']))?$_POST['brand']:'');
	$child=((isset($_POST['child']) && !empty($_POST['child']))?$_POST['child']:'');
	$parent=((isset($_POST['parent']) && !empty($_POST['parent']))?$_POST['parent']:'');
	$price=((isset($_POST['price']) && $_POST['price']!='')?$_POST['price']:'');
	$list_price=((isset($_POST['list_price']) && $_POST['list_price']!='')?$_POST['list_price']:'');
	$description=((isset($_POST['description']) && $_POST['description']!='')?$_POST['description']:'');
	$sizes=((isset($_POST['sizes']) && $_POST['sizes']!='')?$_POST['sizes']:'');
	$sizes=rtrim($sizes,", ");
	if(isset($_GET['edit'])){
		$edit_id=(int)$_GET['edit'];
		$productresults=$con->query("SELECT * FROM products WHERE product_id='$edit_id'");
		$eproduct=mysqli_fetch_assoc($productresults);
		$title=((isset($_POST['title']) && $_POST['title']!='')?$_POST['title']:$eproduct['title']);
		$brand=((isset($_POST['brand']) && $_POST['brand']!='')?$_POST['brand']:$eproduct['brand']);
		$child=((isset($_POST['child']) && $_POST['child']!='')?$_POST['child']:$eproduct['category']);
	//	$parent=((isset($_POST['parent']) && $_POST['parent']!='')?$_POST['parent']:$eproduct['category']);
		$price=((isset($_POST['price']) && $_POST['price']!='')?$_POST['price']:$eproduct['price']);
		$list_price=((isset($_POST['list_price']) && $_POST['list_price']!='')?$_POST['list_price']:$eproduct['list_price']);
		$description=((isset($_POST['description']) && $_POST['description']!='')?$_POST['description']:$eproduct['description']);
		$sizes=((isset($_POST['sizes']) && $_POST['sizes']!='')?$_POST['sizes']:$eproduct['sizes']);
		$sizes=rtrim($sizes,", ");
	}
	if(!empty($sizes)){
			$sizestring=$sizes;
			$sizestring=rtrim($sizestring,", ");
			//echo "$sizestring";
			$sizearray=explode(',',$sizestring);
			$sarray=array();
			$qtyarray=array();
			foreach($sizearray as $ss){
				$s=explode(':',$ss);
				$sarray[]=$s[0];
				$qtyarray[]=$s[1];
			}

		}else{$sizearray=array();}
	if($_POST){
		$required=array('title', 'brand');
		foreach($required as $field){
			if($_POST[$field]==''){
				echo"All fields are required";
				break;
			}
		}
		
	// if(!empty($_FILES)){
	// 	var_dump($_FILES);
	// 	$photo=$_FILES['photo'];
	// 	$name=$photo['name'];
	// 	$namearray=explode('.',$name);
	// 	$filename=$namearray[0];
	// 	$fileext=$namearray[1];
	// 	$mime=explode('/',$photo['type']);
	// 	$mimetype=$mime[0];
	// 	$mimeext=$mime[1];
	// 	$tmploc=$photo['tmp_name'];
	// 	$filesize=$photo['size'];
	// 	$uploadpath='/ecommerce2-master/images/';
	// 	$uploadname=md5(microtime()).'.'.$fileext;
	// 	$dbpath='/ecommerce2-master/images/'.$uploadname;
	// 	$allowed=array('png','jpg','jpeg','gif');
	// 	if($mimetype!='image'){
	// 		echo "The file must be an image";
	// 	}
	// 	if(!in_array($fileext,$allowed)){
	// 		echo "The file must be an acceptable extension";
	// 	}
	// 	if($filesize >5000000){
	// 		echo "The file must beunder 5 MB";
	// 	}
	// }
	// move_uploaded_file($tmploc,$uploadpath);
		if(isset($_FILES['photo'])){
			$file=$_FILES['photo'];
			$file_name=$file['name'];
			$file_temp=$file['tmp_name'];
			$file_size=$file['size'];
			$file_error=$file['error'];

			$file_ext=explode('.',$file_name);
			$file_ext=strtolower(end($file_ext));
			
					if($file_error==0){
						if($file_size<=10097152){
							$file_name_new=uniqid('',true).'.'.$file_ext;
							$file_destination='/uploads'.$file_name_new;
							if(move_uploaded_file($file_temp, $file_destination)){
								echo "Successful";
							}
						}echo "Size issue";
					}

			

		}

		$sql="INSERT INTO products (title,price,list_price,brand,sizes,description,category) VALUES ('$title','$price','$list_price','$brand','$sizes','$description', '$child')";
		if(isset($_GET['edit'])){
			$sql="UPDATE products SET title='$title',brand='$brand',price='$price',list_price='$list_price',description='$description',sizes='$sizes',category='$child' WHERE product_id='$edit_id'";
		}
		$con->query($sql);
		header("location: products.php");

	}
	?>
	<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit a' :'Add a New');?> Product</h2><hr>
	<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
		<div class= "form group col-md-3">
			<label for ="title">Title of the product:</label>
			<input type="text" name="title" class="form-control" id="title" value="<?=$title ?>">
		</div>
		<div class="form-group col-md-3">
			<label for ="brand">Brand:</label>
			<select class="form-control" id="brand" name="brand">
				<option value="" <?=(($brand=='')? 'selected': '');?>></option>
				<?php while($b=mysqli_fetch_assoc($brandq)): ?>
					<option value="<?=$b['brand_id'];?>"<?=(($brand==$b['brand_id'])?'selected' :'')?>><?=$b['brand'];?></option>
				<?php endwhile;?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for ="parent">Main Category:</label>
			<select class="form-control" id="parent" name="parent">
				<option value=""<?=(($parent=='')? 'selected': '');?>></option>
				<?php while($p=mysqli_fetch_assoc($parentq)): ?>
					<option value="<?=$p['category_id'];?>"<?=(($parent==$p['category_id'])?'selected' :'')?>><?=$p['category_name'];?></option>
				<?php endwhile;?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for ="child">Child Category:</label>
			<select class="form-control" id="child" name="child">
				<option value=""<?=(($child=='')? 'selected': '');?>></option>
				<?php while($c=mysqli_fetch_assoc($childq)): ?>
					<option value="<?=$c['category_id'];?>"<?=(($child==$c['category_id'])?'selected' :'')?>><?=$c['category_name'];?></option>
				<?php endwhile;?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for="price">Price:</label>
			<input type="text" id="price" name="price" class="form-control" value="<?=$price?>">
		</div>
		<div class="form-group col-md-3">
			<label for="price">List Price:</label>
			<input type="text" id="list_price" name="list_price" class="form-control" value="<?=$list_price?>">
		</div>
		<div class ="form-group col-md-3">
			<label>Quantity & Sizes:</label>  
			<button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
		</div>
		<div class="form-group col-md-3">
			<label for="sizes">Sizes & Qty Preview</label>
			<input type="text" class="form-control" name="sizes" id="sizes" value="<?=$sizes ?>" readonly>
		</div>
		<div class="form-group col-md-6">
			<label for="photo">Product Photo:</label>
			<input type="file" name="photo" id="photo" class="form-control">
		</div>
		<div class="form-group col-md-6">
			<label for="description">Description:</label>
			<textarea id="description" name="description" class="form-control" rows="6"><?=$description?></textarea>
		</div>
		<div class="form-group pull-right">
			<a href="products.php" class="btn btn-default">Cancel</a>
			<input type="submit" value=<?=(isset($_GET['edit']))?'Edit':'Add a';?> Product" class=" btn btn-success">
		</div><div class="clearfix"></div> 
	</form>
	<!-- Modal -->
	<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="sizesModalLabel">Quantity & Sizes:</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid"> 
						<?php for($i=1;$i<=12;$i++):?>
							<div class="form-group col-md-4">
								<label for="size<?=$i;?>">Size:</label>
								<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sarray[$i-1]))?$sarray[$i-1]:'');?>" class="form-control">
							</div>
							<div class="form-group col-md-2">
								<label for="qty<?=$i;?>">Qty:</label>
								<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qtyarray[$i-1]))?$qtyarray[$i-1]:'');?>" class="form-control">
							</div>
						<?php endfor;?>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
					</div>
				</div>
			</div>
		</div> 
		<?php }
		else{
			if(isset($_GET['featured'])){
				$id=(int)$_GET['product_id'];
				$featured=(int)$_GET['featured'];
				$fsql="UPDATE products SET featured ='$featured' WHERE product_id='$id' ";
				$con->query($sql);
			}
			?>
			<h2 class="text-center">Products</h2>
			<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Product</a><div class="clearfix"></div>


			<hr>
			<table class="table table-bordered table-condensed table-striped">
				<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th> Featured</th></thead>
				<tbody>
					<?php while($product=mysqli_fetch_assoc($results)): 
					$children=$product['category'];
					$csql="SELECT *  FROM categories WHERE category_id ='$children'";
					$result=$con->query($csql);
					$child= mysqli_fetch_assoc($result);
		 // $parent=$product['category'];
		 // // $psql="SELECT *  FROM categories WHERE  ='$parent'";
		 // // $result1=$con->query($csql);
		 // // $parent1=mysqli_fetch_assoc($result1);
					$category=$child['category_name'];
					?>
					<tr>
						<td>
							<a href="products.php?edit=<?=$product['product_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="products.php?delete=<?=$product['product_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
						<td><?=$product['title']?></td>
						<td><?=$product['price']?></td>
						<td><?=$category?></td>
						<td><a href="products.php?featured= <?=(($product['featured'] == 0)? '1' : '0');?> & product_id= <?=$product['product_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-<?=(($product['featured'] == 1)? 'minus' : 'plus');?>"></span> </a>
							&nbsp <?=(($product['featured'] == 1)? 'Featured' : 'Not Featured');?></td>
							
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<?php }
