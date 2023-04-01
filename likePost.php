<?php
if (isset($_POST["likeBtn"])) {
    $postid = $_GET["id"];

    require_once "connectDB.php";

    $stmt = mysqli_stmt_init($conn);
    $sql = "UPDATE posts set likes=likes+1 where postid = ?;";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:index.php?error=sql");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $postid);
    mysqli_stmt_execute($stmt);

    header("Location:viewPost.php?id=" . $postid);
} else {
    header("location:index.php?error=sql");
}
