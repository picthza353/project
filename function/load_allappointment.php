<?php

$connect = new PDO('mysql:host=localhost;dbname=store_steel', 'root', '');
$connect->exec("set names utf8");
$data = array();

$query = "SELECT * FROM appointments WHERE appointment_status ORDER BY id DESC;";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
foreach($result as $row)
{
  $datetime = explode(' ',$row["datetime_appointment"]);
  $get_date = explode("-",$datetime[0]);
  $get_date[0] = $get_date[0] - 543;
  $convert_get_date = $get_date[0].'-'.$get_date[1].'-'.$get_date[2];
  $get_time = substr($datetime[1], 0,5); 
  $convert_date_time = $convert_get_date."T".$datetime[1];
   
 $data[] = array(
  'id'   => $row["id"],
  'title'   => "นัดหมายแล้ว",
  'start'   => $convert_date_time,
  'end'   => $convert_get_date
 );
}

echo json_encode($data);

?>