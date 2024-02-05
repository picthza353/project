<?php

$con = mysqli_connect("localhost","root","","store_steel");
$con->set_charset("utf8");

if($_REQUEST["load"]=="product"){
	
	$result = $con->query("select * from products where id='{$_GET["pro_id"]}'");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="customer"){
	
	$result = $con->query("select * from users where id='{$_GET["users_id"]}'");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="customer1"){
	
	$result = $con->query("select * from users where id='{$_GET["id"]}'");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="destination_location"){
	
	$result = $con->query("select * from appointments where appointment_type = '2' and appointment_status = '2' order by datetime_appointment asc");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="store_location"){
	
	$result = $con->query("select * from contact");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="register"){
	
	$result = $con->query("select * from users");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="categorie"){
	
	$result = $con->query("select * from categories");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="prod_name"){
	
	$result = $con->query("select * from products");

	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);
}

if($_REQUEST["load"]=="datetime"){

	
	$result = $con->query("select * from appointments where datetime_appointment = '".$convert_date_appointment."' ");
	$array = array();
	while($row = $result->fetch_object()){
		
		array_push($array, $row);
	}
	echo json_encode($array);

}

?>



