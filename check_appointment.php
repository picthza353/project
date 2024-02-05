<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allAppointmentsDetail = getAllAppointmentsDetail($_GET["id"]);
$currentAppointment = getAppointment($_GET["id"]);

if (isset($_GET['confirm'])) {
  confirmAppointmentAdmin($_GET['confirm']);
}

if (isset($_GET['cancel'])) {
  cancelAppointmentAdmin($_GET['cancel']);
}
?>
<body onload="initialize();">
  <?php
  require_once("nav.php");
  ?>
  
  <!-- Start All Pages -->
  <div class="all-page-title page-breadcrumb">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>รายละเอียดการนัดหมาย</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">
    <div class="row justify-content-center">
          <div class="col-lg-6">
            <legend>ข้อมูลผู้นัดหมาย</legend>
            <input type="hidden" class="form-control" name="id" value="<?php echo $currentAppointment["id"];?>">
            <input type="hidden" class="form-control" name="users_id" value="<?php echo $currentAppointment["users_id"];?>">
            <input type="hidden" class="form-control" name="lat" id="lat" value="<?php echo $currentAppointment["lat"];?>">
            <input type="hidden" class="form-control" name="lng" id="lng" value="<?php echo $currentAppointment["lng"];?>">
            </br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ประเภทการนัดหมาย : <?php echo $appointment_type_map[$currentAppointment["appointment_type"]];?></label>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ชื่อ นามสกุล : <?php echo $currentAppointment["firstname"];?> <?php echo $currentAppointment["lastname"];?></label>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>หมายเลขโทรศัพท์ : <?php echo $currentAppointment["telephone"];?></label>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <?php
                  $get_date_time = explode(' ',$currentAppointment["datetime_appointment"]);
                  $date = convertchangeDate($get_date_time[0]);
                  $time = substr($get_date_time[1],0,-3);            
                ?>
                  <label>วันเวลาที่นัดหมาย : <?php echo $date." เวลา ".$time." น.";?></label>
                </div>                                 
              </div>
            </div>
            <?php if($currentAppointment["appointment_type"] == 2){ ?>
                <div class="row">
                  <div class="col-lg-12">
                    <lebel style="font-size:18px; font-weight:normal;">วันเวลาที่ว่าง :</lebel>
                      <br/>
                      <table class="table-light" id="dataTable">
                        <tbody>
                          <?php if(empty($allAppointmentsDetail)){
                                }else{
                                  foreach($allAppointmentsDetail as $data){
                                    $get_date_time = explode(' ',$data["freetime"]);
                                    $date = convertchangeDate($get_date_time['0']);
                                    $time = substr($get_date_time['1'],0,-3);           
                                ?>
                              <tr>
                                <td style="width:20%;">
                                  <label style="font-size:18px; font-weight:normal;"> <?php echo $date." เวลา ".$time." น.";?></label>
                                </td>
                              </tr>
                            <?php }
                                } ?>
                        </tbody>
                      </table>
                  </div>
                </div>
                <br/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>ขนาดสินค้า : <?php echo $currentAppointment["size"];?></label>
                    </div>                                 
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>น้ำหนักสินค้า : <?php echo $currentAppointment["weight"];?> กก.</label>
                    </div>                                 
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>ช่องทางการติดต่ออื่น ๆ : <?php echo $currentAppointment["contact"];?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>ภาพสินค้า :</label> 
                      <img src="images/appointment/<?php echo $currentAppointment["image"];?>" class="img-fluid" style="width: auto; height: 200px;">
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <legend>แผนที่</legend>
                  <div id="map_canvas" style="width: auto; height: 500px;"></div>         
                </div>
            <?php } ?>
          </div>
        </div>
        <div align="center">
          <div class="submit-button">
            <a href="edit_appointment.php?id=<?php echo $_GET['id'];?>" class="btn btn-warning" >แก้ไข</a>
            <a data-id="<?php echo $_GET['id'];?>" href="?confirm=<?php echo $_GET['id'];?>" class="btn btn-success confirm-btn" >ยืนยัน</a>
            <a data-id="<?php echo $_GET['id'];?>" href="?cancel=<?php echo $_GET['id'];?>" class="btn btn-danger cancel-btn" >ยกเลิก</a>
            <a href="javascript:history.go(-1);" class="btn btn-warning">ย้อนกลับ</a>
            <div class="clearfix"></div> 
          </div>
        </div>
      </div>
    </div>
    <!-- End Contact -->


    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfteSWSuw2CisRxG-8bRBtU4CqaMBF_m0"></script>
    <script type="text/javascript">
      function initialize() {

        var cLat = $("#lat").val();
        var cLng = $("#lng").val();
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 12,
          center: new google.maps.LatLng(cLat, cLng),
          mapTypeId: google.maps.MapTypeId.DRIVER
        });

        var vMarker = new google.maps.Marker({
          position: new google.maps.LatLng(cLat, cLng),
        });

        map.setCenter(vMarker.position);

        vMarker.setMap(map);
      }
    </script>
    
    <?php
    require_once("footer.php");
    ?>

  <script>
    $('.confirm-btn').click(function(e) {
      var id = $(this).data('id');
      e.preventDefault();
      confirm(id);
    })

    function confirm(id) {
      Swal.fire({
        title: 'ยืนยันการนัดหมาย',
        showCancelButton: true,
        confirmButtonColor: '#009900',
        cancelButtonColor: '#777',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve){
            $.ajax({
              url: 'check_appointment.php',
              type: 'GET',
              data: 'confirm=' + id,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ยืนยันการนัดหมายเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'calendar_appointment.php';
              })
            })
            .fail(function() {
              Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถยืนยันการนัดหมายได้', 'error');
              window.location.reload();
            })
          })
        }
      })
    }
  </script>

<script>
    $('.cancel-btn').click(function(e) {
      var id = $(this).data('id');
      e.preventDefault();
      cancel(id);
    })

    function cancel(id) {
      Swal.fire({
        title: 'ยกเลิกการนัดหมาย',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#777',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve){
            $.ajax({
              url: 'check_appointment.php',
              type: 'GET',
              data: 'cancel=' + id,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ยกเลิกการนัดหมายเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'manage_appointment_confirm.php';
              })
            })
            .fail(function() {
              Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถยกเลิกการนัดหมายได้', 'error');
              window.location.reload();
            })
          })
        }
      })
    }
  </script>

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
  </body>
  </html>