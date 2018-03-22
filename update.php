<?php

    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = "";
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];

    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;
    $id=$_GET['id'];
    $fName = $_GET["fName"];
    $lName = $_GET["lName"];
    $phone = $_GET["phone"];
    $email = $_GET["email"];
    $address = $_GET["address"];
    $city = $_GET["city"];
    $province = $_GET["province"];
    $postal = $_GET["postal"];
    $dob = $_GET["dob"];

    $stmt = $conn->prepare("UPDATE $tblName SET fName=?, lName=?, phone=?, email=?, address=?, city=?, province=?, postal=?, dob=? WHERE id=$id");
    $stmt->bind_param("sssssssss", $fName, $lName, $phone, $email, $address, $city, $province, $postal, $dob);
    $stmt->execute();
      
    $stmt->close();
    $conn->close();
    header("Location: /project1/home");
    exit;
    