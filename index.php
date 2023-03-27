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
            <div class="title"><a href="viewPost.php">Title: ' . $row["title"] . '</a></div>
            <div class="category">Category: ' . $row["category"] . '</div>
            <div class="content">Description: ' . $row["content"] . '</div>
            <div class="content">Likes: ' . $row["likes"] . '</div>
            <div class="content">Comments: ' . $row["comments"] . '</div><br><br>
        </div>
        ';
    }
    ?>
</body>

</html>