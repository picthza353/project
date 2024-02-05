<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allContact = getAllContact();

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
          <h1>ข้อมูลทางร้าน</h1>
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
          <table class="table">
            <thead class=" text-primary">
              <th>เจ้าของร้าน</th>
              <th>เบอร์โทรศัพท์</th>
              <th>ที่อยู่</th>
              <th>วันทำการ</th>
              <th>เวลาเปิด-ปิด</th>
              <th>สถานะร้านค้า</th>
              <th style="width:5%;"></th>
            </thead>
            <tbody>
              <?php if(empty($allContact)){ ?>
                <?php echo "<h3>ไม่พบข้อมูล</h3>";?>
              <?php }else{?>
                <?php foreach($allContact as $data){ ?>   
                  <tr>
                    <td><?php echo $data["owner"];?></td>
                    <td><?php echo $data["phone"];?> </td>
                    <td><?php echo $data["address"];?></td>
                    <td><?php echo $data["work_date"];?></td>
                    <td><?php echo substr($data["time_open"],0,5);?> - <?php echo substr($data["time_close"],0,5);?> น.</td>
                    <td><?php echo $store_map[$data["store_status"]];?></td>
                    <td>
                      <a href="edit_contact.php?id=<?php echo $data["id"];?>" class="btn btn-warning">แก้ไข</a>
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