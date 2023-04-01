<?php

if (isset($_GET["id"])) {
    $uid = $_GET["id"];

    require_once "connectDB.php";

    $sql = "delete from users where id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:index.php?error=sql");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_affected_rows($conn) == 0) {
        header("Location:index.php?error=sql");
        exit();
    }
    else{
        header("location:manageAccounts.php?status=success");
    }
} else {
    header("Location:index.php");
}
