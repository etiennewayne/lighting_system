<?php

require 'config.php';

$con = Connection::con();
$sql = "select * from users";
$stmt = $con->prepare($sql);
// $stmt->bindParam(':user', $user);
// $stmt->bindParam(':pwd', $pwd);
$stmt->execute();
$res = $stmt->fetchAll();

//$obj = new \stdClass();

$arr = [];
foreach($res as $row){

    array_push($arr, array(
        'user_id' => $row['user_id'],
        'username' => $row['username'],
        'lname' => $row['lname'],
        'fname' => $row['fname'],
        'mname' => $row['mname'],
        'sex' => $row['sex'],
        'role' => $row['role'],
    ));
}

echo json_encode($arr);