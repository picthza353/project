<?php
$currentContactFoot = getCurrentContact();
require_once("chatbutton.php");
?>
<style>
  #back-to-top{
    right: 100px;
    bottom: 20px;
  }
</style>
<!-- Start Contact info -->
  <div class="contact-imfo-box">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <i class="fa fa-calendar"></i>
          <div class="overflow-hidden">
            <h4>วันทำการ</h4>
            <p class="lead">
              <?php echo  $currentContactFoot["work_date"];?>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <i class="fa fa-history"></i>
          <div class="overflow-hidden">
            <h4>เวลาเปิด-ปิด</h4>
            <p class="lead">
              <?php echo  substr($currentContactFoot["time_open"],0,5) ," - ", substr($currentContactFoot["time_close"],0,5) ," น. ";?>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <i class="fa fa-map-marker"></i>
          <div class="overflow-hidden">
            <h4>ที่อยู่</h4>
            <p class="lead">
              <?php echo $currentContactFoot["address"];?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Contact info -->
<!-- Start Footer -->
<footer class="footer-area bg-f">
	

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="company-name">All Rights Reserved. &copy; 2022 เว็บแอปพลิเคชันซื้อขายเหล็ก ทองแดง และทองเหลือง</p>
					</div>
				</div>
			</div>
		</div>

	</footer>
    <!-- End Footer -->

    <!-- ALL JS FILES -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/checkvalidation.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>