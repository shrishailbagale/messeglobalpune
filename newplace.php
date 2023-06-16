<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit3']))
{
  $placename=$_POST['placename'];
  $placedes=$_POST['placedes'];
   $price=$_POST['price'];
  $sql="insert into tblplace(PlaceName,PlaceDes,PlacePrice)values(:placename,:placedes,:price)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':placename',$placename,PDO::PARAM_STR);
  $query->bindParam(':placedes',$placedes,PDO::PARAM_STR);
   $query->bindParam(':price',$price,PDO::PARAM_STR);
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Place has been added.")</script>';
  }
  else
  {
   echo '<script>alert("Something Went Wrong. Please try again")</script>';
 }
}
?>
<div class="card-body">
  <h4 class="card-title">Add New Place </h4>
  <form class="forms-sample" method="post">
    <div class="form-group">
      <label for="exampleInputName1">Place Name</label>
      <input type="text" name="placename" class="form-control" id="servicename" placeholder="Place Name" required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Price</label>
      <input type="text" name="price" class="form-control" id="price" placeholder="Place Price" required>
    </div>
    <div class="form-group">
      <label for="exampleTextarea1">Place Description</label>
      <textarea class="form-control" name="placedes" id="servicedes" rows="4" required></textarea>
    </div>
    <button type="submit" name="submit3" class="btn btn-primary mr-2">Submit</button>
  </form>
</div>