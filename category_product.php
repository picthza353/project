<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allProduct = getAllProductInCategory($_GET["categories_id"]);
$currentCategory = getCurrentCategory($_GET["categories_id"]);

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
          <h1><?php echo $currentCategory["cate_name"];?></h1>
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
          <table style="width:100%">
            <tr>
              <td style="width:50%;"></td>
              <td style="width:50%;">
                <input type="text" name="search" id="search" class="form-control border-input" onKeyup="filterSearch();" placeholder="ค้นหา">
              </td>
            </tr>

          </table>
          <br/>
          <table class="table" id="data_table">
            <thead class=" text-primary">
              <th style="width:30%;"></th>
              <th>สินค้า</th>
              <th style="text-align: center;">ราคาซื้อ</th>
            </thead>
            <tbody>
              <?php if(empty($allProduct)){ ?>
                <?php echo "<h3>ไม่พบข้อมูล</h3>";?>
              <?php }else{?>
                <?php foreach($allProduct as $data){ ?>   
                  <tr>
                    <td><img src="images/product/<?php echo $data["prod_image"];?>" class="img-fluid" style="width: 200px;height: 200px;"></td>
                    <td><?php echo $data["prod_name"];?></td>
                    <td style="text-align: center;"><?php echo number_format($data["prod_price_cost"]);?> บาท/กก.</td>
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

  <script>
  function filterSearch() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>

  <?php
  require_once("footer.php");
  ?>

  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>