<?php
class Connection{

    public static function con(){

        $servername = "localhost";
        $username = "root";
        $password = "";

        $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
        );

        try {
            $conn = new PDO("mysql:host=$servername;dbname=doorlock", $username, $password, $options);
            // set the PDO error mode to exception
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, );
            return $conn;

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


}


