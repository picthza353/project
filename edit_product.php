<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allCategory = getAllCategory();
$currentProduct = getCurrentProduct($_GET["id"]);
if(isset($_POST["submit"])){
  if($_POST["id"] == ""){
    saveProduct($_POST["categories_id"],$_POST["prod_name"],$_POST["prod_amount"],$_POST["prod_price_cost"],$_FILES["prod_image"]["name"]);
  }else{
    editProduct($_POST["id"],$_POST["categories_id"],$_POST["prod_name"],$_POST["prod_amount"],$_POST["prod_price_cost"],$_FILES["prod_image"]["name"]);
  }
  
}

if($_GET["id"] == ""){
  $txtHead = "เพิ่มสินค้า";
}else{
  $txtHead = "แก้ไขสินค้า";
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
            <?php if($currentProduct["prod_image"] == ""){ ?>
              <img src="images/category_ico.png" alt="" class="img-fluid">
            <?php }else{ ?>
              <img src="images/product/<?php echo $currentProduct["prod_image"];?>" alt="" class="img-fluid">
            <?php } ?>
          </div>                                 
        </div>
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" value="<?php echo $currentProduct["pid"];?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ประเภทสินค้า </label>
                  <select name="categories_id" id="categories_id" class="form-control" required>
                    <option value="" disabled selected>-- โปรดเลือก --</option>
                    <?php foreach($allCategory as $dataCate){ ?>
                      <?php $selected = ""; 
                      if($currentProduct['categories_id'] == $dataCate['id']){
                        $selected = "selected"; 
                      } 
                      ?> 
                      <option value="<?php echo $dataCate['id']?>" <?php echo $selected;?>><?php echo $dataCate['cate_name']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ชื่อสินค้า </label>
                  <input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $currentProduct["prod_name"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ราคาซื้อ:กก.</label>
                  <input type="text" class="form-control" name="prod_price_cost" id="prod_price_cost" value="<?php echo $currentProduct["prod_price_cost"];?>" required>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>อัพโหลดภาพสินค้า</label>
                  <input type="file" class="form-control" name="prod_image" placeholder="Product Image">
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