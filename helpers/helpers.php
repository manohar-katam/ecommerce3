<?php

function get_category($child_id){
	global $con;
	$id = $child_id;
	$sql = "SELECT p.category_id AS 'pid', p.category_name AS 'parent', c.category_id AS 'cid' , c.category_name AS 'child' 
       		FROM categories c 
       		INNER JOIN categories p 
       		ON c.parent_category = p.category_id 
       		WHERE c.category_id = '$id'";
    $query = $con->query($sql);
    $category = mysqli_fetch_array($query);

    return $category;
}




?>