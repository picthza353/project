<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php 
if(isset($_POST["submit"])){
    checkLogin($_POST["username"],$_POST["password"]);
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
          <h1>เข้าสู่ระบบ</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">
      <form action="" method="post">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ชื่อผู้ใช้งาน</label>
                  <input class="form-control" type="text" name="username"  required >
                  <div class="help-block with-errors"></div>
                </div>   
                <div class="form-group">
                  <label>รหัสผ่าน</label>
                  <input class="form-control" type="password" name="password"  required >
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
          </div>
        </div>
            <div align="center">
              <div class="submit-button" >
                <button class="btn btn-common" type="submit" name="submit">เข้าสู่ระบบ</button>
                <div class="clearfix"></div> 
              </div>
            </div>
          </div>            
        </form> 
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