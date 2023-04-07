<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validateRegister.js"></script>
</head>

<body>
    <?php include_once 'header.php';
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        if ($error == "sql") {
            echo "<script>alert(\"Unexpected Error Occured. Please Try Again\");</script>";
        }
        if ($error == "usertaken") {
            echo "<script>alert(\"Username/E-mail Already In Use. Please Try Again\");</script>";
        }
    }
    ?>
    <div class="wrapper">

        <h2 id="info">Register New Account</h2>
        <div class="registerForm">
            <form action="createUser.php" method="POST" enctype="multipart/form-data" class="userForm" id="registerForm" onsubmit="return validate()" novalidate>
                <div class="form-group">
                    <label for="username" class="formlabel">Username:</label><br>
                    <input type="text" class="required" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="pw" class="formlabel">Password:</label><br>
                    <input type="password" class="required" name="pw" id="pw">
                </div>
                <div class="form-group">
                    <label for="pw" class="formlabel">Confirm Password:</label><br>
                    <input type="password" class="required" name="repw" id="repw">
                </div>
                <div class="form-group">
                    <label for="email" class="formlabel">E-mail:</label><br>
                    <input type="email" class="required" name="email" id="email">
                </div>
                <div class="form-group" id="image">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                    <label for="profile-picture" class="formlabel">Profile Picture:</label><br>
                    <input type="file" name="img" id="img">
                </div>
                <div class=submit>
                    <input type="submit" name="submit" value="Register">
                </div>
            </form>
        </div>


    </div>
    <?php include_once 'footer.php'; ?>
</body>

</html>