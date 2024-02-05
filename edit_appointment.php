<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$currentUser = getCurrentUser($_SESSION["id"]);
$currentAppointment = getCurrentAppointment($_GET["id"]);
if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    $checkTimeAppointment = getCheckTimeAppointment($_POST["datetime_appointment"]);
    if($checkTimeAppointment["numCount"] == 0){
      $freetime = $_POST["freetime"];
      saveAppointment($_POST["users_id"],$_POST["appointment_type"],$_POST["firstname"],$_POST["lastname"],
    $_POST["telephone"],$_POST["size"],$_POST["weight"],$_POST["datetime_appointment"],$freetime,
    $_FILES["image"]["name"],$_POST["contact"],$_POST["lat"],$_POST["lng"]);
    }else{
      echo ("<script>
        $(document).ready(function() {
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'วันและเวลานี้ได้นัดหมายไปแล้ว',
            confirmButtonText: 'ตกลง'
          });
        });
      </script>");
    }
  }else{
    $checkTimeAppointment = getCheckTimeAppointment($_POST["datetime_appointment"]);
    if($checkTimeAppointment["numCount"] == 0){
      editAppointment($_POST["id"],$_POST["datetime_appointment"]);
    }else{
      echo ("<script>
        $(document).ready(function() {
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'วันและเวลานี้ได้นัดหมายไปแล้ว',
            confirmButtonText: 'ตกลง'
          });
        });
      </script>");
    }
  }
}

if($_GET["id"] == ""){
  $txtHead = "สร้างการนัดหมาย";
}else{
  $txtHead = "แก้ไขการนัดหมาย";
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
      <form name="form_appointment" action="" method="post" enctype="multipart/form-data">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <legend>ข้อมูลผู้นัดหมาย</legend>
            <input type="hidden" class="form-control" name="id" value="<?php echo $currentAppointment["aid"];?>">
            <input type="hidden" class="form-control" name="users_id" value="<?php echo $_SESSION["id"];?>">
            <input type="hidden" class="form-control" name="lat" id="lat" value="<?php echo $currentAppointment["lat"];?>"  >
            <input type="hidden" class="form-control" name="lng" id="lng" value="<?php echo $currentAppointment["lng"];?>"  >
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อ</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $currentUser["firstname"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>นามสกุล</label>
                  <input type="text" id="lastname" class="form-control" name="lastname" value="<?php echo $currentUser["lastname"];?>" required >
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>หมายเลขโทรศัพท์</label>
                  <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Your Telephone" value="<?php echo $currentUser["telephone"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>วันเวลาที่นัดหมาย</label>
                  <?php
                    $get_date_time = explode(' ',$currentAppointment["datetime_appointment"]);
                    $date = convertchangeDate($get_date_time[0]);
                    $time = substr($get_date_time[1],0,-3);
                  ?>
                    <input type="text" class="form-control" id="datetime_appointment" name="datetime_appointment" value="<?php if($currentAppointment["datetime_appointment"] != ""){ echo $date." ".$time; }?>" required>
                  </div>    
                </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-lg-12">
                <div id="calendar"></div>
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ประเภทการนัดหมาย</label>
                  <select id="appointment_type" name="appointment_type" class="form-control border-input" required>
                    <option value="" disabled selected>-- โปรดเลือก --</option>
                    <option value="1" <?php if($currentAppointment['appointment_type']== '1'){ echo 'selected'; }?>>ขายสินค้าที่ร้าน</option>
                    <option value="2" <?php if($currentAppointment['appointment_type']== '2'){ echo 'selected'; }?>>นัดทางร้านไปรับสินค้า</option>
                  </select>
                </div>                      
              </div>
            </div>
            <div id="pickup" style="display:none">
              <div class="row">
                <div class="col-md-12">
                <fieldset>
                  <label>วันเวลาที่ว่าง</label>
                  <input type="button" id="delete_row" value="ลบ" class="btn btn-danger" onclick="deleteRow('dataTable')" style="background-color: red;float: right;" />
                  <input type="button" id="add_row" value="เพิ่ม" class="btn btn-success" onclick="addRow('dataTable')" style="background-color: green;float: right;"/>
                  <table class="table table-striped" id="dataTable">
                    <tbody>
                      <?php for($i=0;$i<1;$i++){ ?>
                        <tr>
                          <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                          <td style="width:25%;">
                            <input type="text" class="form-control freetime" name="freetime[]" id="freetime<?php echo $i;?>">
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </fieldset>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>ขนาดสินค้า:เมตร&sup3;</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="โปรดระบุเป็นตัวเลขได้ดังตัวอย่าง กว้าง*ยาว*สูง" value="<?php echo $currentAppointment["size"];?>" >
                    <div class="help-block with-errors"></div>
                  </div>                                 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>น้ำหนักสินค้า:กิโลกรัม</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="โปรดระบุตัวเลข" value="<?php echo $currentAppointment["weight"];?>" >
                    <div class="help-block with-errors"></div>
                  </div>                                 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>อัปโหลดภาพสินค้า</label>
                    <input type="file" class="form-control" name="image" placeholder="Image" value="<?php echo $currentAppointment["image"];?>" >
                  </div>                                 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ช่องทางการติดต่ออื่นๆ(ถ้ามีโปรดระบุ)</label>
                    <input type="text" class="form-control" id="contact"  name="contact" placeholder="" value="<?php echo $currentAppointment["contact"];?>">
                  </div>                                 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <legend>แผนที่</legend>
                    <div id="map_canvas" style="width: auto; height: 500px;"></div> 
                  </div>                                 
                </div>
              </div>
              </div>
              <div align="center">
                <div class="submit-button">
                  <button class="btn btn-common" type="submit" name="submit">ส่ง</button>
                  <div class="clearfix"></div> 
                </div>
              </div>
            </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End Contact -->

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfteSWSuw2CisRxG-8bRBtU4CqaMBF_m0"></script>
  <script type="text/javascript">
    function initialize() {
      $.get("api/api.php?load=store_location", function(store){
        store = $.parseJSON(store);

        var infowindow = new google.maps.InfoWindow();

        var markerstore;

        var myLatlng = new google.maps.LatLng(store[0].lat, store[0].lng);

        var map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 13,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.DRIVER
        });
        var vMarker = new google.maps.Marker({
          position: myLatlng,
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
          
        var markerstore = new google.maps.Marker({
          position: myLatlng,
          map: map,
          icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
          }
        });
        google.maps.event.addListener(markerstore, 'click', (function(markerstore) {
          return function() {
            infowindow.setContent('เจ้าของร้าน : '+store[0].owner+'<br/>'+
            'เบอร์โทรศัพท์ : '+store[0].phone);
            infowindow.open(map, markerstore);
          }
        })(markerstore));

      });
    }
  </script>
  
  <script language="javascript">

    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;

      var row = table.insertRow(rowCount);

      var cell0 = row.insertCell(0);
      var element0 = document.createElement("input");
      element0.type = "checkbox";
      element0.name="chkbox";
      cell0.appendChild(element0);

      var cell1 = row.insertCell(1);
      var element1 = document.createElement("input");
      element1.type = "text";
      element1.name = "freetime[]";
      element1.id = "freetime"+rowCount;
      element1.className = "form-control freetime";
      element1.addEventListener('click', calFreetime);
      cell1.appendChild(element1);
    }

    function deleteRow(tableID) {
      try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        for(var i=0; i<rowCount; i++) {
          var row = table.rows[i];
          var chkbox = row.cells[0].childNodes[0];
          if(null != chkbox && true == chkbox.checked) {
            table.deleteRow(i);
            rowCount--;
            i--;
          }
        }
      }catch(e) {
        alert(e);
      }
    }
  </script>

  <script>
    function calFreetime(){
      var today = new Date();
      $('.freetime').datetimepicker({
        lang:'th',
        minDate:today,
        timepicker:true,
        format:'d/m/Y H:i'
      });
    }
  </script>

  <script>
    var today = new Date();
    $('#datetime_appointment').datetimepicker({
      lang:'th',
      minDate:today,
      timepicker:true,
      format:'d/m/Y H:i'
    });
    $('.freetime').datetimepicker({
        lang:'th',
        minDate:today,
        timepicker:true,
        format:'d/m/Y H:i'
    });
  </script>

  <script>
  $(document).ready(function(){
    $('#appointment_type').change(function(){
      selection = $(this).val();    
      switch(selection)
      { 
        case '2':
          $('#pickup').show();
          break;
        default:
          $('#pickup').hide();
          break;
      }
    });

    var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: 'function/load_allappointment.php',
    selectable:true,
    selectHelper:true,
    editable:true,
    eventColor: '#CCFFCC',
    eventClick: function (event) {
                $.ajax({
                    type: "GET",
                    url: "detail_calendar.php",
                    data: "?id=" + event.id,
                    success: function (response) {
                      window.open("detail_calendar.php?id="+event.id);
                    }
                });
            
              }
  });
  });
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/th.js"></script>

  <?php
  require_once("footer.php");
  ?>

</body>
</html>