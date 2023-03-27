<?php
session_start();
if (isset($_POST["submit"])) {
    $oldName = $_SESSION["name"];
    $uname = $_POST["username"];
    $email = $_POST["email"];
    $imgName = $_FILES['img']['name'];

    require_once "connectDB.php";
    $stmt = mysqli_stmt_init($conn);
    if ($imgName !== "") {
        move_uploaded_file($_FILES['img']['tmp_name'], "img/" . $imgName);

        $sql = "update users set username = ?, email = ?, image = ? where username = ?;";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:myAccount.php?error=sql");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $uname, $email, $imgName, $oldName);
    } else {
        $imgName = "default.jpg";
        $sql = "update users set username = ?, email = ?, image = ? where username = ?;";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:myAccount.php?error=sql");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $uname, $email, $imgName, $oldName);
    }

    if (!mysqli_stmt_execute($stmt)) {
        header("Location:myAccount.php?error=sql");
        exit();
    }
    $_SESSION["name"] = $name;
    mysqli_stmt_close($stmt);
    header("Location:login.php?status=update");

} else {
    header("Location:index.php");
}
