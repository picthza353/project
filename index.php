<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");

$url = 'https://wongpanit.com/';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
$response = curl_exec($curl);
curl_close($curl);

$dom = new DOMDocument();
$dom->loadHTML($response);

$xpath = new DOMXPath($dom);
$expression = '//*[@class="table table-striped"]//tr';
$rows = $xpath->query($expression);
$head = $xpath->query('//p[@class="lead"]');

$data_url = 'http://www.thaigold.info/RealTimeDataV2/gtdata_.txt'; 
 
$data_json = file_get_contents($data_url); 
 
$data_array = json_decode($data_json); 
 

?>
<style>
  .scroll-up {
    overflow: hidden;
    height: 500px;
  }

  .scroll-up table {
    animation: scroll-up 100s linear infinite;
  }

  .scroll-up table:hover {
    animation-play-state: paused;
  }

  @keyframes scroll-up {
    0% {
      transform: translateY(10%);
    }
    100% {
      transform: translateY(-100%);
    }
  }

  
</style>
<body>
  <?php
  require_once("nav.php");
  ?>
  <div class="fb-customerchat" page_id="<PAGE_ID>" logged_in_greeting="สอบถามเพิ่มเติม ?" logged_out_greeting="สอบถามเพิ่มเติม"></div>
  <!-- Start slides -->
  <div id="slides" class="cover-slides">
    <ul class="slides-container">
      <li class="text-center">
        <img src="images/slider-03.jpg" alt="" >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20">ร้านซื้อขายเหล็ก ทองแดง และทองเหลือง</h1>
            </div>
          </div>
        </div>
      </li>

      <li class="text-center">
        <img src="images/slider-02.jpg" alt="">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20">ร้านซื้อขายเหล็ก ทองแดง และทองเหลือง</h1>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <!-- End slides -->
  
  <!-- Start About -->
  <div class="about-section-box">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
          <div class="inner-column">
            <h2 style="font-size:40px;">ราคากลางของสินค้า</h2>
          <?php foreach ($head as $data) {?>
            <h2>อัพเดท<?php echo $data->textContent ?></h2>
          <?php } ?>
           <table class="table table-striped" style="background:#d0a772; color:white;">
              <thead>
                <tr>
                  <th style="padding-left: 40px;text-align: left;">ชนิดสินค้า</th>
                  <th width="33%" style="text-align:left;">ราคา/ต่อหน่วย</th>
                </tr>
              </thead>
            </table>
            <div class="scroll-up">
              <table class="table table-striped">
                <tbody>
                <?php foreach ($rows as $row) {?>
                    <tr>
                      <?php foreach ($row->childNodes as $cell) {?>
                        <td style="text-align:left;"> <?php echo $cell->textContent;?> </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!--<br/>
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="table-danger">
                  <th>name</th>
                  <th>bid</th>
                  <th>ask</th>
                  <th>diff</th>
                </tr>
              </thead>
              
            <?php foreach ($data_array as $row) { ?>
              <tbody>
                <tr>
                  <td><?=$row->name;?></td>
                  <td><?=$row->bid;?></td>
                  <td><?=$row->ask;?></td>
                  <td><?=$row->diff;?></td>
                </tr>
              </tbody>
            <?php  } ?>
            </table>-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End About -->
  
  <!-- Start QT -->
  <div class="qt-box qt-background">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-left">
        </div>
      </div>
    </div>
  </div>
  <!-- End QT -->

  <!-- Start Gallery -->
  <div class="gallery-box">
    <div class="container-fluid">
      <div class="tz-gallery">
        <div class="row">
          <div class="col-sm-12 col-md-4 col-lg-4">
            <a class="lightbox" href="images/gallery-img-01.jpg">
              <img class="img-fluid" src="images/gallery-img-01.jpg" alt="Gallery Images">
            </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <a class="lightbox" href="images/gallery-img-02.jpg">
              <img class="img-fluid" src="images/gallery-img-02.jpg" alt="Gallery Images">
            </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <a class="lightbox" href="images/gallery-img-03.jpg">
              <img class="img-fluid" src="images/gallery-img-03.jpg" alt="Gallery Images">
            </a>
          </div>
          <div class="col-sm-12 col-md-4 col-lg-4">
            <a class="lightbox" href="images/gallery-img-04.jpg">
              <img class="img-fluid" src="images/gallery-img-04.jpg" alt="Gallery Images">
            </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <a class="lightbox" href="images/gallery-img-05.jpg">
              <img class="img-fluid" src="images/gallery-img-05.jpg" alt="Gallery Images">
            </a>
          </div> 
          <div class="col-sm-6 col-md-4 col-lg-4">
            <a class="lightbox" href="images/gallery-img-06.jpg">
              <img class="img-fluid" src="images/gallery-img-06.jpg" alt="Gallery Images">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Gallery -->
  
  
  <?php
  require_once("footer.php");
  ?>
  
    
  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

</body>


</html>