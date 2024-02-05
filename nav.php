<?php
$user = getUser($_SESSION["id"]);
if (isset($_GET['logout'])) {
  logout();
}
$allCategoryMenu = getAllCategory();
?>
<!-- Start header -->
<header class="top-navbar" style="margin-top: -27px;">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container" style="max-width: 1300px;">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" alt="" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbars-rs-food">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">หน้าหลัก</a></li>
          
          <?php if($_SESSION["id"] != "" && !empty($_SESSION["id"])){ ?>
            <?php if($_SESSION["role"] == 1){ ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">ข้อมูลผู้ใช้งาน</a>
                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                  <a class="dropdown-item" href="manage_user.php">ข้อมูลผู้ดูแลระบบ</a>
                  <a class="dropdown-item" href="manage_member.php">ข้อมูลลูกค้า</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">ข้อมูลสินค้า</a>
                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                  <a class="dropdown-item" href="manage_category.php">ประเภทสินค้า</a>
                  <a class="dropdown-item" href="manage_product.php">ข้อมูลสินค้า</a>
                  <a class="dropdown-item" href="stock_product.php">คลังสินค้า</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">การนัดหมาย</a>
                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                  <a class="dropdown-item" href="manage_appointment_confirm.php">ตอบรับการนัดหมาย</a>
                  <a class="dropdown-item" href="calendar_appointment.php">ปฏิทินการนัดหมาย</a>
                  <a class="dropdown-item" href="history_appointment.php">ประวัติการนัดหมาย</a>
                </div>
              </li>
              <li class="nav-item"><a class="nav-link" href="manage_sale_buy.php">ประวัติการซื้อ-ขาย</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">ข้อมูลอื่นๆ</a>
                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                  <a class="dropdown-item" href="manage_contact.php">ข้อมูลทางร้าน</a>
                  <a class="dropdown-item" href="report_profit_loss.php">รายงานสรุปกำไร-ขาดทุน</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown"><?php echo $user["firstname"];?> <?php echo $user["lastname"];?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                  <a class="dropdown-item" href="edit_profile.php">แก้ไขข้อมูลส่วนตัว</a>
                  <a class="dropdown-item" href="?logout=true">ออกจากระบบ</a>

                </div>
              </li>
            <?php } ?>
            <?php if($_SESSION["role"] == 2 || $_SESSION["role"] == 3){ ?>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">สินค้า</a>
              <div class="dropdown-menu" aria-labelledby="dropdown-a">
                <?php if(empty($allCategoryMenu)){ ?>
                <?php }else{?>
                  <?php foreach($allCategoryMenu as $dataMenuCate){ ?>   
                    <a class="dropdown-item" href="category_product.php?categories_id=<?php echo $dataMenuCate["id"];?>"><?php echo $dataMenuCate["cate_name"];?></a>
                  <?php } ?>
                <?php } ?>
              </div>
            </li>
              <li class="nav-item"><a class="nav-link" href="manage_user_appointment.php">การนัดหมาย</a></li>
              <li class="nav-item"><a class="nav-link" href="history_customer_sale.php">ประวัติการซื้อขาย</a></li>
              <li class="nav-item"><a class="nav-link" href="contact.php">ติดต่อร้าน</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown"><?php echo $user["firstname"];?> <?php echo $user["lastname"];?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                  <a class="dropdown-item" href="edit_profile.php">แก้ไขข้อมูลส่วนตัว</a>
                  <a class="dropdown-item" href="?logout=true">ออกจากระบบ</a>
                </div>
              </li>
            <?php } ?>

          <?php }else{ ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">สินค้า</a>
              <div class="dropdown-menu" aria-labelledby="dropdown-a">
                <?php if(empty($allCategoryMenu)){ ?>
                <?php }else{?>
                  <?php foreach($allCategoryMenu as $dataMenuCate){ ?>   
                    <a class="dropdown-item" href="category_product.php?categories_id=<?php echo $dataMenuCate["id"];?>"><?php echo $dataMenuCate["cate_name"];?></a>
                  <?php } ?>
                <?php } ?>
              </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="sale_at_store.php">การนัดหมาย</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">ติดต่อร้าน</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">เข้าสู่ระบบ</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php">สมัครสมาชิก</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- End header -->