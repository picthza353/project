<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<?php
require_once("header.php");
?>
<?php
//$currentSaleBuy = getCurrentSaleBuy($_GET["id"]);
$numberSaleBuy = runNumberSaleBuy();
$allProduct = getAllProduct();
$allMember = getAllCustomer();

if(isset($_POST["submit"])){

  $products_id = $_POST["products_id"];
  $amount = $_POST["amount"];
  $price = $_POST["price"];
  $summary = $_POST["summary"];

  saveSaleBuy($_POST["users_id"],$_POST["types"],$_POST["run_number"],$_POST["customer_name"],$_POST["customer_address"],$_POST["customer_telephone"],$products_id,$amount,$price,$summary,$_POST["customers_id"]);

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
          <h1>สร้างรายการซื้อ</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->
  
  <!-- Start Contact -->
  <div class="contact-box">
    <div class="container">
      <form action="" method="post">
        <div class="row">
          <div class="col-lg-12">
            <legend>ข้อมูลการซื้อ</legend>
            <input type="hidden" class="form-control" name="users_id" value="<?php echo $_SESSION["id"];?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>ลูกค้าที่เป็นสมาชิก </label>
                  <select name="customers_id" id="customers_id" class="form-control" onchange="getDataCustomer();" >
                    <option value="" disabled selected>-- โปรดเลือก --</option>
                    <?php foreach($allMember as $dataMem){ ?>
                      <option value="<?php echo $dataMem['id']?>" <?php echo $selected;?>><?php echo $dataMem['firstname']?> <?php echo $dataMem['lastname']?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <input type="hidden" class="form-control" id="types" name="types" value="2">
              <div class="col-md-6">
                <div class="form-group">
                  <label>เล่มที่</label>
                  <input type="text" class="form-control" id="run_number" name="run_number" value="<?php if($_GET['id'] == ""){ echo $numberSaleBuy; }else{  }?>" readonly >
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อ-นามสกุล</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $currentUser["firstname"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <input type="text" class="form-control" id="customer_address" name="customer_address" value="<?php echo $currentUser["address"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>เบอร์โทรศัพท์</label>
                  <input type="text" class="form-control" id="customer_telephone" name="customer_telephone" value="<?php echo $currentUser["telephone"];?>" required >
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <fieldset>
              <legend>ข้อมูลสินค้า</legend>
              <input type="button" id="delete_row" value="ลบ" class="btn btn-danger" onclick="deleteRow('dataTable')" style="background-color: red;float: right;" />
              <input type="button" id="add_row" value="เพิ่ม" class="btn btn-success" onclick="addRow('dataTable')" style="background-color: green;float: right;"/>
              <table class="table table-striped" id="dataTable">
                <thead>
                  <th></th>
                  <th style="text-align:center;"><label>รายการสินค้า</label></th>
                  <th style="text-align:center;"><label>จำนวน(กก.)</label></th>
                  <th style="text-align:center;"><label>ราคาต่อหน่วย</label></th>
                  <th style="text-align:center;"><label>จำนวนเงิน</label></th>
                </thead>
                <tbody>

                  <?php for($i=0;$i<1;$i++){ ?>
                    <tr>
                      <td style="width:5%;"><input type="checkbox" name="chk2"/></td>
                      <td style="width:35%;">
                        <select name="products_id[]" id="products_id<?php echo $i;?>" class="form-control product" required>
                          <option value="" disabled selected>-- โปรดเลือก --</option>
                          <?php foreach($allProduct as $dataPro1){ ?>
                            <option value="<?php echo $dataPro1['id']?>" <?php echo $selected;?>><?php echo $dataPro1['prod_name']?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td style="width:20%;">
                        <input type="text" class="form-control border-input amount" name="amount[]" id="amount<?php echo $i;?>" required>
                      </td>
                      <td style="width:20%;">
                        <input type="text" class="form-control border-input" name="price[]" id="prod_price<?php echo $i;?>" readonly>
                      </td>
                      <td style="width:20%;">
                        <input type="text" class="form-control border-input" name="summary[]" id="prod_total<?php echo $i;?>" readonly>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </fieldset>
          </div>
        </div>

        <div align="center">
          <div class="submit-button" >
            <button class="btn btn-common" type="submit" name="submit">บันทึก</button>
            <div class="clearfix"></div> 
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End Contact -->


  <script>

    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;

      var row = table.insertRow(rowCount);

      var cell0 = row.insertCell(0);
      var element0 = document.createElement("input");
      element0.type = "checkbox";
      element0.name="chkbox";
      cell0.appendChild(element0);

      var cell1 = row.insertCell(1);
      var element1 = document.createElement("select");
      element1.id = 'products_id'+rowCount;
      element1.name = 'products_id[]';
      element1.required = 'true';
      element1.setAttribute('class', 'form-control product');
      element1.addEventListener('change', getDataFromDropdown);
      cell1.appendChild(element1);
      var option = document.createElement("option");
      option.value = '';
      option.appendChild(document.createTextNode("-- โปรดเลือก --"));
      element1.appendChild(option);

      <?php foreach($allProduct as $dataPro2){ ?>
        var option = document.createElement("option");
        option.value = '<?php echo $dataPro2["id"]?>';
        option.appendChild(document.createTextNode("<?php echo $dataPro2['prod_name']?>"));
        element1.appendChild(option);
      <?php } ?>

      var cell2 = row.insertCell(2);
      var element2 = document.createElement("input");
      element2.type = "text";
      element2.name = "amount[]";
      element2.id = "amount"+rowCount;
      element2.className = "form-control";
      element2.required = 'true';
      element2.addEventListener('change', calTotalPriceFromAmount);
      cell2.appendChild(element2);

      var cell3 = row.insertCell(3);
      var element3 = document.createElement("input");
      element3.type = "text";
      element3.name = "price[]";
      element3.id = "prod_price"+rowCount;
      element3.className = "form-control";
      element3.required = 'true';
      element3.setAttribute('readonly','true');
      cell3.appendChild(element3);

      var cell4 = row.insertCell(4);
      var element4 = document.createElement("input");
      element4.type = "text";
      element4.name = "summary[]";
      element4.id = "prod_total"+rowCount;
      element4.className = "form-control";
      element4.required = 'true';
      element4.setAttribute('readonly','true');
      cell4.appendChild(element4);

    }

    function deleteRow(tableID) {
      try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        for(var i=0; i<rowCount; i++) {
          var row = table.rows[i];
          var chkbox = row.cells[0].childNodes[0];
          if(null != chkbox && true == chkbox.checked) {
            table.deleteRow(i);
            rowCount--;
            i--;
          }
        }
      }catch(e) {
        alert(e);
      }
    }

    function getDataFromDropdown(){

      var id = $(this).attr('id');
      var sub_id = id.substring(13,11);
      var pro_id = $('#products_id'+sub_id).val();
      var types = $('#types').val();
      $.get('api/api.php?load=product&pro_id='+pro_id,function(data){
        pro_line_new = jQuery.parseJSON(data);
        for (var j = 0, len = pro_line_new.length; j < len; j++) {
            $('#prod_price'+sub_id).val(pro_line_new[j].prod_price_cost);
        }
      });
    }

    function calTotalPriceFromAmount(){

      var id = $(this).attr('id');
      var sub_id = id.substring(8, 6);
      var prod_price = parseInt($('#prod_price'+sub_id).val(), 10);
      var prod_amount = parseFloat($('#amount'+sub_id).val(), 10);
      var total_price = parseInt(prod_price*prod_amount);
      var amount = $('#amount'+sub_id).val();

      if(!isNaN(amount) && amount != ""){
          $('#prod_total'+sub_id).val(total_price);
        }else{
          $('#prod_total'+sub_id).val('');
        }
    }

    $(document).ready(function(){
      $('.product').on('change', function() {
        if ($(this).val() != ""){
          var id = $(this).attr('id');
          var sub_id = id.substring(13, 11);
          var types = $('#types').val();
          var pro_id = $('#products_id'+sub_id).val();
          $.get('api/api.php?load=product&pro_id='+pro_id,function(data){
            pro_line = jQuery.parseJSON(data);
            for (var i = 0, len = pro_line.length; i < len; i++) {
              $('#prod_price'+sub_id).val(pro_line[i].prod_price_cost);
            }
          });
        }
      });

      $('.amount').on('change',function() {
        var id = $(this).attr('id');
        var sub_id = id.substring(8, 6);
        var prod_price = parseInt($('#prod_price'+sub_id).val(), 10);
        var prod_amount = parseFloat($('#amount'+sub_id).val(), 10);
        var total_price = parseInt(prod_amount*prod_price);
        var amount = $('#amount'+sub_id).val();
        if(!isNaN(amount) && amount != ""){
          $('#prod_total'+sub_id).val(total_price);
        }else{
          $('#prod_total'+sub_id).val('');
        }
      });

    });

    function getDataCustomer(){
      var users_id = $('#customers_id').val();
      $.get('api/api.php?load=customer&users_id='+users_id,function(data){
        pro_line_new = jQuery.parseJSON(data);
        for (var j = 0, len = pro_line_new.length; j < len; j++) {
            $('#customer_name').val(pro_line_new[j].firstname+" "+pro_line_new[j].lastname);
            $('#customer_address').val(pro_line_new[j].address);
            $('#customer_telephone').val(pro_line_new[j].telephone);
        }

      });
    }

  </script>
  <?php
  require_once("footer.php");
  ?>

  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
</html>