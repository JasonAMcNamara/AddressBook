<?php

    $user = $_GET["username"];
    $pass = $_GET["password"];
    

    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = "";
    $dbName = $config["dbName"];
    $tblNameLogin = $config["tblNameLogin"];

    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;

    $sql = "SELECT id, username, password, hash FROM $tblNameLogin";

    $result = mysqli_query($conn, $sql) or die;

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify($pass, $row['hash']) == true && $user == $row['username']){
                header("Location: /project1/home");
                exit;
            }
        }
    } else {
        header("Location: /project1");
        exit;
    }
    $conn->close();
