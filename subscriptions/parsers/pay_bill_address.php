<?php
include 'includes/db.php';
//include 'includes/UserPane.php';
$c_id = $_SESSION['c_id'];
//$c_id= (isset($_SESSION["edit_id"]) && !empty($_SESSION["edit_id"]))?$_SESSION["edit_id"]:$_SESSION['c_id'];

?>
<div class="container">
  <div class="col-sm-3">
    
  
<?php
$sql="SELECT * FROM customer_details WHERE cus_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_details WHERE cus_detail_id='$delete_id'";
  $con->query($sql);

   header("location: ../../subscriptions.php");
}

$results=$con->query($sql);

if(isset($_GET['add']) ||isset($_GET['edit'])){

  $cus_fullname=((isset($_POST['cus_fullname']) && $_POST['cus_fullname']!='')?$_POST['cus_fullname']:'');
  $cus_address=((isset($_POST['cus_address']) && $_POST['cus_address']!='')?$_POST['cus_address']:'');
  $cus_city=((isset($_POST['cus_city']) && $_POST['cus_city']!='')?$_POST['cus_city']:'');
  $cus_state=((isset($_POST['cus_state']) && $_POST['cus_state']!='')?$_POST['cus_state']:'');
  $cus_zipcode=((isset($_POST['cus_zipcode']) && $_POST['cus_zipcode']!='')?$_POST['cus_zipcode']:'');
  $cus_mobile=((isset($_POST['cus_mobile']) && $_POST['cus_mobile']!='')?$_POST['cus_mobile']:'');



  if(isset($_GET['edit'])){

    $edit_id=(int)$_GET['edit'];
    $detailresults=$con->query("SELECT * FROM customer_details WHERE cus_detail_id='$edit_id'");
    $details=mysqli_fetch_assoc($detailresults);
    $cus_fullname=((isset($_POST['cus_fullname']) && $_POST['cus_fullname']!='')?$_POST['cus_fullname']:$details['cus_fullname']);
    $cus_address=((isset($_POST['cus_address']) && $_POST['cus_address']!='')?$_POST['cus_address']:$details['cus_address']);
    $cus_city=((isset($_POST['cus_city']) && $_POST['cus_city']!='')?$_POST['cus_city']:$details['cus_city']);
    $cus_state=((isset($_POST['cus_state']) && $_POST['cus_state']!='')?$_POST['cus_state']:$details['cus_state']);
    $cus_zipcode=((isset($_POST['cus_zipcode']) && $_POST['cus_zipcode']!='')?$_POST['cus_zipcode']:$details['cus_zipcode']);
    $cus_mobile=((isset($_POST['cus_mobile']) && $_POST['cus_mobile']!='')?$_POST['cus_mobile']:$details['cus_mobile']);

   
    }

  if($_POST){

    $cus_fullname=$_POST['cus_fullname'];
    $cus_address=$_POST['cus_address'];
    $cus_city=$_POST['cus_city'];
    $cus_state=$_POST['cus_state'];
    $cus_zipcode=$_POST['cus_zipcode'];
    $cus_mobile=$_POST['cus_mobile'];

    // $tax_sql = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state'");
    // $tax_rate = mysqli_fetch_assoc($tax_sql);
    // $state_tax = $tax_rate['state_tax'];

    $sql="INSERT INTO customer_details (cus_id, cus_fullname, cus_address, cus_city, cus_state, cus_zipcode, cus_mobile) VALUES ('$c_id', '$cus_fullname', '$cus_address', '$cus_city', '$cus_state', '$cus_zipcode', '$cus_mobile')";
    if(isset($_GET['edit'])){
      $sql="UPDATE customer_details SET cus_fullname='$cus_fullname', cus_address='$cus_address', cus_city='$cus_city', cus_state='$cus_state', cus_zipcode='$cus_zipcode', cus_mobile='$cus_mobile' WHERE cus_detail_id='$edit_id'";
    }
    $con->query($sql);

    header("location: ../../subscriptions.php");
  }

?>


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Shipping Address</h2><hr>
<div class="col-sm-4">
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="subscriptions/parsers/ship_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
        <div class="form-group">
          <label class="col-lg-3 control-label">Full name:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_fullname" name="cus_fullname" value="<?php echo "$cus_fullname"; ?>" >
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Road No./Apt No.:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_address" name="cus_address" value="<?php echo "$cus_address"; ?>">
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-3 control-label">City:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_city" name="cus_city" value="<?php echo "$cus_city"; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">State:</label>
          <div class="col-lg-8">
            <div class="ui-select">
              <select id="cus_state" name="cus_state" class="form-control"> 
                <option ><?php echo $cus_state; ?></option>
                <option value="TX">TX</option>
                <option value="CA">CA</option>
                <option value="IL">IL</option>
                <option value="FL">FL</option>
                <option value="IN">IN</option>
                <option value="MI">MI</option>
                <option value="MA">MA</option>
                <option value="CO">CO</option>
                <option value="NY">NY</option>
                <option value="OH">OH</option>
              </select>
            </div>
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-3 control-label">Zip Code:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_zipcode" name="cus_zipcode" value="<?php echo "$cus_zipcode"; ?>">
          </div>
        </div> 
         <div class="form-group">
          <label class="col-lg-3 control-label">Mobile Number:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_mobile" name="cus_mobile" value="<?php echo "$cus_mobile"; ?>">
          </div>
        </div>
       
        <div class="form-group pull-right">
         <a href="delivery_address.php" class="btn btn-default">Cancel</a>
         <input type="submit" value=<?=(isset($_GET['edit']))?'Edit':'Add ';?> Shipping Address" class=" btn btn-success">
      </div><div class="clearfix"></div> 
      </form>
    </div>
  </div>
</div>


<?php }
else{
  ?>
  
      <hr>
      <div class="container">
       <div class="col-xs-6 col-md-offset-3">
        <div class="row">
       <a href="subscriptions/parsers/ship_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Shipping Address</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>SHIPPING ADDRESS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
            <tr>
            <td>
                <span><form action="subscriptions.php?subscription_add_id=<?=$subscription_id?>" method="POST" enctype="multipart/form-data">
                <input type="radio" class="form-check-input" name="tax_id" id="tax_id" <?php if (isset($_POST['tax_id']) && $_POST['tax_id'] == $cusdetails['cus_detail_id']) echo ' checked="checked"'; ?> value="<?=$cusdetails['cus_detail_id'];?>">
                <!-- <input type="radio" class="form-check-input" name="tax_id" id="tax_id"> -->
                
              
                
                  </span><span class="pull-right"> <a href="subscriptions/parsers/ship_details.php?edit=<?=$cusdetails['cus_detail_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>   <a href="subscriptions/parsers/ship_details.php?delete=<?=$cusdetails['cus_detail_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></span>
            <?=$cusdetails['cus_fullname']?><br><?=$cusdetails['cus_address']?><br><?=$cusdetails['cus_city']?><br><?=$cusdetails['cus_state']?><br><?=$cusdetails['cus_zipcode']?><br><?=$cusdetails['cus_mobile']?></td>
           </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
      <?php }
?>
</div>

<?php

$sql="SELECT * FROM customer_pay WHERE c_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_pay WHERE c_pay_id='$delete_id'";
  $con->query($sql);

 header("location: ../../subscriptions.php");
}

$results=$con->query($sql);

if(isset($_GET['add']) ||isset($_GET['edit'])){

  $c_nameOnCard=((isset($_POST['c_nameOnCard']) && $_POST['c_nameOnCard']!='')?$_POST['c_nameOnCard']:'');
  $c_card=((isset($_POST['c_card']) && $_POST['c_card']!='')?$_POST['c_card']:'');
  $c_expiryMonth=((isset($_POST['c_expiryMonth']) && $_POST['c_expiryMonth']!='')?$_POST['c_expiryMonth']:'');
  $c_expiryYear=((isset($_POST['c_expiryYear']) && $_POST['c_expiryYear']!='')?$_POST['c_expiryYear']:'');
  

  if(isset($_GET['edit'])){

    $edit_id=(int)$_GET['edit'];
    $detailresults=$con->query("SELECT * FROM customer_pay WHERE c_pay_id='$edit_id'");
    $details=mysqli_fetch_assoc($detailresults);
    $c_nameOnCard=((isset($_POST['c_nameOnCard']) && $_POST['c_nameOnCard']!='')?$_POST['c_nameOnCard']:$details['c_nameOnCard']);
    $c_card=((isset($_POST['c_card']) && $_POST['c_card']!='')?$_POST['c_card']:$details['c_card']);
    $c_expiryMonth=((isset($_POST['c_expiryMonth']) && $_POST['c_expiryMonth']!='')?$_POST['c_expiryMonth']:$details['c_expiryMonth']);
    $c_expiryYear=((isset($_POST['c_expiryYear']) && $_POST['c_expiryYear']!='')?$_POST['c_expiryYear']:$details['c_expiryYear']);
    
    }

  if($_POST){

    $c_nameOnCard=$_POST['c_nameOnCard'];
    $c_card=$_POST['c_card'];
    $c_expiryMonth=$_POST['c_expiryMonth'];
    $c_expiryYear=$_POST['c_expiryYear'];
    

    $sql="INSERT INTO customer_pay (c_id, c_nameOnCard, c_card, c_expiryMonth, c_expiryYear) VALUES ('$c_id', '$c_nameOnCard', '$c_card', '$c_expiryMonth', '$c_expiryYear')";
    if(isset($_GET['edit'])){
      $sql="UPDATE customer_pay SET c_nameOnCard='$c_nameOnCard', c_card='$c_card', c_expiryMonth='$c_expiryMonth', c_expiryYear='$c_expiryYear' WHERE c_pay_id='$edit_id'";
    }
    $con->query($sql);

header("location: ../../subscriptions.php");
  }

?>

<div class="col-sm-4">
<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Card Details</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="subscriptions/parsers/pay_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
       <div class="form-group">
          <label class="col-lg-3 control-label">Name On Card:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="c_nameOnCard" name="c_nameOnCard" value="<?php echo "$c_nameOnCard"; ?>" >
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Credit/Debit Card No.:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="c_card" name="c_card" value="<?php echo "$c_card"; ?>" >
          </div>
        </div>
          <div class="form-group">
        <label class="col-sm-3 control-label" for="expiry-month">Expiration Date:</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-xs-3">
              <select class="form-control col-sm-2" name="c_expiryMonth" id="c_expiryMonth">
                <option ><?php echo $c_expiryMonth; ?></option>
                <option value="01">Jan  (01)</option>
                <option value="02">Feb  (02)</option>
                <option value="03">Mar  (03)</option>
                <option value="04">Apr  (04)</option>
                <option value="05">May  (05)</option>
                <option value="06">June (06)</option>
                <option value="07">July (07)</option>
                <option value="08">Aug  (08)</option>
                <option value="09">Sep  (09)</option>
                <option value="10">Oct  (10)</option>
                <option value="11">Nov  (11)</option>
                <option value="12">Dec  (12)</option>
              </select>
            </div>
            <div class="col-xs-3">
              <select class="form-control" name="c_expiryYear" id="c_expiryYear">
                <option ><?php echo $c_expiryYear; ?></option>
                <option value="17">2017</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
                <option value="13">2024</option>
                <option value="14">2025</option>
                <option value="15">2026</option>
                <option value="16">2027</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group pull-right">
         <a href="pay_bill_details.php" class="btn btn-default">Cancel</a>
         <input type="submit" value=<?=(isset($_GET['edit']))?'Edit':'Add ';?> Card Details" class=" btn btn-success">
      </div><div class="clearfix"></div> 
      </form>
    </div>
  </div>
</div>

 
<?php }
else{
  ?>
  <hr>
      <div class="container">
       <div class="col-xs-6 col-md-offset-3">
        <div class="row">
       <a href="subscriptions/parsers/pay_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Payment Details</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>CARD DETAILS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td>
            <span>
                 <input type="radio" class="form-check-input" name="pay_id" id="pay_id" <?php if (isset($_POST['pay_id']) && $_POST['pay_id'] == $cusdetails['c_pay_id']) echo ' checked="checked"'; ?> value="<?=$cusdetails['c_pay_id'];?>" >
                <!-- <input type="radio" class="form-check-input" name="tax_id" id="tax_id"> -->
                
              
                
                  </span><span class="pull-right"> <a href="subscriptions/parsers/pay_details.php?edit=<?=$cusdetails['c_pay_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>   <a href="subscriptions/parsers/pay_details.php?delete=<?=$cusdetails['c_pay_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></span>
            <?=$cusdetails['c_nameOnCard'];?><br><?=$cusdetails['c_card'];?><br><?=$cusdetails['c_expiryMonth'];?>/<?=$cusdetails['c_expiryYear'];?></td>
        
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

    </div>
  </div>
  </div>
  

      <?php }


?>
</div>
<?php 

$sql="SELECT * FROM customer_bill WHERE cust_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_bill WHERE cust_bill_id='$delete_id'";
  $con->query($sql);

  header("location: ../../subscriptions.php");
}

$results=$con->query($sql);

if(isset($_GET['add']) ||isset($_GET['edit'])){

  $cust_billname=((isset($_POST['cust_billname']) && $_POST['cust_billname']!='')?$_POST['cust_billname']:'');
  $cust_billadd=((isset($_POST['cust_billadd']) && $_POST['cust_billadd']!='')?$_POST['cust_billadd']:'');
  $cust_billcity=((isset($_POST['cust_billcity']) && $_POST['cust_billcity']!='')?$_POST['cust_billcity']:'');
  $cust_billstate=((isset($_POST['cust_billstate']) && $_POST['cust_billstate']!='')?$_POST['cust_billstate']:'');
  $cust_billzipcode=((isset($_POST['cust_billzipcode']) && $_POST['cust_billzipcode']!='')?$_POST['cust_billzipcode']:'');
  $cust_billmobile=((isset($_POST['cust_billmobile']) && $_POST['cust_billmobile']!='')?$_POST['cust_billmobile']:'');

  if(isset($_GET['edit'])){

    $edit_id=(int)$_GET['edit'];
    $detailresults=$con->query("SELECT * FROM customer_bill WHERE cust_bill_id='$edit_id'");
    $details=mysqli_fetch_assoc($detailresults);
    $cust_billname=((isset($_POST['cust_billname']) && $_POST['cust_billname']!='')?$_POST['cust_billname']:$details['cust_billname']);
    $cust_billadd=((isset($_POST['cust_billadd']) && $_POST['cust_billadd']!='')?$_POST['cust_billadd']:$details['cust_billadd']);
    $cust_billcity=((isset($_POST['cust_billcity']) && $_POST['cust_billcity']!='')?$_POST['cust_billcity']:$details['cust_billcity']);
    $cust_billstate=((isset($_POST['cust_billstate']) && $_POST['cust_billstate']!='')?$_POST['cust_billstate']:$details['cust_billstate']);
    $cust_billzipcode=((isset($_POST['cust_billzipcode']) && $_POST['cust_billzipcode']!='')?$_POST['cust_billzipcode']:$details['cust_billzipcode']);
    $cust_billmobile=((isset($_POST['cust_billmobile']) && $_POST['cust_billmobile']!='')?$_POST['cust_billmobile']:$details['cust_billmobile']);
    }

  if($_POST){

    $cust_billname=$_POST['cust_billname'];
    $cust_billadd=$_POST['cust_billadd'];
    $cust_billcity=$_POST['cust_billcity'];
    $cust_billstate=$_POST['cust_billstate'];
    $cust_billzipcode=$_POST['cust_billzipcode'];
    $cust_billmobile=$_POST['cust_billmobile'];

    $sql="INSERT INTO customer_bill (cust_id, cust_billname, cust_billadd, cust_billcity, cust_billstate, cust_billzipcode, cust_billmobile) VALUES ('$c_id', '$cust_billname', '$cust_billadd', '$cust_billcity', '$cust_billstate', '$cust_billzipcode', '$cust_billmobile')";
    if(isset($_GET['edit'])){
      $sql="UPDATE customer_bill SET cust_billname='$cust_billname', cust_billadd='$cust_billadd', cust_billcity='$cust_billcity', cust_billstate='$cust_billstate', cust_billzipcode='$cust_billzipcode', cust_billmobile='$cust_billmobile' WHERE cust_bill_id='$edit_id'";
    }
    $con->query($sql);

    header("location: ../../subscriptions.php");
  }

?>

<div class="col-sm-4">
<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Billing Address</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="subscriptions/parsers/bill_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
        <div class="form-group">
          <label class="col-lg-3 control-label">Full name:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cust_billname" name="cust_billname" value="<?php echo "$cust_billname"; ?>" >
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Road No./Apt No.:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cust_billadd" name="cust_billadd" value="<?php echo "$cust_billadd"; ?>">
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-3 control-label">City:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cust_billcity" name="cust_billcity" value="<?php echo "$cust_billcity"; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">State:</label>
          <div class="col-lg-8">
            <div class="ui-select">
              <select id="cust_billstate" name="cust_billstate" class="form-control"> 
                <option ><?php echo $cust_billstate; ?></option>
                <option value="Texas">Texas</option>
                <option value="California">California </option>
                <option value="Illinois">Illinois</option>
                <option value="Florida">Florida </option>
                <option value="Indiana">Indiana</option>
                <option value="Michigan">Michigan </option>
                <option value="Maryland">Maryland</option>
                <option value="Colorado">Colorado </option>
                <option value="Newyork">Newyork</option>
                <option value="Ohio">Ohio </option>
              </select>
            </div>
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-3 control-label">Zip Code:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cust_billzipcode" name="cust_billzipcode" value="<?php echo "$cust_billzipcode"; ?>">
          </div>
        </div> 
         <div class="form-group">
          <label class="col-lg-3 control-label">Mobile Number:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cust_billmobile" name="cust_billmobile" value="<?php echo "$cust_billmobile"; ?>">
          </div>
        </div>

      <div class="form-group pull-right">
         <a href="pay_bill_details.php" class="btn btn-default">Cancel</a>
         <input type="submit" value=<?=(isset($_GET['edit']))?'Edit':'Add ';?> Billing Address" class=" btn btn-success">
      </div><div class="clearfix"></div> 
      </form>
    </div>
  </div>
</div>


<?php }
else{
  ?>
  <hr>
      <div class="container">
        <div class="col-xs-6 col-md-offset-3">
        <div class="row">
       <a href="subscriptions/parsers/bill_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Billing Address</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>BILLING ADDRESS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td>
               <span>
                 <input type="radio" class="form-check-input" name="bill_id" id="bill_id" <?php if (isset($_POST['bill_id']) && $_POST['bill_id'] == $cusdetails['cust_bill_id']) echo ' checked="checked"'; ?> value="<?=$cusdetails['cust_bill_id'];?>" >
                <!-- <input type="radio" class="form-check-input" name="tax_id" id="tax_id"> -->
                
              
                
                  </span><span class="pull-right"> <a href="subscriptions/parsers/bill_details.php?edit=<?=$cusdetails['cust_bill_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>   <a href="subscriptions/parsers/bill_details.php?delete=<?=$cusdetails['cust_bill_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></span>
            <?=$cusdetails['cust_billname']?><br><?=$cusdetails['cust_billadd']?><br><?=$cusdetails['cust_billcity']?><br><?=$cusdetails['cust_billstate']?><br><?=$cusdetails['cust_billzipcode']?><br><?=$cusdetails['cust_billmobile']?></td>
      
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

    </div>
  </div>
  </div>
  
      <?php }


?>
</div>

</div>
</div>
