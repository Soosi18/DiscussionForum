<?php

if (isset($_POST["submit"])) {
    $name = $_POST["username"];
    $pass = $_POST["pw"];
    require_once "connectDB.php";

    $sql = "SELECT * from users where username = ? or email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:login.php?error=sql");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
        header("Location:login.php?error=fail");
        exit();
    }
    else{
        $hashedpw = $row['password'];
        $checkpw = password_verify($pass, $hashedpw);
        if(!password_verify($pass, $hashedpw)){
            header("Location:login.php?error=fail");
            exit();
        }

        session_start();
        $_SESSION["name"] = $name;
        header("location:index.php");
        exit();
    }
}
else{
    header("Location:index.php");
}
