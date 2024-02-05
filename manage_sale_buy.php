<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$allSaleBuyUserId = getAllSaleBuyUserId($_SESSION["id"]);
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
          <h1>ข้อมูลการซื้อ-ขาย</h1>
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
              <th>เลขที่ซื้อชาย</th>
              <th>ประเภท</th>
              <th>ชื่อ-นามสกุล</th>
              <th>วันที่ซื้อขาย</th>
              <th style="width:5%;"></th>
              <th style="width:5%;"></th>
            </thead>
            <tbody>
              <?php if(empty($allSaleBuyUserId)){ ?>
              <?php }else{?>
                <?php foreach($allSaleBuyUserId as $data){ ?>  
                  <tr>
                    <td><?php echo $data["run_number"];?></td>
                    <td><?php echo $sale_buy_map[$data["types"]];?></td>
                    <td><?php echo $data["customer_name"];?></td>
                    <td><?php echo formatDateFull($data["date_create"]);?></td>
                    <td>
                      <a href="detail_sale_buy.php?id=<?php echo $data["id"];?>" class="btn btn-info">รายละเอียด</a>
                    </td>
                    <td>
                      <a href="pdf_sale_buy.php?id=<?php echo $data["id"];?>" class="btn btn-success" target="_blank">พิมพ์ใบเสร็จ</a>
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

  <script>
  function filterSearch() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      if (td0 || td1 || td2 || td3) {
        if (td0.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
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