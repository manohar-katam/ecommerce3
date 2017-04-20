<?php
session_start();
include 'includes/db.php';
//include 'includes/UserPane.php';
$c_id = $_SESSION['c_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> E- CART</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE = edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  
  <script src="js/jquery2.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>


<?php 

$sql="SELECT * FROM customer_details WHERE cus_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_details WHERE cus_detail_id='$delete_id'";
  $con->query($sql);

  header("location: account.php");
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

    $sql="INSERT INTO customer_details (cus_id, cus_fullname, cus_address, cus_city, cus_state, cus_zipcode, cus_mobile) VALUES ('$c_id', '$cus_fullname', '$cus_address', '$cus_city', '$cus_state', '$cus_zipcode', '$cus_mobile')";
    if(isset($_GET['edit'])){
      $sql="UPDATE customer_details SET cus_fullname='$cus_fullname', cus_address='$cus_address', cus_city='$cus_city', cus_state='$cus_state', cus_zipcode='$cus_zipcode', cus_mobile='$cus_mobile' WHERE cus_detail_id='$edit_id'";
    }
    $con->query($sql);

    header("location: account.php");
  }

?>


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Shipping Address</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="ship_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
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
         <a href="account.php" class="btn btn-default">Cancel</a>
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
        <div class="row">
       <a href="ship_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Shipping Address</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>SHIPPING ADDRESS</th><th>ACTIONS</th><th>ACTIONS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td><?=$cusdetails['cus_fullname']?><br><?=$cusdetails['cus_address']?><br><?=$cusdetails['cus_city']?><br><?=$cusdetails['cus_state']?><br><?=$cusdetails['cus_zipcode']?><br><?=$cusdetails['cus_mobile']?></td>
            <td>
              <a href="ship_details.php?edit=<?=$cusdetails['cus_detail_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span>EDIT</a>
            </td>
            <td>
              <a href="ship_details.php?delete=<?=$cusdetails['cus_detail_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span>DELETE</a>
            </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

    </div>
  </div>
      <?php }


?>