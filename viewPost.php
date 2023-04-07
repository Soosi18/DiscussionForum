<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Post</title>
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

    if (isset($_GET["id"])) {
        $postid = $_GET["id"];
        require_once "connectDB.php";
        $sql = "select * from posts where postid = " . $postid . ";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '
        <div class="wrapper">
            <div class="postwrapper">
            <div id="postinfo">
                <div class="title"><h2>Post Title: ' . $row["title"] . '</h2></div>
                <div class="posted">Posted on: ' . $row["postdate"] . '</div>
                <div class="category">Category: ' . $row["category"] . '</div>
                <div class="likes">Likes: ' . $row["likes"] . '<form style="display:inline" action="likePost.php?id=' . $postid . '" method="POST">
                    <input type="submit" name="likeBtn" value="Like Post">
                </form>
                </div>
            ';
        $sql = "select count(*) as numComments from comments where postid = " . $postid . ";";
        $result2 = mysqli_query($conn, $sql);
        $comm = mysqli_fetch_assoc($result2);
        echo '
            <div class="comment">Comments: ' . $comm["numComments"] . '</div><br><br>
            </div>
            <div class="content"><h2>Post Description:</h2><p>' . $row["content"] . '<p></div><br>
            </div>
            ';

        echo '<div class="commentswrapper"><h2>Comments:</h2>';
        $noComms = true;
        $sql = "select * from comments where postid = " . $postid . " and replyid is null order by replyid ASC;";
        $comments = mysqli_query($conn, $sql);
        if (mysqli_num_rows($comments) != 0) {
            $noComms = false;
        }
        postComments($conn, $comments, $postid, 0);
        echo '</div>';
        if ($noComms) {
            if (isset($_SESSION["name"])) {
                echo '<p>Be the first to comment on this post!</p>';
                mainComment($postid);
            } else {
                echo '<p>No comments have been made for this post</p>';
            }
        } else {
            if (isset($_SESSION["name"])) {
                mainComment($postid);
            }
        }
    }

    function postComments($conn, $comments, $postid, $indent)
    {
        while ($comment = mysqli_fetch_assoc($comments)) {
            postComment($conn, $comment, $postid, $indent);
            $replies = getReplies($conn, $comment["commentid"]);
            postComments($conn, $replies, $postid, $indent + 3);
        }
    }

    function postComment($conn, $comment, $postid, $indent)
    {
        $sql = "select username from users, comments where users.id = comments.userid and comments.userid = " . $comment["userid"] . ";";
        $nameresult = mysqli_query($conn, $sql);
        $commenter = mysqli_fetch_assoc($nameresult);
        echo '
                <div class="outer">
                    <div class="inner" style="margin-left:' . $indent . 'em">
                        ' . $commenter["username"] . ' said (on ' . $comment["commentdate"] . '): <br>' . $comment["content"] . '<br>
                        <form action="createComment.php?id=' . $postid . '&reply=' . $comment["commentid"] . '" method="post">
                            <input type="text" name="commentBox" id="commentBox">
                            <input type="submit" name="commentBtn" value="Reply to Comment">
                        </form>
                    </div>
                </div>
            ';
    }

    function getReplies($conn, $commentId)
    {
        $sql = "select * from comments where replyid = " . $commentId . ";";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    function mainComment($postid)
    {
        echo '
                    <div class="makeComment">
                        <br><br>Comment on this post:
                        <form action="createComment.php?id=' . $postid . '" method="post">
                            <textarea name="commentBox" id="commentBox">Type your comment here...</textarea><br>
                            <input type="submit" name="commentBtn" value="Post Comment">
                        </form>
                    </div>
                ';
    }

    include_once 'footer.php'; ?>
</body>

</html>