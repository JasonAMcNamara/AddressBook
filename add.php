<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $sessionUser = $_SESSION['user'];
    } else{
        session_destroy();
        header("Location: /project1");
        exit;
    }
    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = $config["password"];
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];

    $conn = mysqli_connect($servername, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO $tblName (fName, lName, phone, email, address, city, province, postal, dob, UserId) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssi", $fName, $lName, $phone, $email, $address, $city, $province, $postal, $dob, $id);
    
    $fName = $_GET["fName"];
    $lName = $_GET["lName"];
    $phone = $_GET["phone"];
    $email = $_GET["email"];
    $address = $_GET["address"];
    $city = $_GET["city"];
    $province = $_GET["province"];
    $postal = $_GET["postal"];
    $dob = $_GET["dob"];
    $id = $_SESSION['id'];
    
    
    $stmt->execute();
    $stmt->close();
    
    $conn->close();
    header("Location: /project1/home.php");
    exit;
    