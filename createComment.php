<?php
session_start();
if (isset($_POST["commentBtn"])) {
    $postid = $_GET["id"];
    $content = $_POST["commentBox"];
    $uname = $_SESSION["name"];
    $reply = $_GET["reply"];
    
    require_once "connectDB.php";

    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT * from users where username = ?;";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:index.php?error=sql");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $uid = $row["id"];

    if (isset($_GET["reply"])) {
        $replyid = $_GET["reply"];
        $sql = "insert into comments(postid, userid, replyid, content, commentdate, likes) values(?, ?, ?, ?, CURRENT_TIMESTAMP, 0);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:index.php?error=sql");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "iiis", $postid, $uid, $replyid, $content);
    } else {
        $sql = "insert into comments(postid, userid, content, commentdate, likes) values(?, ?, ?, CURRENT_TIMESTAMP, 0);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:index.php?error=sql");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "iis", $postid, $uid, $content);
    }

    if (!mysqli_stmt_execute($stmt)) {
        header("location:viewPost.php?error=sql");
    }

    header("Location:viewPost.php?id=" . $postid);
} else {
    header("location:index.php?error=".$postid."&type=" . $reply);
}
