<?php session_start() ?>
<div class="navbar">
    <a href="index.php">HOME</a>
    <form action="search.php" method="get" id="searchPost">
        <input type="text" id="searchposts" name="searchposts" placeholder="Search...">
        <input type="submit" name="searchpost" placeholder="Search..." value="Search Post">
    </form>
    
    <?php
    if(isset($_SESSION["name"])){
        if($_SESSION["name"] === "admin"){
            echo "<a class=\"right\" href=\"manageAccounts.php\">MANAGE ACCOUNTS</a>";
            echo "<a class=\"right\" href=\"managePosts.php\">MANAGE POSTS</a>";
        }
        $name = $_SESSION["name"];
        echo "<a href=\"post.php\">CREATE POST</a>";
        echo "<a class=\"right\" href=\"myAccount.php\">MY ACCOUNT</a>";
        echo "<a class=\"right\" id=\"logout\" href=\"logout.php\">LOG OUT</a>"; 
    }
    else{
        echo "<a href=\"login.php\">LOG IN</a>";
        echo "<a href=\"register.php\">REGISTER</a>";
    }
    ?>
</div>