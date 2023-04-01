<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'header.php';
    if(isset($_GET["status"])){
        $status = $_GET["status"];
        if($status == "success"){
            echo "<script>alert(\"Successfully Registered! You can now Log In!\");</script>";
        }
    }

    if(isset($_GET["error"])){
        $error = $_GET["error"];
        if($error == "sql"){
            echo "<script>alert(\"Unexpected Error Occured. Please Try Again\");</script>";    
        }
    }
    require_once "connectDB.php";
    $sql = "select * from posts";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="wrapper">
        <div class="allposts">
            <div class="title"><a href="viewPost.php?id=' . $row["postid"] . '">Title: ' . $row["title"] . '</a></div>
            <div class="category">Category: ' . $row["category"] . '</div>
            <div class="posted">Posted on: ' . $row["postdate"] . '</div>
            <div class="likes">Likes: ' . $row["likes"] . '</div>
            ';
        $sql = "select count(*) as numComments from comments where postid = " . $row["postid"] . ";";
        $result2 = mysqli_query($conn, $sql);
        $comm = mysqli_fetch_assoc($result2);
        echo '
            <div class="commentcount">Comments: ' . $comm["numComments"] . '</div><br><br>
        </div>
        </div>
        ';
    }
    ?>
</body>

</html>