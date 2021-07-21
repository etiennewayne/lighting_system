<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['submit'])){

        require 'php/config.php';

        $user = $_POST['username'];
        $pwd = $_POST['password'];

        try {
            $con = Connection::con();
            $sql = "select * from users where username = :user and password = :pwd limit 1";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':pwd', $pwd);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $res = $stmt->fetchAll();     

            //echo $_SESSION['user'];

           if($stmt->rowCount() > 0){
                $userObj = new \stdClass();

                $userObj->username = $res[0]['username'];
                $userObj->lname = $res[0]['lname'];
                $userObj->fname = $res[0]['fname'];
                $userObj->mname = $res[0]['mname'];
                $userObj->role = $res[0]['role'];

                $_SESSION['user'] = json_encode($userObj);

              
              //$root_url = $_SERVER['PHP_SELF'];
              header('location: home.php');
           }

        }catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }


    }

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

    <title>Door Lock</title>

    <style>
        html body{
            height: 100%;
        }
    </style>
</head>
<body>

<div class="welcome-container">

    <div class="card" style="width: 400px;">
        <h5 class="card-header">LOGIN</h5>
        <div class="card-body">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
