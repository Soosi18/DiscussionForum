<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validateLogin.js"></script>
</head>

<body>
    <?php include_once 'header.php';
    if(isset($_GET["error"])){
        $error = $_GET["error"];
        if($error == "sql"){
            echo "<script>alert(\"Unexpected Error Occured. Please Try Again\");</script>";    
        }
        if($error === "fail"){
            echo "<script>alert(\"Username or Password Incorrect. Try Again!\");</script>";  
        }
        if($error == "pw"){
            echo "<script>alert(\"pw\");</script>";    
        }
    }

    if(isset($_GET["status"])){
        $status = $_GET["status"];
        if($status == "update"){
            echo "<script>alert(\"Successfully Updated! Please Log In Again\");</script>";    
        }
    }
    ?>

    <h2 id="info">Log In</h2>
    <div class="registerForm">
        <form action="loginUser.php" method="POST" class="userForm" id="loginForm">
            <div class="form-group">
                <label for="username" class="formlabel">Username/Email:</label><br>
                <input type="text" class="forminput" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="pw" class="formlabel">Password:</label><br>
                <input type="password" class="forminput" name="pw" id="pw">
            </div>
            <div class=submit>
                <input type="submit" name="submit" value="Log in">
            </div>
        </form>
    </div>


    </div>
</body>

</html>