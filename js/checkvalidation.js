var tel = $("#telephone");
  tel.on("change", function() {
    var phoneNumber = $(this).val();
    var phoneRegex = /^0[6,8-9]\(?(\d{1})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
      if (!phoneRegex.test(phoneNumber)){
        Swal.fire({
          icon: 'error',
          title: 'เกิดข้อผิดพลาด',
          text: 'เบอร์โทรศัพท์ไม่ถูกต้อง',
          confirmButtonText: 'ตกลง'
        });
        $('#telephone').val('');
      }
    });

    var mail = $("#email");
    mail.on("blur", function() {
      var email = $(this).val();
      var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!mailRegex.test(email)){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'อีเมลไม่ถูกต้อง',
            confirmButtonText: 'ตกลง'
          });
          $('#email').val('');
        }
      });

$(document).ready(function(){
  
  $('#telephone').blur(function () {
    var phone = $('#telephone').val();
    $.get("api/api.php?load=register", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(phone == pro_line_new[j].telephone){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'เบอร์นี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#telephone').val('');
        }
      }
    });
  });

  $('#email').blur(function () {
    var email = $('#email').val();
    $.get("api/api.php?load=register", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(email == pro_line_new[j].email){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'อีเมลนี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#email').val('');
        }
      }
    });
  });

  $('#username').blur(function () {
    var username = $('#username').val();
    $.get("api/api.php?load=register", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(username == pro_line_new[j].username){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ชื่อผู้ใช้งานนี้ถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#username').val('');
        }
      }
    });
  });

  $('#cate_name').blur(function () {
    var cate = $('#cate_name').val();
    $.get("api/api.php?load=categorie", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(cate == pro_line_new[j].cate_name){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ชื่อประเภทถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#cate_name').val('');
        }
      }
    });
  });

  $('#prod_name').blur(function () {
    var prod_name = $('#prod_name').val();
    $.get("api/api.php?load=prod_name", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(prod_name == pro_line_new[j].prod_name){
          Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ชื่อสินค้าถูกใช้งานแล้ว',
            confirmButtonText: 'ตกลง'
          });
          $('#prod_name').val('');
        }
      }
    });
  });

  $('#date_appointment','#time_appointment').blur(function () {
    var date = $('#date_appointment').val();
    var time = $('#time_appointment').val();
    $.get("api/api.php?load=datetime", function(data){
      pro_line_new = jQuery.parseJSON(data);
      for (var j = 0, len = pro_line_new.length; j < len; j++) {
        if(date == pro_line_new[j].date_appointment){
          if(time == pro_line_new[j].time_appointment){
            Swal.fire({
              icon: 'error',
              title: 'เกิดข้อผิดพลาด',
              text: 'วันและเวลานี้ได้นัดหมายไปแล้ว',
              confirmButtonText: 'ตกลง'
            });
            $('#date_appointment').val('');
            $('#time_appointment').val('');
          }
        }
      }
    });
  });

});