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
    
    ?>
    <div class="wrapper">
        <h2 style="text-align:center">Create New Post</h2>
        <div class="postForm">
            <form action="createPost.php" method="POST" class="userForm">
                <div class="form-group">
                    <label for="title" class="formlabel">Post Title:</label><br>
                    <input type="text" class="required" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="category" class="formlabel">Select Category:</label><br>
                    <select name="category" id="category">
                        <option value="Games">Games</option>
                        <option value="Music">Music</option>
                        <option value="TV and Movies">TV and Movies</option>
                        <option value="Miscellaneous">Miscellaneous</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description" class="formlabel">Description:</label><br>
                    <textarea class="required" name="desc" id="desc" rows="15" cols="100"></textarea>
                </div>
                <div class=submit>
                    <input type="submit" name="submit" value="Create Post">
                </div>
            </form>
        </div>
    </div>
</body>
</html>