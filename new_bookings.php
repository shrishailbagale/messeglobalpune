<?php
include('includes/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
  $bid=$_GET['bookid'];
  $edate=$_POST['eventdate'];
  $name=$_POST['name'];
  $mobnum=$_POST['contact'];
  $email=$_POST['email'];
  $organization=$_POST['organiz'];  
  $est=$_POST['est'];
  $eetime=$_POST['eetime'];
  $placereq=$_POST['placerequired'];
  $eventtype=$_POST['eventtype'];
  $pax=$_POST['pax'];
  $refer=$_POST['refer'];
  $handle=$_POST['handle'];
  $addinfo=$_POST['info'];
  $bookingid=mt_rand(100000000, 999999999);
 
  $sql="insert into tblbooking(BookingID,ServiceID,Name,MobileNumber,Email ,EventDate,Organization,EventStartingtime,EventEndingtime,PlaceRequired,EventType,NoOfPax,Reference, HandleBy, AdditionalInformation)values(:bookingid,:bid,:name,:mobnum,:email,:edate,:orga,:est,:eetime,:placereq,:eventtype,:pax,:refer,:handle,:addinfo)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':bookingid',$bookingid,PDO::PARAM_STR);
  $query->bindParam(':bid',$bid,PDO::PARAM_STR);
  $query->bindParam(':edate',$edate,PDO::PARAM_STR);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':orga',$organization,PDO::PARAM_STR);  
  $query->bindParam(':est',$est,PDO::PARAM_STR);
  $query->bindParam(':eetime',$eetime,PDO::PARAM_STR);
  $query->bindParam(':placereq',$placereq,PDO::PARAM_STR);
  $query->bindParam(':eventtype',$eventtype,PDO::PARAM_STR);
  $query->bindParam(':pax',$pax,PDO::PARAM_STR);
  $query->bindParam(':refer',$refer,PDO::PARAM_STR);
  $query->bindParam(':handle',$handle,PDO::PARAM_STR);
  $query->bindParam(':addinfo',$addinfo,PDO::PARAM_STR);

  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Booking Request Has Been added.")</script>';
    echo "<script>window.location.href ='new_bookings.php'</script>";
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>

<body>
    <div class="container-scroller">

        <?php @include("includes/header.php");?>

        <div class="container-fluid page-body-wrapper">

            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="float: left;">New Bookings</h5>
                                    <div class="card-tools" style="float: right;">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#AddData4"><i class="fas fa-plus"></i> Add Bookings
                                        </button>
                                    </div>
                                </div>

                                <div id="AddData4" class="modal fade">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <form method="POST" id="contactForm" name="contactForm"
                                                    class="contactForm">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="email">Event Date</label>
                                                                <input type="date" class="form-control" name="eventdate"
                                                                    id="eventdate" placeholder="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="subject">Type of
                                                                    Event:</label>
                                                                <select type="text p-3" class="form-control"
                                                                    name="eventtype" required="true">
                                                                    <option value="">Choose Event Type</option>
                                                                    <?php 

                                                                    $sql2 = "SELECT * from   tbleventtype ";
                                                                    $query2 = $dbh -> prepare($sql2);
                                                                    $query2->execute();
                                                                    $result2=$query2->fetchAll(PDO::FETCH_OBJ);

                                                                    foreach($result2 as $row)
                                                                    {          
                                                                      ?>
                                                                    <option class="p-2"
                                                                        value="<?php echo htmlentities($row->EventType);?>">
                                                                        <?php echo htmlentities($row->EventType);?>
                                                                    </option>
                                                                    <?php } ?>
                                                                    <option value="Other">Other</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                       
                                                        <!-- 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                        <label class="label" for="name">Event Starting Time</label>
                                                        <input type="time" name="est" class="form-control">                         
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <div class="form-group">
                                                        <label class="label" for="email">Event Finish Time</label>
                                                        <input type="time" name="eetime" class="form-control" required="true">                         
                                                        </div>
                                                    </div> -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Company Name/ Full Name:</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Full Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Mobile Number:</label>
                                                                <input type="text" class="form-control" name="contact"
                                                                    id="contact" placeholder="Mobile Number"
                                                                    required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Email ID:</label>
                                                                <input type="text" class="form-control" name="email"
                                                                    id="contact" placeholder="Email ID" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Organization</label>
                                                                <input type="text" class="form-control" name="organiz"
                                                                    id="name" placeholder="Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                              <label class="label" for="subject">Choose Place Required:</label>
                                                              <select class="form-control" name="placerequired[]" multiple required="true">
                                                                  <?php 
                                                                  $sql2 = "SELECT * FROM tblplace";
                                                                  $query2 = $dbh->prepare($sql2);
                                                                  $query2->execute();
                                                                  $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                                                  foreach ($result2 as $row) {
                                                                  ?>
                                                                      <option value="<?php echo htmlentities($row->PlaceName); ?>">
                                                                          <?php echo htmlentities($row->PlaceName); ?>
                                                                      </option>
                                                                  <?php 
                                                                  } 
                                                                  ?>
                                                              </select>
                                                          </div>

                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">No of PAX.</label>
                                                                <input type="text" class="form-control" name="pax"
                                                                    id="name" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Reference</label>
                                                                <input type="text" class="form-control" name="refer"
                                                                    id="name" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Handled By</label>
                                                                <input type="text" class="form-control" name="handle"
                                                                    id="name" placeholder="Name" value="Individual">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="label" for="#">Additional
                                                                    Information</label>
                                                                <textarea name="info" class="form-control" id="info"
                                                                    cols="30" rows="4" placeholder=""></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="submit" value="Book" name="submit"
                                                                    class="btn btn-sm btn-info">
                                                                <div class="submitting"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="info_update4">
                                                <?php @include("view_newbooking.php");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="newbid_action" class="modal fade">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Take Action</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="info_update2">
                                                <?php @include("newbooking_action.php");?>
                                            </div>
                                            <div class="modal-footer ">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead>
                                            <tr>
                                                <th class="text-center"></th>
                                                <th>Booking ID</th>
                                                <th class="d-sm-table-cell">Event Date</th>
                                                <th class="d-sm-table-cell">Cutomer Name</th>
                                                <th class="d-sm-table-cell">Mobile Number</th>
                                                <th class="d-sm-table-cell">Email</th>
                                                <th class="d-sm-table-cell">Booking Date</th>
                                                <th class=" d-sm-table-cell">Status</th>
                                                <th class=" Text-center" style="width: 15%;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
               $sql="SELECT * from tblbooking where Status is null";
               $query = $dbh -> prepare($sql);
               $query->execute();
               $results=$query->fetchAll(PDO::FETCH_OBJ);

               $cnt=1;
               if($query->rowCount() > 0)
               {
                foreach($results as $row)
                  {               ?>
                                            <tr>
                                                <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                                <td class="font-w600 text-danger">
                                                    <b><?php  echo htmlentities($row->BookingID);?></b></td>
                                                <td class="font-w600">
                                                    <h5><?php  echo htmlentities($row->EventDate);?></h4>
                                                </td>
                                                <td class="font-w600"><?php  echo htmlentities($row->Name);?></td>
                                                <td class="font-w600"><?php  echo htmlentities($row->MobileNumber);?>
                                                </td>
                                                <td class="font-w600"><?php  echo htmlentities($row->Email);?></td>
                                                <td class="font-w600">
                                                    <span
                                                        class="badge badge-info"><?php  echo htmlentities($row->BookingDate);?></span>
                                                </td>
                                                <?php if($row->Status=="")
                                              { 
                                                ?>
                                                <td class="font-w600"><?php echo "Not Updated Yet"; ?></td>
                                                <?php 
                                                } else { ?>
                                                <td class="d-none d-sm-table-cell">
                                                    <span><?php  echo htmlentities($row->Status);?></span>
                                                </td>
                                                <?php 
                                                } ?>
                                                <td class=" text-center">

                                                    <a href="#" class="edit_data2 btn btn-purple rounded"
                                                        id="<?php echo  ($row->ID); ?>"><i
                                                            class="mdi mdi-pencil-box-outline " aria-hidden="true"
                                                            title="Take action"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt=$cnt+1;
                                          }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <?php @include("includes/footer.php");?>
            </div>

        </div>

    </div>

    <?php @include("includes/foot.php");?>

    <!-- Multiple date select  -->
    

    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.edit_data4', function() {
            var edit_id4 = $(this).attr('id');
            $.ajax({
                url: "view_newbookings.php",
                type: "post",
                data: {
                    edit_id4: edit_id4
                },
                success: function(data) {
                    $("#info_update4").html(data);
                    $("#editData4").modal('show');
                }
            });
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.edit_data2', function() {
            var edit_id2 = $(this).attr('id');
            $.ajax({
                url: "newbooking_action.php",
                type: "post",
                data: {
                    edit_id2: edit_id2
                },
                success: function(data) {
                    $("#info_update2").html(data);
                    $("#newbid_action").modal('show');
                }
            });
        });
    });
    </script>
</body>

</html>