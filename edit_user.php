<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$currentUser = getCurrentUser($_GET["id"]);
if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    saveUser($_POST["firstname"],$_POST["lastname"],$_POST["telephone"],$_POST["email"],$_POST["address"],$_POST["username"],$_POST["password"]);
  }else{
    editUser($_POST["id"],$_POST["firstname"],$_POST["lastname"],$_POST["telephone"],$_POST["email"],$_POST["address"],$_POST["username"],$_POST["password"]);
  }
  
}

if($_GET["id"] == ""){
  $txtHead = "เพิ่มเจ้าของร้าน/ผู้ดูแลระบบ";
}else{
  $txtHead = "แก้ไขเจ้าของร้าน/ผู้ดูแลระบบ";
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
        <div class="col-lg-12">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $currentUser["id"];?>">
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
                  <input type="text" class="form-control telephone" id="telephone" name="telephone" value="<?php echo $currentUser["telephone"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>อีเมล</label>
                  <input type="email" id="email" class="form-control" name="email" value="<?php echo $currentUser["email"];?>" required >
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <input type="text" class="form-control" id="address" name="address" value="<?php echo $currentUser["address"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อผู้ใช้งาน</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $currentUser["username"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6" >
                <div class="form-group">
                  <label>รหัสผ่าน</label>
                  <input type="password" id="password" class="form-control" name="password" value="<?php echo $currentUser["password"];?>" required >
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
        </form>
      </div>
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