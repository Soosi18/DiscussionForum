<?php
session_start();
if (isset($_POST["submit"])){
    $title = $_POST["title"];
    $category = $_POST["category"];
    $desc = $_POST["desc"];
    $uname = $_SESSION["name"];
    $zero = 0;

    require_once "connectDB.php";
    
    $sql = "select id from users where username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:register.php?error=sql");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $uid = $row["id"];

    $sql = "insert into posts(userid, category, title, content, postdate, likes) values(?, ?, ?, ?, CURRENT_TIMESTAMP, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:register.php?error=sql");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "isssi", $uid, $category, $title, $desc, $zero);
    if(!mysqli_stmt_execute($stmt)){
        header("location: post.php?error=sql");
    }

    header("Location:index.php");
}