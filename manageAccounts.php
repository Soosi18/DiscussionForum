<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'header.php';

    require_once "connectDB.php";

    $sql = "SELECT * from users where username != \"admin\"";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:register.php?error=sql");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>
    <div class="wrapper">
        <h2 id="info">Manage All Accounts</h2>
        <div class="userTable">
            <table>
                <thead>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Profile Picture</th>
                    <th>Manage</th>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td><td><img src=\"img/" . $row["image"] . "\"></td><td><a href=\"deleteUser.php\">Delete User</a></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>