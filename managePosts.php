<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Posts</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'header.php';

    if (isset($_GET["status"])) {
        $status = $_GET["status"];
        if ($status == "success") {
            echo "<script>alert(\"Post Deleted Successfully!\");</script>";
        }
    }

    require_once "connectDB.php";

    $sql = "SELECT * from posts";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:index.php?error=sql");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>
    <div class="wrapper">
        <h2 id="info">Manage All Posts</h2>
        <div class="postTable">
            <table>
                <thead>
                    <th>Post Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Likes</th>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["title"] . "</td><td>" . $row["category"] . "</td><td>" . $row["postdate"] . "</td><td><a href=\"deletePost.php?id=" . $row["postid"] . "\">Delete Post</a></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>