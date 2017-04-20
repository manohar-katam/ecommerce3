<?php
include '../includes/db.php';
//include 'includes/UserPane.php';
$c_id = $_SESSION['c_id'];
//$c_id= (isset($_SESSION["edit_id"]) && !empty($_SESSION["edit_id"]))?$_SESSION["edit_id"]:$_SESSION['c_id'];

?>

<?php

$sql="SELECT * FROM customer_pay WHERE c_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_pay WHERE c_pay_id='$delete_id'";
  $con->query($sql);

 header("location: ../checkout.php");
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

 header("location: ../checkout.php");
  }

?>


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Card Details</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="parsers/pay_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
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
       <a href="parsers/pay_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Payment Details</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>CARD DETAILS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td>
            <span><form action="thankyou.php" method="POST" enctype="multipart/form-data">
                 <input type="radio" class="form-check-input" name="pay_id" id="pay_id" <?php if (isset($_POST['pay_id']) && $_POST['pay_id'] == $cusdetails['c_pay_id']) echo ' checked="checked"'; ?> value="<?=$cusdetails['c_pay_id'];?>" >
                <!-- <input type="radio" class="form-check-input" name="tax_id" id="tax_id"> -->
                
              
                
                  </span><span class="pull-right"> <a href="parsers/pay_details.php?edit=<?=$cusdetails['c_pay_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>   <a href="parsers/pay_details.php?delete=<?=$cusdetails['c_pay_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></span>
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

<?php 

$sql="SELECT * FROM customer_bill WHERE cust_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_bill WHERE cust_bill_id='$delete_id'";
  $con->query($sql);

  header("location: ../checkout.php");
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

   header("location: ../checkout.php");
  }

?>


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Billing Address</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="parsers/bill_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
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
       <a href="parsers/bill_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Billing Address</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>BILLING ADDRESS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td>
               <span>
                 <input type="radio" class="form-check-input" name="bill_id" id="bill_id" <?php if (isset($_POST['bill_id']) && $_POST['bill_id'] == $cusdetails['cust_bill_id']) echo ' checked="checked"'; ?> value="<?=$cusdetails['cust_bill_id'];?>" >
                <!-- <input type="radio" class="form-check-input" name="tax_id" id="tax_id"> -->
                
              
                
                  </span><span class="pull-right"> <a href="parsers/bill_details.php?edit=<?=$cusdetails['cust_bill_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>   <a href="parsers/bill_details.php?delete=<?=$cusdetails['cust_bill_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></span>
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



