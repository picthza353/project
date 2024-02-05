<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php

$currentContact = getCurrentContact();
if(isset($_POST["submit"])){
    editContact($_POST["id"],$_POST["users_id"],$_POST["owner"],$_POST["phone"],$_POST["address"],$_POST["work_date"],$_POST["time_open"],$_POST["time_close"],$_POST["lat"],$_POST["lng"],$_POST["store_status"]);
  
}

if($_GET["id"] == ""){
  $txtHead = "แก้ไขข้อมูลทางร้าน";
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
          <h1><?php echo $txtHead;?></h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">

      <div class="row">

        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" value="<?php echo $currentContact["id"];?>">
            <input type="hidden" class="form-control" name="users_id" value="<?php echo $_SESSION["id"];?>">
            <input type="hidden" class="form-control" name="lat" id="lat" value="<?php echo $currentContact["lat"];?>">
            <input type="hidden" class="form-control" name="lng" id="lng" value="<?php echo $currentContact["lng"];?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>เจ้าของร้าน </label>
                  <input type="text" class="form-control" id="owner" name="owner" value="<?php echo $currentContact["owner"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>เบอร์โทรศัพท์ </label>
                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $currentContact["phone"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ที่อยู่ </label>
                  <input type="text" class="form-control" id="address" name="address" value="<?php echo $currentContact["address"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>วันที่ทำการ </label>
                  <input type="text" class="form-control" id="work_date" name="work_date" value="<?php echo $currentContact["work_date"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>เวลาที่เปิด </label>
                  <input type="text" class="form-control" id="time_open" name="time_open" value="<?php echo substr($currentContact["time_open"],0,5);?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>เวลาที่ปิด </label>
                  <input type="text" class="form-control" id="time_close" name="time_close" value="<?php echo substr($currentContact["time_close"],0,5);?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>สถานะร้านค้า </label>
                  <select name="store_status" class="form-control" required>
                    <option value="">-- โปรดระบุสถานะร้านค้า --</option>
                    <option value="1" <?php if($currentContact['store_status']==1){?> selected<?php } ?>>ปกติ</option>
                    <option value="2" <?php if($currentContact['store_status']==2){?> selected<?php } ?>>ไม่ว่าง</option>
                    <option value="3" <?php if($currentContact['store_status']==3){?> selected<?php } ?>>ปิด</option>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div align="center">
              <div class="submit-button" >
                <button class="btn btn-common" type="submit" name="submit">บันทึก</button>
                <div class="clearfix"></div> 
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div id="map_canvas" style="width: auto; height: 500px;"></div>   
            </div>                                 
          </div>           
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Contact -->

<script>
  var today = new Date();


  $('#date_start').datetimepicker({
    lang:'th',
    minDate:today,
    timepicker:false,
    format:'d/m/Y'
  });
  $('#date_end').datetimepicker({
    lang:'th',
    minDate:today,
    timepicker:false,
    format:'d/m/Y'
  });
</script>

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
      draggable: true
    });

    google.maps.event.addListener(vMarker, 'dragend', function (evt) {
      $("#lat").val(evt.latLng.lat().toFixed(6));
      $("#lng").val(evt.latLng.lng().toFixed(6));


      var p1 = new google.maps.LatLng(16.6906389, 99.5373844);
      var p2 = new google.maps.LatLng(evt.latLng.lat(), evt.latLng.lng());

    });

    map.setCenter(vMarker.position);

    vMarker.setMap(map);
  }
</script>
<script>


  $('#time_open').datetimepicker({
    lang:'th',
    datepicker:false,
    format:'H:i',
    enabledHours: '10'

  });
  $('#time_close').datetimepicker({
    lang:'th',
    datepicker:false,
    format:'H:i',
    enabledHours: '10'

  });
</script>

<?php
require_once("footer.php");
?>

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>