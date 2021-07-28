<?php
session_start();

if(isset($_SESSION['user'])){
    $user = json_decode( $_SESSION['user']);
    
}else{
    header('location: index.php');
}
    

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/switchstyle.css">


    <title>Lighting System</title>

    <style>
     
    </style>
</head>
<body>

    <?php include_once 'includes/nav.php' ?>

    <div class="container">
        <h1>Toggle Switch</h1>

        <label class="switch">
            <input type="checkbox" id="togBtn">
            <div class="slider round">
            
            <span class="on">ON</span>
            <span class="off">OFF</span>
            
            </div>
        </label>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
