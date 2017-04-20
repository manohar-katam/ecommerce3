<?php

include("includes/db.php");

$category_sql = "SELECT * FROM categories WHERE parent_category = 0";
$category_query = mysqli_query($con, $category_sql);

?>

<div class="row row3" id="loadCategories" style="text-align: left">
   <?php while ($parent = mysqli_fetch_array($category_query)): ?>
   <?php $parent_id = $parent['category_id']; ?>                 
           <li class="upper-links dropdown"><a class="links" href=""> <?php echo $parent['category_name'];
           $category_sql2 = "SELECT * FROM categories WHERE parent_category = $parent_id";
           $category_query2 = mysqli_query($con, $category_sql2); 
            ?> 
            <span class="caret"></a>
                    <ul class="dropdown-menu">
                    <?php while ($child = mysqli_fetch_array($category_query2)): ?>
                   <li class="profile-li"><a class="profile-links" href="category.php?cat=<?=$child['category_id'];?>"> <?php echo $child['category_name']; ?></a></li>
                   
                   <?php endwhile; ?>
                    </ul>
                </li>
               <?php endwhile; ?>
                  
</div>
