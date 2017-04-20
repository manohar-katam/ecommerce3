<?php   

include("includes/db.php");


$keywords = $_POST['search'];

$product_sql = "SELECT * FROM products WHERE description LIKE '%$keywords%' OR title LIKE '%$keywords%' ";
$product_query = mysqli_query($con, $product_sql);


?>

     <div class="row">
    <h3 style="text-align: center;"><strong>YOUR SEARCH RESULTS</strong> </h3>
    <?php while ($product = mysqli_fetch_array($product_query)): ?>
     <div class="col-sm-3">
            <article class="col-item">
                <div class="photo">
                    <a href="#" onclick="detailsmodal(<?= $product['product_id']; ?>)" data-toggle="modal" > <img src="<?= $product['image']; ?>" class="img-responsive" alt="<?= $product['title']; ?>" style=" height: 175px" /> </a>
                </div>
                <div class="info">
                    <div class="row">
                        <div class="price-details col-md-6">
                         <strong> <p> <?= $product['title'];  ?> </p> </strong>
                            <span class="list-price text-danger"><strong><s><?= $product['list_price']; ?></s></strong></span>
                            <span class="price-new"> <strong>$<?= $product['price']; ?></strong> </span>

                        </div>
                    </div>
                    <div class="pull-right">
                     
                          <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#addtocart">  <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm"> Add to cart</a></button>
                            <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#subscribe"> <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to your Subscriptions"><i class="fa fa-heart"></i> Subscribe</a></button>
                          
                      
                    </div>
                    <div class="clearfix"></div>
                </div>
            </article>

        </div>
        <?php endwhile; ?>
    </div>

   

<script type="text/javascript">   

    function detailsmodal(product_id){

      var data = {"product_id": product_id};
        jQuery.ajax({
            url     : "/ecommerce3/products/product_popup.php",
            method  : "POST",
            data    : data,
            success : function(data){
                
                jQuery('body').append(data);
                jQuery('#details-modal').modal('toggle');
            },
            error : function(){
                alert("Error");
            }

        });
    }

    function add_to_cart(){
            jQuery('modal_errors').html("");
            var size = jQuery('#size').val();
            var quantity = jQuery('#quantity').val();
            var available = jQuery('#available').val();
            var error = '';
            var data = jQuery('#add_product_form').serialize();
            if(size == '' || quantity == '' || quantity ==0){
                error += '<p class="text-danger text-center"> You must choose a size and quantity. </p>';
                jQuery('#modal_errors').html(error);
                return;
            }else if(quantity > available){
                error += '<p class="text-danger text-center"> There are only '+available+' available. </p>';
                jQuery('#modal_errors').html(error);
                return;
            }else{
                jQuery.ajax({
                    url: '/ecommerce3/cart/add_cart.php',
                    method : 'post',
                    data : data,
                    success : function(){
                        location.reload();
                    },
                    error : function(){
                        alert("error");
                    }
                });
            }
       }

       function add_to_subscription(){
            jQuery('modal_errors').html("");
            var size = jQuery('#size').val();
            var quantity = jQuery('#quantity').val();
            var available = jQuery('#available').val();
            var error = '';
            var data = jQuery('#add_product_form').serialize();
            if(size == '' || quantity == '' || quantity ==0){
                error += '<p class="text-danger text-center"> You must choose a size and quantity. </p>';
                jQuery('#modal_errors').html(error);
                return;
            }else if(quantity > available){
                error += '<p class="text-danger text-center"> There are only '+available+' available. </p>';
                jQuery('#modal_errors').html(error);
                return;
            }else{
                jQuery.ajax({
                    url: '/ecommerce3/subscriptions/add_subscription.php',
                    method : 'post',
                    data : data,
                    success : function(){
                        location.reload();
                    },
                    error : function(){
                        alert("error");
                    }
                });
            }
       }
                
 </script>   

<!--<?php   

//include("./includes/db.php");

//$product_sql = "SELECT * FROM products WHERE featured = 1";
//$product_query = mysqli_query($con, $product_sql);

//$rows = array();

//while ($row = mysqli_fetch_array($product_query)) {
//    $rows[] = $row;
//}

//echo json_encode($rows);

?> -->


