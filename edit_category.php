<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$currentCategory = getCurrentCategory($_GET["id"]);
if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    saveCategory($_POST["cate_name"]);
  }else{
    editCategory($_POST["id"],$_POST["cate_name"]);
  }
  
}

if($_GET["id"] == ""){
  $txtHead = "เพิ่มประเภทสินค้า";
}else{
  $txtHead = "แก้ไขประเภทสินค้า";
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
        <div class="col-md-6">
          <div class="form-group">
            <img src="images/category_ico.png" alt="" class="img-fluid">
          </div>                                 
        </div>
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" value="<?php echo $currentCategory["id"];?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ประเภทสินค้า </label>
                  <input type="text" class="form-control" id="cate_name" name="cate_name" value="<?php echo $currentCategory["cate_name"];?>" required >
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