<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
  require_once("header.php");
?>
<?php
if(isset($_POST["submit"])){
  saveRegister($_POST["firstname"],$_POST["lastname"],$_POST["telephone"],$_POST["email"],$_POST["address"],$_POST["username"],$_POST["password"]);
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
          <h1>สมัครสมาชิก</h1>
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
          <form action="" method="post">
            <input type="hidden" class="form-control" name="id" id="id" value="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อจริง</label>
                  <input class="form-control" type="text" id="firstname" name="firstname"  required>
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>นามสกุล</label>
                  <input class="form-control" type="text"  id="lastname" name="lastname"  required>
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="myform_phone">เบอร์โทรศัพท์</label>
                  <input class="form-control" type="text" id="telephone" name="telephone" required>
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>อีเมล</label>
                  <input class="form-control" type="text" id="email" name="email" required>
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <input class="form-control" type="text" id="address" name="address" required>
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อผู้ใช้งาน</label>
                  <input class="form-control" type="text" id="username" name="username" required>
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6" >
                <div class="form-group">
                  <label>รหัสผ่าน</label>
                  <input class="form-control" type="password"  id="password" name="password" required>
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div align="center">
              <div class="submit-button" >
                <button class="btn btn-common" type="submit" name="submit">สมัครสมาชิก</button>
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