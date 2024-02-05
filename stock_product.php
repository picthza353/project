<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allStock = getAllStock();

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
          <h1>คลังสินค้า</h1>
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
          <a href="edit_sale.php" class="btn btn-primary" style="float:right;" ><i class="ti-plus"></i>ขาย</a>
          <table class="table">
            <thead class=" text-primary">
              <th style="width:20%;"></th>
              <th>สินค้า</th>
              <th>จำนวน</th>              
            </thead>
            <tbody>
              <?php if(empty($allStock)){ ?>

              <?php }else{?>
                <?php foreach($allStock as $data){ ?>   
                  <tr>
                    <td><img src="images/product/<?php echo $data["prod_image"];?>" class="img-fluid" style="width: 100px;height: 100px;"></td>
                    <td><?php echo $data["prod_name"];?></td>
                    <td><?php echo $data["prod_amount"];?> กก.</td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
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