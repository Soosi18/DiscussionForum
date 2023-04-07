<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Account</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'header.php';
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        if ($error == "sql") {
            echo "<script>alert(\"Unexpected Error Occured. Please Try Again\");</script>";
        }
    }

    if (isset($_GET["status"])) {
        $status = $_GET["status"];
        if ($status == "success") {
            echo "<script>alert(\"Successfully Updated!\");</script>";
        }
    }

    if (isset($_SESSION["name"])) {
        $uname = $_SESSION["name"];
        require_once "connectDB.php";

        $sql = "SELECT email, image from users where username = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:index.php?error=sql");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $email = $row["email"];
        $currentImg = $row["image"];
    } else {
        header("location:index.php");
    }
    ?>

    <h2 id="info">Account Information</h2>
    <div class="registerForm">
        <form action="updateUser.php" method="POST" class="userForm" id="updateForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username" class="formlabel">Username:</label><br>
                <input type="text" class="forminput" name="username" id="username" placeholder="<?php echo $_SESSION["name"]; ?>">
            </div>
            <div class="form-group">
                <label for="email" class="formlabel">Email:</label><br>
                <input type="email" class="forminput" name="email" id="email" placeholder="<?php echo $row["email"]; ?>">
            </div>
            <div class="form-group" id="image">
                <img id="pp" src="img/<?php echo $row["image"]; ?>">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000"><br>
                <input type="file" name="img" id="img">
            </div>
            <div class=submit>
                <input type="submit" name="submit" value="Update">
            </div>
        </form>
    </div>


    </div>
    <?php include_once 'footer.php'; ?>
</body>

</html>