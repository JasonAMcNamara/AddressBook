<?php

    $fName = $_GET["fName"];
    $lName = $_GET["lName"];
    $phone = $_GET["phone"]. "";
    $email = $_GET["email"];
    $address = $_GET["address"];
    $city = $_GET["city"];
    $province = $_GET["province"];
    $postal = $_GET["postal"];
    $dob = $_GET["dob"];
    
    
    echo $fName . "<br>".
    $lName. "<br>".
    $phone. "<br>".
    $email. "<br>".
    $address. "<br>".
    $city. "<br>".
    $province. "<br>".
    $postal. "<br>".
    $dob. "<br>";

    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = "";
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];

    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO $tblName (fName, lName, phone, email, address, city, province, postal, dob) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss", $fName, $lName, $phone, $email, $address, $city, $province, $postal, $dob);
    $stmt->execute();
    $stmt->close();
    
    $conn->close();
?>