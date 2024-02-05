<?php
session_start();
require("function/function.php");
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">   

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Site Metas -->
  <title>เว็บแอปพลิเคชันซื้อขายเหล็ก ทองแดง และทองเหลือง</title>  
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Site Icons -->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">    
  <!-- Site CSS -->
  <link rel="stylesheet" href="css/style.css">    
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">
  
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="datepicker/datetimepicker-master/jquery.datetimepicker.js"></script>
  <link href="datepicker/datetimepicker-master/jquery.datetimepicker.css" rel="stylesheet"/>

</head>

<?php 
$role_map = array( 1=>'<a style="color:red">ผู้ดูแลระบบ</a>',2=>'<a style="color:green">ลูกค้า</a>');
$appointment_map = array( 0=>'<a style="color:red">ยกเลิก</a>',1=>'<a style="color:green">รอการยืนยัน</a>',2=>'<a style="color:green">ยืนยัน</a>',3=>'<a style="color:blue">สำเร็จ</a>');
$appointment_type_map = array( 1=>'<a style="color:blue">ขายสินค้าที่ร้าน</a>',2=>'<a style="color:green">นัดทางร้านไปรับสินค้า</a>');
$sale_buy_map = array( 1=>'<a style="color:blue">ขายสินค้า</a>',2=>'<a style="color:green">ซื้อสินค้า</a>');
$store_map = array( 1=>'<a style="color:green">ปกติ</a>',2=>'<a style="color:orange">ไม่ว่าง</a>',3=>'<a style="color:red">ปิด</a>');
$role = array(1=>'<a style="color:red">เจ้าของร้าน</a>',2=>'<a style="color:green">ลูกค้า</a>',3=>'<a style="color:blue">ร้านค้า</a>');
$role_map = array(2=>'<a>ลูกค้า</a>',3=>'<a>ร้านค้า</a>');
?>
