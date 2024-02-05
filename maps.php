<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
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
          <h1>แผนที่</h1>
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
          <div id="map_canvas" style="width: auto; height: 500px;"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Contact -->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfteSWSuw2CisRxG-8bRBtU4CqaMBF_m0&callback=initMap&v=weekly" defer></script>
  <script type="text/javascript">


    function initialize() {

      var lat_lo = $("#lat").val();
      var lng_lo = $("#lng").val();

      var myLatlng = new google.maps.LatLng(16.6906389, 99.5373844);
      var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 12,
        center: new google.maps.LatLng(16.6906389, 99.5373844),
        mapTypeId: google.maps.MapTypeId.DRIVER
      });
      $.get("api/api.php?load=destination_location", function (data) {
        data = $.parseJSON(data);

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        var iconCounter = 0;

        for (var i = 0; i < data.length; i++) {
          var latLng = new google.maps.LatLng(data[i].lat,data[i].lng);
          var marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent('ชื่อ-นามสกุล : '+data[i].firstname+' '+data[i].lastname+'<br/>'+
                'ที่ตั้ง : '+data[i].contact);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
      });

      var markerstore = new google.maps.Marker({
        position: myLatlng,
        icon: {
          url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
        },
        title:"ร้านขายเหล็ก ทองแดง และทองเหลือง"
      });
      markerstore.setMap(map);
    }

    function initMap() {
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 6,
    center: { lat: 41.85, lng: -87.65 },
  });

  directionsRenderer.setMap(map);
  document.getElementById("submit").addEventListener("click", () => {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const waypts = [];
  const checkboxArray = document.getElementById("waypoints");

  for (let i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected) {
      waypts.push({
        location: checkboxArray[i].value,
        stopover: true,
      });
    }
  }

  directionsService
    .route({
      origin: document.getElementById("start").value,
      destination: document.getElementById("end").value,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);

      const route = response.routes[0];
      const summaryPanel = document.getElementById("directions-panel");

      summaryPanel.innerHTML = "";

      // For each route, display summary information.
      for (let i = 0; i < route.legs.length; i++) {
        const routeSegment = i + 1;

        summaryPanel.innerHTML +=
          "<b>Route Segment: " + routeSegment + "</b><br>";
        summaryPanel.innerHTML += route.legs[i].start_address + " to ";
        summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
        summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
      }
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}

window.initMap = initMap;
  </script>

  <?php
  require_once("footer.php");
  ?>

  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>