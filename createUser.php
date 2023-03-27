<?php

if (isset($_POST["submit"])){
    $name = $_POST["username"];
    $pass = $_POST["pw"];
    $repw = $_POST["repw"];
    $email = $_POST["email"];
    $imgName = $_FILES['img']['name'];
    $hashedpw = password_hash($pass, PASSWORD_DEFAULT);

    require_once "connectDB.php";
    
    $sql = "SELECT * from users where username = ? or email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:register.php?error=sql");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($result)){
        header("Location:register.php?error=usertaken");
        exit();
    }
    else{
        if($imgName !== ""){  
            move_uploaded_file($_FILES['img']['tmp_name'], "img/". $imgName);

            $sql = "insert into users(username, password, email, image) values(?,?,?,?);";
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location:register.php?error=sql");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ssss", $name, $hashedpw, $email, $imgName);
        }
        else{
            $imgName = "default.jpg";
            $sql = "insert into users(username, password, email, image) values(?,?,?,?);";
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location:register.php?error=sql");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ssss", $name, $hashedpw, $email, $imgName);
        }

        if(!mysqli_stmt_execute($stmt)){
            header("Location:register.php?error=sql");
            exit();
        }
        mysqli_stmt_close($stmt);
        header("Location:index.php?status=success");
    }
}
else{
    header("Location:index.php");
}
