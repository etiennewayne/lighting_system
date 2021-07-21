<?php

require 'config.php';

$con = Connection::con();

$sql = "select * from doors";
$stmt = $con->prepare($sql);
// $stmt->bindParam(':user', $user);
// $stmt->bindParam(':pwd', $pwd);
$stmt->execute();
$res = $stmt->fetchAll();

//$obj = new \stdClass();

$arr = [];
foreach($res as $row){

    array_push($arr, array(
        'door_id' => $row['door_id'],
        'rfid' => $row['rfid'],
        'door_name' => $row['door_name'],

    ));
}

echo json_encode($arr);