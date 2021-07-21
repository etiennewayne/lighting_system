<?php

    require 'config.php';

    $con = Connection::con();

    $sql = "select * from schedules a join doors b on a.door_id = b.door_id
        join users c on a.user_id = c.user_id";
    $stmt = $con->prepare($sql);
    // $stmt->bindParam(':user', $user);
    // $stmt->bindParam(':pwd', $pwd);
    $stmt->execute();
    $res = $stmt->fetchAll();
    
    //$obj = new \stdClass();

    $arr = [];
    foreach($res as $row){
        
        array_push($arr, array(
            'schedule_id' => $row['schedule_id'],
            'username' => $row['username'],
            'lname' => $row['lname'],
            'fname' => $row['fname'],
            'mname' => $row['mname'],
            'sex' => $row['sex'],
            'role' => $row['role'],

            'rfid' => $row['rfid'],
            'door_name' => $row['door_name'],

            'schedule_name' => $row['schedule_name'],
            'datetime_from' => $row['datetime_from'],
            'datetime_to' => $row['datetime_to'],

        ));
    }
 
    echo json_encode($arr);