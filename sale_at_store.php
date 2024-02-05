<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
  require_once("header.php");
?>
<?php
if(isset($_POST["submit"])){
  $checkTimeAppointment = getCheckTimeAppointment($_POST["datetime_appointment"]);
  if($checkTimeAppointment["numCount"] == 0){
    saveAppointment($_POST["users_id"],$_POST["appointment_type"],$_POST["firstname"],$_POST["lastname"],
        $_POST["telephone"],$_POST["size"],$_POST["weight"],$_POST["datetime_appointment"],
        $_POST["freetime"],$_FILES["image"]["name"],$_POST["contact"],$_POST["lat"],$_POST["lng"]);
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
          <h1>สร้างการนัดหมาย</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <form action="" method="post">
            <input type="hidden" class="form-control" id="appointment_type" name="appointment_type" value="1">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อจริง</label>
                  <input class="form-control" type="text" id="firstname" name="firstname" required>
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>นามสกุล</label>
                  <input class="form-control" type="text" id="lastname"  name="lastname" required>
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="myform_phone">เบอร์โทรศัพท์</label>
                  <input class="form-control" type="tel" id="telephone" name="telephone" required>
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label>วันเวลาที่นัดหมาย</label>
                    <input type="text" class="form-control" id="datetime_appointment" name="datetime_appointment" required>
                  </div>    
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-lg-12">
              <label>ข้อมูลการนัดหมาย</label>
                <div id="calendar1"></div>
              </div>
            </div>
            <div align="center">
              <div class="submit-button" >
                <button class="btn btn-common" type="submit" name="submit">ส่ง</button>
                <div class="clearfix"></div> 
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
    $('#datetime_appointment').datetimepicker({
      lang:'th',
      minDate:today,
      timepicker:true,
      format:'d/m/Y H:i'
    });

    $(document).ready(function() {
    var calendar = $('#calendar1').fullCalendar({
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