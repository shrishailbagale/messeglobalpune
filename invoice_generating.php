<?php
include('includes/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <div class="container-scroller">

        <?php @include("includes/header.php");?>

        <div class="container page-body-wrapper" id="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row" id="exampl">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="table-responsive p-3">
                                    <?php
                                    
                                    $invid=$_GET['invid'];
                                    $sql="SELECT tblbooking.BookingID,tblbooking.Name,tblbooking.MobileNumber,tblbooking.Email,tblbooking.EventDate,tblbooking.EventStartingtime,tblbooking.EventEndingtime,tblbooking.VenueAddress,tblbooking.EventType,tblbooking.AdditionalInformation,tblbooking.BookingDate,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblservice.ServiceName,tblservice.SerDes,tblservice.ServicePrice from tblbooking join tblservice on tblbooking.ServiceID = tblservice.ID where tblbooking.ID=:invid";
                                    $query = $dbh -> prepare($sql);
                                    $query-> bindParam(':invid', $invid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $row)
                                    { 
                                        ?>

                                    <table border="1" class=" table align-items-center table-bordered display"
                                        style="width:100%">

                                        <tr>
                                            <th>
                                                <img src="assets/images/logo.png" alt="" srcset=""
                                                    style="width: 100px; height: auto;">
                                            </th>
                                            <td colspan="12" style="text-align: center;">
                                                <img src="assets/img/companyimages/logo1.jpg" alt="" srcset=""
                                                    style="border-radius: 0%; width: auto; height: 70px;">
                                                <h4 style="font-size: 14px; line-height: 1;">133, next to Magarpatta,
                                                    Magarpatta, Hadapsar, Pune, Maharashtra 411013</h4>
                                                <div class="contact" style="line-height: 0;">
                                                    <h5 style="display: inline; line-height: normal;"><i
                                                            class="fa fa-phone fa-rotate-90"></i> +917020229060</h5>
                                                    <h5 style="display: inline; line-height: normal;"><i
                                                            class="fa fa-envelope"></i> info@messeglobalpune.com</h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="5" style="text-align: center; color: red; font-size: 18px">
                                                Booking No.:<?php  echo $row->BookingID;?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Name of Client/Company</th>
                                            <td>
                                                <?php  echo $row->Name;?>
                                            </td>
                                            <th>Mobile Number</th>
                                            <td>
                                                <?php  echo $row->MobileNumber;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email ID</th>
                                            <td>
                                                <?php  echo $row->Email;?>
                                            </td>
                                            <th>Event Date</th>
                                            <td>
                                                <?php  echo $row->EventDate;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Event Type</th>
                                            <td>
                                                <?php  echo $row->EventType;?>
                                            </td>
                                            <th>Nunber of Pax</th>
                                            <td>
                                                <?php  echo $row->NoOfPax;?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th style="text-align: center;" colspan="2">Service
                                                Name</th>
                                            <th style="text-align: center;" colspan="2">Service
                                                Price</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;" colspan="2">
                                                <?php  echo $row->ServiceName;?>
                                            </td>
                                            <td style="text-align: center;" colspan="2">
                                                <?php  echo $total= $row->ServicePrice;?>
                                            </td>

                                        </tr>
                                        <?php 
                                  $grandtotal+=$total;
                                  $cnt=$cnt+1;
                                } ?>
                                        <tr>
                                            <th colspan="2" style="text-align: center; color: blue">Grand
                                                Total</th>
                                            <td colspan="2" style="text-align: center;">
                                                <?php  echo $grandtotal;?>
                                            </td>
                                        </tr>

                                        <?php 
                                $cnt=$cnt+1;
                              } ?>

                                    </table>
                                    <p style="margin-top: 1%" align="center">
                                        <i class="mdi mdi-printer fa-4x" style="cursor: pointer; font-size: 30px;"
                                            OnClick="CallPrint(this.value)">
                                        </i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php @include("includes/footer.php");?>


        </div>
    </div>

    <?php @include("includes/foot.php");?>


    <script>
    function CallPrint(strid) {
        var prtContent = document.getElementById("container");
        var WinPrint = window
            .open('', '',
                'left=2,top=2,right=2, width=1000,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();

    }
    </script>
</body>

</html>