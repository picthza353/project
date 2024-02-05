<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$currentContact = getCurrentContact();
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
          <h1>ติดต่อ</h1>
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

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div id="map_canvas" style="width: auto; height: 500px;"></div>
              </div>                                 
            </div>
            <div class="col-md-6" >
              <div class="form-group">
                <input type="hidden" class="form-control" name="lat" id="lat" value="<?php echo $currentContact["lat"];?>">
                <input type="hidden" class="form-control" name="lng" id="lng" value="<?php echo $currentContact["lng"];?>">
                <h2 class="tm-recommended-title">เจ้าของร้าน</h2>
                <p class="tm-text-gray"><?php echo $currentContact["owner"];?></p>
                <h2 class="tm-recommended-title">เบอร์โทรศัพท์</h2>
                <p class="tm-text-gray"><?php echo $currentContact["phone"];?></p>
                <h2 class="tm-recommended-title">ที่อยู่</h2>
                <p class="tm-text-gray"><?php echo $currentContact["address"];?></p>
                <h2 class="tm-recommended-title">วันทำการ</h2>
                <p class="tm-text-gray"><?php echo $currentContact["work_date"];?></p>
                <h2 class="tm-recommended-title">เวลา เปิด-ปิด ร้าน</h2>
                <p class="tm-text-gray"><?php echo substr($currentContact["time_open"],0,5);?> - <?php echo substr($currentContact["time_close"],0,5);?></p>
                <h2 class="tm-recommended-title">สถานะร้าน</h2>
                <p class="tm-text-gray"><?php echo $store_map[$currentContact["store_status"]];?></p>
              </div> 
            </div>
          </div>
        </div>            
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
          zoom: 13,
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

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>