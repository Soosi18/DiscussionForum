<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'header.php';
    require_once "connectDB.php";
    $sql = "select * from posts";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="wrapper">
            <div class="title"><a href="viewPost.php">Title: ' . $row["title"] . '</a></div>
            <div class="category">Category: ' . $row["category"] . '</div>
            <div class="content">Description: ' . $row["content"] . '</div>
        </div>
        ';
    }
    ?>
</body>

</html>