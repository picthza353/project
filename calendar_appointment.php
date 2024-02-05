<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$currentContact = getCurrentContact();
$user = getUser($_SESSION["id"]);
$allAppointmentSuccess = getAllAppointmentSuccess();
$allAppointmentUser = getAllAppointmentUser($_SESSION["id"]);

if (isset($_GET['success'])) {
  successAppointmentAdmin($_GET['success']);
}
?>
<script>
  
  $(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
      editable:true,
      header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: 'function/load_appointment.php',
    selectable:true,
    selectHelper:true,
    editable:true,
    eventColor: '#CCFFCC',
    eventClick: function (event) {
                  $.ajax({
                      type: "GET",
                      url: "detail_appointment.php",
                      data: "?id=" + event.id,
                      success: function (response) {
                        window.open("detail_appointment.php?id="+event.id);
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

<body>
  <?php
  require_once("nav.php");
  ?>
  
  <!-- Start All Pages -->
  <div class="all-page-title page-breadcrumb">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>ปฏิทินการนัดหมาย</h1>
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
                  <th>ชื่อ-นามสกุล</th>              
                  <th>เบอร์โทรศัพท์</th>              
                  <th>วันเวลาที่นัดหมาย</th>
                  <th>สถานะ</th>
                  <th style="width:5%;"></th>
                </thead>
                <tbody>
                  <?php if(empty($allAppointmentSuccess)){ ?>
                    <?php }else{?>
                      <?php foreach($allAppointmentSuccess as $data){ 
                        $get_date_time = explode(' ',$data["datetime_appointment"]);
                        $date = convertchangeDate($get_date_time['0']);
                        $time = substr($get_date_time['1'],0,-3);   
                        ?>   
                        <tr>
                          <td><?php echo $data["firstname"];?> <?php echo $data["lastname"];?></td>
                          <td><?php echo $data["telephone"];?></td>
                          <td><?php echo $date." เวลา ".$time." น.";?></td>
                          <td><?php echo $appointment_map[$data["appointment_status"]];?></td>
                          <td>
                            <a href="detail_appointment.php?id=<?php echo $data["id"];?>" class="btn btn-warning">รายละเอียด</a>
                          </td>
                          <td>
                            <a data-id="<?php echo $data['id'];?>" href="?success=<?php echo $data['id'];?>" class="btn btn-primary success-btn">สำเร็จ</a>
                          </td>
                      </tr>
                      <?php } ?>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </br >
            <div class="row">
              <div class="col-lg-12">
                <div id="calendar"></div>
              </div>
            </div>
          </br >
          <div class="row">
            <div class="col-lg-12">
              <legend>แผนที่</legend>
                <div id="map" style="width: auto; height: 500px;"></div>
                <br/>
                <div id="directions-panel"></div>
            </div>
          </div>
      </div>
    </div>
  <!-- End Contact -->
  

  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfteSWSuw2CisRxG-8bRBtU4CqaMBF_m0&callback=initMap"></script>
  <script  type="text/javascript">
    function initMap() {
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();

    $.get("api/api.php?load=store_location", function(store){
      $.get("api/api.php?load=destination_location", function (data) {
      store = $.parseJSON(store);
      data = $.parseJSON(data);

      var waypts = [];
      var marker, i;

      var infowindow = new google.maps.InfoWindow();

      var myLatlng = new google.maps.LatLng(store[0].lat, store[0].lng);

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.DRIVER
      });
      /*var markerstore = new google.maps.Marker({
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
      })(markerstore));*/

    directionsRenderer.setMap(map);
    calculateAndDisplayRoute(directionsService, directionsRenderer);
    directionsRenderer.setPanel(document.getElementById('directions-panel'));

      /*for ( i = 0; i < data.length; i++) {
          var latLng = new google.maps.LatLng(data[i].lat,data[i].lng);
              waypts.push({
              location: latLng,
              stopover: true,
            });
          var marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent('ชื่อ-นามสกุล : ' + data[i].firstname + ' ' + data[i].lastname + '<br/>' +
              'เบอร์โทรศัพท์ : ' + data[i].telephone + '<br/>' +
              'น้ำหนักสินค้า : ' + data[i].weight);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }*/
      });
    });
  }
  
  function calculateAndDisplayRoute(directionsService, directionsRenderer) {
    $.get("api/api.php?load=store_location", function(store){
      $.get("api/api.php?load=destination_location", function (data) {
        store = $.parseJSON(store);
        data = $.parseJSON(data);
        
        var waypts = [];
        var myLatlng = new google.maps.LatLng(store[0].lat, store[0].lng);

        for (let i = 0; i < data.length; i++) {
          var latLng = new google.maps.LatLng(data[i].lat,data[i].lng);
            waypts.push({
                location: latLng,
                stopover: true,
              });
        }

        directionsService
          .route({
            origin: myLatlng,
            destination: myLatlng,
            waypoints: waypts,
            travelMode: google.maps.TravelMode.DRIVING,
          })
          .then((response) => {
            directionsRenderer.setDirections(response);
      
            /*const route = response.routes[0];
            const summaryPanel = document.getElementById("directions-panel");
      
            summaryPanel.innerHTML = "";
      
            for (let i = 0; i < route.legs.length; i++) {
              const routeSegment = i + 1;
      
              summaryPanel.innerHTML +=
                "<b>เส้นทางที่ " + routeSegment + "</b><br>";
              summaryPanel.innerHTML += route.legs[i].start_address + " ไป ";
              summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
              summaryPanel.innerHTML += route.legs[i].distance.text + ' ' + "ประมาณ" + ' ' + route.legs[i].duration.text + "<br><br>";
            }*/
          });
      });
    });
  }
  
  </script>
    
  <?php
  require_once("footer.php");
  ?>

  <script>
      $('.success-btn').click(function(e) {
        var id = $(this).data('id');
        e.preventDefault();
        success(id);
      })

      function success(id) {
        Swal.fire({
          title: 'สำเร็จการนัดหมาย',
          showCancelButton: true,
          confirmButtonColor: '#3366FF',
          cancelButtonColor: '#777',
          confirmButtonText: 'ยืนยัน',
          showLoaderOnConfirm: true,
          preConfirm: function() {
            return new Promise(function(resolve){
              $.ajax({
                url: 'calendar_appointment.php',
                type: 'GET',
                data: 'success=' + id,
              })
              .done(function() {
                Swal.fire({
                  title: 'สำเร็จ',
                  text: 'สำเร็จการนัดหมายเรียบร้อย',
                  icon: 'success',
                  confirmButtonText: 'ยืนยัน'
                }).then(() => {
                  document.location.href = 'calendar_appointment.php';
                })
              })
              .fail(function() {
                Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถสำเร็จการนัดหมายได้', 'error');
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
