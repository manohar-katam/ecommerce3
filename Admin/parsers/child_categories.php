<!-- <?php
include '../../includes/db.php';
$parentID = (int)$_POST['parentID'];
$childQuery = $con->query("SELECT * FROM categories WHERE parent_category = '$parentID' ORDER BY category_name");
ob_start(); ?>
 <option value =""></option>
 <?php while($child = mysqli_fetch_assoc($childQuery)); ?>
 <option value="<?=$child['category_id'];?>"><?=$child['category_name'];?></option>
 <?php endwhile; ?>
 
<?php echo ob_get_clean(); ?> -->