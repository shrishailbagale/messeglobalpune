<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $placeid=$_SESSION['edplaceid'];
  $placename=$_POST['placename'];
  $placedes=$_POST['placedes'];
  $price=$_POST['price'];
  $sql="update tblplace set PlaceName =:placename,PlaceDes=:placedes,PlacePrice=:price  where tblplace.PlaceId=:placeid";
  $query=$dbh->prepare($sql);
  $query-> bindParam(':placeid', $placeid, PDO::PARAM_STR);
  $query->bindParam(':placename',$placename,PDO::PARAM_STR);
  $query->bindParam(':placedes',$placedes,PDO::PARAM_STR);
  $query->bindParam(':price',$price,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()){
    echo '<script>alert("Place has been updated")</script>';
  }else{
    echo '<script>alert("update failed! try again later")</script>';
  }
}
?>
<div class="card-body">
  <h4 class="card-title">Update Place Form </h4>
  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
    $PlaceId=$_POST['edit_id'];
    $sql="SELECT * from  tblplace where tblplace.PlaceId=:eid";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':eid', $PlaceId, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
      foreach($results as $row)
      { 
        $_SESSION['edplaceid']=$row->PlaceId;
        ?>        
        <div class="form-group">
          <label for="exampleInputName1">Place Name</label>
          <input type="text" name="placename" class="form-control" id="servicename" value="<?php  echo $row->PlaceName;?>"required>
        </div>
        <div class="form-group">
          <label for="exampleInputName1">Place Price</label>
          <input type="text" name="price" class="form-control" id="price" value="<?php  echo $row->PlacePrice;?>" required>
        </div>
        <div class="form-group">
          <label for="exampleTextarea1">Place Description</label>
          <textarea class="form-control" name="placedes" id="servicedes" rows="4" style="line-height: 30px;" required><?php  echo $row->PlaceDes;?></textarea>
        </div>
        <?php
        $cnt=$cnt+1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
  </form>
</div>