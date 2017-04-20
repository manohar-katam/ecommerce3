<?php

include("../includes/db.php");

$product_id = $_POST['product_id'];

$pop_sql = "SELECT * FROM products WHERE product_id = '$product_id'";
$pop_query = mysqli_query($con, $pop_sql);

$product = mysqli_fetch_array($pop_query);

$brand_id = $product['brand'];
$brand_sql = "SELECT brand FROM brand WHERE brand_id = '$brand_id'";
$brand_query = mysqli_query($con, $brand_sql);

$brand = mysqli_fetch_array($brand_query);

$sizestring = $product['sizes'];
$size_array = explode(',', $sizestring);
?>


<?php ob_start(); ?> <!-- Buffer start -->

<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden ="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button class="close" type="button" onclick="closeModal();" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center"><?= $product['title']; ?></h4>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                <span id="modal_errors" class="bg-danger"></span>
                    <div class="col-sm-6">
                        <div class="center-block">
                            <img src="<?= $product['image']; ?>" class="details img-responsive" alt="<?= $product['title']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>Details:</h4>
                        <p><?= $product['description']; ?></p>
                        <hr>
                        <p> Price: <strong><?= $product['price']; ?></strong> </p>
                        <p> Brand: <?= $brand['brand']; ?></p>

                        <form action="add_to_cart.php" method="POST" id="add_product_form">
                        <input type="hidden" name="product_id" value="<?=$product_id ?>">
                        <input type="hidden" name="available" id="available" value="">
                            <div class="form-group" >
                                <div class="col-xs-3">
                                    <label for="quantity">Quantity:</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity">
                                    </div><div class="col-xs-9"></div>
                                   
                                </div><br><br>
                                <div class="form-group">
                                    <label for="size"> Size & Availability:</label>
                                    <select name="size" id="size" class="form-control">

                                    <option value=""></option>
                                    <?php foreach($size_array as $string){
                                        $string_array = explode(':', $string);
                                        $size = $string_array[0];
                                        $available = $string_array[1];
                                        if($available == 0){
                                            echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' (Stock Out)</option>';
                                        }else{
                                        echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.' Available)</option>';
                                        }
                                        } ?>
        
                                    </select>
                                </div><br>
                                <div class="form-group">
                                <label for="frequency"> Select this option only if your subscribing this product:</label>
                                <select id="frequency" name="frequency" class="form-control"> 
                                       <option value="1">Every 1 Month (by default)</option>
                                        <option value="2">Every 2 Months</option>
                                        <option value="4">Every 4 Months</option>
                                        <option value="6">Every 6 Months</option>
                                       
                                </select>
                                </div>
                                 </form>
                            </div>
                      
                    </div>
                </div>
            </div>
             <div class="modal-footer">
            <button class="btn btn-default" onclick="closeModal();" >Close</button>
            <button class="btn btn-danger" id="add_to_cart" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button>
            <button class="btn btn-warning" id="add_to_subscription" onclick="add_to_subscription();return false;"><span class="glyphicon glyphicon-refresh"></span> Add to Subscriptions</button>
        </div>
        </div>
       
    </div>
    </div>

    <script type="text/javascript">

    jQuery('#size').change(function(){
        var available = jQuery('#size option:selected').data("available");
        jQuery('#available').val(available);
    });
    
        function closeModal(){
            jQuery('#details-modal').modal('hide');
            setTimeout(function(){
                jQuery('#details-modal').remove();
                jQuery('.modal-backdrop').remove();
                jQuery('body').removeClass('modal-open');
            },0);
        }
    </script> 
    <?php echo ob_get_clean(); ?>