<?php
    $username = "project";
    $pw = "projectpw";
    $db = "forumdb";
    $host = "localhost";

    $conn = new mysqli($host, $username, $pw, $db);

    if($conn->connect_error){
        die("Connection Error Occoured..." . $conn->connect_error);
    }