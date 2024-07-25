<?php
error_reporting(0);

$con = mysqli_connect("localhost", "root", "", "store");
$con->set_charset("utf8");

function checkLogin($username, $password)
{
	$data = array();
	global $con;
	$sql = "select * from users where username = '" . $username . "' AND password = '" . $password . "'";
	$res = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($res)) {
		$data['id'] = $row['id'];
		$data['role'] = $row['role'];
	}
	if (!empty($data)) {
		session_start();
		$id = $data['id'];
		$_SESSION['id'] = $data['id'];
		$_SESSION['role'] = $data['role'];
		echo ("<script language='JavaScript'>
				window.location.href='index.php';
		</script>");
	} else {
		echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'error',
					title: 'а№ЂаёЃаёґаё”аё‚а№‰аё­аёњаёґаё”аёћаёҐаёІаё”',
					text: 'аёЉаё·а№€аё­аёњаё№а№‰а№ѓаёЉа№‰аё‡аёІаё™ аё«аёЈаё·аё­аёЈаё«аё±аёЄаёња№€аёІаё™ а№„аёЎа№€аё–аё№аёЃаё•а№‰аё­аё‡а№„аёЎа№€аёЄаёІаёЎаёІаёЈаё–а№Ђаё‚а№‰аёІаёЄаё№а№€аёЈаё°аёљаёља№„аё”а№‰',
					confirmButtonText: 'аё•аёЃаёҐаё‡'
				});
			});
		</script>");
	}
	mysqli_close($con);
}

function dateThaiFull($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strHour = date("H", strtotime($strDate));
	$strMinute = date("i", strtotime($strDate));
	$strSeconds = date("s", strtotime($strDate));
	$strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$strMonthThai = $strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}

function logout()
{
	session_start();
	session_unset();
	session_destroy();
	echo ("<script language='JavaScript'>
			window.location.href='index.php';
	</script>");
	exit();
}

function formatDateFull($date)
{
	if ($date == "0000-00-00") {
		return "";
	}
	if ($date == "")
		return $date;
	$raw_date = explode("-", $date);
	return  $raw_date[2] . "/" . $raw_date[1] . "/" . $raw_date[0];
}

function getUser($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT * FROM users WHERE id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function saveRegister($firstname, $lastname, $telephone, $email, $address, $username, $password)
{

	global $con;
	$sql = "INSERT INTO users (firstname, lastname, telephone, email, address, username, password, role) VALUES('" . $firstname . "','" . $lastname . "','" . $telephone . "','" . $email . "','" . $address . "','" . $username . "','" . $password . "','2')";
	mysqli_query($con, $sql);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'аёЄаёіа№ЂаёЈа№‡аё€',
				text: 'аёЄаёЎаё±аё„аёЈаёЄаёЎаёІаёЉаёґаёЃа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=login.php");
	mysqli_close($con);
}

function saveUser($firstname, $lastname, $telephone, $email, $address, $username, $password)
{

	global $con;
	$sql = "INSERT INTO users (firstname, lastname, telephone, email, address, username, password, role) VALUES('" . $firstname . "','" . $lastname . "','" . $telephone . "','" . $email . "','" . $address . "','" . $username . "','" . $password . "','1')";
	mysqli_query($con, $sql);

	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'аёЄаёіа№ЂаёЈа№‡аё€',
				text: 'а№Ђаёћаёґа№€аёЎаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=manage_user.php");
	mysqli_close($con);
}

function editUser($id, $firstname, $lastname, $telephone, $email, $address, $username, $password)
{

	global $con;
	$sql = "UPDATE users SET firstname='" . $firstname . "',lastname='" . $lastname . "',telephone='" . $telephone . "',email='" . $email . "',address='" . $address . "',username='" . $username . "',password='" . $password . "' WHERE id = '" . $id . "'";
	mysqli_query($con, $sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'аёЄаёіа№ЂаёЈа№‡аё€',
				text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=manage_user.php");
}

function editProfile($id, $firstname, $lastname, $telephone, $email, $address, $username, $password)
{

	global $con;
	$sql = "UPDATE users SET firstname='" . $firstname . "',lastname='" . $lastname . "',telephone='" . $telephone . "',email='" . $email . "',address='" . $address . "',username='" . $username . "',password='" . $password . "' WHERE id = '" . $id . "'";
	mysqli_query($con, $sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'аёЄаёіа№ЂаёЈа№‡аё€',
				text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=edit_profile.php");
}

function deleteUser($id)
{
	global $con;

	mysqli_query($con, "DELETE FROM users WHERE id='" . $id . "'");
	mysqli_close($con);
}


function getAllUser()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM users ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'address' => $row['address'],
			'username' => $row['username'],
			'password' => $row['password'],
			'role' => $row['role']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllAdmin()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM users WHERE role = '1' ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'address' => $row['address'],
			'username' => $row['username'],
			'password' => $row['password'],
			'role' => $row['role']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getCurrentUser($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT * FROM users WHERE id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function saveMember($firstname, $lastname, $telephone, $email, $address, $username, $password, $role)
{

	global $con;

	$sql = "INSERT INTO users (firstname, lastname, telephone, email, address, username, password, role) VALUES('" . $firstname . "','" . $lastname . "','" . $telephone . "','" . $email . "','" . $address . "','" . $username . "','" . $password . "','" . $role . "')";
	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("<script>
	$(document).ready(function() {
		Swal.fire({
			icon: 'success',
			title: 'аёЄаёіа№ЂаёЈа№‡аё€',
			text: 'а№Ђаёћаёґа№€аёЎаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
			showConfirmButton: false
		});
	});
	</script>");
	header("refresh:1; url=manage_member.php");
}

function editMember($id, $firstname, $lastname, $telephone, $email, $address, $username, $password, $role)
{

	global $con;
	$sql = "UPDATE users SET firstname='" . $firstname . "',lastname='" . $lastname . "',telephone='" . $telephone . "',email='" . $email . "',address='" . $address . "',username='" . $username . "',password='" . $password . "',role='" . $role . "' WHERE id = '" . $id . "'";
	mysqli_query($con, $sql);
	mysqli_close($con);
	echo ("<script>
		$(document).ready(function() {
			Swal.fire({
				icon: 'success',
				title: 'аёЄаёіа№ЂаёЈа№‡аё€',
				text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
				showConfirmButton: false
			});
		});
		</script>");
	header("refresh:1; url=manage_member.php");
}

function deleteMember($id)
{
	global $con;

	mysqli_query($con, "DELETE FROM users WHERE id='" . $id . "'");
	mysqli_close($con);
}

function getAllMember()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM users WHERE role = '2' or role = '3' ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'address' => $row['address'],
			'username' => $row['username'],
			'password' => $row['password'],
			'role' => $row['role']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllStore()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM users WHERE role = '3' ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'address' => $row['address'],
			'username' => $row['username'],
			'password' => $row['password'],
			'role' => $row['role']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllCustomer()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM users WHERE role = '2' ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'address' => $row['address'],
			'username' => $row['username'],
			'password' => $row['password'],
			'role' => $row['role']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getCurrentMember($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT * FROM members WHERE id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function saveCategory($cate_name)
{

	global $con;

	$sql = "INSERT INTO categories (cate_name) VALUES('" . $cate_name . "')";
	mysqli_query($con, $sql);

	mysqli_close($con);
	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'а№Ђаёћаёґа№€аёЎаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_category.php");
}

function editCategory($id, $cate_name)
{

	global $con;

	$sql = "UPDATE categories SET cate_name='" . $cate_name . "' WHERE id = '" . $id . "'";
	mysqli_query($con, $sql);

	mysqli_close($con);

	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_category.php");
}

function deleteCategory($id)
{
	global $con;

	mysqli_query($con, "DELETE FROM categories WHERE id='" . $id . "'");
	mysqli_close($con);
}

function getAllCategory()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM categories ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'cate_name' => $row['cate_name']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}


function getCurrentCategory($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT * FROM categories WHERE id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function saveProduct($categories_id, $prod_name, $prod_amount, $prod_price_cost, $prod_image)
{

	global $con;

	if ($prod_image != null) {
		if (move_uploaded_file($_FILES["prod_image"]["tmp_name"], "images/product/" . $_FILES["prod_image"]["name"])) {
			$sql = "INSERT INTO products (categories_id, prod_name, prod_amount, prod_price_cost, prod_image) VALUES('" . $categories_id . "','" . $prod_name . "','" . $prod_amount . "','" . $prod_price_cost . "','" . $_FILES["prod_image"]["name"] . "')";
		}
	} else {
		$sql = "INSERT INTO products (categories_id, prod_name, prod_amount, prod_price_cost) VALUES('" . $categories_id . "','" . $prod_name . "','" . $prod_amount . "','" . $prod_price_cost . "')";
	}
	mysqli_query($con, $sql);
	mysqli_close($con);
	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'а№Ђаёћаёґа№€аёЎаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_product.php");
}

function editProduct($id, $categories_id, $prod_name, $prod_amount, $prod_price_cost, $prod_image)
{

	global $con;

	if ($prod_image != null) {
		if (move_uploaded_file($_FILES["prod_image"]["tmp_name"], "images/product/" . $_FILES["prod_image"]["name"])) {
			$sql = "UPDATE products SET categories_id='" . $categories_id . "',prod_name='" . $prod_name . "',prod_amount='" . $prod_amount . "',prod_price_cost='" . $prod_price_cost . "',prod_image='" . $_FILES["prod_image"]["name"] . "' WHERE id = '" . $id . "'";
		}
	} else {
		$sql = "UPDATE products SET categories_id='" . $categories_id . "',prod_name='" . $prod_name . "',prod_amount='" . $prod_amount . "',prod_price_cost='" . $prod_price_cost . "' WHERE id = '" . $id . "'";
	}

	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_product.php");
}

function deleteProduct($id)
{
	global $con;

	mysqli_query($con, "DELETE FROM products WHERE id='" . $id . "'");
	mysqli_close($con);
}

function getAllStock()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM products WHERE prod_amount > 0; ");
	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'categories_id' => $row['categories_id'],
			'cate_name' => $row['cate_name'],
			'prod_name' => $row['prod_name'],
			'prod_amount' => $row['prod_amount'],
			'prod_price_cost' => $row['prod_price_cost'],
			'prod_image' => $row['prod_image']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllProduct()
{
	global $con;

	$res = mysqli_query($con, "SELECT *,p.id as pid FROM products p LEFT JOIN categories c ON p.categories_id = c.id ORDER BY p.id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['pid'],
			'categories_id' => $row['categories_id'],
			'cate_name' => $row['cate_name'],
			'prod_name' => $row['prod_name'],
			'prod_amount' => $row['prod_amount'],
			'prod_price_cost' => $row['prod_price_cost'],
			'prod_image' => $row['prod_image']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllProductInCategory($categories_id)
{
	global $con;

	$sql = "SELECT *,p.id as pid FROM products p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.categories_id = '" . $categories_id . "' ORDER BY p.id DESC";
	$res = mysqli_query($con, $sql);

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['pid'],
			'categories_id' => $row['categories_id'],
			'cate_name' => $row['cate_name'],
			'prod_name' => $row['prod_name'],
			'prod_amount' => $row['prod_amount'],
			'prod_price_cost' => $row['prod_price_cost'],
			'prod_image' => $row['prod_image']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}


function getCurrentProduct($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT *,p.id as pid FROM products p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}
function convertchangeDate($date)
{
	$get_date = explode("-", $date);
	return $get_date["2"] . "/" . $get_date["1"] . "/" . $get_date["0"];
}

function changeDate($date)
{
	$get_date = explode("/", $date);
	return $get_date["2"] . "-" . $get_date["1"] . "-" . $get_date["0"];
}

function saveAppointment($users_id, $appointment_type, $firstname, $lastname, $telephone, $size, $weight, $datetime_appointment, $freetime, $image, $contact, $lat, $lng)
{
	global $con;

	$datetime = explode(' ', $datetime_appointment);
	$date = changeDate($datetime['0']);
	$time = substr($datetime['1'], 0);
	$get_datetime = $date . " " . $time;

	if ($image != null) {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], "images/appointment/" . $_FILES["image"]["name"])) {
			$sql = "INSERT INTO appointments (users_id, appointment_type, firstname, lastname, telephone, size, weight, datetime_appointment, image, contact, lat, lng, appointment_status) 
			VALUES('" . $users_id . "','" . $appointment_type . "','" . $firstname . "','" . $lastname . "','" . $telephone . "','" . $size . "','" . $weight . "','" . $get_datetime . "','" . $_FILES["image"]["name"] . "','" . $contact . "','" . $lat . "','" . $lng . "', '1')";
		}
	} else {

		$sql = "INSERT INTO appointments (users_id, appointment_type, firstname, lastname, telephone, size, weight, datetime_appointment, contact, lat, lng, appointment_status) 
		VALUES('" . $users_id . "','" . $appointment_type . "','" . $firstname . "','" . $lastname . "','" . $telephone . "','" . $size . "','" . $weight . "','" . $get_datetime . "','" . $contact . "','" . $lat . "','" . $lng . "', '1')";
	}
	mysqli_query($con, $sql);
	$last_id = $con->insert_id;

	foreach ($freetime as $ft) {
		if ($ft != "") {
			$get_date_time = explode(' ', $ft);
			$date = changeDate($get_date_time['0']);
			$time = substr($get_date_time['1'], 0);
			$get_ft = $date . " " . $time;
			$sql_detail = "INSERT INTO appointments_detail (appointments_id, freetime) VALUES ('" . $last_id . "','" . $get_ft . "')";
			mysqli_query($con, $sql_detail);
		}
	}

	mysqli_close($con);

	if ($_SESSION["role"] == 1) {
		echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'аёљаё±аё™аё—аё¶аёЃаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					confirmButtonText: 'аёўаё·аё™аёўаё±аё™'
				}).then(() => {
					document.location.href = 'manage_appointment_confirm.php';
				});
			});
		</script>");
	} else if ($_SESSION["role"] == 2) {
		echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'аёљаё±аё™аё—аё¶аёЃаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					confirmButtonText: 'аёўаё·аё™аёўаё±аё™'
				}).then(() => {
					document.location.href = 'manage_user_appointment.php';
				});
			});
		</script>");
	} else {
		echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'аёљаё±аё™аё—аё¶аёЃаё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					confirmButtonText: 'аёўаё·аё™аёўаё±аё™'
				}).then(() => {
					document.location.href = 'index.php';
				});
			});
		</script>");
	}
}

function editAppointment($id, $datetime_appointment)
{

	global $con;

	$datetime = explode(' ', $datetime_appointment);
	$date = changeDate($datetime['0']);
	$time = substr($datetime['1'], 0);
	$get_datetime = $date . " " . $time;

	$sql = "UPDATE appointments SET datetime_appointment='" . $get_datetime . "' WHERE id = '" . $id . "'";

	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_appointment_confirm.php");
}

function cancelAppointment($id)
{

	global $con;

	$sql = "UPDATE appointments SET appointment_status='0' WHERE id = '" . $id . "'";

	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'аёўаёЃа№ЂаёҐаёґаёЃаё™аё±аё”аё«аёЎаёІаёўа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_user_appointment.php");
}

function confirmAppointmentAdmin($id)
{

	global $con;

	$sql = "UPDATE appointments SET appointment_status='2' WHERE id = '" . $id . "'";

	mysqli_query($con, $sql);
	mysqli_close($con);
}

function cancelAppointmentAdmin($id)
{

	global $con;

	$sql = "UPDATE appointments SET appointment_status='0' WHERE id = '" . $id . "'";

	mysqli_query($con, $sql);
	mysqli_close($con);
}

function successAppointmentAdmin($id)
{

	global $con;

	$sql = "UPDATE appointments SET appointment_status='3' WHERE id = '" . $id . "'";

	mysqli_query($con, $sql);
	mysqli_close($con);
}

function getAllAppointmentUser($users_id)
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM appointments WHERE users_id = '" . $users_id . "' ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'appointment_type' => $row['appointment_type'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'size' => $row['size'],
			'weight' => $row['weight'],
			'datetime_appointment' => $row['datetime_appointment'],
			'freetime' => $row['freetime'],
			'image' => $row['image'],
			'contact' => $row['contact'],
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'appointment_status' => $row['appointment_status']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllAppointment()
{
	global $con;

	$res = mysqli_query($con, "SELECT *,a.id as aid FROM appointments a ORDER BY a.id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'appointment_type' => $row['appointment_type'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'size' => $row['size'],
			'weight' => $row['weight'],
			'datetime_appointment' => $row['datetime_appointment'],
			'freetime' => $row['freetime'],
			'image' => $row['image'],
			'contact' => $row['contact'],
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'appointment_status' => $row['appointment_status']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllAppointmentConfirm()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status = '1' ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'appointment_type' => $row['appointment_type'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'size' => $row['size'],
			'weight' => $row['weight'],
			'datetime_appointment' => $row['datetime_appointment'],
			'freetime' => $row['freetime'],
			'image' => $row['image'],
			'contact' => $row['contact'],
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'appointment_status' => $row['appointment_status']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllAppointmentSuccess()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status = '2' ORDER BY datetime_appointment ASC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'appointment_type' => $row['appointment_type'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'size' => $row['size'],
			'weight' => $row['weight'],
			'datetime_appointment' => $row['datetime_appointment'],
			'freetime' => $row['freetime'],
			'image' => $row['image'],
			'contact' => $row['contact'],
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'appointment_status' => $row['appointment_status']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllHistoryAppointment()
{
	global $con;

	$res = mysqli_query($con, "SELECT * FROM appointments ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'appointment_type' => $row['appointment_type'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'size' => $row['size'],
			'weight' => $row['weight'],
			'datetime_appointment' => $row['datetime_appointment'],
			'freetime' => $row['freetime'],
			'image' => $row['image'],
			'contact' => $row['contact'],
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'appointment_status' => $row['appointment_status']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAppointment($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT * FROM appointments WHERE id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function getCurrentAppointment($id)
{

	global $con;

	$res = mysqli_query($con, "SELECT *,a.id as aid FROM appointments a LEFT JOIN users u ON a.users_id = u.id  WHERE a.id = '" . $id . "'");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function getAllAppointmentsDetail($appointments_id)
{
	global $con;

	$res = mysqli_query($con, "SELECT *,ad.id as adid FROM appointments_detail ad LEFT JOIN appointments a ON ad.appointments_id = a.id WHERE ad.appointments_id = '" . $appointments_id . "' ORDER BY ad.id ASC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['adid'],
			'appointments_id' => $row['appointments_id'],
			'products_id' => $row['products_id'],
			'freetime' => $row['freetime'],
			'users_id' => $row['users_id'],
			'appointment_type' => $row['appointment_type'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'size' => $row['size'],
			'weight' => $row['weight'],
			'datetime_appointment' => $row['datetime_appointment'],
			'image' => $row['image'],
			'contact' => $row['contact'],
			'lat' => $row['lat'],
			'lng' => $row['lng'],
			'appointment_status' => $row['appointment_status']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function runNumberSaleBuy()
{
	global $con;

	$res = mysqli_query($con, "SELECT max(id) as mid FROM sale_buy");
	$data = array();
	while ($row = mysqli_fetch_array($res)) {
		$data['mid'] = $row['mid'];
	}
	$run = intval($data['mid']);
	$run = $run + 1;

	if ($run == "")
		$run = 1;
	$number_sale_buy = sprintf('%05d', $run);

	return $number_sale_buy;
	mysqli_close($con);
}

function saveSaleBuy($users_id, $types, $run_number, $customer_name, $customer_address, $customer_telephone, $products_id, $amount, $price, $summary, $customers_id)
{
	global $con;

	$yThai = date("Y") + 543;
	$dateNow = $yThai . date("-m-d");

	$sql = "INSERT INTO sale_buy (users_id, types, run_number, customer_name, customer_address, customer_telephone, date_create, customers_id) VALUES('" . $users_id . "','" . $types . "','" . $run_number . "','" . $customer_name . "','" . $customer_address . "','" . $customer_telephone . "','" . $dateNow . "','" . $customers_id . "')";

	mysqli_query($con, $sql);
	$last_id = $con->insert_id;

	foreach ($products_id as $key => $pd) {
		if ($pd != "") {
			$pa = $amount[$key];
			$pr = $price[$key];
			$sm = $summary[$key];

			$sql_check = "select * from products where id = '" . $pd . "'";
			$res_check = mysqli_query($con, $sql_check);

			while ($row = mysqli_fetch_array($res_check)) {
				$data['prod_name'] = $row['prod_name'];
				$data['prod_amount'] = $row['prod_amount'];
			}

			if ($types == 1) {
				define('LINE_API', "https://notify-api.line.me/api/notify");
				$token = "6dKlB1LBsb8WLNN5mUlVCai1tEb3FebJtNb9UszUDwq";
				$str = $dateNow . "\n аё‚аёІаёўаёЄаёґаё™аё„а№‰аёІа№ЂаёЄаёЈа№‡аё€аёЄаёґа№‰аё™ \n аёЉаё·а№€аё­аёЈа№‰аёІаё™: " . $customer_name . "\n а№Ђаёљаё­аёЈа№Ња№‚аё—аёЈаёЁаё±аёћаё—а№Њ: " . $customer_telephone . "\n аёЉаё·а№€аё­аёЄаёґаё™аё„а№‰аёІ: " . $data['prod_name'] . "\n аё™а№‰аёіаё«аё™аё±аёЃ: " . $pa . "\n аёЈаёІаё„аёІаёЈаё§аёЎ: " . $sm;
				$res = notify_message($str, $token);
				$bal = $data['prod_amount'] - $pa;
				$sql_amount = "UPDATE products SET prod_amount='" . $bal . "' WHERE id = '" . $pd . "'";
				mysqli_query($con, $sql_amount);
			} else if ($types == 2) {
				define('LINE_API', "https://notify-api.line.me/api/notify");
				$token = "6dKlB1LBsb8WLNN5mUlVCai1tEb3FebJtNb9UszUDwq";
				$str = $dateNow . "\n аё‹аё·а№‰аё­аёЄаёґаё™аё„а№‰аёІа№ЂаёЄаёЈа№‡аё€аёЄаёґа№‰аё™ \n аё„аёёаё“: " . $customer_name . "\n а№Ђаёљаё­аёЈа№Ња№‚аё—аёЈаёЁаё±аёћаё—а№Њ: " . $customer_telephone . "\n аёЉаё·а№€аё­аёЄаёґаё™аё„а№‰аёІ: " . $data['prod_name'] . "\n аё™а№‰аёіаё«аё™аё±аёЃ: " . $pa . "\n аёЈаёІаё„аёІаёЈаё§аёЎ: " . $sm;
				$res = notify_message($str, $token);
				$bal = $data['prod_amount'] + $pa;
				$sql_amount = "UPDATE products SET prod_amount='" . $bal . "' WHERE id = '" . $pd . "'";
				mysqli_query($con, $sql_amount);
			}

			$sql_detail = "INSERT INTO sale_buy_detail (sale_buy_id, products_id, amount, price, summary) VALUES ('" . $last_id . "','" . $pd . "','" . $pa . "','" . $pr . "','" . $sm . "')";
			mysqli_query($con, $sql_detail);
		}
	}

	mysqli_close($con);
	if ($types == 1) {
		echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'аё‚аёІаёўаёЄаёґаё™аё„а№‰аёІа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					confirmButtonText: 'аёўаё·аё™аёўаё±аё™'
				}).then(() => {
					document.location.href = 'manage_sale_buy.php';
				});
			});
		</script>");
	} else if ($types == 2) {
		echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'аё‹аё·а№‰аё­аёЄаёґаё™аё„а№‰аёІа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					confirmButtonText: 'аёўаё·аё™аёўаё±аё™'
				}).then(() => {
					document.location.href = 'manage_sale_buy.php';
				});
			});
		</script>");
	}
}

function getAllSaleBuy()
{
	global $con;

	$sql = "SELECT *,s.id as sid FROM sale_buy s LEFT JOIN users u ON s.users_id = u.id ORDER BY s.id DESC";
	$res = mysqli_query($con, $sql);

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'users_id' => $row['users_id'],
			'types' => $row['types'],
			'run_number' => $row['run_number'],
			'customer_name' => $row['customer_name'],
			'customer_address' => $row['customer_address'],
			'customer_telephone' => $row['customer_telephone'],
			'date_create' => $row['date_create']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllSaleBuyUserId($users_id)
{
	global $con;

	$sql = "SELECT *,s.id as sid FROM sale_buy s LEFT JOIN users u ON s.users_id = u.id WHERE s.users_id = '" . $users_id . "' ORDER BY s.id DESC";
	$res = mysqli_query($con, $sql);

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sid'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'users_id' => $row['users_id'],
			'types' => $row['types'],
			'run_number' => $row['run_number'],
			'customer_name' => $row['customer_name'],
			'customer_address' => $row['customer_address'],
			'customer_telephone' => $row['customer_telephone'],
			'date_create' => $row['date_create']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllSaleBuyDetail($sale_buy_id)
{
	global $con;

	$res = mysqli_query($con, "SELECT *,sb.id as sbid FROM sale_buy_detail sb LEFT JOIN products p ON sb.products_id = p.id WHERE sb.sale_buy_id = '" . $sale_buy_id . "' ORDER BY sb.id ASC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sbid'],
			'sale_buy_id' => $row['sale_buy_id'],
			'products_id' => $row['products_id'],
			'amount' => $row['amount'],
			'price' => $row['price'],
			'summary' => $row['summary'],
			'categories_id' => $row['categories_id'],
			'prod_name' => $row['prod_name'],
			'prod_amount' => $row['prod_amount'],
			'prod_price_cost' => $row['prod_price_cost'],
			'prod_image' => $row['prod_image']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getAllSaleBuyCustomer($customers_id)
{
	global $con;

	$sql = "SELECT *,s.id as sid FROM sale_buy s LEFT JOIN users u ON s.users_id = u.id WHERE s.customers_id = '" . $customers_id . "' ORDER BY s.id DESC";
	$res = mysqli_query($con, $sql);

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sid'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'users_id' => $row['users_id'],
			'types' => $row['types'],
			'run_number' => $row['run_number'],
			'customer_name' => $row['customer_name'],
			'customer_address' => $row['customer_address'],
			'customer_telephone' => $row['customer_telephone'],
			'date_create' => $row['date_create']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getCurrentSaleBuy($id)
{

	global $con;

	$sql = "SELECT *,s.id as sid FROM sale_buy s LEFT JOIN users u ON s.users_id = u.id WHERE s.id = '" . $id . "' ";
	$res = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function editContact($id, $users_id, $owner, $phone, $address, $work_date, $time_open, $time_close, $lat, $lng, $store_status)
{

	global $con;

	$sql = "UPDATE contact SET users_id='" . $users_id . "',owner='" . $owner . "',phone='" . $phone . "',address='" . $address . "',work_date='" . $work_date . "',time_open='" . $time_open . "',time_close='" . $time_close . "',lat='" . $lat . "',lng='" . $lng . "',store_status='" . $store_status . "' WHERE id = '" . $id . "'";

	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("<script>
			$(document).ready(function() {
				Swal.fire({
					icon: 'success',
					title: 'аёЄаёіа№ЂаёЈа№‡аё€',
					text: 'а№ЃаёЃа№‰а№„аё‚аё‚а№‰аё­аёЎаё№аёҐа№ЂаёЈаёµаёўаёљаёЈа№‰аё­аёў',
					showConfirmButton: false
				});
			});
	</script>");
	header("refresh:1; url=manage_contact.php");
}

function getAllContact()
{
	global $con;


	$res = mysqli_query($con, "SELECT * FROM contact ORDER BY id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['id'],
			'users_id' => $row['users_id'],
			'owner' => $row['owner'],
			'phone' => $row['phone'],
			'address' => $row['address'],
			'work_date' => $row['work_date'],
			'time_open' => $row['time_open'],
			'time_close' => $row['time_close'],
			'lat' => $row['lat'],
			'store_status' => $row['store_status'],
			'lng' => $row['lng']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getCurrentContact()
{

	global $con;

	$sql = "SELECT * FROM contact WHERE id = '1' ";
	$res = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function getReportProfit($dateStart, $dateEnd)
{
	global $con;

	$arrDate1 = explode("/", $dateStart);
	$convert_start_date = $arrDate1[2] . '-' . $arrDate1[1] . '-' . $arrDate1[0];
	$arrDate2 = explode("/", $dateEnd);
	$convert_end_date = $arrDate2[2] . '-' . $arrDate2[1] . '-' . $arrDate2[0];

	$sql = "SELECT *,sb.id as sbid
	FROM sale_buy sb
	LEFT JOIN users u ON sb.users_id = u.id 
	WHERE (sb.date_create BETWEEN '" . $convert_start_date . "' AND '" . $convert_end_date . "') AND sb.types = '1'
	ORDER BY sb.date_create ASC";
	$res = mysqli_query($con, $sql);

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sbid'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'users_id' => $row['users_id'],
			'types' => $row['types'],
			'run_number' => $row['run_number'],
			'customer_name' => $row['customer_name'],
			'customer_tax' => $row['customer_tax'],
			'customer_address' => $row['customer_address'],
			'customer_telephone' => $row['customer_telephone'],
			'date_create' => $row['date_create']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getReportLoss($dateStart, $dateEnd)
{
	global $con;

	$arrDate1 = explode("/", $dateStart);
	$convert_start_date = $arrDate1[2] . '-' . $arrDate1[1] . '-' . $arrDate1[0];
	$arrDate2 = explode("/", $dateEnd);
	$convert_end_date = $arrDate2[2] . '-' . $arrDate2[1] . '-' . $arrDate2[0];

	$sql = "SELECT *,sb.id as sbid
	FROM sale_buy sb
	LEFT JOIN users u ON sb.users_id = u.id 
	WHERE (sb.date_create BETWEEN '" . $convert_start_date . "' AND '" . $convert_end_date . "') AND sb.types = '2'
	ORDER BY sb.date_create ASC";
	$res = mysqli_query($con, $sql);

	$data = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$namesArray[] = array(
			'id' => $row['sbid'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'telephone' => $row['telephone'],
			'email' => $row['email'],
			'users_id' => $row['users_id'],
			'types' => $row['types'],
			'run_number' => $row['run_number'],
			'customer_name' => $row['customer_name'],
			'customer_tax' => $row['customer_tax'],
			'customer_address' => $row['customer_address'],
			'customer_telephone' => $row['customer_telephone'],
			'date_create' => $row['date_create']
		);
	}

	$data = $namesArray;

	return $data;
	mysqli_close($con);
}

function getCheckTimeAppointment($datetime_appointment)
{

	global $con;

	$datetime = explode(' ', $datetime_appointment);
	$date = changeDate($datetime['0']);
	$time = substr($datetime['1'], 0);
	$get_datetime = $date . " " . $time;

	$res = mysqli_query($con, "SELECT count(*) as numCount FROM appointments  WHERE datetime_appointment = '" . $get_datetime . "' ");
	$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $result;

	mysqli_close($con);
}

function convertMoneyToText($number)
{
	$txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
	$txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
	$number = str_replace(",", "", $number);
	$number = str_replace(" ", "", $number);
	$number = str_replace("บาท", "", $number);
	$number = explode(".", $number);
	if (sizeof($number) > 2) {
		return 'ทศนิยมหลายตัว';
		exit;
	}
	$strlen = strlen($number[0]);
	$convert = '';
	for ($i = 0; $i < $strlen; $i++) {
		$n = substr($number[0], $i, 1);
		if ($n != 0) {
			if ($i == ($strlen - 1) and $n == 1) {
				$convert .= 'เอ็ด';
			} elseif ($i == ($strlen - 2) and $n == 2) {
				$convert .= 'ยี่';
			} elseif ($i == ($strlen - 2) and $n == 1) {
				$convert .= '';
			} else {
				$convert .= $txtnum1[$n];
			}
			$convert .= $txtnum2[$strlen - $i - 1];
		}
	}

	$convert .= 'บาท';
	if (
		$number[1] == '0' or $number[1] == '00' or
		$number[1] == ''
	) {
		$convert .= 'ถ้วน';
	} else {
		$strlen = strlen($number[1]);
		for ($i = 0; $i < $strlen; $i++) {
			$n = substr($number[1], $i, 1);
			if ($n != 0) {
				if ($i == ($strlen - 1) and $n == 1) {
					$convert
						.= 'เอ็ด';
				} elseif (
					$i == ($strlen - 2) and
					$n == 2
				) {
					$convert .= 'ยี่';
				} elseif (
					$i == ($strlen - 2) and
					$n == 1
				) {
					$convert .= '';
				} else {
					$convert .= $txtnum1[$n];
				}
				$convert .= $txtnum2[$strlen - $i - 1];
			}
		}
		$convert .= 'สตางค์';
	}
	return $convert;
}


function notify_message($message, $token)
{
	$queryData = array('message' => $message);
	$queryData = http_build_query($queryData, '', '&');
	$headerOptions = array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
				. "Authorization: Bearer " . $token . "\r\n"
				. "Content-Length: " . strlen($queryData) . "\r\n",
			'content' => $queryData
		),
	);
	$context = stream_context_create($headerOptions);
	$result = file_get_contents(LINE_API, FALSE, $context);
	$res = json_decode($result);
	return $res;
}
