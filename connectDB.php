<?php
    $username = "61900635";
    $pw = "61900635";
    $db = "db_61900635";
    $host = "localhost";

    $conn = new mysqli($host, $username, $pw, $db);

    if($conn->connect_error){
        die("Connection Error Occoured..." . $conn->connect_error);
    }