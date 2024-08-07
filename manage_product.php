﻿<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allProduct = getAllProduct();
if (isset($_GET['delete'])) {
  deleteProduct($_GET['delete']);
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
          <h1>จัดการสินค้า</h1>
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
          <a href="edit_product.php" class="btn btn-success" ><i class="ti-plus"></i> เพิ่ม</a>
          <a href="edit_buy.php" class="btn btn-success" style="float:right;" ><i class="ti-plus"></i> ซื้อ</a>
          <table class="table">
            <thead class=" text-primary">
              <th style="width:10%;"></th>
              <th>ประเภท</th>
              <th>สินค้า</th>
              <th>ราคารับซื้อ</th>              
              <th style="width:5%;"></th>
              <th style="width:5%;"></th>
            </thead>
            <tbody>
              <?php if(empty($allProduct)){ ?>
                <?php echo "<h3>ไม่พบข้อมูล</h3>";?>
              <?php }else{?>
                <?php foreach($allProduct as $data){ ?>   
                  <tr>
                    <td><img src="images/product/<?php echo $data["prod_image"];?>" class="img-fluid" style="width: 100px;height: 100px;"></td>
                    <td><?php echo $data["cate_name"];?></td>
                    <td><?php echo $data["prod_name"];?></td>
                    <td><?php echo $data["prod_price_cost"];?> บาท/กก.</td>
                    <td>
                      <a href="edit_product.php?id=<?php echo $data["id"];?>" class="btn btn-warning">แก้ไข</a>
                    </td>
                    <td>
                      <a data-id="<?php echo $data["id"];?>" href="?delete=<?php echo $data['id'];?>" class="btn btn-danger delete-btn">ลบ</a>
                    </td>
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

<script>
    $('.delete-btn').click(function(e) {
      var id = $(this).data('id');
      e.preventDefault();
      deleteConfirm(id);
    })

    function deleteConfirm(id) {
      Swal.fire({
        title: 'ยืนยันการลบ',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#777',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve){
            $.ajax({
              url: 'manage_product.php',
              type: 'GET',
              data: 'delete=' + id,
            })
            .done(function() {
              Swal.fire({
                title: 'สำเร็จ',
                text: 'ลบข้อมูลเรียบร้อย',
                icon: 'success',
                confirmButtonText: 'ยืนยัน'
              }).then(() => {
                document.location.href = 'manage_product.php';
              })
            })
            .fail(function() {
              Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถลบข้อมูลได้', 'error');
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