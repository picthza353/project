<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allAppointmentUser = getAllAppointmentUser($_SESSION["id"]);
if (isset($_GET['cancel'])) {
  cancelAppointment($_GET['cancel']);
}

?>
<body>
  <?php
  require_once("nav.php");
  ?>
  
  <!-- Start All Pages -->
  <div class="all-page-title page-breadcrumb">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>การนัดหมาย</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          
          <a href="edit_appointment.php" class="btn btn-success" style="float:right;">สร้างการนัดหมาย</a>
          <table class="table">
            <thead class=" text-primary">
              <th>ชื่อ-นามสกุล</th>
              <th>วันเวลาที่นัดหมาย</th>
              <th>สถานะ</th>
              <th style="width:5%;"></th>
              <th style="width:5%;"></th>
            </thead>
            <tbody>
              <?php if(empty($allAppointmentUser)){ ?>
              <?php }else{?>
                <?php foreach($allAppointmentUser as $data){ 
                  $get_date_time = explode(' ',$data["datetime_appointment"]);
                  $date = convertchangeDate($get_date_time['0']);
                  $time = substr($get_date_time['1'],0,-3);
                  ?>
                  <tr>
                    <td><?php echo $data["firstname"];?> <?php echo $data["lastname"];?></td>
                    <td><?php echo $date." เวลา ".$time." น.";?></td>
                    <td><?php echo $appointment_map[$data["appointment_status"]];?></td>
                    <td>
                      <a href="detail_appointment.php?id=<?php echo $data["id"];?>" class="btn btn-warning">รายละเอียด</a>
                    </td>
                    <td>
                      <a href="?cancel=<?php echo $data['id'];?>" class="btn btn-danger" onClick="javascript: return confirm('ยืนยันการยกเลิก');">ยกเลิก</a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Contact -->



  <?php
  require_once("footer.php");
  ?>

  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>