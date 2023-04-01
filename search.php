<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'header.php';
    if (isset($_GET["error"])) {
        $status = $_GET["error"];
        if ($status == "noPost") {
            echo "<script>alert(\"There are no posts matching the entered Keyboards. Please try again!\");</script>";
        }
    }

    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        if ($error == "sql") {
            echo "<script>alert(\"Unexpected Error Occured. Please Try Again\");</script>";
        }
    }

    if (isset($_GET["searchposts"])) {
        $keyword = $_GET["searchposts"];
        require_once "connectDB.php";
        $sql = "select * from posts where content like '%" . $keyword . "%' or title like '%" . $keyword . "%'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo 'No posts that match the keyword were found...';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <div class="wrapper">
                        <div class="title"><a href="viewPost.php?id=' . $row["postid"] . '">Title: ' . $row["title"] . '</a></div>
                        <div class="category">Category: ' . $row["category"] . '</div>
                        <div class="posted">Posted on: ' . $row["postdate"] . '</div>
                        <div class="likes">Likes: ' . $row["likes"] . '</div>
                    ';
                $sql = "select count(*) as numComments from comments where postid = " . $row["postid"] . ";";
                $result2 = mysqli_query($conn, $sql);
                $comm = mysqli_fetch_assoc($result2);
                echo '
                <div class="content">Comments: ' . $comm["numComments"] . '</div><br><br>
            </div>
            ';
            }
        }
    } else {
        header("location:index.php?error=sql");
    }
    ?>
</body>

</html>