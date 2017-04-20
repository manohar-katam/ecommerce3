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


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Card Details</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="pay_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
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
         <a href="../../subscriptions.php" class="btn btn-default">Cancel</a>
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
        <div class="row">
       <a href="pay_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Payment Details</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>CARD DETAILS</th><th>ACTIONS</th><th>ACTIONS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
          <tr>
            <td><?=$cusdetails['c_nameOnCard']?><br><?=$cusdetails['c_card']?><br><?=$cusdetails['c_expiryMonth']?>/<?=$cusdetails['c_expiryYear']?></td>
            <td>
              <a href="pay_details.php?edit=<?=$cusdetails['c_pay_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span>EDIT</a>
            </td>
            <td>
              <a href="pay_details.php?delete=<?=$cusdetails['c_pay_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span>DELETE</a>
            </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

    </div>
  </div>
      <?php }


?>