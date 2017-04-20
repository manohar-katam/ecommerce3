<?php
session_start();
include '../../includes/db.php';
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
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/styles.css">
  
  <script src="../../js/jquery2.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/script.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

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


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Billing Address</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="bill_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
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
         <a href="../../subscriptions.php" class="btn btn-default">Cancel</a>
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
        <div class="row">
       <a href="bill_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Billing Address</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>BILLING ADDRESS</th><th>ACTIONS</th><th>ACTIONS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td><?=$cusdetails['cust_billname']?><br><?=$cusdetails['cust_billadd']?><br><?=$cusdetails['cust_billcity']?><br><?=$cusdetails['cust_billstate']?><br><?=$cusdetails['cust_billzipcode']?><br><?=$cusdetails['cust_billmobile']?></td>
            <td>
              <a href="bill_details.php?edit=<?=$cusdetails['cust_bill_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span>EDIT</a>
            </td>
            <td>
              <a href="bill_details.php?delete=<?=$cusdetails['cust_bill_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span>DELETE</a>
            </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

    </div>
  </div>
      <?php }


?>