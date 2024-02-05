<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
$currentSaleBuy = getCurrentSaleBuy($_GET["id"]);
$allSaleBuyDetail = getAllSaleBuyDetail($_GET["id"]);
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
          <h1>รายละเอียดการซื้อขาย</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <legend>ข้อมูลซื้อ-ขาย</legend>
          </br>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>วันที่ : <?php echo formatDateFull($currentSaleBuy["date_create"]);?></label>
              </div>                                 
            </div>
          </div>
            <?php if($_SESSION["role"] == 1){ ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ประเภท : <?php echo $sale_buy_map[$currentSaleBuy["types"]];?></label>
                  </div>                                 
                </div>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>เล่มที่ : <?php echo $currentSaleBuy["run_number"];?></label>
                  </div>                                 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ชื่อ-นามสกุล : <?php echo $currentSaleBuy["customer_name"];?></label>
                  </div>                                 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ที่อยู่ : <?php echo $currentSaleBuy["customer_address"];?></label>
                  </div>                                 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>เบอร์โทรศัพท์ : <?php echo $currentSaleBuy["customer_telephone"];?></label>
                  </div>                                 
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <img src="images/sale/<?php echo $currentSaleBuy["sale_image"];?>" alt="" class="img-fluid">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <fieldset>
                <legend>ข้อมูลสินค้า</legend>
                <table class="table table-light" id="dataTable">
                  <thead>
                    <th style="text-align:center;"><label>รายการสินค้า</label></th>
                    <th style="text-align:center;"><label>จำนวน(กก.)</label></th>
                    <th style="text-align:center;"><label>ราคาต่อหน่วย</label></th>
                    <th style="text-align:center;"><label>จำนวนเงิน</label></th>
                  </thead>
                  <tbody>
                    <?php if(empty($allSaleBuyDetail)){ ?>
                    <?php }else{?>
                      <?php $total = 0;?>
                      <?php foreach($allSaleBuyDetail as $data){ ?>
                        <?php $total += $data["summary"];?>
                        <tr>
                          <td style="width:40%;">
                            <label> <?php echo $data["prod_name"];?></label>
                          </td>
                          <td style="width:20%;text-align:center;">
                            <label> <?php echo $data["amount"];?></label>
                          </td>
                          <td style="width:20%;text-align:center;">
                            <label> <?php echo number_format($data["price"]);?></label>
                          </td>
                          <td style="width:20%;text-align:center;">
                            <label> <?php echo number_format($data["summary"]);?></label>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>
                    <tr>
                      <td colspan="3" style="text-align:right;">
                        <label>รวม</label>
                      </td>
                      <td style="text-align:center;">
                        <label> <?php echo number_format($total);?></label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>
            </div>
          </div>
      <div align="center">
        <div class="submit-button" >
          <a href="javascript:history.go(-1);" class="btn btn-danger">ย้อนกลับ</a>
          <div class="clearfix"></div> 
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