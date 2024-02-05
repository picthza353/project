<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
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
          <h1>รายงานสรุปผลกำไรขาดทุน</h1>
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
          <form action="pdf_profit_loss.php" method="post" enctype="multipart/form-data" target="_blank">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>วันที่เริ่มต้น</label>
                  <input type="text" class="form-control" id="date_start" name="date_start" placeholder="00/00/0000" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>วันที่สิ้นสุด</label>
                  <input type="text" class="form-control" id="date_end" name="date_end" placeholder="00/00/0000"  required >
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
            </div>
            <div align="center">
              <div class="submit-button" >
                <button class="btn btn-common" type="submit" name="submit">แสดงรายงาน</button>
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
<script>
  
  $('#date_start').datetimepicker({
    lang:'th',
    timepicker:false,
    format:'d/m/Y'
  });
  $('#date_end').datetimepicker({
    lang:'th',
    timepicker:false,
    format:'d/m/Y'
  });

</script>
<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>